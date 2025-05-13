<?php

namespace App\Repositories\UserRole;

use App\Models\UserRole;

interface IUserRolesRepository {

    public function getById(int $id): ?UserRole;
}
