<?php

namespace Database\Seeders;

use App\Enum\UrlScanStatus as UrlScanStatusEnum;
use App\Models\UrlScanStatus as UrlScanStatusModel;

class UrlScanStatusesSeeder extends EnumSeeder {

    protected string $modelClass = UrlScanStatusModel::class;
    protected string $enumClass  = UrlScanStatusEnum::class;
}
