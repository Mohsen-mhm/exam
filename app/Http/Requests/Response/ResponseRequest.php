<?php

namespace App\Http\Requests\Response;

use Illuminate\Foundation\Http\FormRequest;

class ResponseRequest extends FormRequest
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
        $rules = [];
        foreach ($this->request->all() as $key => $value) {
            if (strpos($key, 'q_') === 0 && $value !== null) {
                $rules[$key] = ['integer','in:1,2,3,4'];
            }
        }
        return $rules;
    }
}
