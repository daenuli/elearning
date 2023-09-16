<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexTeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'teacher' => [
                'id' => $this->teacher->id,
                'date' => $this->teacher->date,
                'gender' => $this->teacher->gender,
                'religion' => $this->teacher->religion,
                'education' => $this->teacher->education,
                'appointment_decree' => $this->teacher->appointment_decree,
            ],
        ];
    }
}