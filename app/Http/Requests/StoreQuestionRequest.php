<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreQuestionRequest extends FormRequest
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
            'questions.*.text' => 'required',
            'questions.*.optionA' => 'required',
            'questions.*.optionB' => 'required',
            'questions.*.optionC' => 'required',
            'questions.*.optionD' => 'required',
            'questions.*.file' => File::image(),
            'questions.*.correctOption' => 'required',
        ];
    }

    public function messages() {
        return [
            'questions.*.text.required' => 'The question field cannot be empty.',
            'questions.*.optionA.required' => 'Option A field cannot be empty.',
            'questions.*.optionB.required' => 'Option B field cannot be empty.',
            'questions.*.optionC.required' => 'Option C field cannot be empty.',
            'questions.*.optionD.required' => 'Option D field cannot be empty.',
            'questions.*.correctOption.required' => 'Please select the correct option for this question.',
            'questions.*.file.image' => 'The file must be an image.'
        ];
    }
}
