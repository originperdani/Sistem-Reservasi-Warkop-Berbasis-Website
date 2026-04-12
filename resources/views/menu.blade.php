@extends('layouts.main')

@section('title', 'Menu - Warkop Pamulang')

@section('content')
    <section id="menu" class="py-5 mt-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-custom-red fw-bold text-uppercase">Daftar Menu</h6>
                <h2 class="fw-bold">Menu Kami</h2>
                <div class="d-flex justify-content-center gap-2 mt-3 overflow-auto pb-2" id="category-filters">
                    <button class="btn btn-custom-red rounded-pill filter-btn active" data-category="all">Semua</button>
                    <button class="btn btn-outline-custom rounded-pill filter-btn" data-category="makanan">Makanan</button>
                    <button class="btn btn-outline-custom rounded-pill filter-btn" data-category="minuman">Minuman</button>
                    <button class="btn btn-outline-custom rounded-pill filter-btn" data-category="cemilan">Cemilan</button>
                </div>
            </div>
            <div class="row g-4" id="menu-container">
                @foreach($menus as $index => $menu)
                <div class="col-md-3 menu-item" data-category="{{ $menu->kategori }}" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                    <div class="menu-card" style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 30px; overflow: hidden; transition: all 0.4s; border: 1px solid rgba(255, 255, 255, 0.5); height: 100%;">
                        <img src="{{ $menu->gambar ?? 'https://via.placeholder.com/300' }}" class="menu-img" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 220px; object-fit: cover; border-radius: 30px 30px 0 0;">
                        <div class="menu-content" style="padding: 24px;">
                            <h5 class="fw-bold mb-1">{{ $menu->nama_menu }}</h5>
                            <p class="text-muted small mb-2">{{ $menu->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price" style="background: var(--header-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800; font-size: 1.3rem;">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                <a href="#" class="btn btn-sm btn-custom-red rounded-circle"><i class="bi bi-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('btn-custom-red', 'active');
                b.classList.add('btn-outline-custom');
            });
            this.classList.remove('btn-outline-custom');
            this.classList.add('btn-custom-red', 'active');

            const category = this.getAttribute('data-category');
            
            document.querySelectorAll('.menu-item').forEach(item => {
                if (category === 'all' || item.getAttribute('data-category') === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
