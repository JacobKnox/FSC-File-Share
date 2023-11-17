<?php

namespace App\Http\Requests;

use App\Models\Like;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteLikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $response = Gate::inspect('delete-like', Like::where(['file_id' => $this->file_id, 'user_id' => $this->user_id])->first());
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
            //
        ];
    }
}
