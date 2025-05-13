<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::group([
    
    'prefix'        => 'auth',
    'controller'    => APIAuthenticationController::class,

], __DIR__ . '/v1/auth.php');

Route::middleware('auth:api')->group(function() {

    Route::group([
        
        'prefix'        => 'url-scans',
        'controller'    => APIUrlScansController::class,

    ], __DIR__ . '/v1/url-scans.php');

    Route::get('statistics', [ APIStatisticsController::class, 'getStatistics' ])->name('get-statistics');
});
