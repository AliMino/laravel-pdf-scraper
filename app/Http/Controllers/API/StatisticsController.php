<?php

namespace App\Http\Controllers\API;

use App\Services\StatisticsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Statistics\StatisticsRetrievalRequest;

final class StatisticsController extends Controller {

    public final function __construct(private StatisticsService $statistics) {}
    
    public final function getStatistics(StatisticsRetrievalRequest $request) {

        $statistics = $this->statistics->all();

        return response()->json([ 'status' => true, 'data' => $statistics ]);
    }
}
