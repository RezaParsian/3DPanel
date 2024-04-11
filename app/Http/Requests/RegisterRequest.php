<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            User::PASSWORD => ['required', Password::default()],
            User::USERNAME => ['required', 'string', 'max:256', 'unique:users'],
        ];
    }
}
