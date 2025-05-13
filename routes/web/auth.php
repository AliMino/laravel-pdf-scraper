<?php

/**
 * Registration and Login Web Routes
 */

use Illuminate\Support\Facades\Route;


Route::get('register', 'showRegistrationForm')
     ->name('user-registration-form');

Route::post('register', 'submitRegistrationForm')
     ->name('user-registration-form-submission');

// ================================================================

Route::get('login', 'showLoginForm')
     ->name('user-login-form');

Route::post('login', 'submitLoginForm')
     ->name('user-login-form-submission');

// ================================================================

Route::get('logout', 'logout')
     ->name('user-logout');
