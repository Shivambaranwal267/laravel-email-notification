<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\AbandonedCartEmail::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Run abandoned cart command every 5 minutes
        $schedule->command('cart:send-email')->everyMinute();

    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
