<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return true && config('requests.filefilter');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|array',
        ];
    }
}
