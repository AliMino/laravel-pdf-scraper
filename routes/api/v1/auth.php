<?php

/**
 * ============================================
 * API Routes for Registration & Authentication
 * ============================================
 */

use Illuminate\Support\Facades\Route;

Route::post('signup', 'signup')->name('api-signup');

Route::post('login', 'login')->name('api-login');
