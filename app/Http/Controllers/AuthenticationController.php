<?php

namespace App\Http\Controllers;


use App\Services\UsersService;

use Auth;
use Validator;
use Illuminate\Http\Request;


final class AuthenticationController extends Controller {

    public final function showRegistrationForm() {

        if (!is_null(auth()->user())) {

            return redirect(route('home'));
        }

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

        if (!is_null(auth()->user())) {

            return redirect(route('home'));
        }

        return view('auth.login');
    }

    public final function submitLoginForm(Request $request) {

        $validationErrors = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string',
        ])->errors();

        if ($validationErrors->isNotEmpty()) {

            return redirect(route('user-login-form'))
                ->withInput($request->input())
                ->withErrors($validationErrors);
        }

        if (Auth::attempt($request->only('email', 'password'))) {

            return redirect(route('home'));
        }

        return redirect(route('user-login-form'))
            ->withErrors([ 'invalidCredentials' => 'Invalid credentials provided.' ])
            ->withInput([ 'email' => $request->input('email') ]);
    }

    public final function logout() {

        Auth::logout();

        return redirect(route('user-login-form'));
    }
}
