<?php

namespace App\Http\Requests\Questions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => ['required', 'string'],
            'o1' => ['required', 'string'],
            'o2' => ['required', 'string'],
            'o3' => ['required', 'string'],
            'o4' => ['required', 'string'],
            'answer' => ['required', 'numeric', Rule::in([1, 2, 3, 4])],
            'exam_id' => ['required', 'numeric'],
        ];
    }
}
