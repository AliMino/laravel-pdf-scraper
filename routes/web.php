<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('', HomeController::class)->name('home');


Route::get('docs', function () {
    
    return view('docs.swagger');
});


Route::group([
    
    'prefix'        => 'auth',
    'controller'    => AuthenticationController::class,

], __DIR__ . '/web/auth.php');

Route::group([
        
    'prefix'        => 'url-scans',
    'controller'    => UrlScansController::class,

], __DIR__ . '/web/url-scans.php');
