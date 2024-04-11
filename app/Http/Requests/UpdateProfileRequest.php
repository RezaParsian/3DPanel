<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            User::NAME => ['required', 'string', 'max:256'],
            User::PASSWORD => ['nullable', Password::default()],
            User::USERNAME => ['nullable', 'string', 'max:256', 'unique:users,id,'.Auth::id()],
        ];
    }
}
