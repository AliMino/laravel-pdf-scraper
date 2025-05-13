<?php

namespace Database\Seeders;

use App\Enum\UserRole as UserRoleEnum;
use App\Models\UserRole as UserRoleModel;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder {
    
    public function run() {

        UserRoleModel::insert(array_map(
            fn (UserRoleEnum $userRoleEnumCase) => [
                
                'id'   => $userRoleEnumCase->value,
                'name' => $userRoleEnumCase->name,
            ],
            UserRoleEnum::cases()
        ));
    }
}
