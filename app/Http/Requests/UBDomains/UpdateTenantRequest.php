<?php

namespace App\Http\Requests\UBDomains;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('ubdomains')->check() &&
               auth()->guard('ubdomains')->user()->canManageTenants();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $tenantId = $this->route('tenant')->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tenants,slug,' . $tenantId,
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tenant name is required.',
            'slug.required' => 'Tenant slug is required.',
            'slug.unique' => 'This slug is already in use by another tenant.',
        ];
    }
}
