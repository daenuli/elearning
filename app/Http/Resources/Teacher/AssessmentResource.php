<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Teacher\IndexQuestionResource;

class AssessmentResource extends JsonResource
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
            'title' => $this->title,
            'time_limit_in_minutes' => $this->time_limit_in_minutes,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_published' => $this->is_published,
            'class' => $this->whenLoaded('class'),
            'study_group' => $this->whenLoaded('study_group'),
            'subject' => $this->whenLoaded('subject'),
            'multiple_choice_questions' => QuestionIndexResource::collection($this->multiple_choice_questions()->with('choices')->whereHas('choices')->get()),
            'essay_questions' => QuestionIndexResource::collection($this->essay_questions)
        ];
    }
}
