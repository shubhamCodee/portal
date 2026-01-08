<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assigned_to_user_id' => ['required', 'exists:users,id'],

            'subject' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:100'],

            'scheduled_at' => ['required', 'date'],
            'duration_minutes' => ['nullable', 'integer', 'min:0'],

            'description' => ['nullable', 'string'],
        ];
    }
}
