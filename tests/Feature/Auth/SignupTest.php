<?php

namespace Tests\Feature\Auth;

use App\Services\UsersService;
use App\Exceptions\API\EntityAlreadyExistsException;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class SignupTest extends TestCase {

    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register_with_unique_email() {

        $usersService = app(UsersService::class);

        $emailAddress = self::faker()->unique()->safeEmail();

        $this->assertDatabaseMissing("users", [
            
            "email" => $emailAddress,
        ]);

        $usersService->signup(
            self::faker()->name(),
            $emailAddress,
            self::faker()->password(),
        );

        $this->assertDatabaseHas("users", [
            
            "email" => $emailAddress,
        ]);
    }

    public function test_user_cannot_register_with_used_email() {

        $usersService = app(UsersService::class);

        $emailAddress = self::faker()->unique()->safeEmail();

        $this->assertDatabaseMissing("users", [
            
            "email" => $emailAddress,
        ]);

        $usersService->signup(
            self::faker()->name(),
            $emailAddress,
            self::faker()->password(),
        );

        $this->assertDatabaseHas("users", [
            
            "email" => $emailAddress,
        ]);

        $this->expectException(EntityAlreadyExistsException::class);

        $usersService->signup(
            self::faker()->name(),
            $emailAddress,
            self::faker()->password(),
        );
    }
}
