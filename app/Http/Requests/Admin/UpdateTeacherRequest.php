<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateTeacherRequest extends FormRequest
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
            'form.name' => 'required',
            'form.date' => 'required',
            'form.religion' => 'required',
            'form.education' => 'required',
            'form.appointment_decree' => 'required',
            'form.avatar' => ['nullable', File::image()],
            'form.password' => ['nullable', 'confirmed', Password::defaults()],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'form.password.required' => 'The password field is required.',
            'form.password' => 'The password confirmation deos not match.',
        ];
    }
}
