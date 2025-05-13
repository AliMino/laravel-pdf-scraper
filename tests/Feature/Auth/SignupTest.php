<?php

namespace Tests\Feature\Auth;

use App\Enum\UserRole;
use Database\Seeders\DatabaseSeeder;

use App\Services\UsersService;
use App\Exceptions\API\EntityAlreadyExistsException;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;

class SignupTest extends TestCase {

    use WithFaker;
    use RefreshDatabase;
    use DatabaseMigrations;

    protected string $seeder = DatabaseSeeder::class;

    public function setUp(): void {

        parent::setUp();

        $this->runDatabaseMigrations();
    }

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

    public function test_newly_registered_user_are_assigned_the_user_role() {

        $usersService = app(UsersService::class);

        $emailAddress = self::faker()->unique()->safeEmail();

        $this->assertDatabaseMissing("users", [
            
            "email" => $emailAddress,
        ]);

        $user = $usersService->signup(
            self::faker()->name(),
            $emailAddress,
            self::faker()->password(),
        );

        $this->assertDatabaseHas("users", [
            
            "email" => $emailAddress,
        ]);

        $this->assertNotNull($user->userRole);
        $this->assertEquals($user->userRole->enumCase, UserRole::User);
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
