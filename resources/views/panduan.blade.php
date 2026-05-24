@extends('layouts.main')
@section('title', 'Panduan Pemesanan - Warkop Pamulang')
@push('styles')
<style>
    .panduan-hero { padding: 100px 0 60px; }
    .panduan-hero-badge { display:inline-flex; align-items:center; gap:8px; background:rgba(155,27,48,0.08); color:var(--primary-red); padding:8px 20px; border-radius:50px; font-weight:700; font-size:0.8rem; text-transform:uppercase; letter-spacing:2px; margin-bottom:20px; }
    .panduan-hero h1 { font-size:3rem; font-weight:800; color:var(--primary-red); line-height:1.15; margin-bottom:20px; }
    .panduan-hero p.lead { font-size:1.1rem; color:#6D4C41; line-height:1.8; }

    .flow-section { padding:60px 0; width:100%; }
    .section-title-sm { font-weight:700; font-size:0.8rem; text-transform:uppercase; letter-spacing:2px; color:var(--primary-red); margin-bottom:10px; }
    .section-title-lg { font-weight:800; font-size:2.2rem; color:#333; margin-bottom:15px; }

    .step-timeline { position:relative; padding:40px 0; }
    .step-timeline::before { content:''; position:absolute; left:50%; top:0; bottom:0; width:3px; background:linear-gradient(180deg, var(--primary-red), rgba(155,27,48,0.1)); transform:translateX(-50%); border-radius:3px; }

    .step-item { display:flex; align-items:flex-start; margin-bottom:60px; position:relative; }
    .step-item:last-child { margin-bottom:0; }
    .step-item.left .step-content { text-align:right; padding-right:60px; }
    .step-item.right .step-content { text-align:left; padding-left:60px; }
    .step-item.left { flex-direction:row; }
    .step-item.right { flex-direction:row-reverse; }
    .step-content { flex:1; }
    .step-spacer { flex:1; }

    .step-dot { width:60px; height:60px; border-radius:50%; background:var(--header-gradient); color:white; display:flex; align-items:center; justify-content:center; font-size:1.3rem; font-weight:800; flex-shrink:0; z-index:2; box-shadow:0 8px 25px rgba(155,27,48,0.3); position:relative; border:6px solid #FEFBF6; }
    .step-dot::after { content:''; position:absolute; inset:-9px; border-radius:50%; border:2px solid rgba(155,27,48,0.12); }

    .step-card { background:rgba(255,255,255,0.8); backdrop-filter:blur(15px); border-radius:25px; padding:30px; border:1px solid rgba(255,255,255,0.5); box-shadow:0 10px 30px rgba(0,0,0,0.04); transition:all 0.4s ease; }
    .step-card:hover { transform:translateY(-5px); box-shadow:0 20px 40px rgba(0,0,0,0.08); }
    .step-card h4 { font-weight:800; color:#333; margin-bottom:10px; font-size:1.2rem; }
    .step-card p { color:#777; font-size:0.9rem; line-height:1.7; margin-bottom:0; }
    .step-card .step-icon { width:50px; height:50px; border-radius:15px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; margin-bottom:15px; background:rgba(155,27,48,0.08); color:var(--primary-red); }
    .step-item.left .step-card .step-icon { margin-left:auto; }

    .tip-card { background:rgba(255,255,255,0.7); backdrop-filter:blur(15px); border-radius:25px; padding:30px; border:1px solid rgba(255,255,255,0.5); box-shadow:0 10px 30px rgba(0,0,0,0.04); height:100%; transition:all 0.4s ease; }
    .tip-card:hover { transform:translateY(-5px); box-shadow:0 20px 40px rgba(0,0,0,0.08); }
    .tip-card .tip-icon { width:55px; height:55px; border-radius:18px; display:flex; align-items:center; justify-content:center; font-size:1.4rem; margin-bottom:15px; }
    .tip-card h5 { font-weight:700; color:#333; margin-bottom:8px; }
    .tip-card p { color:#777; font-size:0.88rem; line-height:1.7; margin-bottom:0; }

    .cta-panduan { background:var(--header-gradient); border-radius:30px; padding:50px; text-align:center; color:white; position:relative; overflow:hidden; }
    .cta-panduan::before { content:''; position:absolute; top:-50%; right:-20%; width:300px; height:300px; border-radius:50%; background:rgba(255,255,255,0.05); }
    .cta-panduan h2 { font-weight:800; font-size:2rem; margin-bottom:10px; position:relative; z-index:2; }
    .cta-panduan p { opacity:0.9; font-size:1rem; margin-bottom:25px; position:relative; z-index:2; }
    .cta-panduan .btn { position:relative; z-index:2; }

    @media (max-width: 768px) {
        .step-timeline::before { left:30px; }
        .step-item, .step-item.right { flex-direction:column !important; align-items:flex-start; padding-left:80px; }
        .step-item .step-content, .step-item.left .step-content, .step-item.right .step-content { text-align:left !important; padding:15px 0 0 0 !important; }
        .step-spacer { display:none; }
        .step-dot { position:absolute; left:0; }
        .step-item.left .step-card .step-icon { margin-left:0; }
    }
</style>
@endpush

@section('content')
    <div class="panduan-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-6" data-aos="fade-right">
                    <div class="panduan-hero-badge"><i class="bi bi-book-fill"></i> Panduan</div>
                    <h1>Panduan Pemesanan</h1>
                    <p class="lead">Ikuti langkah-langkah mudah berikut untuk memesan menu dan reservasi meja di Warkop Pamulang. Proses cepat, praktis, dan tanpa ribet!</p>
                </div>
                <div class="col-6" data-aos="fade-left" data-aos-delay="200">
                    <div style="background:rgba(255,255,255,0.7); backdrop-filter:blur(15px); border-radius:25px; padding:35px; border:1px solid rgba(255,255,255,0.5); box-shadow:0 15px 35px rgba(0,0,0,0.05);">
                        <h5 class="fw-bold text-custom-red mb-3"><i class="bi bi-lightning-fill me-2"></i>Ringkasan Alur</h5>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge bg-custom-red px-3 py-2 rounded-pill fw-bold" style="font-size:0.8rem;">Daftar / Login</span>
                            <i class="bi bi-arrow-right text-muted"></i>
                            <span class="badge bg-custom-red px-3 py-2 rounded-pill fw-bold" style="font-size:0.8rem;">Pilih Menu</span>
                            <i class="bi bi-arrow-right text-muted"></i>
                            <span class="badge bg-custom-red px-3 py-2 rounded-pill fw-bold" style="font-size:0.8rem;">Keranjang</span>
                            <i class="bi bi-arrow-right text-muted"></i>
                            <span class="badge bg-custom-red px-3 py-2 rounded-pill fw-bold" style="font-size:0.8rem;">Reservasi Meja</span>
                            <i class="bi bi-arrow-right text-muted"></i>
                            <span class="badge bg-custom-red px-3 py-2 rounded-pill fw-bold" style="font-size:0.8rem;">Konfirmasi</span>
                        </div>
                        <hr style="border-color:rgba(155,27,48,0.1);">
                        <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i> Proses pemesanan hanya membutuhkan waktu kurang dari 5 menit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Steps -->
    <section class="flow-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-title-sm text-center">Langkah demi Langkah</div>
                <h2 class="section-title-lg text-center">Alur Pemesanan & Reservasi</h2>
            </div>

            <div class="step-timeline">
                <!-- Step 1 -->
                <div class="step-item left" data-aos="fade-right">
                    <div class="step-content">
                        <div class="step-card">
                            <div class="step-icon"><i class="bi bi-person-plus-fill"></i></div>
                            <h4>Daftar atau Login Akun</h4>
                            <p>Buat akun baru dengan mengklik tombol <strong>"Daftar"</strong> di navbar, atau login jika sudah punya akun. Isi nama, email, dan password Anda.</p>
                        </div>
                    </div>
                    <div class="step-dot">1</div>
                    <div class="step-spacer"></div>
                </div>
                <!-- Step 2 -->
                <div class="step-item right" data-aos="fade-left">
                    <div class="step-content">
                        <div class="step-card">
                            <div class="step-icon"><i class="bi bi-egg-fried"></i></div>
                            <h4>Jelajahi Menu</h4>
                            <p>Klik menu <strong>"Menu"</strong> di navbar untuk melihat semua pilihan makanan dan minuman. Temukan favorit Anda dari berbagai kategori: kopi, makanan berat, cemilan, dan minuman segar.</p>
                        </div>
                    </div>
                    <div class="step-dot">2</div>
                    <div class="step-spacer"></div>
                </div>
                <!-- Step 3 -->
                <div class="step-item left" data-aos="fade-right">
                    <div class="step-content">
                        <div class="step-card">
                            <div class="step-icon"><i class="bi bi-cart-plus-fill"></i></div>
                            <h4>Tambah ke Keranjang</h4>
                            <p>Klik tombol <strong>"+"</strong> pada menu yang diinginkan. Tentukan jumlah porsi, lalu klik <strong>"Tambah ke Keranjang"</strong>. Anda bisa menambahkan beberapa menu sekaligus.</p>
                        </div>
                    </div>
                    <div class="step-dot">3</div>
                    <div class="step-spacer"></div>
                </div>
                <!-- Step 4 -->
                <div class="step-item right" data-aos="fade-left">
                    <div class="step-content">
                        <div class="step-card">
                            <div class="step-icon"><i class="bi bi-bag-check-fill"></i></div>
                            <h4>Cek Keranjang</h4>
                            <p>Klik ikon <strong>keranjang <i class="bi bi-cart3"></i></strong> di navbar untuk melihat pesanan Anda. Atur jumlah, hapus item jika perlu, dan lihat total harga. Lalu pilih <strong>"Pesan & Reservasi Meja"</strong>.</p>
                        </div>
                    </div>
                    <div class="step-dot">4</div>
                    <div class="step-spacer"></div>
                </div>
                <!-- Step 5 -->
                <div class="step-item left" data-aos="fade-right">
                    <div class="step-content">
                        <div class="step-card">
                            <div class="step-icon"><i class="bi bi-calendar2-check"></i></div>
                            <h4>Reservasi Meja</h4>
                            <p>Anda akan diarahkan ke halaman <strong>"Reservasi Meja"</strong>. Lihat denah meja yang tersedia, klik meja yang diinginkan. Isi tanggal, waktu, durasi, dan nomor WhatsApp Anda.</p>
                        </div>
                    </div>
                    <div class="step-dot">5</div>
                    <div class="step-spacer"></div>
                </div>
                <!-- Step 6 -->
                <div class="step-item right" data-aos="fade-left">
                    <div class="step-content">
                        <div class="step-card">
                            <div class="step-icon"><i class="bi bi-check-circle-fill"></i></div>
                            <h4>Konfirmasi & Selesai!</h4>
                            <p>Klik <strong>"Konfirmasi Reservasi Sekarang"</strong>. Pesanan Anda akan masuk ke sistem dan admin akan mengkonfirmasi melalui WhatsApp. Anda bisa melihat status reservasi di halaman riwayat.</p>
                        </div>
                    </div>
                    <div class="step-dot">6</div>
                    <div class="step-spacer"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section style="padding:40px 0 60px; width:100%;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <div class="section-title-sm text-center">Tips</div>
                <h2 class="section-title-lg text-center">Tips Agar Pemesanan Lancar</h2>
            </div>
            <div class="row g-4">
                <div class="col-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="tip-card text-center">
                        <div class="tip-icon mx-auto" style="background:rgba(155,27,48,0.08); color:var(--primary-red);"><i class="bi bi-alarm-fill"></i></div>
                        <h5>Pesan Lebih Awal</h5>
                        <p>Reservasi meja di jam sibuk (malam & weekend) sebaiknya dilakukan minimal 1 hari sebelumnya agar mendapat meja terbaik.</p>
                    </div>
                </div>
                <div class="col-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="tip-card text-center">
                        <div class="tip-icon mx-auto" style="background:rgba(155,27,48,0.08); color:var(--primary-red);"><i class="bi bi-whatsapp"></i></div>
                        <h5>Nomor WA Aktif</h5>
                        <p>Pastikan nomor WhatsApp yang Anda masukkan aktif karena admin akan menghubungi Anda untuk konfirmasi reservasi.</p>
                    </div>
                </div>
                <div class="col-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="tip-card text-center">
                        <div class="tip-icon mx-auto" style="background:rgba(155,27,48,0.08); color:var(--primary-red);"><i class="bi bi-pin-map-fill"></i></div>
                        <h5>Perhatikan Denah</h5>
                        <p>Gunakan denah interaktif untuk melihat posisi meja. Area hijau (Ready) bisa dipilih, area merah (Terisi) sedang digunakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section style="padding:0 0 60px; width:100%;">
        <div class="container" data-aos="fade-up">
            <div class="cta-panduan">
                <h2>Sudah Paham Alurnya?</h2>
                <p>Yuk langsung pesan menu dan reservasi meja favoritmu sekarang juga!</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('menu.index') }}" class="btn bg-white text-custom-red fw-bold px-5 py-3 rounded-pill shadow">
                        <i class="bi bi-egg-fried me-2"></i>Pesan Menu
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-calendar-check me-2"></i>Reservasi Meja
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
