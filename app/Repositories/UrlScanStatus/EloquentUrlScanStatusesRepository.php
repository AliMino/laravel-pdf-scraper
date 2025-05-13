<?php

namespace App\Repositories\UrlScanStatus;

use App\Models\UrlScanStatus;

final class EloquentUrlScanStatusesRepository implements IUrlScanStatusesRepository {

    public final function getById(int $id): ?UrlScanStatus {

        return UrlScanStatus::find($id);
    }
}
