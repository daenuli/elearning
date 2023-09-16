<?php

namespace App\Console\Commands;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Console\Command;
use App\Notifications\NewAssignment;
use Illuminate\Support\Facades\Notification;

class SendNewAssignmentNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-new-assignment-notification';

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
        $students = Student::all(); // Replace with your logic to retrieve the students
        $assignment = Assignment::find(2);

        foreach ($students as $student) {
            $student->assignments()->attach($assignment->id, ['is_completed' => false]);
        }

        Notification::sendNow($students, new NewAssignment($assignment));

        $this->info('New assignment notifications sent to students.');

        return Command::SUCCESS;
    }
}
