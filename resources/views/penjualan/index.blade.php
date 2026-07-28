@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

    @include('layouts.navbar')

    {{-- Alert Errors --}}
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Halaman --}}
    <div class="mb-4 mt-4">
        <h2 class="fw-bold text-dark mb-1">Halaman Penjualan</h2>
        <p class="text-muted mb-0 small">Kelola dan pantau seluruh riwayat transaksi penjualan.</p>
    </div>

    {{-- Stat Cards / Ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-cart-check fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Total Transaksi</span>
                        <h4 class="fw-bold text-dark mb-0">{{ $sales->total() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Total Pembayaran</span>
                        <h4 class="fw-bold text-dark mb-0">
                            Rp {{ number_format($sales->sum('total_pembayaran') ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3 d-flex align-items-center justify-content-center">
                        <i class="bi bi-receipt-cutoff fs-4"></i>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Data Ditampilkan</span>
                        <h4 class="fw-bold text-dark mb-0">{{ $sales->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Main Content --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
        
        <!-- Header Card: Search Bar & Tombol Create Sejajar -->
        <div class="card-header bg-white border-0 pt-4 px-4 pb-3">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">
                    
                    <!-- Search Input (Kiri) -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted ps-3">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request()->search }}" 
                                   class="form-control bg-light border-start-0 ps-0" 
                                   placeholder="Cari transaksi...">
                            @if(request()->search)
                                <a href="{{ route('penjualan.index') }}" class="btn btn-light border-start-0 text-muted">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                            <button class="btn btn-primary px-3" type="submit">Search</button>
                        </div>
                    </div>

                    <!-- Tombol Create Penjualan Baru (Kanan) -->
                    <div class="col-12 col-md-auto text-md-end">
                        <a href="{{ route('penjualan.create') }}" class="btn btn-primary fw-semibold px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg"></i>
                            <span>Create Transaksi</span>
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <!-- Body Card: Table Penjualan -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase text-secondary small fw-bold">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 60px;">#</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Kasir</th>
                            <th scope="col">Total Pembayaran</th>
                            <th scope="col">Metode Pembayaran</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <!-- Nomor -->
                                <td class="ps-4 text-muted fw-semibold">
                                    {{ $sales->firstItem() + $loop->index }}
                                </td>

                                <!-- Tanggal Transaksi -->
                                <td>
                                    <div class="d-flex align-items-center gap-2 text-dark font-monospace small">
                                        <i class="bi bi-calendar-event text-muted"></i>
                                        <span>{{ $sale->created_at ? $sale->created_at->translatedFormat('d-m-Y H:i') : '-' }}</span>
                                    </div>
                                </td>

                                <!-- Kasir -->
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0" 
                                             style="width: 32px; height: 32px; font-size: 0.8rem;">
                                            {{ strtoupper(substr($sale->user->name ?? 'K', 0, 1)) }}
                                        </div>
                                        <span class="fw-semibold text-dark small">{{ $sale->user->name ?? 'Kasir' }}</span>
                                    </div>
                                </td>

                                <!-- Total Pembayaran -->
                                <td class="fw-bold text-dark">
                                    Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}
                                </td>

                                <!-- Metode Pembayaran -->
                                <td>
                                    <span class="badge bg-light text-dark border px-2.5 py-1.5 fw-semibold text-uppercase">
                                        <i class="bi bi-credit-card me-1 text-muted"></i>
                                        {{ $sale->metode_pembayaran ?? 'Cash' }}
                                    </span>
                                </td>

                                <!-- Status -->
                                <td>
                                    @php
                                        $status = strtolower($sale->status ?? 'selesai');
                                        $badgeClass = match($status) {
                                            'selesai', 'lunas', 'success' => 'bg-success bg-opacity-10 text-success',
                                            'pending', 'proses' => 'bg-warning bg-opacity-10 text-warning',
                                            'batal', 'cancelled' => 'bg-danger bg-opacity-10 text-danger',
                                            default => 'bg-secondary bg-opacity-10 text-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} fw-bold px-3 py-1.5 rounded-pill text-capitalize">
                                        {{ $sale->status }}
                                    </span>
                                </td>

                                <!-- Aksi -->
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        {{-- Detail --}}
                                        <a href="{{ route('penjualan.show', $sale) }}" 
                                           class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1"
                                           title="Detail Penjualan">
                                            <i class="bi bi-eye"></i>
                                            <span>Detail</span>
                                        </a>

                                        {{-- Edit (Authorization Policy) --}}
                                        @can('view', $sale)
                                            <a href="{{ route('penjualan.edit', $sale) }}" 
                                               class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1"
                                               title="Edit Penjualan">
                                                <i class="bi bi-pencil-square"></i>
                                                <span>Edit</span>
                                            </a>
                                        @endcan

                                        {{-- Delete (Authorization Policy) --}}
                                        @can('delete', $sale)
                                            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')"
                                                        title="Hapus Penjualan">
                                                    <i class="bi bi-trash"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-cart-x fs-1 text-secondary d-block mb-2"></i>
                                    <span>Data Tidak Ditemukan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination -->
        @if (method_exists($sales, 'hasPages') && $sales->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $sales->links() }}
            </div>
        @endif

    </div>

@endsection