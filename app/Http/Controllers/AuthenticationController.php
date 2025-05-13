<?php

namespace App\Http\Controllers;

use App\Services\UsersService;
use App\Http\Requests\User\UserRegistrationRequest;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthenticationController extends Controller {

    public final function __construct(private UsersService $users) {}

    public final function signup(UserRegistrationRequest $request): JsonResponse {

        $user = $this->users->signup(
            
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );
        
        return response()->json($user, Response::HTTP_CREATED);
    }
}
