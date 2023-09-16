<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignStudentToStudyGroupRequest extends FormRequest
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
            'studentIds' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'studentIds.required' => 'Please select atleast one student to add.'
        ];
    }
}
