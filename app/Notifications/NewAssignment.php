<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewAssignment extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public $assignment)
    {
        $this->afterCommit();
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the type of the notification being broadcast.
     */
    public function broadcastType(): string
    {
        return 'broadcast.new-assignment';
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'read_at' => NULL,
            'student_id' => $notifiable->id,
            'assignment_id' => $this->assignment->id,
            'message' => "A new assignment has been published for your subject {$this->assignment->subject->title}" ,
            'title' => 'Assignment - ' . $this->assignment->title,
            'created_at' => Carbon::now()->toFormattedDateString(),
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }

    public function broadcastOn()
    {
        return new PrivateChannel('private-class.' . $this->assignment->class_id);
    }
}
