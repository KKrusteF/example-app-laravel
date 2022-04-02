<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ValidateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'username' => [Rule::unique('users', 'username')
                ->ignore($this->user)],
            'avatar' => 'image',
            'current_password' => 'sometimes',
            'password' => ['confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->sometimes()],
            'password_confirmation' => 'sometimes',
        ];
    }
}
