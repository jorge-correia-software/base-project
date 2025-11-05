<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'role' => 'required|in:ADMIN,MANAGER,OPERATOR,VIEWER',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|in:ACTIVE,INACTIVE,SUSPENDED',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'User name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already in use.',
            'role.required' => 'User role is required.',
            'role.in' => 'Invalid user role selected.',
            'status.required' => 'User status is required.',
            'status.in' => 'Invalid status selected.',
        ];
    }
}
