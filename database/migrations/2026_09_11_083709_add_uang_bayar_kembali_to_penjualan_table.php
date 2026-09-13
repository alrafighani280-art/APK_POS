<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('uang_bayar')->default(0)->after('total_pembayaran');
            $table->unsignedBigInteger('uang_kembali')->default(0)->after('uang_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['uang_bayar', 'uang_kembali']);
        });
    }
};