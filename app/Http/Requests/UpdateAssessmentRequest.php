<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssessmentRequest extends FormRequest
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
            'form.title' => 'required',
            'form.class_id' => 'required',
            'form.study_group_id' => 'required',
            'form.end_date' => 'required|date|after:form.start_date',
        ];
    }
    public function messages()
    {
        return [
            'form.class_id.required' => 'The class field is required.',
            'form.study_group_id.required' => 'The study group field is required.',
            'form.end_date' => 'The Schedule To must be a date after Schedule From.',
        ];
    }
}
