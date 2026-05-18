<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'email'     => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('user')),
            ],
            'password'  => 'nullable|min:3',
            'role_id'   => 'required',
            'is_active' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'Nama wajib diisi.',
            'name.max'       => 'Maksimal panjang nama 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'password.min'   => 'Password minimal :min karakter.',
            'role_id.required' => 'Role wajib diisi.' // ← fix typo 'role' → 'role_id'
        ];
    }
}