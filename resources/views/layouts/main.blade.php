<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Warkop Pamulang')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --primary-red: #9B1B30;
            --secondary-red: #7A1526;
            --cream-bg: #F5E6D3;
            --cream-light: #FEFBF6;
            --header-gradient: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream-light);
            background-image: 
                radial-gradient(at 0% 0%, rgba(245, 230, 211, 0.5) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(155, 27, 48, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(245, 230, 211, 0.5) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(155, 27, 48, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: #4A1E1B;
            overflow-x: hidden;
        }
        .navbar {
            background: rgba(254, 251, 246, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(155, 27, 48, 0.08);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        .navbar-brand {
            font-size: 1.25rem;
            letter-spacing: -0.02em;
        }
        .nav-link {
            color: #333333 !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            color: var(--primary-red) !important;
        }
        .nav-link.active {
            color: var(--primary-red) !important;
            font-weight: 700;
        }
        .cart-btn {
            color: var(--primary-red) !important;
            font-size: 1.3rem;
            transition: transform 0.2s ease;
        }
        .cart-btn:hover {
            transform: scale(1.1);
        }
        #cart-badge {
            background-color: var(--primary-red);
            font-size: 0.6rem;
            padding: 4px 6px;
            top: 2px !important;
            right: 2px !important;
        }
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 0.5em;
            vertical-align: middle;
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
        .btn-primary {
            background: var(--header-gradient);
            border: none;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(155, 27, 48, 0.2);
            transition: all 0.3s ease;
            color: white !important;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(155, 27, 48, 0.3);
        }
        .btn-outline-custom {
            color: var(--primary-red);
            border: 2px solid var(--primary-red);
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: transparent;
        }
        .btn-outline-custom:hover {
            background: var(--primary-red);
            color: white;
            transform: translateY(-3px);
        }
        .footer {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
            padding: 80px 0 30px;
            position: relative;
            color: white !important;
        }
        .footer h5 {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        .footer ul li {
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            opacity: 0.85;
        }
        .footer a {
            color: white !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer a:hover {
            color: var(--cream-bg) !important;
            padding-left: 5px;
        }
        .footer .bi {
            font-size: 1.2rem;
            vertical-align: middle;
        }
        .footer .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 0.85rem;
        }
        .footer hr {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 40px 0 25px;
        }
        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: var(--primary-red);
            filter: blur(120px);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.07;
            animation: float 20s infinite alternate;
        }
        @keyframes float {
            from { transform: translate(0, 0); }
            to { transform: translate(100px, 100px); }
        }
        .text-custom-red { color: var(--primary-red) !important; }
        .bg-custom-red { background-color: var(--primary-red) !important; color: white !important; }
        .btn-custom-red { 
            background: var(--header-gradient) !important;
            color: white !important;
            border: none;
            box-shadow: 0 5px 15px rgba(155, 27, 48, 0.2);
        }

        /* Cart Styling */
        .cart-item {
            padding: 15px;
            border-bottom: 1px solid rgba(155, 27, 48, 0.05);
            transition: all 0.3s ease;
        }
        .cart-item:hover {
            background: rgba(155, 27, 48, 0.02);
        }
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 5px 12px;
            border-radius: 50px;
        }
        .quantity-btn {
            border: none;
            background: none;
            color: var(--primary-red);
            font-weight: bold;
            font-size: 1.2rem;
            line-height: 1;
        }
        .cart-footer {
            background: var(--cream-light);
            padding: 20px;
            border-top: 2px solid rgba(155, 27, 48, 0.1);
        }
        .offcanvas-cart {
            border-left: 5px solid var(--primary-red);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="blob" style="top: -10%; left: -10%;"></div>
    <div class="blob" style="top: 40%; right: -10%; background: var(--cream-bg); opacity: 0.15;"></div>
    <div class="blob" style="bottom: -10%; left: 20%;"></div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-cup-hot-fill me-2 text-custom-red" style="font-size: 1.5rem;"></i>
                <span class="fw-bold text-custom-red">Warkop Pamulang</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ auth()->check() ? route('menu.index') : route('login') }}">Menu</a></li>
                    <li class="nav-item"><a class="nav-link px-3 {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Reservasi Meja</a></li>
                    
                    <!-- Shopping Cart Icon -->
                    <li class="nav-item me-2">
                        <button class="nav-link px-2 border-0 bg-transparent position-relative cart-btn" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
                            <i class="bi bi-cart3"></i>
                            <span id="cart-badge" class="position-absolute translate-middle badge rounded-pill d-none">0</span>
                        </button>
                    </li>

                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2">
                                    <li><a class="dropdown-item rounded-3 mb-1" href="{{ route('dashboard') }}"><i class="bi bi-calendar-check me-2"></i> Reservasi Meja</a></li>
                                    <li><a class="dropdown-item rounded-3 mb-1" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item rounded-3 text-danger"><i class="bi bi-box-arrow-right me-2"></i> Keluar</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link px-3" href="{{ route('login') }}">Masuk</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="btn btn-primary ms-2 rounded-pill px-4 py-2" href="{{ route('register') }}">Daftar</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Shopping Cart Offcanvas -->
    <div class="offcanvas offcanvas-end offcanvas-cart" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel" style="width: 400px;">
        <div class="offcanvas-header border-bottom py-4 px-4">
            <h5 class="offcanvas-title fw-bold" id="cartOffcanvasLabel">
                <i class="bi bi-bag-check me-2 text-custom-red"></i> Keranjang Saya
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div id="cart-items-container" class="h-100 overflow-auto">
                <!-- Cart items will be injected here -->
                <div class="text-center py-5 empty-cart-msg">
                    <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                    <p class="text-muted mt-3">Keranjang masih kosong</p>
                    <a href="{{ route('menu.index') }}" class="btn btn-outline-custom mt-2">Lihat Menu</a>
                </div>
            </div>
        </div>
        <div class="cart-footer">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="fw-bold text-muted">Total Bayar:</span>
                <span id="cart-total" class="fs-4 fw-bold text-custom-red">Rp 0</span>
            </div>
            <div id="cart-actions" class="d-grid gap-2 d-none">
                <button id="checkout-reservasi-btn" class="btn btn-primary py-3 fs-6 rounded-pill shadow-lg">
                    Pesan & Reservasi Meja <i class="bi bi-calendar-check ms-2"></i>
                </button>
                <button id="checkout-menu-saja-btn" class="btn btn-outline-custom py-2 fs-6 rounded-pill">
                    Pesan Menu Saja <i class="bi bi-whatsapp ms-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Quantity Modal -->
    <div class="modal fade" id="quantityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <img id="modal-item-image" src="" alt="" class="rounded-4 mb-3 shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        <h5 id="modal-item-name" class="fw-bold mb-1"></h5>
                        <p id="modal-item-price" class="text-custom-red fw-bold mb-0"></p>
                    </div>
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                        <button onclick="adjustModalQty(-1)" class="btn btn-outline-custom rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 1.5rem;">-</button>
                        <span id="modal-qty" class="fs-3 fw-bold" style="min-width: 40px; text-align: center;">1</span>
                        <button onclick="adjustModalQty(1)" class="btn btn-outline-custom rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 1.5rem;">+</button>
                    </div>
                    <button id="confirm-add-btn" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row g-4 align-items-start" data-aos="fade-up">
                <!-- Column 1: Toko Kami -->
                <div class="col-lg-2 col-md-6 text-center text-lg-start">
                    <h5 class="fw-bold mb-3">Toko Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('menu.index') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Menu</a></li>
                        <li class="mb-2"><a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="text-white text-decoration-none hover:text-cream-bg transition">Reservasi</a></li>
                    </ul>
                </div>

                <!-- Column 2: Kontak -->
                <div class="col-lg-2 col-md-6 text-center text-lg-start">
                    <h5 class="fw-bold mb-3">Kontak Admin</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://wa.me/6285793930723?text=Halo%20Admin%20Warkop%20Pamulang%2C%20%0ASaya%20ingin%20reservasi%20dengan%20detail%3A%20%0A%20%0ANama%3A%20%0ATanggal%3A%20%0AWaktu%3A%20%0AJumlah%20Orang%3A%20%0APilihan%20Meja%20(VIP%2FOutdoor%2FIndoor)%3A%20%0A%20%0AMohon%20konfirmasi%20ketersediaannya.%20%0ATerima%20kasih." target="_blank" class="text-white text-decoration-none hover:text-cream-bg transition d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Admin 1
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://wa.me/6289524673814?text=Halo%20Admin%20Warkop%20Pamulang%2C%20%0ASaya%20ingin%20reservasi%20dengan%20detail%3A%20%0A%20%0ANama%3A%20%0ATanggal%3A%20%0AWaktu%3A%20%0AJumlah%20Orang%3A%20%0APilihan%20Meja%20(VIP%2FOutdoor%2FIndoor)%3A%20%0A%20%0AMohon%20konfirmasi%20ketersediaannya.%20%0ATerima%20kasih." target="_blank" class="text-white text-decoration-none hover:text-cream-bg transition d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Admin 2
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://wa.me/6281287225850?text=Halo%20Admin%20Warkop%20Pamulang%2C%20%0ASaya%20ingin%20reservasi%20dengan%20detail%3A%20%0A%20%0ANama%3A%20%0ATanggal%3A%20%0AWaktu%3A%20%0AJumlah%20Orang%3A%20%0APilihan%20Meja%20(VIP%2FOutdoor%2FIndoor)%3A%20%0A%20%0AMohon%20konfirmasi%20ketersediaannya.%20%0ATerima%20kasih." target="_blank" class="text-white text-decoration-none hover:text-cream-bg transition d-inline-flex align-items-center">
                                <i class="bi bi-whatsapp me-2"></i> Admin 3
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Branding (Absolute Center) -->
                <div class="col-lg-4 col-md-12 text-center position-relative">
                    <h5 class="mb-3 invisible">Spacer</h5>
                    <div class="position-relative mb-4">
                        <i class="bi bi-cup-hot-fill position-absolute start-50 translate-middle-x" style="font-size: 2.5rem; top: -4.5rem;"></i>
                        <h2 class="fw-bold mb-2">Warkop Pamulang</h2>
                    </div>
                    <p class="opacity-75 mb-0 small" style="line-height: 1.8; letter-spacing: 0.05em;">
                        Nikmati suasana santai dengan hidangan berkualitas dan kopi pilihan terbaik.
                    </p>
                </div>

                <!-- Column 4: Alamat Kami -->
                <div class="col-lg-4 col-md-12 text-center text-lg-end">
                    <h5 class="fw-bold mb-3">Alamat Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a href="https://maps.app.goo.gl/NJNd3rnqHpyWFJQP7" target="_blank" class="d-inline-flex justify-content-lg-end align-items-start text-decoration-none text-white hover:text-cream-bg transition">
                                <span class="me-3 small text-lg-end">Jl. Raya Puspitek No.31, Buaran, Serpong, Tangsel</span>
                                <i class="bi bi-geo-alt-fill flex-shrink-0"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="text-muted mb-0">Copyright &copy; 2026 Warkop Pamulang</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            mirror: true,
            offset: 120,
            easing: 'ease-in-out-cubic'
        });

        // Cart Management
        let cart = JSON.parse(localStorage.getItem('warkop_cart')) || [];
        let currentItem = null;
        let currentQty = 1;

        function updateCartUI() {
            const container = document.getElementById('cart-items-container');
            const totalDisplay = document.getElementById('cart-total');
            const badge = document.getElementById('cart-badge');
            const cartActions = document.getElementById('cart-actions');

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-5 empty-cart-msg">
                        <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                        <p class="text-muted mt-3">Keranjang masih kosong</p>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline-custom mt-2">Lihat Menu</a>
                    </div>`;
                totalDisplay.innerText = 'Rp 0';
                badge.classList.add('d-none');
                cartActions.classList.add('d-none');
                return;
            }

            badge.classList.remove('d-none');
            badge.innerText = cart.reduce((total, item) => total + item.quantity, 0);
            cartActions.classList.remove('d-none');

            let total = 0;
            container.innerHTML = cart.map((item, index) => {
                total += item.price * item.quantity;
                return `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex gap-3">
                                <img src="${item.image}" alt="${item.name}" class="rounded-3 shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                <div>
                                    <h6 class="fw-bold mb-0">${item.name}</h6>
                                    <span class="text-muted small">Rp ${item.price.toLocaleString('id-ID')} / porsi</span>
                                </div>
                            </div>
                            <button onclick="removeFromCart(${index})" class="btn btn-sm text-danger border-0 p-0"><i class="bi bi-trash"></i></button>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-custom-red">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                            <div class="quantity-control shadow-sm border">
                                <button onclick="updateQuantity(${index}, -1)" class="quantity-btn">-</button>
                                <span class="fw-bold px-2">${item.quantity}</span>
                                <button onclick="updateQuantity(${index}, 1)" class="quantity-btn">+</button>
                            </div>
                        </div>
                    </div>`;
            }).join('');

            totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
            localStorage.setItem('warkop_cart', JSON.stringify(cart));
        }

        window.addToCart = function(item) {
            currentItem = item;
            currentQty = 1;
            
            document.getElementById('modal-item-name').innerText = item.name;
            document.getElementById('modal-item-price').innerText = 'Rp ' + item.price.toLocaleString('id-ID');
            document.getElementById('modal-item-image').src = item.image;
            document.getElementById('modal-qty').innerText = currentQty;
            
            const modal = new bootstrap.Modal(document.getElementById('quantityModal'));
            modal.show();
        };

        window.adjustModalQty = function(change) {
            currentQty += change;
            if (currentQty < 1) currentQty = 1;
            document.getElementById('modal-qty').innerText = currentQty;
        };

        document.getElementById('confirm-add-btn').addEventListener('click', function() {
            const existingItem = cart.find(i => i.id === currentItem.id);
            if (existingItem) {
                existingItem.quantity += currentQty;
            } else {
                cart.push({ ...currentItem, quantity: currentQty });
            }
            updateCartUI();
            
            bootstrap.Modal.getInstance(document.getElementById('quantityModal')).hide();
            const offcanvas = new bootstrap.Offcanvas(document.getElementById('cartOffcanvas'));
            offcanvas.show();
        });

        window.updateQuantity = function(index, change) {
            cart[index].quantity += change;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            updateCartUI();
        };

        window.removeFromCart = function(index) {
            cart.splice(index, 1);
            updateCartUI();
        };

        function generateWAMessage(isReservation = false) {
            let message = isReservation ? "*Halo Admin Warkop Pamulang,*\nSaya ingin *Pesan Menu & Reservasi Meja* dengan detail berikut:\n\n" : "*Halo Admin Warkop Pamulang,*\nSaya ingin *Pesan Menu Saja* dengan detail berikut:\n\n";
            let total = 0;
            
            cart.forEach((item, index) => {
                message += `${index + 1}. ${item.name} (${item.quantity}x) - Rp ${(item.price * item.quantity).toLocaleString('id-ID')}\n`;
                total += item.price * item.quantity;
            });
            
            message += `\n*Total Bayar: Rp ${total.toLocaleString('id-ID')}*`;
            
            if (isReservation) {
                message += "\n\nMohon bantu siapkan meja untuk saya. Saya akan melengkapi detail reservasi (Tanggal/Waktu) melalui sistem/chat ini.";
            } else {
                message += "\n\nMohon diproses pesanannya. Terima kasih.";
            }
            
            return message;
        }

        document.getElementById('checkout-menu-saja-btn').addEventListener('click', function() {
            if (cart.length === 0) return;
            const message = generateWAMessage(false);
            const waUrl = `https://wa.me/6285793930723?text=${encodeURIComponent(message)}`;
            window.open(waUrl, '_blank');
        });

        document.getElementById('checkout-reservasi-btn').addEventListener('click', function() {
            if (cart.length === 0) return;
            
            // Simpan detail pesanan untuk ditampilkan di dashboard
            const orderSummary = {
                items: cart,
                total: cart.reduce((t, i) => t + (i.price * i.quantity), 0)
            };
            localStorage.setItem('pending_order_summary', JSON.stringify(orderSummary));

            // Arahkan ke dashboard untuk reservasi
            window.location.href = "{{ route('dashboard') }}";
        });

        // Initialize UI
        updateCartUI();
    </script>
    @stack('scripts')
</body>
</html>
