<?php

namespace App\Http\Requests\UBDomains;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('ubdomains')->check() &&
               auth()->guard('ubdomains')->user()->canManageLicenses();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:licenses',
            'description' => 'nullable|string',
            'symphony_access' => 'required|boolean',
            'monsoon_access' => 'required|boolean',
            'max_users' => 'nullable|integer|min:1',
            'max_plants' => 'nullable|integer|min:1',
            'max_portfolios' => 'nullable|integer|min:1',
            'features' => 'nullable|json',
            'monthly_price' => 'required|numeric|min:0',
            'annual_price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'License name is required.',
            'name.unique' => 'A license with this name already exists.',
            'symphony_access.required' => 'Please specify Symphony access.',
            'monsoon_access.required' => 'Please specify Monsoon access.',
            'monthly_price.required' => 'Monthly price is required.',
            'annual_price.required' => 'Annual price is required.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert empty max values to null for Custom license
        if ($this->max_users === '' || $this->max_users === 'null') {
            $this->merge(['max_users' => null]);
        }
        if ($this->max_plants === '' || $this->max_plants === 'null') {
            $this->merge(['max_plants' => null]);
        }
        if ($this->max_portfolios === '' || $this->max_portfolios === 'null') {
            $this->merge(['max_portfolios' => null]);
        }
    }
}
