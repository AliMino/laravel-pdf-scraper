<?php

namespace App\Http\Controllers;


use App\Services\UsersService;
use App\Http\Requests\User\UserRegistrationRequest;
use App\Http\Requests\User\UserAuthenticationRequest;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


final class AuthenticationController extends Controller {

    public final function __construct(private UsersService $users) {}

    /**
     * @throws \App\Exceptions\API\EntityAlreadyExistsException If the specified email already in se by other user.
     */
    public final function signup(UserRegistrationRequest $request): JsonResponse {

        $user = $this->users->signup(
            
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );
        
        return response()->json([ 'status' => true, 'data' => $user ], Response::HTTP_CREATED);
    }

    /**
     * @throws \App\Exceptions\API\InvalidCredentialsException If the specified credentials are invalid.
     */
    public final function login(UserAuthenticationRequest $request): JsonResponse {

        $token = $this->users->generateAccessToken(
            
            $request->input('email'),
            $request->input('password')
        );
        
        return response()->json([ 'status' => true, 'data' => $token ]);
    }
}
