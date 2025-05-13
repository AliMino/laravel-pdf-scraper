<?php

namespace App\Http\Controllers;

final class HomeController extends Controller {

    public final function __construct() {}

    public final function __invoke() {

        if (is_null(auth()->user())) {

            return redirect(route('user-login-form'));
        }

        return view('home');
    }
}
