<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\File;
use Illuminate\Support\Facades\Gate;

class FileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update-file', [File::findOrFail($this->file_id)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string' . (File::find($this->file_id)?->title != $this->title ? '|unique:files,title' : ''),
            'description' => 'required|string',
            'downloads' => 'nullable',
            'comments' => 'nullable',
            'likes' => 'nullable',
            'tags' => 'nullable|array',
        ];
    }
}
