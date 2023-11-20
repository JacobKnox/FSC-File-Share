<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Warning;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $warnings = Warning::where('expired', '=', 0)->get();
            foreach($warnings as $warning)
            {
                $days = $warning->days_left - 1;
                if($days = 0)
                {
                    $warning->expired = 1;
                }
                $warning->days_left = $days;
                $warning->save();
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
