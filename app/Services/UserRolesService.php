<?php

namespace App\Services;

use App\Models\UserRole;
use App\Exceptions\API\EntityNotFoundException;
use App\Repositories\UserRole\IUserRolesRepository;

final class UserRolesService {

    public final function __construct(private IUserRolesRepository $db) {}

    /**
     * @throws EntityNotFoundException If the specified user not found and the $throwIfNotFound parameter is set to true.
     */
    public final function getUserRoleById(int $id, bool $throwIfNotFound = true): ?UserRole {

        if (!is_null(value: $userRole = $this->db->getById($id))) {

            return $userRole;
        }

        if ($throwIfNotFound) {

            throw new EntityNotFoundException('UserRole');
        }
        
        return null;
    }
}
