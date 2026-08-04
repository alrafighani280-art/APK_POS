@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')

    @include('layouts.navbar')

    {{-- Alert Errors / Success --}}
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-0" role="alert">
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Header Halaman --}}
    <div class="mb-4 mt-4">
        <h2 class="fw-bold text-dark mb-1">Manajemen Produk</h2>
        <p class="text-muted mb-0 small">Kelola data inventaris, harga beli, harga jual, dan stok barang.</p>
    </div>

    {{-- Card Main Content --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden mb-4">
        
        <!-- Header Card: Search Bar & Tombol Tambah Produk Sejajar -->
        <div class="card-header bg-white border-0 pt-4 px-4 pb-3">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">
                    
                    <!-- Search Input (Kiri) -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted ps-3">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-control bg-light border-start-0 ps-0" 
                                   placeholder="Cari nama produk...">
                            
                            @if(request('search'))
                                <a href="{{ route('produk.index') }}" class="btn btn-light border-start-0 text-muted">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                            
                            <button class="btn btn-primary px-3" type="submit">Cari</button>
                        </div>
                    </div>

                    <!-- Tombol Tambah Produk (Kanan) -->
                    @can('create', App\Models\Produk::class)
                        <div class="col-12 col-md-auto text-md-end">
                            <a href="{{ route('produk.create') }}" class="btn btn-primary fw-semibold px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                                <i class="bi bi-plus-lg"></i>
                                <span>Tambah Produk</span>
                            </a>
                        </div>
                    @endcan

                </div>
            </form>
        </div>

        <!-- Body Card: Table Produk -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase text-secondary small fw-bold">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 60px;">#</th>
                            <th scope="col" style="width: 80px;">Foto</th>
                            <th scope="col">Nama Jenis</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">User/Inputor</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col">Stok</th>
                            <th scope="col" class="text-end pe-4" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <!-- Nomor -->
                                <td class="ps-4 text-muted fw-semibold">
                                    {{ $products->firstItem() + $loop->index }}
                                </td>

                                <!-- Foto Produk -->
                                <td>
                                    @if($product->foto)
                                        <img src="{{ asset('storage/' . $product->foto) }}" 
                                             alt="{{ $product->nama }}" 
                                             class="rounded-3 border object-fit-cover" 
                                             style="width: 48px; height: 48px;">
                                    @else
                                        <div class="bg-light border rounded-3 d-flex align-items-center justify-content-center text-muted" 
                                             style="width: 48px; height: 48px;">
                                            <i class="bi bi-box-seam fs-5"></i>
                                        </div>
                                    @endif
                                </td>

                                <!-- Nama Jenis -->
                                <td>
                                    <span class="small text-muted">
                                        <i class="bi bi-tags me-1"></i>{{ $product->jenis->nama_jenis ?? '-' }}
                                    </span>
                                <!-- Nama Produk -->
                                <td>
                                    <span class="fw-semibold text-dark mb-0 d-block">{{ $product->nama }}</span>
                                </td>

                                <!-- User -->
                                <td>
                                    <span class="small text-muted">
                                        <i class="bi bi-person me-1"></i>{{ $product->user->name ?? '-' }}
                                    </span>
                                </td>

                                <!-- Harga Beli -->
                                <td class="text-muted small">
                                    Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                </td>

                                <!-- Harga Jual -->
                                <td class="fw-bold text-dark">
                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                </td>

                                <!-- Stok -->
                                <td>
                                    @if($product->stok <= 5)
                                        <span class="badge bg-danger bg-opacity-10 text-danger fw-bold px-2.5 py-1.5 rounded-pill">
                                            {{ $product->stok }} Pcs (Tipis)
                                        </span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success fw-bold px-2.5 py-1.5 rounded-pill">
                                            {{ $product->stok }} Pcs
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        @can('update', $product)
                                            <a href="{{ route('produk.edit', $product) }}" 
                                               class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 px-2.5 py-1" 
                                               title="Edit Produk">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan

                                        @can('delete', $product)
                                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-2.5 py-1" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                                        title="Hapus Produk">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-box-seam fs-1 text-secondary d-block mb-2"></i>
                                    <span>Data produk tidak tersedia.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination -->
        @if (method_exists($products, 'hasPages') && $products->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $products->links() }}
            </div>
        @endif

    </div>

@endsection