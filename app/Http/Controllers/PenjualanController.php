<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Services\QrisHelper;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()

            ->when($user->role->name == 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })

            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
            ]
        );

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
                ->orderBy('nama')
                ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
        }

        $mode = 'create';

        // Generate QRIS dinamis sesuai total keranjang saat ini
        $total = (int) $sale->itemPenjualan()->sum('subtotal');
        $qrImage = null;

        if ($total > 0) {
            $qrisString = QrisHelper::generateDynamicQris(env('QRIS_STATIC_STRING'), $total);
            $qrCode = new QrCode($qrisString);
            $writer = new PngWriter();
            $qrImage = base64_encode($writer->write($qrCode)->getString());
        }

        return view('penjualan.pos', compact('sale', 'products', 'mode', 'qrImage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Penjualan::with(['user', 'itemPenjualan.produk'])->findOrFail($id);

        $qrImage = null;

        if ($sale->status === 'COMPLETED') {
            // Sudah selesai: QR hanya ditampilkan kalau memang dibayar via QRIS
            if ($sale->metode_pembayaran === 'QRIS' && $sale->qris_payload) {
                $qrCode = new QrCode($sale->qris_payload);
                $writer = new PngWriter();
                $qrImage = base64_encode($writer->write($qrCode)->getString());
            }
        } else {
            // Masih OPEN: selalu generate QR dinamis dari total saat ini
            $total = (int) $sale->itemPenjualan()->sum('subtotal');
            if ($total > 0) {
                $qrisString = QrisHelper::generateDynamicQris(env('QRIS_STATIC_STRING'), $total);
                $qrCode = new QrCode($qrisString);
                $writer = new PngWriter();
                $qrImage = base64_encode($writer->write($qrCode)->getString());
            }
        }

        return view('penjualan.show', compact('sale', 'qrImage'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');

        $products = Produk::orderBy('nama')->get();

        $mode = 'edit';

        // 🔽 Generate QRIS dinamis juga saat mode edit
        $total = (int) $sale->itemPenjualan()->sum('subtotal');
        $qrImage = null;

        if ($total > 0) {
            $qrisString = QrisHelper::generateDynamicQris(env('QRIS_STATIC_STRING'), $total);
            $qrCode = new QrCode($qrisString);
            $writer = new PngWriter();
            $qrImage = base64_encode($writer->write($qrCode)->getString());
        }

        return view('penjualan.pos', compact('sale', 'products', 'mode', 'qrImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS',
            'uang_bayar' => 'required|numeric|min:0',
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('errors', 'Transaksi sudah diproses');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('errors', 'Keranjang masih kosong');
        }

        // 🔄 Hitung ulang total (anti manipulasi)
        $total = $penjualan->itemPenjualan()->sum('subtotal');
        $uangBayar = (int) $request->uang_bayar;

        if ($uangBayar < $total) {
            return back()->with('errors', 'Uang bayar tidak boleh kurang dari total pembayaran')->withInput();
        }

        $uangKembali = $uangBayar - $total;

        // 🔽 Simpan payload QRIS kalau metode bayarnya QRIS
        $qrisPayload = null;
        if ($request->payment_method === 'QRIS') {
            $qrisPayload = QrisHelper::generateDynamicQris(env('QRIS_STATIC_STRING'), $total);
        }

        DB::transaction(function () use ($penjualan, $request, $total, $uangBayar, $uangKembali, $qrisPayload) {
            $penjualan->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran' => $total,
                'uang_bayar' => $uangBayar,
                'uang_kembali' => $uangKembali,
                'qris_payload' => $qrisPayload,
                'status' => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('penjualan.show', $penjualan->id)
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);
        // Pastikan hanya transaksi OPEN
        if ($penjualan->status !== 'OPEN') {
            return redirect()->route('penjualan.index')->with('errors', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {

            foreach ($penjualan->itemPenjualan as $item) {

                $item->produk->increment('stok', $item->kuantitas);
            }

            $penjualan->itemPenjualan()->delete();

            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}