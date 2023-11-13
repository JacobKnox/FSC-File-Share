<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;

class FileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $response = Gate::inspect('update-file', File::find($this->file_id));
        if($response->allowed())
        {
            return true;
        }
        throw new HttpResponseException(
            back()->with('auth_error', $response->message())
        );
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
