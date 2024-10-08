<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;

class PasswordChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $response = Gate::inspect('update-user', User::find($this->user_id));
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
            'password' => 'required|current_password',
            'npassword' => 'required|different:password',
            'cpassword' => 'required|same:npassword',
        ];
    }
}
