<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest
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
            'files.*' => File::types(['pdf', 'ppt', 'pptx']),
        ];
    }

    public function messages()
    {
        return [
            'class_id.required' => 'The class field is required.',
            'study_group_id.required' => 'The study group field is required.',
            'files.*.mimes' => 'The files must be a files of type: pdf, ppt.',
        ];
    }
}
