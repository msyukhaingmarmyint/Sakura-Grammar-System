<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
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
                'max:50',
                Rule::unique('exams', 'title')->ignore($this->route('exam')),
            ],
            'pass_mark' => 'required|integer|min:10|max:50',
            'level_id'  => 'required|exists:levels,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required'     => 'Please enter an exam title.',
            'title.unique'       => 'An exam with this title already exists.',
            'pass_mark.required' => 'The passing mark is required.',
            'pass_mark.integer'  => 'The passing mark must be a valid number. Text characters or words are not allowed.',
            'pass_mark.min'      => 'The passing mark cannot be less than 10.',
            'pass_mark.max'      => 'The passing mark cannot be greater than 50.',
            'level_id.required'  => 'Please select a difficulty level for this exam.',
            'level_id.exists'    => 'The selected difficulty level does not exist.',
        ];
    }
}
