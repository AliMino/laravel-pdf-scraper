<?php

namespace App\Repositories\UrlScan;

use App\Models\UrlScan;

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

    public final function getById(int $id, bool $lock = false): ?UrlScan {

        $query = UrlScan::query();

        if ($lock) {

            $query->lockForUpdate();
        }

        $query->where('id', $id);

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
}
