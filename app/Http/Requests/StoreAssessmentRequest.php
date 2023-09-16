<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssessmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'class_id' => 'required',
            'study_group_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'time_limit_in_minutes' => 'required',
            'end_date' => 'required|date|after:start_date',
        ];
    }
    public function messages()
    {
        return [
            'class_id.required' => 'The class field is required.',
            'study_group_id.required' => 'The study group field is required.',
            'end_date' => 'The Schedule To must be a date after Schedule From.',
            'time_limit_in_minutes.required' => 'The time limit field is required.',
        ];
    }
}
