<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah 'item_penjualans' menjadi 'item_penjualan'
        Schema::table('item_penjualan', function (Blueprint $table) {
            $table->string('tipe_satuan')->default('satuan')->after('produk_id');
        });
    }

    public function down(): void
    {
        Schema::table('item_penjualan', function (Blueprint $table) {
            $table->dropColumn('tipe_satuan');
        });
    }
};
