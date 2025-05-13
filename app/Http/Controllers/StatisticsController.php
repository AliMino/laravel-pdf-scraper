<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Services\UsersService;
use App\Services\StatisticsService;

final class StatisticsController extends Controller {

    public final function __construct() {}

    public final function __invoke(StatisticsService $statisticsService, UsersService $usersService) {

        if (is_null(auth()->user())) {

            return redirect(route('user-login-form'));
        }

        $usersService->assertUserOfType(auth()->user()->id, UserRole::Admin);

        $statistics = $statisticsService->all();

        return view('statistics', [ 'statistics' => $statistics ]);
    }
}

