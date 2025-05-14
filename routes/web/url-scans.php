<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/**
 * ============================================
 * Web Routes for Processing URL Scans
 * ============================================
 */


Route::post('', 'requestUrlScan')->name('scan-url:web');

Route::prefix('{urlScanId}')->group(function () {

    Route::get('download', 'downloadUrlScan')->name('download-url-scan:web');
});
