<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
                Rule::unique(User::class, 'email')
                    ->ignore(Auth::id()),
            ],
        ];
    }
}
