@extends('layouts.app')

@section('title', 'POS')


@section('content')

    @include('layouts.navbar')
    
    {{-- Alert Section --}}
    @if (session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h4 class="mb-3 text-dark fw-bold">
        {{ isset($mode) && $mode == 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
    </h4>

    <div class="row">

        {{-- ================== KATALOG PRODUK ================== --}}
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="max-height:70vh; overflow-y:auto">
                    
                    {{-- Form Pencarian --}}
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <div class="input-group">
                                <span class="input-group-text bg-white text-primary border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-0"
                                    placeholder="Cari produk..." onkeyup="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    {{-- Daftar Produk --}}
                    @forelse ($products as $product)
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 mb-2 align-items-center">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button type="submit"
                                    class="btn btn-outline-primary w-100 text-start p-2 {{ isset($sale) && $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}"
                                            class="rounded-circle border" style="width:45px; height:45px; object-fit:cover">
                                        <div>
                                            <div class="fw-semibold text-truncate" style="max-width: 150px;">{{ $product->nama }}</div>
                                            <small class="text-primary fw-bold">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                    class="form-control text-center" {{ isset($sale) && $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            </div>

                            <div class="col-2">
                                <button type="submit"
                                    class="btn btn-primary w-100 fw-bold {{ isset($sale) && $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                            </div>
                        </form>
                    @empty
                        <p class="text-center text-muted my-4">Produk tidak ditemukan.</p>
                    @endforelse

                </div>
            </div>
        </div>

        {{-- ================== KERANJANG BELANJA ================== --}}
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-custom-header">
                            <tr>
                                <th class="ps-3">Produk</th>
                                <th style="width: 90px;" class="text-center">Qty</th>
                                <th>Subtotal</th>
                                <th style="width: 80px;" class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sale->itemPenjualan ?? [] as $item)
                                <tr>
                                    <td class="ps-3 fw-medium">{{ $item->produk->nama }}</td>

                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <input type="number" name="quantity" value="{{ $item->kuantitas }}" min="1"
                                                class="form-control form-control-sm text-center" onchange="this.form.submit()">
                                        </form>
                                    </td>

                                    <td class="fw-semibold text-dark">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="text-center pe-3">
                                        @can('delete', $item)
                                            <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Keranjang masih kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Footer Ringkasan Pembayaran --}}
                <div class="card-footer bg-white border-top p-3">
                    <div class="card-total-box p-3 rounded mb-3 d-flex justify-content-between align-items-center">
                        <span class="text-secondary fw-medium">Total Pembayaran:</span>
                        <strong class="fs-4 text-success">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                    </div>

                    <form method="POST" action="{{ route('penjualan.update', $sale->id ?? 0) }}"
                        onsubmit="return confirm('Yakin ingin checkout ?')">
                        @csrf
                        @method('PUT')

                        <select name="payment_method" id="payment_method" class="form-select mb-2" onchange="toggleQris()" required>
                            <option value="" {{ !($sale->metode_pembayaran ?? false) ? 'selected' : '' }}>-- Pilih Pembayaran --</option>
                            <option value="CASH" {{ ($sale->metode_pembayaran ?? '') === 'CASH' ? 'selected' : '' }}>Cash (Tunai)</option>
                            <option value="QRIS" {{ ($sale->metode_pembayaran ?? '') === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        </select>

                        <div id="qris-box" class="mb-3 text-center p-2 border rounded bg-light qris-hidden">
                            @if(isset($qrImage) && $qrImage)
                                <img src="data:image/png;base64,{{ $qrImage }}" alt="QRIS"
                                    class="img-fluid border rounded mx-auto d-block mb-1 bg-white p-2" style="max-width:180px;">
                            @endif
                            <div class="small text-muted">
                                Scan QRIS untuk membayar <strong class="text-dark">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                            </div>
                        </div>

                        <input type="number" name="uang_bayar" id="uang_bayar" class="form-control mb-2"
                            placeholder="Masukkan Uang Dibayar" min="{{ $sale->total_pembayaran ?? 0 }}"
                            oninput="hitungKembalian()" required>

                        <div class="mb-3 fw-semibold text-muted" id="kembalian_info">
                            Kembalian: Rp 0
                        </div>

                        <button type="submit" id="btn-checkout" 
                            class="btn btn-success w-100 py-2 fw-bold {{ (isset($sale) && $sale->status === 'COMPLETED') || empty($sale->itemPenjualan->count()) ? 'disabled' : '' }}" disabled>
                            Checkout Sekarang
                        </button>
                    </form>

                    @if(isset($sale) && $sale->id)
                        @can('delete', $sale)
                        <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan transaksi?')" class="mt-2">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-outline-danger w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                Batalkan Transaksi
                            </button>
                        </form>
                        @endcan
                    @endif
                </div>
            </div>
        </div>

    </div>

<script>
    function hitungKembalian() {
        const total = {{ $sale->total_pembayaran ?? 0 }};
        const bayarInput = document.getElementById('uang_bayar');
        const bayar = parseInt(bayarInput.value) || 0;
        const selisih = bayar - total;
        const info = document.getElementById('kembalian_info');
        const btnCheckout = document.getElementById('btn-checkout');
        const itemCount = {{ count($sale->itemPenjualan ?? []) }};

        if (itemCount === 0) {
            info.innerText = 'Keranjang belanja kosong';
            info.className = 'mb-3 fw-semibold text-danger';
            btnCheckout.disabled = true;
            return;
        }

        if (bayarInput.value === '') {
            info.innerText = 'Kembalian: Rp 0';
            info.className = 'mb-3 fw-semibold text-muted';
            btnCheckout.disabled = true;
        } else if (selisih < 0) {
            info.innerText = 'Uang kurang Rp ' + Math.abs(selisih).toLocaleString('id-ID');
            info.className = 'mb-3 fw-semibold text-danger';
            btnCheckout.disabled = true;
        } else {
            info.innerText = 'Kembalian: Rp ' + selisih.toLocaleString('id-ID');
            info.className = 'mb-3 fw-semibold text-success';
            btnCheckout.disabled = false;
        }
    }

    function toggleQris() {
        const method = document.getElementById('payment_method').value;
        const qrisBox = document.getElementById('qris-box');
        const uangBayarInput = document.getElementById('uang_bayar');
        const total = {{ $sale->total_pembayaran ?? 0 }};

        if (method === 'QRIS') {
            qrisBox.classList.remove('qris-hidden');
            uangBayarInput.value = total;
            uangBayarInput.readOnly = true;
        } else {
            qrisBox.classList.add('qris-hidden');
            uangBayarInput.readOnly = false;
            if (method === '') {
                uangBayarInput.value = '';
            }
        }
        hitungKembalian();
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleQris();
    });
</script>
@endsection