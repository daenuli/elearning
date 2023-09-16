<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentRequest extends FormRequest
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
            'form.start_date' => 'required',
            'form.end_date' => 'required',
            'form.files.*' => File::types(['pdf', 'ppt', 'pptx']),
        ];
    }

    public function messages()
    {
        return [
            'form.class_id.required' => 'The class field is required.',
            'form.study_group_id.required' => 'The study group field is required.',
            'form.files.*.mimes' => 'The files must be a files of type: pdf, ppt.',
        ];
    }
}
