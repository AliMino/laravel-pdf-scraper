<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Statistics\StatisticsRetrievalRequest;
use App\Services\StatisticsService;

final class APIStatisticsController extends Controller {

    public final function __construct(private StatisticsService $statistics) {}
    
    public final function getStatistics(StatisticsRetrievalRequest $request) {

        $statistics = $this->statistics->all();

        return response()->json([ 'status' => true, 'data' => $statistics ]);
    }
}
