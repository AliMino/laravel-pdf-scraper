<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class APIController extends Controller {

    protected final function getSuccessResponse(mixed $data, int $status = 200): JsonResponse {
        
        return response()->json([ 'status' => true, 'data' => $data ], $status);
    }
}
