@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Jenis Produk</h2>
        <a href="{{ route('jenis.create') }}" class="btn btn-primary">+ Tambah Jenis</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
                <th>Dibuat Oleh (User)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jenis as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama_jenis }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('jenis.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Data jenis belum ada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection