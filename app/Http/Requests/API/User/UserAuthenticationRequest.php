<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

final class UserAuthenticationRequest extends FormRequest {

    public function authorize(): bool {

        return true;
    }

    public function rules(): array {

        return [

            'email'    => 'required|string|email|max:255',
            'password' => 'required|string',
        ];
    }
}
