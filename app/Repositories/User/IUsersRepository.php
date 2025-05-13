<?php

namespace App\Repositories\User;

use App\Models\User;

interface IUsersRepository {

    public function getUserByEmail(string $email): ?User;
    
    public function getById(int $id): ?User;
    
    public function createUser(string $name, string $email, string $password, int $userRoleId): User;
}
