@extends('layouts.app')

@section('title', 'POS')

@section('content')

    @include('layouts.navbar')
    
    @if (session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

    <h4 class="mb-3">
        {{ $mode == 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}
    </h4>
    <div class="row">

        {{-- ================== PRODUK ================== --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="max-height:70vh; overflow:auto">
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Cari produk..." onkeyup="this.form.submit()">
                        </form>
                    </div>

                    @foreach ($products as $product)
                        <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button type="button"
                                    class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('storage/' . $product->foto) }}" alt="Gambar"
                                            class="rounded-circle" style="width:45px; height:45px; object-fit:cover">
                                        <div>
                                            <div class="fw-semibold">{{ $product->nama }}</div>
                                            <small class="text-muted">{{ number_format($product->harga_jual) }}</small>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number" name="quantity" value="1" min="1"
                                    class="form-control {{ $sale->status === 'COMPLETED' ? '' : '' }}">
                            </div>

                            <div class="col-2">
                                <button type="submit"
                                    class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                            </div>
                        </form>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- ================== KERANJANG ================== --}}
        <div class="col-md-6">
            <div class="card">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->itemPenjualan as $item)
                            <tr>
                                <td>{{ $item->produk->nama }}</td>

                                <td>
                                    <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <input type="number" name="quantity" value="{{ $item->kuantitas }}"
                                            class="form-control form-control-sm">
                                    </form>
                                </td>

                                <td>Rp {{ number_format($item->subtotal) }}</td>
                                <td>
                                @can('delete', $item)
                                    <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

               <div class="card-footer">
                    <strong>Rp {{ number_format($sale->total_pembayaran) }}</strong>

                    <form method="POST" action="{{ route('penjualan.update', $sale->id) }}"
                        onsubmit="return confirm('Yakin ingin checkout ?')" class="mt-2">
                        @csrf
                        @method('PUT')

                        <select name="payment_method" id="payment_method" class="form-select mb-2" onchange="toggleQris()">
                            <option value="" {{ !$sale->metode_pembayaran ? 'selected' : '' }}>Pilih Pembayaran</option>
                            <option value="CASH" {{ $sale->metode_pembayaran === 'CASH' ? 'selected' : '' }}>Cash</option>
                            <option value="QRIS" {{ $sale->metode_pembayaran === 'QRIS' ? 'selected' : '' }}>QRIS</option>
                        </select>

                        <div id="qris-box" class="mb-2 text-center qris-hidden">
                            @if($qrImage)
                                <img src="data:image/png;base64,{{ $qrImage }}" alt="QRIS"
                                    class="img-fluid border rounded mx-auto d-block" style="max-width:200px;">
                            @endif
                            <div class="small text-muted mt-1">
                                Scan QRIS untuk membayar Rp {{ number_format($sale->total_pembayaran) }}
                            </div>
                        </div>

                        <input type="number" name="uang_bayar" id="uang_bayar" class="form-control mb-2"
                            placeholder="Uang Dibayar" min="{{ $sale->total_pembayaran }}"
                            oninput="hitungKembalian()" required>

                        <div class="mb-2 fw-semibold" id="kembalian_info">
                            Kembalian: Rp 0
                        </div>

                        <button type="submit" id="btn-checkout" class="btn btn-success w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" disabled>
                            Checkout
                        </button>
                    </form>

                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-outline-danger w-100 mt-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Batalkan Transaksi
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>

    </div>
<script>
    function hitungKembalian() {
        const total = {{ $sale->total_pembayaran }};
        const bayar = parseInt(document.getElementById('uang_bayar').value) || 0;
        const selisih = bayar - total;
        const info = document.getElementById('kembalian_info');
        const btnCheckout = document.getElementById('btn-checkout');

        if (bayar === 0) {
            info.innerText = 'Kembalian: Rp 0';
            info.className = 'mb-2 fw-semibold text-muted';
            btnCheckout.disabled = true;
        } else if (selisih < 0) {
            info.innerText = 'Uang kurang Rp ' + Math.abs(selisih).toLocaleString('id-ID');
            info.className = 'mb-2 fw-semibold text-danger';
            btnCheckout.disabled = true;
        } else {
            info.innerText = 'Kembalian: Rp ' + selisih.toLocaleString('id-ID');
            info.className = 'mb-2 fw-semibold text-success';
            btnCheckout.disabled = false;
        }
    }

   function toggleQris() {
        const method = document.getElementById('payment_method').value;
        const qrisBox = document.getElementById('qris-box');
        const uangBayarInput = document.getElementById('uang_bayar');
        const total = {{ $sale->total_pembayaran }};

        if (method === 'QRIS') {
            qrisBox.classList.remove('qris-hidden');
            uangBayarInput.value = total;
            uangBayarInput.readOnly = true;
        } else {
            qrisBox.classList.add('qris-hidden');
            uangBayarInput.readOnly = false;
            uangBayarInput.value = '';
        }
        hitungKembalian();
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleQris();
    });
</script>
@endsection