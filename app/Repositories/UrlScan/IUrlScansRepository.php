<?php

namespace App\Repositories\UrlScan;

use App\Models\UrlScan;

interface IUrlScansRepository {

    public function getLatestUrlScan(?string $url = null, ?int $userId = null): ?UrlScan;

    public function createUrlScan(string $url, int $userId, int $urlScanStatusId): UrlScan;

    public function getById(int $id, bool $lock = false): ?UrlScan;
    
    public function updateUrlScanStatus(int $id, int $urlScanStatusId): bool;
}
