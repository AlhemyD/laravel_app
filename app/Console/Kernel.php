<?php

   namespace App\Console;

   use Illuminate\Console\Scheduling\Schedule;
   use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
   use App\Console\Commands\PublishPostsCommand

   class Kernel extends ConsoleKernel
   {
       protected $commands = [CommandsPublishContent::class];

       protected function schedule(Schedule $schedule)
       {
           $schedule->command('posts:publish-auto')->everyMinute();
       }

       protected function commands()
       {
           $this->load(__DIR__.'/Commands');
		   $this->command(PublishPostsCommand::class)

           require base_path('routes/console.php');
       }
   }
   