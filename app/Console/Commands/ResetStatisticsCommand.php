<?php

namespace App\Console\Commands;

use App\Services\StatisticsService;
use Illuminate\Console\Command;

class ResetStatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Reset application's statistics stored in Redis";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(private StatisticsService $statistics)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {

        $this->statistics->clear();

        $this->info('Statistics reset successfully.');
        
        return 0;
    }
}
