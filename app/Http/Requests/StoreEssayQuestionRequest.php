<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreEssayQuestionRequest extends FormRequest
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
            'questions.*.file' => File::image(),
        ];
    }

    public function messages() {
        return [
            'questions.*.text.required' => 'The question field cannot be empty.',
            'questions.*.file.image' => 'The file must be an image.'
        ];
    }
}
