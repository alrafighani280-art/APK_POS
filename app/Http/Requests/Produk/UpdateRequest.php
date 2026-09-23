<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama'              => 'required|string|max:255',
            'jenis_id'          => 'required|exists:jenis,id',
            'harga_beli_satuan' => 'required|numeric|min:0',
            'harga_beli_pack'   => 'nullable|numeric|min:0',
            'harga_jual_satuan' => 'required|numeric|min:0',
            'harga_jual_pack'   => 'nullable|numeric|min:0',
            'stok'              => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'                 => 'File yang diupload harus berupa gambar.',
            'foto.mimes'                 => 'Ekstensi gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max'                   => 'Maksimal ukuran gambar 2MB.',
            'nama.required'              => 'Nama produk wajib diisi.',
            'jenis_id.required'          => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'            => 'Jenis produk tidak valid.',
            'harga_beli_satuan.required' => 'Harga beli satuan wajib diisi.',
            'harga_jual_satuan.required' => 'Harga jual satuan wajib diisi.',
            'stok.required'              => 'Stok wajib diisi.',
            'stok.integer'               => 'Stok harus berupa angka.',
        ];
    }
}