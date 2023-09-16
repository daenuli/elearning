<?php
namespace App\Http\Controllers\Student;


use Inertia\Inertia;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Events\NewAssignmentCreated;
use App\Http\Controllers\Controller;
use App\Notifications\NewAssignment;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{
    public function index(Request $request)
    {
        $student = Auth::user()->student;
        return Inertia::render('Student/Pusher', [
            'student' => $student->load('user')
        ]);
    }

    public function sendNotification()
    {
        $student = Auth::user()->student;
        $assignment = Assignment::find(1);

		$student->notify(new NewAssignment($assignment));


        // event(new NewAssignmentCreated($assignment));

        return 'Notification sent.';
    }
}