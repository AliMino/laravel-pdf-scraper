<?php

namespace App\Console\Commands;

use Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\UrlScansService;
use App\Mail\UrlScanCompletionNotificationEmail;

use Throwable;

class NotifyForFinishedUrlScansCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify-for-finished-url-scans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for finished URL scans';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(private UrlScansService $urlScansService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {

        $unnotifiedUrlScans = $this->urlScansService->getUnnotifiedUrlScans();

        if (count($unnotifiedUrlScans) === 0) {

            $this->info('No unnotified URL scans found.');
            return 0;
        }

        foreach ($unnotifiedUrlScans as $urlScan) {

            try {

                Mail::to($urlScan->user->email)->send(
                    new UrlScanCompletionNotificationEmail($urlScan->user->name, $urlScan->url)
                );

                $this->info('URL scan completion email sent to: ' . $urlScan->user->email);

                $this->urlScansService->updateNotificationDate($urlScan->id, Carbon::now());

            } catch (Throwable $e) {
                
                $this->error($e->getMessage());
            }
        }

        return 0;
    }
}
