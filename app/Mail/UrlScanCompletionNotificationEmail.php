<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UrlScanCompletionNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private string $username, private string $scannedUrl) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        return $this->from(config('url-scans.notificationEmail.from'))
                    ->subject(config('url-scans.notificationEmail.subject'))
                    
                    ->view('emails.url-scan-completed-email')
                    
                    ->with('username', $this->username)
                    ->with('scannedUrl', $this->scannedUrl);
    }
}
