<?php

namespace App\Repositories\UrlScanStatus;

use App\Models\UrlScanStatus;

interface IUrlScanStatusesRepository {

    public function getById(int $id): ?UrlScanStatus;
}
