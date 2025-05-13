<?php

namespace App\Http\Controllers;

final class StatisticsController extends Controller {

    public final function __construct() {}

    public final function __invoke() {

        if (is_null(auth()->user())) {

            return redirect(route('user-login-form'));
        }

        // DUMMY DATA
        $statistics = [

            'statstics_start_date'  => now(),
            'users_count'           => rand(0, 100),
            'submitted_urls_count'  => rand(0, 100),
            'processing_urls_count' => rand(0, 100),
            'processed_urls_count'  => rand(0, 100),
            'failed_urls_count'     => rand(0, 100),
            'reused_urls_count'     => rand(0, 100),
        ];

        return view('statistics', [ 'statistics' => $statistics ]);
    }
}

