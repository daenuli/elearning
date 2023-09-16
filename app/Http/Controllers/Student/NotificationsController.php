<?php

namespace App\Http\Controllers\Student;

use Inertia\Inertia;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function index()
    {
        return Inertia::render('Student/Notifications', [
            'read_notifications' => student()->notifications()->whereNotNull('read_at')->orderBy('created_at', 'asc')->get(),
            'unread_notifications' => student()->unreadNotifications()->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function markAsRead(Request $request)
    {
        $notification = Notification::find($request->notificationId);

        $notification->markAsRead();

        $data               = $notification->data;
        $data['read_at']    = Carbon::now()->format('Y-m-y');

        $notification->data = $data;
        $notification->save();

        return redirect()->route('student.assignment.show', $notification->data['assignment_id']);
    }
}
