<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Upcoming_events;
use Carbon\Carbon;

class DeletePastEvents extends Command
{
    protected $signature = 'events:delete-past';
    protected $description = 'Delete events that have passed the current date';

    public function handle()
    {
        $today = Carbon::today();
        $deletedCount = Upcoming_events::where('event_date', '<', $today)->delete();
        
        $this->info("Deleted {$deletedCount} past events.");
        return 0;
    }
}