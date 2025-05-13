<?php

namespace Tests\Feature\Auth;

use App\Services\UsersService;
use App\Exceptions\API\InvalidCredentialsException;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginTest extends TestCase {

    use WithFaker;
    use RefreshDatabase;

    public function test_existing_user_can_generate_valid_access_tokens() {

        $usersService = app(UsersService::class);

        // Create a new user to login with
        $emailAddress = self::faker()->unique()->safeEmail();
        $password     = self::faker()->password();

        $this->assertDatabaseMissing("users", [ "email" => $emailAddress ]);
        $user = $usersService->signup(
            self::faker()->name(),
            $emailAddress,
            $password,
        );
        $this->assertDatabaseHas("users", [ "email" => $emailAddress ]);

        $token = $usersService->generateAccessToken($emailAddress, $password);

        $this->assertIsString($token);
        $this->assertNotEmpty($token);

        $payload = JWTAuth::setToken($token)->getPayload();

        $this->assertEquals($payload->get('sub'), $user->id);
    }

    public function test_invalid_credentials_result_in_error() {

        $usersService = app(UsersService::class);

        $emailAddress = self::faker()->unique()->safeEmail();
        $password     = self::faker()->password();

        $this->assertDatabaseMissing("users", [ "email" => $emailAddress ]);
        $this->expectException(InvalidCredentialsException::class);
        
        $usersService->generateAccessToken($emailAddress, $password);
    }
}
