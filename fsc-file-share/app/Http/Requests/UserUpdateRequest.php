<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (User::find($this->user_id) == $this->user()) && config('requests.userupdate');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required' . ($this->username != $this->user()->username ? '|unique:users,username' : ''),
            'pemail' => 'nullable|email' . ($this->pemail != $this->user()->pemail ? '|unique:users,pemail' : ''),
        ];
    }
}
