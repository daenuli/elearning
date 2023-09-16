<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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

            'form.youtube_link' => ['required', 'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/', function ($attribute, $value, $fail) {
                $parts = parse_url($value);
                if (!isset($parts['query'])) {
                    return $fail('Invalid youtube link');
                }
                parse_str($parts['query'], $query);
                if (!isset($query['v'])) {
                    return $fail('Invalid youtube link');
                }
                $videoId = $query['v'];
                // Check if video id is valid or not
                // You can hit the youtube api to check if video exist or not
                // or you can check if the id is in correct format or not
                if (!preg_match('/^[A-Za-z0-9_-]{11}$/', $videoId)) {
                    return $fail('Invalid youtube link');
                }
            }],
        ];
    }
    public function messages()
    {
        return [
            'form.title.required' => 'The title field is required.', 
            'form.youtube_link.required' => 'The youtube link field is required.', 
            'form.class_id.required' => 'The class field is required.',
            'form.study_group_id.required' => 'The study group field is required.',
            'form.files.*.mimes' => 'The files must be a files of type: pdf, ppt.',
            'form.youtube_link.regex' => 'Invalid youtube link.',
        ];
    }
}
