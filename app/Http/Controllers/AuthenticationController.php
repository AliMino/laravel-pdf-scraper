<?php

namespace App\Http\Controllers;

use App\Services\UsersService;

use Illuminate\Http\Request;

use Validator;

final class AuthenticationController extends Controller {

    public final function showRegistrationForm() {

        return view('auth.registration');
    }

    public final function submitRegistrationForm(Request $request, UsersService $users) {

        $validationErrors = Validator::make($request->all(), [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ])->errors();

        if ($validationErrors->isNotEmpty()) {

            return redirect(route('user-registration-form'))
                ->withInput($request->input())
                ->withErrors($validationErrors);
        }
        
        $users->signup(
            
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );

        return redirect(route('home'));
    }

    public final function showLoginForm() {

        return view('auth.login');
    }
}
