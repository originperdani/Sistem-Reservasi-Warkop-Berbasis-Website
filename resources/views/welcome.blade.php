@extends('layouts.main')

@section('content')
    <div class="hero-section" style="padding: 120px 0 80px; position: relative; width: 100%;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 text-start" data-aos="fade-right">
                    <h1 class="hero-title mb-4" style="font-size: 3.5rem; font-weight: 800; color: var(--primary-red); line-height: 1.2;">Temukan Makanan & Kopi Favoritmu</h1>
                    <p class="hero-subtitle" style="font-size: 1.2rem; color: #6D4C41; margin-bottom: 30px;">Nikmati suasana santai dengan hidangan berkualitas di Warkop Pamulang. Pesan meja dan menu favoritmu secara online sekarang!</p>
                    <div class="d-flex gap-3 justify-content-start">
                        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn btn-primary">Pesan Sekarang</a>
                        <a href="{{ auth()->check() ? route('menu.index') : route('login') }}" class="btn btn-outline-custom">Lihat Menu</a>
                    </div>
                </div>
                <div class="col-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="">
                        <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&q=80&w=800" alt="Hero Image" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5" style="width: 100%;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-custom-red fw-bold text-uppercase">Keunggulan Kami</h6>
                <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(10px); padding: 30px 15px; border-radius: 20px; text-align: center; transition: all 0.4s; border: 1px solid rgba(255, 255, 255, 0.5); height: 100%;">
                        <i class="bi bi-calendar-check" style="font-size: 2.5rem; color: var(--primary-red);"></i>
                        <h4 class="fw-bold mt-2" style="font-size: 1.1rem;">Reservasi Meja</h4>
                        <p class="text-muted small">Hindari antrian dengan reservasi meja terlebih dahulu.</p>
                        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn btn-sm btn-outline-custom px-3 py-1 mt-2" style="font-size: 0.75rem;">Pesan Meja</a>
                    </div>
                </div>
                <div class="col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card" style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(10px); padding: 30px 15px; border-radius: 20px; text-align: center; transition: all 0.4s; border: 1px solid rgba(255, 255, 255, 0.5); height: 100%;">
                        <i class="bi bi-egg-fried" style="font-size: 2.5rem; color: var(--primary-red);"></i>
                        <h4 class="fw-bold mt-2" style="font-size: 1.1rem;">Menu Spesial</h4>
                        <p class="text-muted small">Beragam pilihan menu makanan dan minuman spesial.</p>
                        <a href="{{ auth()->check() ? route('menu.index') : route('login') }}" class="btn btn-sm btn-outline-custom px-3 py-1 mt-2" style="font-size: 0.75rem;">Lihat Menu</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="py-5" style="width: 100%;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-custom-red fw-bold text-uppercase">Pilihan Terfavorit</h6>
                <h2 class="fw-bold">Menu Best Seller</h2>
            </div>
            <div class="row g-4" id="menu-container">
                @foreach($menus as $index => $menu)
                <div class="col-3 menu-item" data-category="{{ strtolower(trim($menu->kategori)) }}" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                    <div class="menu-card" style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 20px; overflow: hidden; transition: all 0.4s; border: 1px solid rgba(255, 255, 255, 0.5); height: 100%;">
                        <img src="{{ $menu->gambar ?? 'https://via.placeholder.com/300' }}" class="menu-img" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="menu-content" style="padding: 12px;">
                            <h6 class="fw-bold mb-1 text-truncate" style="font-size: 0.9rem;">{{ $menu->nama_menu }}</h6>
                            <p class="text-muted small mb-2 text-truncate">{{ $menu->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-1">
                                <span class="price" style="background: var(--header-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800; font-size: 0.9rem;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                <button onclick="addToCart({
                                    id: {{ $menu->id }},
                                    name: '{{ $menu->nama_menu }}',
                                    price: {{ $menu->harga }},
                                    image: '{{ $menu->gambar ?? 'https://via.placeholder.com/300' }}'
                                })" class="btn btn-sm btn-custom-red rounded-circle p-1" style="width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-plus" style="font-size: 1rem;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="zoom-in">
                <a href="{{ auth()->check() ? route('menu.index') : route('login') }}" class="btn btn-outline-custom px-5">Lihat Lebih Banyak</a>
            </div>
        </div>
    </section>
@endsection
