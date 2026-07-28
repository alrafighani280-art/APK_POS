<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisController extends Controller
{
    /**
     * Menampilkan daftar semua jenis.
     */
    public function index()
    {
        // Mengambil semua jenis beserta relasi user yang membuatnya
        $jenis = Jenis::with('user')->latest()->get();

        // Jika menggunakan View Blade:
        // return view('jenis.index', compact('jenis'));

        // Jika berupa API:
        return response()->json([
            'success' => true,
            'data' => $jenis
        ]);
    }

    /**
     * Menyimpan jenis baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        // Simpan ke database
        $jenis = Jenis::create([
            'user_id'    => Auth::id() ?? $request->user_id, // otomatis ambil ID user yang login
            'nama_jenis' => $request->nama_jenis,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jenis berhasil ditambahkan!',
            'data'    => $jenis
        ], 201);
    }

    /**
     * Menampilkan detail 1 jenis beserta daftar produk di dalamnya.
     */
    public function show(Jenis $jenis)
    {
        // Load relasi produk dan user
        $jenis->load(['produk', 'user']);

        return response()->json([
            'success' => true,
            'data'    => $jenis
        ]);
    }

    /**
     * Mengubah data jenis.
     */
    public function update(Request $request, Jenis $jenis)
    {
        // Validasi input
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        // Update data
        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Jenis berhasil diperbarui!',
            'data'    => $jenis
        ]);
    }

    /**
     * Menghapus jenis dari database.
     */
    public function destroy(Jenis $jenis)
    {
        $jenis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Jenis berhasil dihapus!'
        ]);
    }
}