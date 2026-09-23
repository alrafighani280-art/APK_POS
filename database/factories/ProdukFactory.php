<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Jenis;

/**
 * @extends Factory<Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        $hargaBeliSatuan = $this->faker->numberBetween(10_000, 100_000);
        $hargaBeliPack = $hargaBeliSatuan * 10;

        return [
            'user_id' => User::where('role_id', 1)->inRandomOrder()->value('id') ?? User::factory(),
            'jenis_id' => Jenis::inRandomOrder()->value('id') ?? Jenis::factory(),
            'foto' => 'produk/' . $this->faker->uuid() . '.jpg',
            'nama' => $this->faker->words(3, true),
            'harga_beli_satuan' => $hargaBeliSatuan,
            'harga_beli_pack' => $hargaBeliPack,
            'harga_jual_satuan' => $hargaBeliSatuan + $this->faker->numberBetween(1_000, 10_000),
            'harga_jual_pack' => $hargaBeliPack + $this->faker->numberBetween(10_000, 50_000),
            'stok' => $this->faker->numberBetween(1, 500),
        ];
    }
}

