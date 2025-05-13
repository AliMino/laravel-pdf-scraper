<?php

namespace App\Enum;

enum StatisticsKey: string {

    case StartDate           = 'statstics_start_date';
    
    case UsersCount          = 'users_count';
    
    case SubmittedUrlsCount  = 'submitted_urls_count';
    
    case ProcessingUrlsCount = 'processing_urls_count';
    
    case ProcessedUrlsCount  = 'processed_urls_count';
    
    case FailedUrlsCount     = 'failed_urls_count';
    
    case ReusedUrlsCount     = 'reused_urls_count';

    public final function getInitialValue(): string {

        return match ($this) {
            self::StartDate           => now()->toDateTimeString(),
            self::UsersCount          => '0',
            self::SubmittedUrlsCount  => '0',
            self::ProcessingUrlsCount => '0',
            self::ProcessedUrlsCount  => '0',
            self::FailedUrlsCount     => '0',
            self::ReusedUrlsCount     => '0',
        };
    }
}
