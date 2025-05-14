<?php

use Illuminate\Support\Facades\Route;

Route::get('statistics', App\Http\Controllers\StatisticsController::class)->name('app-statistics');
