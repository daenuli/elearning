<?php

namespace App\Console;

use App\Console\Commands\RunQueryCommand;
use App\Invokable\ClearNotificationsTable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run an artisan command on live server using cron
        $schedule->command('queue:work')->cron('* * * * *');
        
        // Run an artisan command using the command's class name
        $schedule->call(RunQueryCommand::class)->everyMinute();

        // Schedule an Invokable object
        $schedule->call(ClearNotificationsTable::class)->everyMinute();

        // Run Shell commands
        $schedule->exec('mkdir App\ANewFolder')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
