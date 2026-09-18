<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TOKO BERKAH UTAMA - Sembako & Kebutuhan Pokok</title>
<meta name="description" content="Toko Berkah Utama - Menyediakan kebutuhan pokok, sembako eceran dan grosir harga murah di Tasikmalaya.">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
<style>
    :root {
        --primary: #16A34A; /* Hijau Segar Sembako */
        --primary-dark: #15803D;
        --navy: #1F2937;
        --muted: #6B7280;
        --bg-soft: #F8FAFC;
        --border-soft: #E2E8F0;
    }
    body { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; color: var(--navy); background: #fff; }

    .navbar-brand-custom { font-weight: 700; font-size: 1.3rem; color: var(--navy) !important; }
    .nav-link-custom { color: var(--muted) !important; font-weight: 500; font-size: 0.95rem; }
    .nav-link-custom:hover { color: var(--primary) !important; }

    .hero { padding: 5.5rem 0 4.5rem; background: linear-gradient(180deg, #F8FAFC 0%, #ffffff 100%); }
    .hero-badge {
        background: rgba(22, 163, 74, 0.08); color: var(--primary); font-weight: 600; font-size: 0.85rem;
        padding: 0.4rem 0.9rem; border-radius: 50px; display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .hero h1 { font-size: 2.75rem; font-weight: 800; line-height: 1.15; letter-spacing: -0.02em; }
    .hero p.lead { color: var(--muted); font-size: 1.1rem; max-width: 520px; }

    .btn-primary-custom {
        background: var(--primary); border: none; color: #fff; font-weight: 600;
        padding: 0.75rem 1.6rem; border-radius: 0.6rem; transition: background 0.15s ease;
    }
    .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; }
    .btn-outline-custom {
        border: 1px solid var(--border-soft); color: var(--navy); font-weight: 600;
        padding: 0.75rem 1.6rem; border-radius: 0.6rem; background: #fff;
    }
    .btn-outline-custom:hover { background: var(--bg-soft); color: var(--navy); }

    .hero-visual {
        background: linear-gradient(135deg, #16A34A 0%, #15803D 100%); border-radius: 1.25rem;
        padding: 2.5rem; color: #fff; position: relative; overflow: hidden;
        box-shadow: 0 20px 40px rgba(22, 163, 74, 0.2);
    }
    .hero-visual .bi { opacity: 0.15; position: absolute; font-size: 9rem; top: -1rem; right: -1rem; }

    .section-eyebrow { color: var(--primary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem; }
    .section-title { font-size: 1.9rem; font-weight: 700; margin-bottom: 0.75rem; letter-spacing: -0.01em; }
    .section-sub { color: var(--muted); max-width: 620px; }

    .service-card {
        border: 1px solid var(--border-soft); border-radius: 1rem; padding: 1.9rem; height: 100%;
        transition: box-shadow 0.15s ease, transform 0.15s ease;
    }
    .service-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.06); transform: translateY(-2px); }
    .service-icon {
        width: 48px; height: 48px; border-radius: 0.7rem; background: rgba(22, 163, 74, 0.08); color: var(--primary);
        display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 1rem;
    }
    .service-card h5 { font-weight: 700; }
    .service-card p { color: var(--muted); font-size: 0.93rem; margin-bottom: 0; }

    .product-card {
        border: 1px solid var(--border-soft); border-radius: 1rem; overflow: hidden; height: 100%; background: #fff;
    }
    .product-photo {
        width: 100%; height: 160px; object-fit: cover; background: var(--bg-soft);
    }
    .product-photo-fallback {
        width: 100%; height: 160px; display: flex; align-items: center; justify-content: center;
        background: var(--bg-soft); color: #CBD5E1; font-size: 2.2rem;
    }
    .product-body { padding: 1rem 1.1rem; }
    .product-body h6 { font-weight: 700; margin-bottom: 0.25rem; font-size: 0.95rem; }
    .product-price { color: var(--primary); font-weight: 700; font-size: 0.95rem; }
    .badge-bestseller {
        background: #FEF3C7; color: #92400E; font-size: 0.72rem; font-weight: 700;
        padding: 0.3rem 0.6rem; border-radius: 50px;
    }

    .why-item { display: flex; gap: 1rem; align-items: flex-start; }
    .why-icon {
        width: 42px; height: 42px; border-radius: 50%; background: rgba(22, 163, 74, 0.08); color: var(--primary);
        display: flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;
    }
    .why-item h6 { font-weight: 700; margin-bottom: 0.2rem; }
    .why-item p { color: var(--muted); font-size: 0.9rem; margin-bottom: 0; }

    .contact-box { background: var(--navy); border-radius: 1.25rem; padding: 2.5rem; color: #fff; }
    .contact-box .info-row { display: flex; gap: 0.9rem; align-items: flex-start; margin-bottom: 1.3rem; }
    .contact-box .info-row i { font-size: 1.1rem; color: #86EFAC; margin-top: 0.2rem; }
    .contact-box .info-row .label { font-size: 0.8rem; color: rgba(255,255,255,0.55); margin-bottom: 0.15rem; }
    .contact-box .info-row .value { font-weight: 600; }
    .map-frame { border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-soft); min-height: 340px; }

    .social-btn {
        width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,0.1); color: #fff;
        display: inline-flex; align-items: center; justify-content: center; text-decoration: none; font-size: 1.1rem;
    }
    .social-btn:hover { background: rgba(255,255,255,0.2); color: #fff; }

    footer { border-top: 1px solid var(--border-soft); padding: 2.2rem 0; color: var(--muted); font-size: 0.88rem; }
    section { scroll-margin-top: 80px; }

    .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.is-visible { opacity: 1; transform: translateY(0); }
    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
    }

    #backToTop {
        position: fixed; bottom: 24px; right: 24px; width: 46px; height: 46px; border-radius: 50%;
        background: var(--primary); color: #fff; border: none; display: none; align-items: center; justify-content: center;
        font-size: 1.2rem; box-shadow: 0 8px 20px rgba(22, 163, 74, 0.35); z-index: 999; transition: opacity 0.2s ease;
    }
    #backToTop:hover { background: var(--primary-dark); }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top border-bottom py-3">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom d-flex align-items-center gap-2" href="#top">
            <span class="bg-success text-white rounded-3 d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
                <i class="bi bi-basket2-fill"></i>
            </span>
            BERKAH UTAMA
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navMenu">
            <ul class="navbar-nav align-items-md-center gap-md-4">
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#layanan">Layanan</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#produk">Produk</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#kontak">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="top" class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <span class="hero-badge"><i class="bi bi-geo-alt"></i> Cihideung, Tasikmalaya</span>
                <h1 class="mt-3 mb-3">Toko sembako terpercaya untuk kebutuhan harian.</h1>
                <p class="lead mb-4">
                    Toko Berkah Utama menyediakan beras, minyak goreng, gula, telur, hingga barang kebutuhan dapur sehari-hari dengan harga terjangkau dan barang yang selalu baru.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#produk" class="btn btn-primary-custom"><i class="bi bi-bag-check me-1"></i> Lihat Produk</a>
                    <a href="#kontak" class="btn btn-outline-custom">Hubungi Kami</a>
                </div>
            </div>
            <div class="col-lg-6 reveal">
                <div class="hero-visual">
                    <i class="bi bi-basket2-fill"></i>
                    <span class="badge bg-white bg-opacity-25 text-white px-3 py-2 rounded-pill mb-3">BERKAH UTAMA</span>
                    <h3 class="fw-bold mb-2">Sedia Sembako Eceran & Grosir</h3>
                    <p class="text-white-50 mb-0">Satu tempat lengkap untuk belanja kebutuhan dapur keluarga Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LAYANAN -->
<section id="layanan" class="py-5 my-4">
    <div class="container">
        <div class="text-center mx-auto mb-5 reveal" style="max-width:600px;">
            <div class="section-eyebrow">Layanan Kami</div>
            <h2 class="section-title">Melayani dengan jujur, cepat, dan ramah.</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5 reveal">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-shop"></i></div>
                    <h5>Penjualan Eceran</h5>
                    <p>Membantu kebutuhan harian dapur seperti beras kiloan, minyak pouch, bumbu dapur, dan barang kelontong lengkap.</p>
                </div>
            </div>
            <div class="col-md-5 reveal">
                <div class="service-card">
                    <div class="service-icon"><i class="bi bi-box-seam"></i></div>
                    <h5>Penjualan Grosir / Karungan</h5>
                    <p>Menyediakan beras karungan, minyak dus-dusan, dan gula karton untuk stok warung atau hajatan dengan harga khusus.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- KENAPA PILIH KAMI -->
<section class="py-5 my-4">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 reveal">
                <div class="section-eyebrow">Alasan Memilih Kami</div>
                <h2 class="section-title">Kenapa warga langganan di Berkah Utama.</h2>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-md-6 reveal">
                        <div class="why-item">
                            <div class="why-icon"><i class="bi bi-tag"></i></div>
                            <div><h6>Harga Bersahabat</h6><p>Harga kompetitif untuk eceran maupun pembelian partai besar.</p></div>
                        </div>
                    </div>
                    <div class="col-md-6 reveal">
                        <div class="why-item">
                            <div class="why-icon"><i class="bi bi-patch-check"></i></div>
                            <div><h6>Barang Selalu Baru</h6><p>Stok selalu berputar sehingga kualitas bahan makanan tetap segar.</p></div>
                        </div>
                    </div>
                    <div class="col-md-6 reveal">
                        <div class="why-item">
                            <div class="why-icon"><i class="bi bi-heart"></i></div>
                            <div><h6>Pelayanan Ramah</h6><p>Dilayani dengan cepat, hangat, dan mengutamakan kenyamanan pembeli.</p></div>
                        </div>
                    </div>
                    <div class="col-md-6 reveal">
                        <div class="why-item">
                            <div class="why-icon"><i class="bi bi-geo-alt"></i></div>
                            <div><h6>Lokasi Strategis</h6><p>Mudah dijangkau oleh warga sekitar pemukiman Cihideung.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="kontak" class="py-5 my-4">
    <div class="container">
        <div class="text-center mx-auto mb-5 reveal" style="max-width:600px;">
            <div class="section-eyebrow">Hubungi Kami</div>
            <h2 class="section-title">Datang langsung atau hubungi WhatsApp.</h2>
        </div>
        <div class="row g-4">
            <div class="col-lg-5 reveal">
                <div class="contact-box h-100">
                    <div class="info-row">
                        <i class="bi bi-geo-alt-fill"></i>
                        <div>
                            <div class="label">Alamat Toko</div>
                            <div class="value">Jl. Paseh No. 12, Tugujaya, Kec. Cihideung, Kab. Tasikmalaya, Jawa Barat 46126</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <i class="bi bi-whatsapp"></i>
                        <div>
                            <div class="label">WhatsApp / Telepon</div>
                            <div class="value">0812XXXXXXXX</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <i class="bi bi-clock-fill"></i>
                        <div>
                            <div class="label">Jam Operasional</div>
                            <div class="value">06.00 - 21.00 WIB</div>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-btn" title="Instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 reveal">
                <div class="map-frame">
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode('Jl. Paseh, Tugujaya, Kec. Cihideung, Kab. Tasikmalaya, Jawa Barat 46126') }}&output=embed"
                        width="100%" height="100%" style="border:0; min-height:340px;" allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <div class="d-flex align-items-center gap-2">
            <span class="bg-success text-white rounded-2 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:0.8rem;">
                <i class="bi bi-basket2-fill"></i>
            </span>
            <strong class="text-dark">TOKO BERKAH UTAMA</strong>
            <a href="{{ route('login') }}" class="text-muted text-decoration-none ms-2" style="font-size: 0.75rem; opacity: 0.4;" title="Area Admin / Kasir">
                <i class="bi bi-lock-fill"></i> Login
            </a>
        </div>
        <div>&copy; {{ date('Y') }} Toko Berkah Utama. Sembako Cihideung, Tasikmalaya.</div>
    </div>
</footer>

<button id="backToTop" title="Kembali ke atas"><i class="bi bi-arrow-up"></i></button>

<script>
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });
    revealEls.forEach(el => observer.observe(el));

    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });
    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>