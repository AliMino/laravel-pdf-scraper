<?php

/**
 * ============================================
 * API Routes for Processing URL Scans
 * ============================================
 */

use Illuminate\Support\Facades\Route;

Route::post('', 'requestUrlScan')->name('scan-url');
