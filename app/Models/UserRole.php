<?php

namespace App\Models;

use App\Enum\UserRole as UserRoleEnum;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property-read UserRoleEnum $enumCase
 * @property-read \Illuminate\Database\Eloquent\Collection<User> $users
 */
final class UserRole extends Model {

    public final function users() {

        return $this->hasMany(User::class);
    }

    public final function getEnumCaseAttribute(): UserRoleEnum {

        return UserRoleEnum::from($this->id);
    }
}
