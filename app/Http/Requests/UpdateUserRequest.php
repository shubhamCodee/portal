<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'unique:users,email,' . $userId],

            'password'       => ['nullable', 'string', 'min:8', 'confirmed'],

            'phone'          => ['required', 'string', 'max:20'],
            'date_of_birth'  => ['required', 'date'],
            'gender'         => ['required', 'string'],
            'role'           => ['required', 'string'],
            'is_active'      => ['required', 'boolean'],

            'profile_image'  => ['required', 'image', 'max:2048'],
            'bio'            => ['required', 'string'],
        ];
    }
}
