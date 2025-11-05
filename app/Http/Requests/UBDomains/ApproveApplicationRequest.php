<?php

namespace App\Http\Requests\UBDomains;

use Illuminate\Foundation\Http\FormRequest;

class ApproveApplicationRequest extends FormRequest
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
            'license_id' => 'required|exists:licenses,id',
            'notes' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'license_id.required' => 'Please select a license for the tenant.',
            'license_id.exists' => 'The selected license is invalid.',
        ];
    }
}
