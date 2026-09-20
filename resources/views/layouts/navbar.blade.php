<link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

<!-- Topbar Mobile (hanya muncul di layar < 992px) -->
<div class="topbar-mobile position-fixed top-0 start-0 end-0 bg-white border-bottom shadow-sm align-items-center justify-content-between px-3 z-3" style="height: 56px;">
    <button class="btn btn-outline-secondary btn-sm" type="button" id="sidebarToggleBtn">
        <i class="bi bi-list fs-5"></i>
    </button>
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5">
        <i class="bi bi-shop text-primary fs-4"></i>
        <span>BAROKAH UTAMA</span>
    </a>
    <div style="width: 38px;"></div> <!-- spacer biar judul center -->
</div>

<!-- Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar Navigasi -->
<div class="sidebar-desktop position-fixed top-0 bottom-0 start-0 bg-white border-end shadow-sm d-flex flex-column justify-content-between p-3" id="sidebarNav">
    <div>
        <!-- Brand Logo / Title -->
        <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold fs-5 mb-4 px-2">
            <i class="bi bi-shop text-primary fs-4"></i>
            <span>BAROKAH UTAMA</span>
        </a>

        <!-- Menu Links -->
        <div class="nav nav-pills flex-column gap-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('dashboard*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-grid-1x2 fs-5"></i>
                <span>Beranda</span>
            </a>

            <!-- Users (Khusus Admin) -->
            @if(auth()->user()->role === 'admin' || auth()->user()->role_id == 1)
            <a href="{{ route('admin.users') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('admin/users*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-people fs-5"></i>
                <span>Pengguna</span>
            </a>

             <!-- Jenis -->
            <a href="{{ route('jenis.index') }}" 
               class="nav-link d-flex align-items-center gap-3 px-3 py-2 rounded-3 {{ Request::is('jenis*') ? 'active bg-danger bg-opacity-10 text-danger fw-semibold' : 'text-secondary' }}">
                <i class="bi bi-tag fs-5"></i>
                <span>Jenis</span>
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

        <form action="{{ route('logout') }}" method="POST" id="logoutForm">
            @csrf
            <button type="button" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2 py-2 rounded-3" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4 p-2">
            <div class="modal-body text-center py-4">
                <div class="mb-3">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-box-arrow-right fs-2"></i>
                    </div>
                </div>
                <h5 class="fw-bold text-dark mb-2" id="logoutModalLabel">Konfirmasi Logout</h5>
                <p class="text-muted mb-4 fs-6">Apakah kamu yakin ingin keluar dari aplikasi POS ini?</p>
                
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light px-4 rounded-3 fw-semibold" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary px-4 rounded-3 fw-semibold" id="confirmLogoutBtn">Ya, Keluar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebarNav');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggleBtn');

    function openSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    }

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    // Tutup otomatis saat link menu diklik (khusus mobile)
    sidebar.querySelectorAll('a.nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 992) closeSidebar();
        });
    });

    // Reset state saat resize ke desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) closeSidebar();
    });

    // Konfirmasi Logout Script
    const confirmLogoutBtn = document.getElementById('confirmLogoutBtn');
    const logoutForm = document.getElementById('logoutForm');

    if (confirmLogoutBtn && logoutForm) {
        confirmLogoutBtn.addEventListener('click', function () {
            logoutForm.submit();
        });
    }
});
</script>