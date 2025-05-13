<?php

/**
 * ============================================
 * API Routes for Processing URL Scans
 * ============================================
 */

use Illuminate\Support\Facades\Route;

Route::post('', 'requestUrlScan')->name('scan-url');

Route::get('', 'getUrlScans')->name('url-scans-list');

Route::prefix('{urlScanId}')->group(function () {

    Route::get('', 'getUrlScan')->name('get-url-scan');
    
    Route::get('download', 'downloadUrlScan')->name('download-url-scan');
});
