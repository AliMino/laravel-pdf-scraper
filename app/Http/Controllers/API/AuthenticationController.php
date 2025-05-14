<?php

namespace App\Http\Controllers\API;

use App\Services\UsersService;
use App\Http\Requests\API\User\UserRegistrationRequest;
use App\Http\Requests\API\User\UserAuthenticationRequest;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticationController extends APIController {

    public final function __construct(private UsersService $users) {}

    public final function signup(UserRegistrationRequest $request): JsonResponse {

        $user = $this->users->signup(
            
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );

        return $this->getSuccessResponse($user, Response::HTTP_CREATED);
    }

    public final function login(UserAuthenticationRequest $request): JsonResponse {

        $token = $this->users->generateAccessToken(
            
            $request->input('email'),
            $request->input('password')
        );
        
        return $this->getSuccessResponse($token);
    }
}
