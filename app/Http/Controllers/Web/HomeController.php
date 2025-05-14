<?php

namespace App\Http\Controllers\Web;

use App\Services\UrlScansService;
use App\Http\Controllers\Controller;

final class HomeController extends Controller {

    public final function __construct() {}

    public final function __invoke(UrlScansService $urlScansService) {

        if (is_null(auth()->user())) {

            return redirect(route('user-login-form'));
        }

        $urlScans = $urlScansService->getUrlScans(auth()->user()->id, recordsPerPage: config('url-scans.web.recordsPerPage'));
        
        return view('home', compact('urlScans'));
    }
}
