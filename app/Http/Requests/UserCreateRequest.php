<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'alpha', 'max:125'],
            'last_name' => ['required', 'alpha', 'max:125'],
            'email' => ['required', 'email', 'max:125', 'unique:users'],
            'password' => ['required', 'confirmed', Password::default()->mixedCase()->numbers()],
        ];
    }
}
