<?php

namespace App\Http\Resources\Student;

use Illuminate\Http\Resources\Json\JsonResource;

class ActiveAssessmentsResource extends JsonResource
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
            'teacher_id' => $this->teacher_id,
            'class_id' => $this->class_id,
            'study_group_id' => $this->study_group_id,
            'title' => $this->title,
            'time_limit_in_minutes' => $this->time_limit_in_minutes,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_completed' => $this->end_date,
        ];
    }
}
