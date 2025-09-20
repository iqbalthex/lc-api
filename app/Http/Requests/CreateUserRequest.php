<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'between:3,255'],
            'email' => [
                'bail',
                'required',
                'string',
                'email',
                'unique:users,email',
            ],
        ];
    }
}
