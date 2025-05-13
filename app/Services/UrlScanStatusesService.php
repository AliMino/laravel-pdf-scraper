<?php

namespace App\Services;

use App\Enum\UrlScanStatus as UrlScanStatusEnum;
use App\Exceptions\API\EntityNotFoundException;
use App\Models\UrlScanStatus;
use App\Repositories\UrlScanStatus\IUrlScanStatusesRepository;

final class UrlScanStatusesService {

    public final function __construct(private IUrlScanStatusesRepository $db) {}

    public final function getById(int|UrlScanStatusEnum $id, bool $throwIfNotFound = true): ?UrlScanStatus {

        if (!is_null($urlScanStatus = $this->db->getById(is_int($id) ? $id : $id->value))) {

            return $urlScanStatus;
        }

        if ($throwIfNotFound) {

            throw new EntityNotFoundException('UrlScanStatus');
        }
        
        return null;
    }
}
