<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\File;

class FileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return File::findOrFail(last($this->segments()))->user_id == $this->user()->id && config('requests.fileupdate');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string' . (File::findOrFail(last($this->segments()))->title != $this->title ? '|unique:files,title' : ''),
            'description' => 'required|string',
            'downloads' => 'nullable',
            'comments' => 'nullable',
            'likes' => 'nullable',
            'tags' => 'nullable|array',
        ];
    }
}
