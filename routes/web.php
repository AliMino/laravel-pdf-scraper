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

Route::get('statistics', StatisticsController::class)->name('statistics-view');
