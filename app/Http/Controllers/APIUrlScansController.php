<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\URL\URLScanRequest;
use App\Services\UrlScansService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class APIUrlScansController extends Controller {

    public final function __construct(private UrlScansService $urlScans) {}

    public final function requestUrlScan(URLScanRequest $request): JsonResponse {

        $urlScan = $this->urlScans->requestUrlScan(
            $request->input('url'),
            $request->user()->id
        );

        return response()->json($urlScan, Response::HTTP_CREATED);
    }
}
