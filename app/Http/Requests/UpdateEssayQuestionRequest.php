<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateEssayQuestionRequest extends FormRequest
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
            'form.text' => 'required',
            'form.file' => ['nullable', File::image()],
        ];
    }

    public function messages() {
        return [
            'form.text.required' => 'The question field cannot be empty.',
            'form.file.image' => 'The file must be an image.'
        ];
    }
}
