<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],

            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'url', 'max:255'],

            'status' => ['required', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],

            'assigned_to_user_id' => ['nullable', 'exists:users,id'],

            'department' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],

            'lead_cost' => ['nullable', 'numeric'],
            'total_lead_cost' => ['nullable', 'numeric'],
            'currency' => ['nullable', 'string', 'size:3'],
            'percentage' => ['nullable', 'numeric'],

            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:255'],

            'follow_up_date' => ['nullable', 'date'],
            'follow_up_time' => ['nullable', 'date_format:H:i'],
            'meeting_at' => ['nullable', 'date'],
            'follow_up_at' => ['nullable', 'date'],
            'closed_date' => ['nullable', 'date'],

            'city' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],

            'notes' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
