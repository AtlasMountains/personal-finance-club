<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'max:125'],
            'last_name' => ['required', 'max:125'],
            'email' => ['required', 'email', 'max:125', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ];
    }
}
