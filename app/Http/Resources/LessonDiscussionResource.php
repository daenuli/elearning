<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class LessonDiscussionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $student = $this->studentLesson->student;

        return [
            'avatar' => $student->user->getAvatar(),
            'text' => $this->message,
            'user_name' => $student->name,
            'type' => $student->id === Auth::user()->student->id ? 'me' : 'you',
            'student_id' => $student->id,
            'created_at' => $this->created_at->format('h:i A')
        ];
    }
}
