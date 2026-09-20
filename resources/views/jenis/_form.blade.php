@extends('layouts.app')

@section('title', isset($jenis) ? 'Edit Jenis Barang' : 'Tambah Jenis Barang')

@section('content')

    @include('layouts.navbar')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="fw-bold mb-0 text-dark">
                        {{ isset($jenis) ? 'Edit Jenis Barang' : 'Tambah Jenis Barang Baru' }}
                    </h5>
                </div>
                <div class="card-body p-4 pt-0">
                    <!-- Form Action otomatis menyesuaikan Tambah / Edit -->
                    <form action="{{ isset($jenis) ? route('jenis.update', $jenis->id) : route('jenis.store') }}" method="POST">
                        @csrf
                        @if(isset($jenis))
                            @method('PUT')
                        @endif

                        <!-- Input Nama Jenis -->
                        <div class="mb-3">
                            <label for="nama_jenis" class="form-label small fw-semibold text-secondary">Nama Jenis / Kategori</label>
                            <input type="text" 
                                   id="nama_jenis"
                                   name="nama_jenis" 
                                   class="form-control @error('nama_jenis') is-invalid @enderror"
                                   value="{{ old('nama_jenis', $jenis->nama_jenis ?? '') }}"
                                   placeholder="Contoh: Sembako, Minuman, Snak"
                                   required
                                   autofocus>
                            @error('nama_jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <a href="{{ route('jenis.index') }}" class="btn btn-light px-4 fw-medium border">
                                Batal
                            </a>
                            <button class="btn btn-primary px-4 fw-semibold" type="submit" style="background-color: #0B6477; border-color: #0B6477;">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection