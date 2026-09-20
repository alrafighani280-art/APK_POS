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
        --primary: #0B6477;        /* Teal Biru Utama */
        --primary-dark: #095161;   /* Teal Biru Gelap untuk Hover */
        --accent-teal: #70C1B3;    /* Light Teal untuk Aksesori/Badge */
        --navy: #142834;           /* Teks Utama / Dark Blue */
        --muted: #526774;          /* Teks Sekunder / Muted Blue */
        --bg-soft: #F4F7F6;        /* Background Lembut */
        --bg-card: #FFFFFF;        /* Background Kartu */
        --border-soft: #D1E0E0;    /* Garis Batas / Border */
    }

    body { 
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; 
        color: var(--navy); 
        background: var(--bg-soft); 
    }

    /* NAVBAR */
    .navbar-brand-custom { font-weight: 700; font-size: 1.3rem; color: var(--navy) !important; }
    .nav-link-custom { color: var(--muted) !important; font-weight: 500; font-size: 0.95rem; }
    .nav-link-custom:hover { color: var(--primary) !important; }
    .brand-icon {
        background: var(--primary) !important;
        color: #fff !important;
    }

    /* HERO */
    .hero { padding: 5.5rem 0 4.5rem; background: linear-gradient(180deg, #EBF2F2 0%, var(--bg-soft) 100%); }
    .hero-badge {
        background: rgba(11, 100, 119, 0.1); 
        color: var(--primary); 
        font-weight: 600; 
        font-size: 0.85rem;
        padding: 0.4rem 0.9rem; 
        border-radius: 50px; 
        display: inline-flex; 
        align-items: center; 
        gap: 0.4rem;
        border: 1px solid rgba(11, 100, 119, 0.2);
    }
    .hero h1 { font-size: 2.75rem; font-weight: 800; line-height: 1.15; letter-spacing: -0.02em; color: var(--navy); }
    .hero p.lead { color: var(--muted); font-size: 1.1rem; max-width: 520px; }

    /* BUTTONS */
    .btn-primary-custom {
        background: var(--primary); 
        border: none; 
        color: #fff; 
        font-weight: 600;
        padding: 0.75rem 1.6rem; 
        border-radius: 0.6rem; 
        transition: background 0.15s ease;
    }
    .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; }
    .btn-outline-custom {
        border: 1px solid var(--primary); 
        color: var(--primary); 
        font-weight: 600;
        padding: 0.75rem 1.6rem; 
        border-radius: 0.6rem; 
        background: #fff;
    }
    .btn-outline-custom:hover { background: var(--primary); color: #fff; }

    .hero-visual {
        background: linear-gradient(135deg, #0B6477 0%, #142834 100%); 
        border-radius: 1.25rem;
        padding: 2.5rem; 
        color: #fff; 
        position: relative; 
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(11, 100, 119, 0.25);
    }
    .hero-visual .bi { opacity: 0.15; position: absolute; font-size: 9rem; top: -1rem; right: -1rem; }

    /* SECTIONS */
    .section-eyebrow { color: var(--primary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.5rem; }
    .section-title { font-size: 1.9rem; font-weight: 700; margin-bottom: 0.75rem; letter-spacing: -0.01em; color: var(--navy); }
    .section-sub { color: var(--muted); max-width: 620px; }

    /* CARDS */
    .service-card {
        border: 1px solid var(--border-soft); 
        border-radius: 1rem; 
        padding: 1.9rem; 
        height: 100%;
        background: var(--bg-card);
        transition: box-shadow 0.15s ease, transform 0.15s ease;
    }
    .service-card:hover { box-shadow: 0 8px 24px rgba(11, 100, 119, 0.1); transform: translateY(-2px); }
    .service-icon {
        width: 48px; 
        height: 48px; 
        border-radius: 0.7rem; 
        background: rgba(11, 100, 119, 0.1); 
        color: var(--primary);
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.4rem; 
        margin-bottom: 1rem;
    }
    .service-card h5 { font-weight: 700; color: var(--navy); }
    .service-card p { color: var(--muted); font-size: 0.93rem; margin-bottom: 0; }

    /* WHY CHOOSE US */
    .why-item { display: flex; gap: 1rem; align-items: flex-start; }
    .why-icon {
        width: 42px; 
        height: 42px; 
        border-radius: 50%; 
        background: rgba(11, 100, 119, 0.1); 
        color: var(--primary);
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 1.15rem; 
        flex-shrink: 0;
    }
    .why-item h6 { font-weight: 700; margin-bottom: 0.2rem; color: var(--navy); }
    .why-item p { color: var(--muted); font-size: 0.9rem; margin-bottom: 0; }

    /* CONTACT BOX */
    .contact-box { background: var(--navy); border-radius: 1.25rem; padding: 2.5rem; color: #fff; }
    .contact-box .info-row { display: flex; gap: 0.9rem; align-items: flex-start; margin-bottom: 1.3rem; }
    .contact-box .info-row i { font-size: 1.1rem; color: var(--accent-teal); margin-top: 0.2rem; }
    .contact-box .info-row .label { font-size: 0.8rem; color: rgba(255,255,255,0.65); margin-bottom: 0.15rem; }
    .contact-box .info-row .value { font-weight: 600; }
    .map-frame { border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-soft); min-height: 340px; }

    .social-btn {
        width: 42px; 
        height: 42px; 
        border-radius: 50%; 
        background: rgba(255,255,255,0.12); 
        color: #fff;
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        text-decoration: none; 
        font-size: 1.1rem;
    }
    .social-btn:hover { background: var(--primary); color: #fff; }

    /* FOOTER */
    footer { border-top: 1px solid var(--border-soft); padding: 2.2rem 0; color: var(--muted); font-size: 0.88rem; background: #fff; }
    section { scroll-margin-top: 80px; }

    .reveal { opacity: 0; transform: translateY(18px); transition: opacity 0.6s ease, transform 0.6s ease; }
    .reveal.is-visible { opacity: 1; transform: translateY(0); }
    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
    }

    #backToTop {
        position: fixed; 
        bottom: 24px; 
        right: 24px; 
        width: 46px; 
        height: 46px; 
        border-radius: 50%;
        background: var(--primary); 
        color: #fff; 
        border: none; 
        display: none; 
        align-items: center; 
        justify-content: center;
        font-size: 1.2rem; 
        box-shadow: 0 8px 20px rgba(11, 100, 119, 0.35); 
        z-index: 999; 
        transition: opacity 0.2s ease;
    }
    #backToTop:hover { background: var(--primary-dark); }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top border-bottom py-3">
    <div class="container">
        <a class="navbar-brand navbar-brand-custom d-flex align-items-center gap-2" href="#top">
            <span class="brand-icon rounded-3 d-flex align-items-center justify-content-center" style="width:36px;height:36px;">
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
                <li class="nav-item"><a class="nav-link nav-link-custom" href="#kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom" href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section id="top" class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <span class="hero-badge"><i class="bi bi-geo-alt"></i> Purbaratu, Tasikmalaya</span>
                <h1 class="mt-3 mb-3">Toko sembako terpercaya untuk kebutuhan harian.</h1>
                <p class="lead mb-4">
                    Toko Berkah Utama menyediakan beras, minyak goreng, gula, telur, hingga barang kebutuhan dapur sehari-hari dengan harga terjangkau dan barang yang selalu baru.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#kontak" class="btn btn-outline-custom">Hubungi Kami</a>
                </div>
            </div>
           <!-- (FOTO TOKO FISIK) -->
            <div class="col-lg-6 reveal">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('assets/img/sembako.jpg') }}" alt="Suasana Toko Berkah Utama" class="img-fluid rounded-4 shadow-sm w-100 object-fit-cover" style="max-height: 380px;">
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
                            <div><h6>Lokasi Strategis</h6><p>Mudah dijangkau oleh warga sekitar pemukiman.</p></div>
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
                            <div class="value">Jl. Lkr. Utara Cimerak, Sukaasih, Kec. Purbaratu, Kab. Tasikmalaya, Jawa Barat 46196</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <i class="bi bi-whatsapp"></i>
                        <div>
                            <div class="label">WhatsApp / Telepon</div>
                            <div class="value">085721594989</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <i class="bi bi-clock-fill"></i>
                        <div>
                            <div class="label">Jam Operasional</div>
                            <div class="value">05.30 - 16.00 WIB</div>
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
                        src="https://www.google.com/maps?q={{ urlencode('M6GR+MCH, Jl. Lkr. Utara Cimerak, Sukaasih, Kec. Purbaratu, Kab. Tasikmalaya, Jawa Barat 46196') }}&output=embed"
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
            <span class="brand-icon rounded-2 d-flex align-items-center justify-content-center" style="width:26px;height:26px;font-size:0.8rem;">
                <i class="bi bi-basket2-fill"></i>
            </span>
            <strong class="text-dark">TOKO BERKAH UTAMA</strong>
        </div>
        <div>&copy; {{ date('Y') }} Toko Berkah Utama. Sembako Purbaratu, Tasikmalaya.</div>
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