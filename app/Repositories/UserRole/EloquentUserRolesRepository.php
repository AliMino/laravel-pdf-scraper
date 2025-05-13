<?php

namespace App\Repositories\UserRole;

use App\Models\UserRole;

final class EloquentUserRolesRepository implements IUserRolesRepository {

    public final function getById(int $id): ?UserRole {

        return UserRole::where('id', $id)->first();
    }
}
