<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'avatar' => ['nullable', File::image()],
        ];
    }
}
