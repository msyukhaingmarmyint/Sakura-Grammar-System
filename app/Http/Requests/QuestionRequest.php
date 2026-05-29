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
                'max:255',
                Rule::unique('questions', 'question')->ignore($this->route('question')),
            ],
            'a' => 'required|string|max:255',
            'b' => 'required|string|max:255',
            'c' => 'required|string|max:255',
            'd' => 'required|string|max:255',
            'correct_answer' => 'required|string|in:a,b,c,d',
            'exam_id' => 'required|exists:exams:id',
        ];
    }
}
