<?php

namespace App\Http\Requests\UBDomains;

use Illuminate\Foundation\Http\FormRequest;

class RejectApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('ubdomains')->check() &&
               auth()->guard('ubdomains')->user()->canApproveApplications();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'reason' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'reason.required' => 'Please provide a reason for rejecting this application.',
            'reason.max' => 'The rejection reason must not exceed 500 characters.',
        ];
    }
}
