<?php

namespace App\Models;

use App\Enum\UrlScanStatus as UrlScanStatusEnum;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property-read UrlScanStatusEnum $enumCase
 * @property-read \Illuminate\Database\Eloquent\Collection<User> $users
 */
final class UrlScanStatus extends Model {

    public final function users() {

        return $this->hasMany(User::class);
    }

    public final function getEnumCaseAttribute(): UrlScanStatusEnum {

        return UrlScanStatusEnum::from($this->id);
    }
}
