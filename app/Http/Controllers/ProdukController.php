<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Models\Jenis;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        $products = Produk::with(['jenis', 'user'])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    // 1. Cari berdasarkan nama produk
                    $q->where('nama', 'like', "%" . $keyword . "%")
                    // 2. Cari berdasarkan kolom 'nama_jenis' di tabel jenis
                    ->orWhereHas('jenis', function ($qJenis) use ($keyword) {
                        $qJenis->where('nama_jenis', 'like', "%" . $keyword . "%");
                    });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisList = Jenis::all();
        return view('produk.create', compact('jenisList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $dataReq['nama_jenis'], // Pastikan ini sesuai dengan field yang ada di form
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        // Ambil data jenis untuk dropdown
        $jenisList = Jenis::all();

        return view('produk.edit', compact('produk', 'jenisList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $dataReq['nama_jenis'],
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'] ?? 0,
        ];

        // Jika user meng-upload foto baru
        if ($request->hasFile('foto')) {

            // 1. Hapus foto lama jika ada
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // 2. Olah foto baru agar mendekati/di bawah 50 KB
            $file = $request->file('foto');
            
            // Buat nama unik file (disarankan format .webp untuk kompresi maksimal)
            $filename = 'products/' . Str::random(20) . '.webp';

            // Baca gambar dan resize dimensinya (misal max lebar 800px)
            // Menurunkan resolusi adalah kunci utama memangkas ukuran file ke 50 KB
            $img = Image::read($file); // Jika v2 gunakan Image::make($file)
            $img->scale(width: 800);   // Mengubah ukuran proporsional (max width 800px)

            // Encode ke format WEBP dengan kualitas 50-60% untuk target ~50 KB
            $compressedContent = $img->toWebp(quality: 55); 

            // 3. Simpan ke Storage Public
            Storage::disk('public')->put($filename, $compressedContent);

            $data['foto'] = $filename;
        }

        $produk->update($data);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}