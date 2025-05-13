<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::group([
    
    'prefix'        => 'auth',
    'controller'    => APIAuthenticationController::class,

], __DIR__ . '/v1/auth.php');
