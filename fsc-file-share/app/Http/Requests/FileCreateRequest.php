<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FileCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && config('requests.filecreate');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:files,title',
            'description' => 'required|string',
            'file' => 'required',
            'downloads' => 'nullable',
            'comments' => 'nullable',
            'likes' => 'nullable',
            'tags' => 'nullable|array',
            'plagiarism' => 'required|accepted',
        ];
    }
}
