<style>
    /* Menggeser konten utama ke kanan agar tidak tertutup sidebar */
    @media (min-width: 992px) {
        body {
            padding-left: 260px;
        }
        .sidebar-desktop {
            width: 260px;
        }
    }
</style>

<!-- Sidebar Navigasi -->
<div class="sidebar-desktop position-fixed top-0 bottom-0 start-0 bg-white border-end shadow-sm d-flex flex-column justify-content-between p-3 z-3">
    <div>
        <!-- Brand Logo / Title -->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5 mb-4 px-2">
            <i class="bi bi-shop text-primary fs-4"></i>
            <span>POS</span>
        </a>

        <!-- Menu Links -->
        <div class="nav nav-pills flex-column gap-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('dashboard*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-grid-1x2 fs-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Users (Khusus Admin) -->
            @if(auth()->user()->role === 'admin' || auth()->user()->role_id == 1)
            <a href="{{ route('admin.users') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('admin/users*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-people fs-5"></i>
                <span>Users</span>
            </a>
            @endif

            <!-- Produk -->
            <a href="{{ route('produk.index') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('produk*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-box-seam fs-5"></i>
                <span>Produk</span>
            </a>

            <!-- Penjualan -->
            <a href="{{ route('penjualan.index') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('penjualan*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-receipt fs-5"></i>
                <span>Penjualan</span>
            </a>
            <!-- Jenis -->
            <a href="{{ route('jenis.index') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('jenis*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-tag fs-5"></i>
                <span>Jenis</span>
            </a>
        </div>
    </div>

    <!-- User Profile & Logout Box (Bagian Bawah) -->
    <div class="border-top pt-3">
        <div class="d-flex align-items-center gap-2 mb-3 px-1">
            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="overflow-hidden">
                <h6 class="mb-0 text-dark fw-semibold text-truncate">{{ auth()->user()->name ?? 'User' }}</h6>
                <small class="text-muted text-capitalize" style="font-size: 0.75rem;">
                   {{ auth()->user()->role->nama ?? auth()->user()->role->name ?? 'Kasir' }}
                </small>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2 py-2 rounded-3">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>