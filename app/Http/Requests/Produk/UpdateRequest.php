<?php

namespace App\Http\Requests\Produk;

use Illuminate\Contracts\Validation\ValidationRule;
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 1. Tambahkan 'webp' pada mimes
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'           => 'required|string|max:255',
            
            // 2. Ubah validasi nama_jenis agar memeriksa ID di tabel jenis
            'nama_jenis'     => 'required|exists:jenis,id',
            'purchase_price' => 'required|integer|min:0',
            'selling_price'  => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'foto.image'             => 'File yang diupload harus berupa gambar.',
            'foto.mimes'             => 'Ekstensi gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max'               => 'Maksimal ukuran gambar 2MB.',
            'name.required'          => 'Nama produk wajib diisi.',
            'nama_jenis.required'    => 'Jenis produk wajib dipilih.',
            'nama_jenis.exists'      => 'Jenis produk tidak valid.',
            'purchase_price.required'=> 'Harga beli wajib diisi.',
            'purchase_price.integer' => 'Harga beli harus diisi angka bulat.',
            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.integer'  => 'Harga jual harus diisi angka bulat.',
            'stock.required'         => 'Stok wajib diisi.',
            'stock.integer'          => 'Stok harus diisi angka bulat.',
        ];
    }
}