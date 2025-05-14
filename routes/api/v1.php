<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Route;

/**
 * =============
 * API V1 Routes
 * =============
 */


Route::group([ 'prefix' => 'auth', 'controller' => AuthenticationController::class ], __DIR__ . '/v1/auth.php');

Route::middleware('auth:api')->group(function() {

    Route::group([ 'prefix' => 'url-scans', 'controller' => UrlScansController::class ], __DIR__ . '/v1/url-scans.php');

    Route::get('statistics', [ StatisticsController::class, 'getStatistics' ])->name('get-statistics');
});
