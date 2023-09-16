<?php

namespace App\Http\Resources\Teacher;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionIndexResource extends JsonResource
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
            'text' => $this->text,
            'created_at' => $this->created_at,
            'assessment_id' => $this->assessment_id,
            'file' => $this->when(!is_null($this->getMediaModel()), $this->getFile()),
            'choices' => QuestionChoicesResource::collection($this->whenLoaded('choices'))
        ];
    }
}
