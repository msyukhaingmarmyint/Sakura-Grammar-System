<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
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
            'question' => [
                'required',
                'string',
                Rule::unique('questions', 'question')->ignore($this->route('question')),
            ],
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'correct_answer' => 'required',
            'exam_id' => 'required',
        ];
    }
}
