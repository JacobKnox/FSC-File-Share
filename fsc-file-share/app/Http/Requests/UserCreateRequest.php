<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['student', 'faculty'])],
            'name' => 'required',
            'sid' => 'required|integer|min_digits:7|unique:users,sid',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|ends_with:@flsouthern.edu,@mocs.flsouthern.edu|unique:users,email',
            'pemail' => 'nullable|email|unique:users,pemail',
            'password' => 'required',
            'cpassword' => 'required|same:password',
            'terms' => 'accepted',
            'policy' => 'accepted',
        ];
    }
}
