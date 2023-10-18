<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BugCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true && config('requests.bugcreate');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category' => ['required', Rule::in(config('requests.bugs.categories'))],
            'intended' => 'required',
            'actual' => 'required',
            'page' => 'required|url',
            'other' => 'nullable',
        ];
    }
}
