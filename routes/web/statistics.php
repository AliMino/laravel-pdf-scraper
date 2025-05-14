<?php

use Illuminate\Support\Facades\Route;

Route::get('statistics', App\Http\Controllers\Web\StatisticsController::class)->name('app-statistics');
