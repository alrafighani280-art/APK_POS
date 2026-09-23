<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class ItemPenjualanController extends Controller
{
    /**
     * Tambah item ke keranjang
     */
   public function store(Request $request)
{
    $request->validate([
        'product_id'  => 'required|exists:produk,id',
        'quantity'    => 'required|integer|min:1',
        'tipe_satuan' => 'nullable|in:satuan,pack',
    ]);

    $produk = Produk::findOrFail($request->product_id);
    $user = auth()->user();

    // Cari transaksi OPEN milik kasir
    $penjualan = Penjualan::firstOrCreate([
        'user_id' => $user->id,
        'status'  => 'OPEN',
    ], [
        'total_pembayaran' => 0,
    ]);

    $tipeSatuan = $request->input('tipe_satuan', 'satuan');
    
    // Pilih harga berdasarkan tipe satuan
    $harga = ($tipeSatuan === 'pack') 
        ? ($produk->harga_jual_pack ?? $produk->harga_jual_satuan) 
        : $produk->harga_jual_satuan;

    // Cek jika item sudah ada di keranjang
    $item = ItemPenjualan::where('penjualan_id', $penjualan->id)
        ->where('produk_id', $produk->id)
        ->first();

    if ($item) {
        $newQty = $item->kuantitas + $request->quantity;
        $item->update([
            'tipe_satuan'  => $tipeSatuan,
            'kuantitas'    => $newQty,
            'harga_satuan' => $harga, // Gunakan harga_satuan
            'subtotal'     => $harga * $newQty,
        ]);
    } else {
        ItemPenjualan::create([
            'penjualan_id' => $penjualan->id,
            'produk_id'    => $produk->id,
            'tipe_satuan'  => $tipeSatuan,
            'kuantitas'    => $request->quantity,
            'harga_satuan' => $harga, // Gunakan harga_satuan
            'subtotal'     => $harga * $request->quantity,
        ]);
    }

    // Hitung & Sinkronkan Total Pembayaran
    $this->syncTotalPembayaran($penjualan->id);

    return redirect()->back();
}
    /**
     * Update Tipe Satuan / Qty di Keranjang
     */
// app/Http/Controllers/ItemPenjualanController.php

    public function update(Request $request, $id)
    {
        $item = ItemPenjualan::with('produk')->findOrFail($id);

        $tipeSatuan = $request->input('tipe_satuan', $item->tipe_satuan ?? 'satuan');
        $quantity   = (int) $request->input('quantity', $item->kuantitas);

        // Ambil harga dari produk
        $harga = ($tipeSatuan === 'pack') 
            ? ($item->produk->harga_jual_pack ?? $item->produk->harga_jual_satuan) 
            : $item->produk->harga_jual_satuan;

        $subtotal = $harga * $quantity;

        // Hapus 'harga' dari array update
        $item->update([
            'tipe_satuan' => $tipeSatuan,
            'kuantitas'   => $quantity,
            'subtotal'    => $subtotal,
        ]);

        // Update total di transaksi Penjualan
        $totalBaru = ItemPenjualan::where('penjualan_id', $item->penjualan_id)->sum('subtotal');
        $item->penjualan->update([
            'total_pembayaran' => $totalBaru,
        ]);

        return redirect()->back();
    }

    /**
     * Hapus item dari keranjang
     */
    public function destroy($id)
    {
        $item = ItemPenjualan::findOrFail($id);
        $penjualanId = $item->penjualan_id;

        $item->delete();

        // Hitung ulang total pembayaran
        $this->syncTotalPembayaran($penjualanId);

        return redirect()->back();
    }

    /**
     * Helper Function untuk memperbarui Total Pembayaran pada tabel Penjualan
     */
    private function syncTotalPembayaran($penjualanId)
    {
        $total = ItemPenjualan::where('penjualan_id', $penjualanId)->sum('subtotal');
        Penjualan::where('id', $penjualanId)->update([
            'total_pembayaran' => $total,
        ]);
    }
}