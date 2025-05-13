<?php

namespace App\Repositories\UrlScan;

use App\Models\UrlScan;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

final class EloquentUrlScansRepository implements IUrlScansRepository {

    public final function getLatestUrlScan(?string $url = null, ?int $userId = null): ?UrlScan {

        $query = UrlScan::query();

        if (!is_null($userId)) {

            $query->where('user_id', $userId);
        }

        if (!is_null($url)) {
            
            $query->where('url', $url);
        }

        return $query->orderBy('created_at','desc')->first();
    }

    public final function createUrlScan(string $url, int $userId, int $urlScanStatusId): UrlScan {

        $urlScan = new UrlScan([
            'url'                => $url,
            'user_id'            => $userId,
            'url_scan_status_id' => $urlScanStatusId,
        ]);

        $urlScan->save();

        return $urlScan;
    }

    public final function getById(int $id, ?int $userId, bool $lock = false): ?UrlScan {

        $query = UrlScan::query();

        if ($lock) {

            $query->lockForUpdate();
        }

        $query->where('id', $id);

        if (!is_null($userId)) {

            $query->where('user_id', $userId);
        }

        return $query->first();
    }

    public final function updateUrlScanStatus(int $id, int $urlScanStatusId): bool {

        return 0 < UrlScan::where('id', $id)
                          ->update(['url_scan_status_id' => $urlScanStatusId]);
    }

    public final function setUrlScanFilename(int $id, string $filename): bool {

        return 0 < UrlScan::where('id', $id)
                          ->update(['filename' => $filename]);
    }

    public final function getUrlScans(

        int     $userId,
        ?array  $urls            = null,
        ?string $fromDate        = null,
        ?string $toDate          = null,
        ?int    $recordsPerPage  = null
    ): ArrayAccess&Countable&IteratorAggregate&JsonSerializable {

        $query = UrlScan::where('user_id', $userId);

        if (!is_null($urls)) {

            $query->whereIn('url', $urls);
        }

        if (!is_null($fromDate)) {

            $query->where('created_at', '>=', $fromDate);
        }

        if (!is_null($toDate)) {

            $query->where('created_at', '<=', $toDate);
        }

        return is_null($recordsPerPage) ? $query->get() : $query->paginate($recordsPerPage);
    }
}
