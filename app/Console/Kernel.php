<?php

namespace App\Console;

use App\Http\Controllers\Admin\HoroscopeController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('chatinteraction:cron')->everyThirtySeconds();
        $schedule->command('puja:send-reminders');
        // ->everyMinute()
        // ->withoutOverlapping();
        // 🗓️ Run daily horoscope generation every day at 12:10 AM
        $schedule->call(function () {
            $controller = new HoroscopeController();
            $controller->generateDailyHorscope();
        })->dailyAt('00:10')->withoutOverlapping();

        // 📅 Run weekly horoscope generation every Monday at 12:30 AM
        $schedule->call(function () {
            $controller = new HoroscopeController();
            $controller->generateWeeklyHorscope();
        })->weeklyOn(1, '00:30')->withoutOverlapping();
        // weeklyOn(1, '00:30') => Monday (1) at 00:30

        // 📆 Run yearly horoscope generation every January 1st at 1:00 AM
        $schedule->call(function () {
            $controller = new HoroscopeController();
            $controller->generateYearlyHorscope();
        })->yearlyOn(1, 1, '01:00')->withoutOverlapping();


        // Add new scheduled notifications cron
        $schedule->command('notifications:send-scheduled')->everyMinute()->withoutOverlapping();
        $schedule->command('call-chat:delete')->everyFiveMinutes()->withoutOverlapping();
        $schedule->command('reset:astro-free-paid')->daily()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
