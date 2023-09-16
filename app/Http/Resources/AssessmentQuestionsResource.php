<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssessmentQuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $answer = $this->type === 'Multiple Choice' 
            ? $this->answer->choice->text
            : $this->answer->essay_answer_text; 

        return [
            'id' => $this->id,
            'text' => $this->text,
            'type' => $this->type,
            'options' => $this->when($this->type === 'Multiple Choice', $this->choices()->select('id', 'text')->get()->toArray()),
            'correct_answer' => $this->correctOption(),
            'student_answer' => $answer
        ];
    }
}
