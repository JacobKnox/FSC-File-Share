<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Bug;
use Illuminate\Validation\Rule;

class UpdateBugRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $response = Gate::inspect('update-bug', Bug::find($this->bug_id));
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
            'category' => ['required', Rule::in(array_keys(config('mod.bug_categories')))],
            'intended' => 'required',
            'actual' => 'required',
            'page' => 'required|url',
            'other' => 'nullable',
        ];
    }
}
