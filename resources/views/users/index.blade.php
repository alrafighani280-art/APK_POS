@extends('layouts.app')

@section('title', 'Kelola Users')

@section('content')

 @include('layouts.navbar')

    {{-- Header Halaman (Tanpa tombol tambah) --}}
    <div class="mb-4 mt-4">
        <h2 class="fw-bold text-dark mb-1">Manajemen Users</h2>
        <p class="text-muted mb-0 small">Kelola data pengguna, hak akses, dan akun sistem.</p>
    </div>

    {{-- Card Main Content --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        
        <!-- Header Card: Search Bar & Tombol Tambah Sejajar -->
        <div class="card-header bg-white border-0 pt-4 px-4 pb-3">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">
                    
                    <!-- Form Search (Kiri) -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted ps-3">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-control bg-light border-start-0 ps-0" 
                                   placeholder="Cari nama atau email...">
                            @if(request('search'))
                                <a href="{{ route('admin.users') }}" class="btn btn-light border-start-0 text-muted">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                            <button class="btn btn-primary px-3" type="submit">Cari</button>
                        </div>
                    </div>

                    <!-- Tombol Tambah User (Kanan) -->
                    <div class="col-12 col-md-auto text-md-end">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary fw-semibold px-3 py-2 rounded-3 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg"></i>
                            <span>Tambah User Baru</span>
                        </a>
                    </div>

                </div>
            </form>
        </div>

        <!-- Body Card: Table Users -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-uppercase text-secondary small fw-bold">
                        <tr>
                            <th scope="col" class="ps-4" style="width: 60px;">#</th>
                            <th scope="col">User Info</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end pe-4" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <!-- Nomor -->
                                <td class="ps-4 text-muted fw-semibold">
                                    {{ method_exists($users, 'firstItem') ? $users->firstItem() + $loop->index : $loop->iteration }}
                                </td>

                                <!-- User Info (Avatar + Name + Email) -->
                                <td>
                                    <div class="d-flex align-items-center gap-3 py-1">
                                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold flex-shrink-0" 
                                             style="width: 40px; height: 40px; font-size: 0.9rem;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="lh-sm">
                                            <div class="fw-semibold text-dark mb-1">{{ $user->name }}</div>
                                            <div class="text-muted small">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Role Badge -->
                                <td>
                                    @php
                                        $roleName = is_object($user->role) ? ($user->role->nama ?? $user->role->name ?? 'Kasir') : ($user->role ?? 'Kasir');
                                        $isAdmin = strtolower($roleName) === 'admin';
                                    @endphp
                                    <span class="badge {{ $isAdmin ? 'bg-primary bg-opacity-10 text-primary' : 'bg-success bg-opacity-10 text-success' }} fw-bold px-3 py-2 rounded-pill text-capitalize">
                                        <i class="bi {{ $isAdmin ? 'bi-shield-lock-fill' : 'bi-person-badge-fill' }} me-1"></i>
                                        {{ $roleName }}
                                    </span>
                                </td>

                                <!-- Action Buttons -->
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                                           class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 px-2.5 py-1" 
                                           title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 px-2.5 py-1" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"
                                                    title="Hapus User">
                                                <i class="bi bi-trash"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bi bi-people fs-1 text-secondary d-block mb-2"></i>
                                    <span>Tidak ada data user yang ditemukan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination -->
        @if (method_exists($users, 'hasPages') && $users->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $users->links() }}
            </div>
        @endif

    </div>

@endsection