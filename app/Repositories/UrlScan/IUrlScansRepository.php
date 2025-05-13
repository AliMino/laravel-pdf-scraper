<?php

namespace App\Repositories\UrlScan;

use App\Models\UrlScan;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use JsonSerializable;

interface IUrlScansRepository {

    public function getLatestUrlScan(?string $url = null, ?int $userId = null): ?UrlScan;

    public function createUrlScan(string $url, int $userId, int $urlScanStatusId): UrlScan;

    public function getById(int $id, ?int $userId, bool $lock = false): ?UrlScan;
    
    public function updateUrlScanStatus(int $id, int $urlScanStatusId): bool;
    
    public function setUrlScanFilename(int $id, string $filename): bool;

    public function getUrlScans(

        int     $userId,
        ?array  $urls            = null,
        ?string $fromDate        = null,
        ?string $toDate          = null,
        ?int    $recordsPerPage  = null
    ): ArrayAccess&Countable&IteratorAggregate&JsonSerializable;
}
