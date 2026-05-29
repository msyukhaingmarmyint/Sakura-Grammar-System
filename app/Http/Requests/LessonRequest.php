<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lessons', 'title')->ignore($this->route('lesson')),
            ],
           'structure' => 'required|string|max:255',
            'explanation' => 'required|string|max:255',
           'example' => 'required|string|max:255',
            'level_id' => 'required|exists:levels,id',
        ];
    }
}
