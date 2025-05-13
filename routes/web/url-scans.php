<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::prefix('{urlScanId}')->group(function () {

    Route::get('download', 'downloadUrlScan')->name('download-url-scan:web');
});

