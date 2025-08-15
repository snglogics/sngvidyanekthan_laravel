<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\upcoming_events;
class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Delete anything before today (keeps today's events)
        $schedule->call(function () {
            upcoming_events::whereDate('event_date', '<', today())->delete();
        })->hourly(); // use everyMinute() while testing if you want
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}


