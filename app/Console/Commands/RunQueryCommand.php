<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunQueryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // ALTER TABLE `umarazac_elearning`.`answers` ADD COLUMN `student_choice_id` TINYINT(1) NULL AFTER `type`; 

       DB::table('notifications')->delete();

        return Command::SUCCESS;
    }
}
