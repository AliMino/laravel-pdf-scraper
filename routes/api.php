<?php

use Illuminate\Support\Facades\Route;

Route::group([ 'prefix' => 'v1' ], __DIR__ . '/api/v1.php');
