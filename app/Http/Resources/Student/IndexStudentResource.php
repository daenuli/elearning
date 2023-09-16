<?php

namespace App\Http\Resources\Student;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexStudentResource extends JsonResource
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
            'student' => [
                'id' => $this->student->id,
                'NISN_number' => $this->student->NISN_number,
                'date_of_birth' => $this->student->date_of_birth,
                'place_of_birth' => $this->student->place_of_birth,
                'school_class' => [
                    'id' => $this->student->school_class->id,
                    'name' => $this->student->school_class->name,
                ],
                'study_group' => [
                    'id' => $this->student->study_group->id,
                    'name' => $this->student->study_group->name,
                ],
            ],
        ];
    }
}