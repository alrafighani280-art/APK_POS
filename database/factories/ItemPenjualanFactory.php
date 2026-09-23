<?php

namespace Database\Factories;

use App\Models\ItemPenjualan;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ItemPenjualan>
 */
class ItemPenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ItemPenjualan::class;
    public function definition(): array
    {
        $produk = Produk::inRandomOrder()->first() ?? Produk::factory()->create();
        $qty = $this->faker->numberBetween(1, 10);
        
        // Pastikan harga_jual memiliki nilai (fallback ke angka jika null)
        $hargaSatuan = $produk->harga_jual ?? $this->faker->numberBetween(10000, 50000);

        return [
            'produk_id'    => $produk->id,
            'kuantitas'    => $qty,
            'harga_satuan' => $hargaSatuan,
            'subtotal'     => $hargaSatuan * $qty,
        ];
    }
}
