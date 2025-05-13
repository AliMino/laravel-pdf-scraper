<?php

namespace App\Repositories\User;

use App\Models\User;

final class EloquentUsersRepository implements IUsersRepository {

    public final function getUserByEmail(string $email): ?User {

        return User::where('email', $email)
                   ->first();
    }

    public function getById(int $id): ?User {

        return User::find($id);
    }

    public final function createUser(string $name, string $email, string $password, int $userRoleId): User {

        $user = new User([
            'name'          => $name,
            'email'         => $email,
            'password'      => $password,
            'user_role_id'  => $userRoleId,
        ]);

        $user->save();

        return $user;
    }
}
