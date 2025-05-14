<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/**
 * Web Routes
 *
 * All web routes for the application are defined here.
 * The routes are grouped by their functionality for better organization.
 */


 
/*======*\
 * Home *
\*======*/

Route::get('', HomeController::class)->name('home');

/*=========================*\
 * Documentation & Manuals *
\*=========================*/

Route::group([], __DIR__ . '/web/docs.php');

/*===========*\
 * Statistics *
\*===========*/

Route::group([], __DIR__ . '/web/statistics.php');

/*===============================*\
 * Registration & Authentication *
\*===============================*/

Route::group([ 'prefix' => 'auth',      'controller' => AuthenticationController::class ], __DIR__ . '/web/auth.php');

/*===========*\
 * URL Scans *
\*===========*/

Route::group([ 'prefix' => 'url-scans', 'controller' => UrlScansController::class       ], __DIR__ . '/web/url-scans.php');
