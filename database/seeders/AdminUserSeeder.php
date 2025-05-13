<?php

namespace Database\Seeders;


use App\Enum\UserRole;
use App\Services\UsersService;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $usersService = app(UsersService::class);
        
        $adminData = config('app-admin');

        $usersService->signup(
            $adminData['name'],
            $adminData['email'],
            $adminData['password'],
            UserRole::Admin
        );
    }
}
