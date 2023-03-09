<?php

namespace App\Http\Requests\Admin\Exams;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string'],
            'start_at' => ['required', 'date_format:Y-m-d H:i'],
            'finish_at' => ['required', 'date_format:Y-m-d H:i'],
            'time' => ['required', 'numeric'],
        ];
    }
}
