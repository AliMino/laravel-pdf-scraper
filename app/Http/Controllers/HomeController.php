<?php

namespace App\Http\Controllers;

use App\Services\UrlScansService;

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
