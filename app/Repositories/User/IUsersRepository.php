<?php

namespace App\Repositories\User;

use App\Models\User;

interface IUsersRepository {

    public function getUserByEmail(string $email): ?User;
    
    public function createUser(string $name, string $email, string $password): User;
}
