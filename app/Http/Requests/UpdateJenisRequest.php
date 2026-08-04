<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // authorize sudah dicek manual di controller pakai $this->authorize()
    }

    public function rules(): array
    {
        return [
            'nama_jenis' => 'required|string|max:255',
        ];
    }
}