<?php

namespace App\Http\Controllers\API;

use App\Services\UrlScansService;
use App\Http\Requests\API\URL\URLScanRequest;
use App\Http\Requests\API\URL\URLScanRetrievalRequest;
use App\Http\Requests\API\URL\URLScansRetrievalRequest;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

final class UrlScansController extends APIController {

    public final function __construct(private UrlScansService $urlScans) {}

    public final function requestUrlScan(URLScanRequest $request): JsonResponse {

        $urlScan = $this->urlScans->requestUrlScan(
            $request->input('url'),
            $request->user()->id
        );

        return $this->getSuccessResponse($urlScan, Response::HTTP_CREATED);
    }

    public final function getUrlScans(URLScansRetrievalRequest $request): JsonResponse {

        $urlScans = $this->urlScans->getUrlScans(
            $request->user()->id,
            $request->input('urls'),
            $request->input('from_date'),
            $request->input('to_date'),
            config('url-scans.api.recordsPerPage')
        );
        
        return $this->getSuccessResponse($urlScans);
    }

    public final function getUrlScan(URLScanRetrievalRequest $request, int $urlScanId): JsonResponse {

        $urlScan = $this->urlScans->getById($urlScanId, userId: $request->user()->id);
        
        return $this->getSuccessResponse($urlScan);
    }

    public final function downloadUrlScan(URLScanRetrievalRequest $request, int $urlScanId): BinaryFileResponse {

        return response()->download(
            $this->urlScans->getUrlScanFilename($urlScanId, userId: $request->user()->id),
            uniqid() . '.pdf'
        );
    }
}
