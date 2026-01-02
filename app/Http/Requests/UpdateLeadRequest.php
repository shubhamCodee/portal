<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],

            'status' => ['required', 'string'],
            'source' => ['nullable', 'string', 'max:255'],

            'tags' => ['nullable', 'array'],
            'tags.*' => ['string'],

            'follow_up_date' => ['nullable', 'date'],
            'follow_up_time' => ['nullable', 'date_format:H:i'],
            'meeting_at' => ['nullable', 'date'],

            'notes' => ['nullable', 'string'],

            'is_active' => ['boolean'],
        ];
    }
}
