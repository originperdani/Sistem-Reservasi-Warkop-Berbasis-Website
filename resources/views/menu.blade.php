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
            <div class="row g-3 g-md-4" id="menu-container">
                @forelse($menus as $index => $menu)
                <div class="col-6 col-md-3 menu-item" data-category="{{ strtolower(trim($menu->kategori)) }}" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                    <div class="menu-card" style="background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border-radius: 20px; overflow: hidden; transition: all 0.4s; border: 1px solid rgba(255, 255, 255, 0.5); height: 100%;">
                        <img src="{{ $menu->gambar ?? 'https://via.placeholder.com/300' }}" class="menu-img" alt="{{ $menu->nama_menu }}" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="menu-content" style="padding: 12px;">
                            <h6 class="fw-bold mb-1 text-truncate" style="font-size: 0.9rem;">{{ $menu->nama_menu }}</h6>
                            <p class="text-muted small mb-2 text-truncate d-none d-md-block">{{ $menu->deskripsi }}</p>
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
                @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-info-circle text-muted mb-3" style="font-size: 3rem;"></i>
                    <p class="text-muted">Belum ada menu yang tersedia.</p>
                </div>
                @endforelse
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

            const category = this.getAttribute('data-category').toLowerCase().trim();
            
            document.querySelectorAll('.menu-item').forEach(item => {
                const itemCategory = item.getAttribute('data-category').toLowerCase().trim();
                if (category === 'all' || itemCategory === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            // Refresh AOS to handle newly visible elements
            AOS.refresh();
        });
    });
</script>
@endpush
