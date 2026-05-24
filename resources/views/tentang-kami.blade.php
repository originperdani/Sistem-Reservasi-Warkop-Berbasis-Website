@extends('layouts.main')

@section('title', 'Tentang Kami - Warkop Pamulang')

@push('styles')
    <style>
        .about-hero {
            padding: 100px 0 60px;
            position: relative;
        }
        .about-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(155, 27, 48, 0.08);
            color: var(--primary-red);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }
        .about-hero h1 {
            font-size: 3.2rem;
            font-weight: 800;
            color: var(--primary-red);
            line-height: 1.15;
            margin-bottom: 20px;
        }
        .about-hero p.lead {
            font-size: 1.15rem;
            color: #6D4C41;
            line-height: 1.8;
        }
        .about-hero-img {
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
            position: relative;
        }
        .about-hero-img img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .about-hero-img:hover img {
            transform: scale(1.05);
        }
        .about-hero-img .overlay-badge {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(155, 27, 48, 0.9);
            backdrop-filter: blur(10px);
            color: white;
            padding: 12px 24px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .section-about {
            padding: 80px 0;
        }
        .section-title-sm {
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary-red);
            margin-bottom: 10px;
        }
        .section-title-lg {
            font-weight: 800;
            font-size: 2.2rem;
            color: #333;
            margin-bottom: 15px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 35px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.04);
            transition: all 0.4s ease;
            height: 100%;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }
        .glass-card .icon-circle {
            width: 65px;
            height: 65px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary-red), var(--secondary-red));
            color: white;
            box-shadow: 0 8px 20px rgba(155, 27, 48, 0.25);
        }
        .glass-card h5 {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        .glass-card p {
            color: #777;
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 0;
        }

        .story-section {
            background: linear-gradient(135deg, rgba(155, 27, 48, 0.03) 0%, rgba(245, 230, 211, 0.3) 100%);
            border-radius: 40px;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .story-section::before {
            content: '"';
            position: absolute;
            top: 20px;
            left: 40px;
            font-size: 8rem;
            color: var(--primary-red);
            opacity: 0.08;
            font-family: Georgia, serif;
            line-height: 1;
        }
        .story-text {
            font-size: 1.05rem;
            line-height: 1.9;
            color: #555;
        }

        .vm-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .vm-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--header-gradient);
            border-radius: 0 0 25px 25px;
        }
        .vm-card .vm-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 20px;
        }
        .vm-card h4 {
            font-weight: 800;
            margin-bottom: 15px;
            color: #333;
        }
        .vm-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .vm-card ul li {
            padding: 8px 0;
            color: #666;
            font-size: 0.95rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .vm-card ul li i {
            color: var(--primary-red);
            font-size: 0.75rem;
            margin-top: 5px;
            flex-shrink: 0;
        }

        .stat-item {
            text-align: center;
            padding: 25px;
        }
        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-red);
            line-height: 1;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 0.85rem;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stat-divider {
            width: 1px;
            background: rgba(155, 27, 48, 0.1);
            align-self: stretch;
        }

        .cta-about {
            background: var(--header-gradient);
            border-radius: 30px;
            padding: 60px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .cta-about::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .cta-about::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .cta-about h2 {
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }
        .cta-about p {
            opacity: 0.9;
            font-size: 1.05rem;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
        }
        .cta-about .btn {
            position: relative;
            z-index: 2;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-6" data-aos="fade-right">
                    <div class="about-hero-badge">
                        <i class="bi bi-cup-hot-fill"></i> Tentang Kami
                    </div>
                    <h1>Warkop Pamulang</h1>
                    <p class="lead">
                        Tempat nongkrong paling nyaman di Pamulang! Kami menyajikan kopi pilihan terbaik dan hidangan berkualitas dalam suasana yang hangat dan bersahabat. Berdiri sejak 2020, kami terus berkomitmen memberikan pengalaman terbaik untuk setiap pengunjung.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="{{ route('menu.index') }}" class="btn btn-primary px-4 py-3 rounded-pill">
                            <i class="bi bi-egg-fried me-2"></i>Lihat Menu Kami
                        </a>
                        <a href="{{ route('panduan') }}" class="btn btn-outline-custom px-4 py-3 rounded-pill">
                            <i class="bi bi-book me-2"></i>Panduan Pemesanan
                        </a>
                    </div>
                </div>
                <div class="col-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="about-hero-img">
                        <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?auto=format&fit=crop&q=80&w=800" alt="Suasana Warkop Pamulang">
                        <div class="overlay-badge">
                            <i class="bi bi-geo-alt-fill me-2"></i> Serpong, Tangerang Selatan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <section class="pb-5" style="width: 100%;">
        <div class="container" data-aos="fade-up">
            <div class="glass-card d-flex justify-content-center align-items-center" style="padding: 20px 40px;">
                <div class="stat-item">
                    <div class="stat-number">5+</div>
                    <div class="stat-label">Tahun Berdiri</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">35+</div>
                    <div class="stat-label">Pilihan Meja</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Menu Tersedia</div>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <div class="stat-number">1000+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="section-about" style="width: 100%;">
        <div class="container">
            <div class="story-section" data-aos="fade-up">
                <div class="row align-items-center g-5">
                    <div class="col-5">
                        <div class="section-title-sm">Cerita Kami</div>
                        <h2 class="section-title-lg">Dari Secangkir Kopi, Menjadi Rumah Kedua</h2>
                    </div>
                    <div class="col-7">
                        <p class="story-text mb-0">
                            Warkop Pamulang berawal dari sebuah mimpi sederhana — menciptakan tempat di mana semua orang bisa menikmati kopi berkualitas dengan harga terjangkau. Berlokasi di Jl. Raya Puspitek No.31, Buaran, Serpong, kami hadir sebagai ruang berkumpul untuk keluarga, teman, hingga para pekerja yang membutuhkan suasana nyaman.
                            <br><br>
                            Dengan area <strong>indoor smoking</strong>, <strong>non-smoking</strong>, <strong>lesehan</strong>, dan <strong>outdoor</strong>, kami memastikan setiap pengunjung mendapatkan tempat yang sesuai dengan kebutuhan mereka. Sistem reservasi online kami memudahkan Anda untuk memesan meja dan menu sebelum datang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="pb-5" style="width: 100%;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-title-sm text-center">Visi & Misi</div>
                <h2 class="section-title-lg text-center">Komitmen Kami untuk Anda</h2>
            </div>
            <div class="row g-4">
                <div class="col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="vm-card">
                        <div class="vm-icon" style="background: rgba(155, 27, 48, 0.1); color: var(--primary-red);">
                            <i class="bi bi-eye-fill"></i>
                        </div>
                        <h4>Visi</h4>
                        <ul>
                            <li>
                                <i class="bi bi-circle-fill"></i>
                                <span>Menjadi warkop terbaik dan terfavorit di Tangerang Selatan yang dikenal dengan kualitas pelayanan dan cita rasa menu yang konsisten.</span>
                            </li>
                            <li>
                                <i class="bi bi-circle-fill"></i>
                                <span>Menciptakan ruang sosial yang nyaman dan inklusif untuk semua kalangan masyarakat.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="vm-card">
                        <div class="vm-icon" style="background: rgba(155, 27, 48, 0.1); color: var(--primary-red);">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h4>Misi</h4>
                        <ul>
                            <li><i class="bi bi-circle-fill"></i><span>Menyajikan kopi dan hidangan berkualitas tinggi dengan harga yang terjangkau.</span></li>
                            <li><i class="bi bi-circle-fill"></i><span>Menyediakan sistem reservasi online yang mudah dan praktis bagi pelanggan.</span></li>
                            <li><i class="bi bi-circle-fill"></i><span>Memberikan pelayanan yang ramah, cepat, dan profesional kepada setiap pengunjung.</span></li>
                            <li><i class="bi bi-circle-fill"></i><span>Terus berinovasi dalam menu dan fasilitas untuk kenyamanan pelanggan.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section class="section-about" style="width: 100%; background: linear-gradient(180deg, transparent, rgba(245,230,211,0.2), transparent);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-title-sm text-center">Keunggulan</div>
                <h2 class="section-title-lg text-center">Kenapa Harus Warkop Pamulang?</h2>
            </div>
            <div class="row g-4">
                <div class="col-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card text-center">
                        <div class="icon-circle mx-auto"><i class="bi bi-wifi"></i></div>
                        <h5>WiFi Gratis</h5>
                        <p>Koneksi internet cepat dan stabil untuk kerja maupun bersantai.</p>
                    </div>
                </div>
                <div class="col-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card text-center">
                        <div class="icon-circle mx-auto"><i class="bi bi-calendar2-check"></i></div>
                        <h5>Reservasi Online</h5>
                        <p>Pesan meja dan menu dari rumah tanpa perlu antri saat datang.</p>
                    </div>
                </div>
                <div class="col-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card text-center">
                        <div class="icon-circle mx-auto"><i class="bi bi-building"></i></div>
                        <h5>4 Area Berbeda</h5>
                        <p>Smoking, non-smoking, lesehan, dan outdoor sesuai keinginan Anda.</p>
                    </div>
                </div>
                <div class="col-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="glass-card text-center">
                        <div class="icon-circle mx-auto"><i class="bi bi-clock"></i></div>
                        <h5>Buka Setiap Hari</h5>
                        <p>Melayani Anda setiap hari dari pagi hingga malam hari.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="pb-5" style="width: 100%; padding-top: 20px;">
        <div class="container" data-aos="fade-up">
            <div class="cta-about">
                <h2>Siap Menikmati Pengalaman Terbaik?</h2>
                <p>Pesan menu favorit Anda sekarang dan reservasi meja dengan mudah melalui sistem kami.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('menu.index') }}" class="btn bg-white text-custom-red fw-bold px-5 py-3 rounded-pill shadow">
                        <i class="bi bi-egg-fried me-2"></i>Lihat Menu
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-calendar-check me-2"></i>Reservasi Meja
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
