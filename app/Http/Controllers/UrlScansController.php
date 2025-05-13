<?php

namespace App\Http\Controllers;

use App\Services\UrlScansService;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Validator;

final class UrlScansController extends Controller {

    public final function __construct(private UrlScansService $urlScans) {}

    public final function requestUrlScan(Request $request): RedirectResponse {

        if (is_null($request->user())) {

            return redirect(route('user-login-form'));
        }

        $validationErrors = Validator::make($request->all(), [
            'url' => 'required|url',
        ])->errors();

        if ($validationErrors->isNotEmpty()) {

            return redirect(route('home'))
                ->withInput($request->input())
                ->withErrors($validationErrors);
        }

        $this->urlScans->requestUrlScan($request->input('url'), userId: $request->user()->id);

        return redirect(route('home'));
    }

    public final function downloadUrlScan(Request $request, int $urlScanId): BinaryFileResponse|RedirectResponse {

        if (is_null($request->user())) {

            return redirect(route('user-login-form'));
        }
        
        return response()->download(
            $this->urlScans->getUrlScanFilename($urlScanId, userId: $request->user()->id),
            uniqid() . '.pdf'
        );
    }
}
