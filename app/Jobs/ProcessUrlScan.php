<?php

namespace App\Jobs;

use App\Enum\UrlScanStatus;
use App\Services\UrlScansService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUrlScan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private int $urlScanId) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        $urlScansService = app(UrlScansService::class);
        $urlScan = $urlScansService->getById($this->urlScanId, lock: true, throwIfNotFound: false);
        
        if (is_null($urlScan)) {

            return;
        }

        switch ($urlScan->urlScanStatus->enumCase) {

            case UrlScanStatus::Submitted:

                $urlScansService->processUrlScan($urlScan);
                return;
        }
    }
}
