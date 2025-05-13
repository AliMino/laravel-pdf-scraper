<?php

namespace App\Repositories\User;

use App\Models\User;

final class EloquentUsersRepository implements IUsersRepository {

    public final function getUserByEmail(string $email): ?User {

        return User::where('email', $email)
                   ->first();
    }

    public final function createUser(string $name, string $email, string $password): User {

        $user = new User(compact('name', 'email', 'password'));

        $user->save();

        return $user;
    }
}
