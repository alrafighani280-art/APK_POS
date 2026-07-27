@extends('layouts.app')

@section('title', 'Dashboard - POS')

@section('content')
@include('layouts.navbar')
<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

<div class="container py-4">

    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-3 border-bottom">
        <div>
            <h2 class="fw-bold text-dark mb-1">Ringkasan Hari Ini</h2>
            <p class="text-muted mb-0">
                <i class="bi bi-calendar-event me-1"></i>
                {{ isset($tanggalHariIni) ? $tanggalHariIni->translatedFormat('l, d F Y') : \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </p>
        </div>
        <div class="mt-3 mt-md-0 d-flex gap-2">
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary fw-semibold px-3">
                <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
            </a>
        </div>
    </div>

    {{-- Hanya Admin yang Bisa Melihat Statistik Transaksi --}}
    @if(auth()->user()->role === 'admin' || auth()->user()->role_id == 1)
    <!-- Section 1: Today's Sales & Payment Status (4 Grid Cards) -->
    <div class="mb-5">
        <h5 class="fw-bold text-secondary mb-3">Statistik Transaksi & Pembayaran</h5>
        <div class="row g-3">
            
            <!-- Total Penjualan -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total Penjualan</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">
                                Rp {{ number_format($ringkasan['total_penjualan'] ?? $ringkasan['total_pembayaran'] ?? 0, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="icon-box bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Transaksi -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Jumlah Transaksi</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">
                                {{ $ringkasan['total_transaksi'] ?? $ringkasan['jumlah_transaksi'] ?? 0 }}
                            </h4>
                        </div>
                        <div class="icon-box bg-info bg-opacity-10 text-info">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Tunai -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total Tunai</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">
                                Rp {{ number_format($ringkasan['total_cash'] ?? $ringkasan['total_tunai'] ?? 0, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="icon-box bg-success bg-opacity-10 text-success">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Non-Tunai -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card shadow-sm p-3 bg-white h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-semibold">Total Non-Tunai</span>
                            <h4 class="fw-bold text-dark mt-1 mb-0">
                                Rp {{ number_format($ringkasan['total_non_tunai'] ?? $ringkasan['total_qris'] ?? 0, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="icon-box bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endif

    <!-- Section 2: Critical Inventory Status -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-secondary mb-0">Status Inventaris Kritis</h5>
            <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-secondary">
                Lihat Semua Produk
            </a>
        </div>
        <div class="row g-4">
            
            <!-- Table Produk Stok Rendah -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white border-0 pt-3 px-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-warning mb-0">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Produk Stok Rendah
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-3" style="width: 50px;">#</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td class="ps-3 text-muted">
                                                {{ method_exists($produkStokRendah, 'firstItem') ? $produkStokRendah->firstItem() + $index : $loop->iteration }}
                                            </td>
                                            <td class="fw-semibold text-dark">{{ $produk->nama ?? $produk->nama_produk }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning bg-opacity-20 text-dark fw-bold px-3 py-1 rounded-pill">
                                                    {{ $produk->stok }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                <i class="bi bi-check-circle-fill text-success fs-4 d-block mb-1"></i>
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (method_exists($produkStokRendah, 'hasPages') && $produkStokRendah->hasPages())
                        <div class="card-footer bg-white border-0 py-2">
                            {{ $produkStokRendah->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Table Produk Habis Stok -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white border-0 pt-3 px-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-danger mb-0">
                            <i class="bi bi-x-circle-fill me-1"></i> Produk Habis Stok
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-3" style="width: 50px;">#</th>
                                        <th>Nama Produk</th>
                                        <th class="text-center">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td class="ps-3 text-muted">
                                                {{ method_exists($produkStokHabis, 'firstItem') ? $produkStokHabis->firstItem() + $index : $loop->iteration }}
                                            </td>
                                            <td class="fw-semibold text-dark">{{ $produk->nama ?? $produk->nama_produk }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-danger bg-opacity-20 text-danger fw-bold px-3 py-1 rounded-pill">
                                                    {{ $produk->stok }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                <i class="bi bi-check-circle-fill text-success fs-4 d-block mb-1"></i>
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (method_exists($produkStokHabis, 'hasPages') && $produkStokHabis->hasPages())
                        <div class="card-footer bg-white border-0 py-2">
                            {{ $produkStokHabis->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Section 3: Best Seller Products -->
    <div class="mb-4">
        <h5 class="fw-bold text-secondary mb-3">Produk Terlaris</h5>
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Nama Produk</th>
                                <th>Sisa Stok</th>
                                <th class="pe-3">Total Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $produk)
                                <tr>
                                    <td class="ps-3 fw-semibold text-dark">{{ $produk->nama ?? $produk->nama_produk }}</td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-dark">
                                            {{ $produk->stok }}
                                        </span>
                                    </td>
                                    <td class="pe-3 fw-bold text-primary">
                                        {{ $produk->total_terjual ?? $produk->item_penjualan_sum_kuantitas ?? $produk->total_unit ?? 0 }} Unit
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        <i class="bi bi-box-seam fs-4 d-block mb-1 text-secondary"></i>
                                        Belum ada data penjualan produk terlaris.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection