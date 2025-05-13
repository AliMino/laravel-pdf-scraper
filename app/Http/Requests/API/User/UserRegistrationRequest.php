<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

final class UserRegistrationRequest extends FormRequest {

    public final function authorize(): bool {

        return true;
    }

    public final function rules(): array {

        return [

            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }
}
