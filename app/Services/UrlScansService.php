<?php

namespace App\Services;

use App\Enum\UserRole;
use App\Enum\UrlScanStatus;

use App\Models\UrlScan;
use App\Jobs\ProcessUrlScan;
use App\Repositories\UrlScan\IUrlScansRepository;

use App\Exceptions\API\EntityNotFoundException;
use App\Exceptions\API\UrlScanInProgressException;
use App\Exceptions\API\InvalidUrlScanStatusException;


use DB;
use Ramsey\Uuid\Uuid;
use Spatie\Browsershot\Browsershot;

use Throwable;

final class UrlScansService {

    public final function __construct(
        
        private IUrlScansRepository     $db,
        private UsersService            $users,
        private UrlScanStatusesService  $urlScanStatuses
    ) {}

    public final function requestUrlScan(string $url, int $userId): UrlScan {

        if (!is_null($latestUrlScan = $this->getLatestUrlScan($url, $userId))) {

            switch ($latestUrlScan->urlScanStatus->enumCase) {

                case UrlScanStatus::Submitted:  // soon to be processed
                case UrlScanStatus::Processing: // in progress
                    throw new UrlScanInProgressException();
                
                case UrlScanStatus::Processed:  // already processed within the expiration time

                    if ($latestUrlScan->updated_at->diffInMinutes() <= config('url-scans.url_scan_expiration_minutes')) {

                        return $latestUrlScan;
                    }
            }
        }

        $submittedUrlScanStatus = $this->urlScanStatuses->getById(UrlScanStatus::Submitted);
        
        $urlScan = $this->db->createUrlScan($url, $userId, $submittedUrlScanStatus->id);

        ProcessUrlScan::dispatch($urlScan->id);

        return $urlScan->load('urlScanStatus');
    }

    public final function getLatestUrlScan(?string $url = null, ?int $userId = null): ?UrlScan {

        if (!is_null($userId)) {

            $this->users->assertUserOfType($userId, UserRole::User);
        }

        return $this->db->getLatestUrlScan($url, $userId);
    }

    public final function getById(int $id, bool $lock = false, bool $throwIfNotFound = true): ?UrlScan {

        if (!is_null($urlScan = $this->db->getById($id, $lock))) {

            return $urlScan;
        }

        if ($throwIfNotFound) {
            
            throw new EntityNotFoundException('UrlScan');
        }

        return null;
    }

    public final function processUrlScan(UrlScan $urlScan): UrlScan {

        if ($urlScan->urlScanStatus->enumCase != UrlScanStatus::Submitted) {

            throw new InvalidUrlScanStatusException();
        }

        return DB::transaction(function() use ($urlScan) {

            $this->db->updateUrlScanStatus($urlScan->id, UrlScanStatus::Processing->value);

            $urlScan = $this->getById($urlScan->id, lock: true);

            try {

                $browserShot = Browsershot::url($urlScan->url)->noSandbox();
                $storageDir = storage_path(config('url-scans.storageDir'));
                $filename = UUid::uuid4() . '.pdf';

                $browserShot->save($storageDir . DIRECTORY_SEPARATOR . $filename);

                $this->db->setUrlScanFilename($urlScan->id, $filename);

                $this->db->updateUrlScanStatus($urlScan->id, UrlScanStatus::Processed->value);

                //TODO: Notify the user about the URL scan completion

            } catch (Throwable $_) {

                $this->db->updateUrlScanStatus($urlScan->id, UrlScanStatus::Failed->value);
            }

            return $this->getById($urlScan->id);
        });
    }
}
