@extends('layouts.main')

@section('title', 'Reservasi Meja - Warkop Pamulang')

@push('styles')
    <style>
        .dashboard-container {
            padding: 60px 0;
            min-height: 80vh;
        }
        .navbar, .footer { font-family: 'Poppins', sans-serif !important; }
        .section-title {
            font-weight: 800;
            color: #333;
            margin-bottom: 30px;
        }
        .card-custom {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 30px;
            padding: 35px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 15px;
            padding: 12px 20px;
            border: 1px solid rgba(155, 27, 48, 0.1);
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(155, 27, 48, 0.1);
            border-color: var(--primary-red);
        }
        .table-custom {
            border-radius: 20px;
            overflow: hidden;
        }
        .table-custom thead {
            background: var(--header-gradient);
            color: white;
        }
        .badge-status {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
        }
        .meja-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .meja-card {
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .meja-tersedia {
            background: rgba(40, 167, 69, 0.1);
            border-color: rgba(40, 167, 69, 0.2);
            color: #198754;
        }
        .meja-terisi {
            background: rgba(220, 53, 69, 0.1);
            border-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
        .meja-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
        }
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-container">
        <div class="container">
            <h2 class="section-title" data-aos="fade-right">
                {{ __('Reservasi Meja') }}
            </h2>

            <!-- Real-time Table Status -->
            <div class="card-custom mb-5" data-aos="fade-up">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-grid-3x3-gap-fill me-2 text-custom-red"></i> Denah Meja Real-time
                    </h4>
                    <div class="d-flex gap-3">
                        <small class="fw-bold"><span class="status-dot bg-success"></span> Tersedia</small>
                        <small class="fw-bold"><span class="status-dot bg-danger"></span> Terisi/Booked</small>
                    </div>
                </div>
                <div class="meja-grid">
                    @foreach(\App\Models\Meja::all() as $meja)
                        @php
                            // Cek apakah ada reservasi aktif atau mendatang hari ini
                            $now = \Carbon\Carbon::now();
                            $todayReservations = $meja->reservasis()
                                ->where('tanggal', $now->toDateString())
                                ->where('status', 'valid')
                                ->get();

                            $activeReservation = $todayReservations->filter(function($res) use ($now) {
                                $startTime = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                $endTime = $startTime->copy()->addHours((int)$res->durasi);
                                return $now->greaterThanOrEqualTo($startTime) && $now->lessThan($endTime);
                            })->first();

                            $upcomingReservation = $todayReservations->filter(function($res) use ($now) {
                                $startTime = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                return $startTime->isAfter($now);
                            })->first();

                            $isBooked = !is_null($activeReservation) || !is_null($upcomingReservation);
                            $displayReservation = $activeReservation ?? $upcomingReservation;
                            
                            $statusLabel = 'Tersedia';
                            $timeRangeStr = '';
                            
                            if ($activeReservation) {
                                $statusLabel = 'Sedang Terisi';
                                $startTime = \Carbon\Carbon::parse($activeReservation->tanggal->format('Y-m-d') . ' ' . $activeReservation->waktu);
                                $endTime = $startTime->copy()->addHours((int)$activeReservation->durasi);
                                $timeRangeStr = $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
                            } elseif ($upcomingReservation) {
                                $statusLabel = 'Booked';
                                $startTime = \Carbon\Carbon::parse($upcomingReservation->tanggal->format('Y-m-d') . ' ' . $upcomingReservation->waktu);
                                $endTime = $startTime->copy()->addHours((int)$upcomingReservation->durasi);
                                $timeRangeStr = $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
                            }
                        @endphp
                        <div class="meja-card {{ $isBooked ? 'meja-terisi' : 'meja-tersedia' }}">
                            <i class="bi bi-tablet-landscape"></i>
                            <h5 class="fw-bold mb-1">{{ $meja->nama_meja }}</h5>
                            <p class="small mb-2">Kapasitas: {{ $meja->kapasitas }} Orang</p>
                            
                            @if($isBooked)
                                <span class="badge rounded-pill bg-danger mb-2">{{ $statusLabel }}</span>
                                <div class="small fw-bold text-danger mt-1">
                                    <i class="bi bi-clock-history"></i> {{ $timeRangeStr }} WIB
                                </div>
                            @else
                                <span class="badge rounded-pill bg-success">Tersedia</span>
                                <div class="small text-success mt-1 opacity-0">-</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            @auth
                <!-- Pending Order Summary -->
                <div id="pending-order-section" class="d-none mb-4" data-aos="fade-up">
                    <div class="card-custom border-warning bg-warning bg-opacity-10">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold text-warning-emphasis mb-0">
                                <i class="bi bi-cart-check-fill me-2"></i> Pesanan Menu Anda
                            </h4>
                            <button onclick="clearPendingOrder()" class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                Batalkan Pesanan
                            </button>
                        </div>
                        <div id="pending-items-list" class="mb-4">
                            <!-- Items injected by JS -->
                        </div>
                        <div class="border-top border-warning border-opacity-25 pt-3 d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total Pesanan:</span>
                            <span id="pending-total" class="fs-4 fw-black text-danger"></span>
                        </div>
                        <p class="text-muted small mt-3 italic mb-0">
                            *Silakan lengkapi form reservasi di bawah untuk memesan meja sekaligus.
                        </p>
                    </div>
                </div>
            @endauth

            @if($errors->has('meja_id'))
                <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 py-3" role="alert" data-aos="zoom-in">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first('meja_id') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 py-3" role="alert" data-aos="zoom-in">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
                <script>
                    localStorage.removeItem('pending_order_summary');
                    localStorage.removeItem('warkop_cart');
                </script>
            @endif

            <div class="row g-4">
                @auth
                    <!-- Reservation Form -->
                    <div class="col-12" data-aos="fade-up">
                        <div class="card-custom">
                            <h4 class="fw-bold mb-4 text-custom-red">
                                <i class="bi bi-calendar-plus me-2"></i> Buat Reservasi Meja
                            </h4>
                            <form action="{{ route('reservasi.store') }}" method="POST" id="reservasiForm">
                                @csrf
                                <input type="hidden" name="cart_data" id="cart_data">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Reservasi</label>
                                        <div class="input-group">
                                            <input type="text" name="tanggal" id="tanggal_reservasi" class="form-control" placeholder="Pilih Tanggal (DD/MM/YYYY)" required @guest disabled @endguest>
                                            <span class="input-group-text bg-white border-start-0"><i class="bi bi-calendar3 text-custom-red"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Waktu Reservasi</label>
                                        <input type="time" name="waktu" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pilih Meja</label>
                                        <select name="meja_id" class="form-select" required>
                                            @foreach(\App\Models\Meja::where('status', 'tersedia')->get() as $meja)
                                                <option value="{{ $meja->id }}">{{ $meja->nama_meja }} (Kapasitas: {{ $meja->kapasitas }} orang)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Durasi (Jam)</label>
                                        <input type="number" name="durasi" min="1" max="12" class="form-control" placeholder="contoh: 2" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Nomor WhatsApp</label>
                                        <input type="text" name="whatsapp" class="form-control" placeholder="Contoh: 081234567890" required>
                                        <small class="text-muted">Kami akan menghubungi Anda melalui nomor ini untuk konfirmasi.</small>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <button type="submit" class="btn btn-custom-red w-100 py-3 rounded-pill fw-bold fs-5 shadow">
                                        Konfirmasi Reservasi Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="col-12 text-center" data-aos="fade-up">
                        <div class="card-custom py-5">
                            <i class="bi bi-info-circle text-custom-red fs-1 d-block mb-3"></i>
                            <h3 class="fw-bold mb-3">Ingin Melakukan Reservasi?</h3>
                            <p class="text-muted mb-4">Silakan login terlebih dahulu untuk dapat memesan meja dan menu favorit Anda.</p>
                            <a href="{{ route('login') }}" class="btn btn-custom-red px-5 py-3 rounded-pill fw-bold shadow">
                                Login Sekarang
                            </a>
                        </div>
                    </div>
                @endauth

                @auth
                    <!-- History Table -->
                    <div class="col-12" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-custom">
                            <h4 class="fw-bold mb-4 text-custom-red">
                                <i class="bi bi-clock-history me-2"></i> Riwayat Reservasi
                            </h4>
                            <div class="table-responsive table-custom">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th class="py-3 px-4 border-0">Meja</th>
                                            <th class="py-3 px-4 border-0">Tanggal & Waktu</th>
                                            <th class="py-3 px-4 border-0 text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(auth()->user()->reservasis as $res)
                                        <tr>
                                            <td class="py-4 px-4 fw-bold text-dark">{{ $res->meja->nama_meja }}</td>
                                            <td class="py-4 px-4">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold text-dark">{{ $res->tanggal->format('d/m/Y') }}</span>
                                                    <span class="text-muted small">{{ $res->waktu }} WIB</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                @php
                                                    $statusClass = $res->status == 'valid' ? 'bg-success text-white' : ($res->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger text-white');
                                                    $statusText = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
                                                    $pembayaran = $res->pembayaran;
                                                @endphp
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span class="badge-status {{ $statusClass }} shadow-sm">
                                                        {{ $statusText }}
                                                    </span>
                                                    @if($pembayaran)
                                                        @if($pembayaran->sisa_bayar > 0)
                                                            <small class="text-danger fw-bold" style="font-size: 0.65rem;">
                                                                Sisa: Rp {{ number_format($pembayaran->sisa_bayar, 0, ',', '.') }}
                                                            </small>
                                                        @else
                                                            <small class="text-success fw-bold" style="font-size: 0.65rem;">
                                                                Lunas
                                                            </small>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="py-5 text-center text-muted">
                                                <i class="bi bi-calendar-x d-block mb-2 fs-1"></i>
                                                Belum ada riwayat reservasi.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Flatpickr
            flatpickr("#tanggal_reservasi", {
                locale: "id",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d/m/Y",
                minDate: "today",
                disableMobile: "true"
            });

            const pendingOrder = JSON.parse(localStorage.getItem('pending_order_summary'));
            const section = document.getElementById('pending-order-section');
            const listContainer = document.getElementById('pending-items-list');
            const totalDisplay = document.getElementById('pending-total');

            if (pendingOrder && pendingOrder.items.length > 0) {
                section.classList.remove('d-none');
                document.getElementById('cart_data').value = JSON.stringify(pendingOrder.items);
                
                listContainer.innerHTML = pendingOrder.items.map(item => `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-dark">${item.name} <small class="text-muted">(${item.quantity}x)</small></span>
                        <span class="fw-bold">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                    </div>
                `).join('');

                totalDisplay.innerText = 'Rp ' + pendingOrder.total.toLocaleString('id-ID');
            }

            // Validasi sebelum submit
            document.getElementById('reservasiForm')?.addEventListener('submit', function(e) {
                const cartData = document.getElementById('cart_data').value;
                if (!cartData || JSON.parse(cartData).length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        title: '<h4 class="fw-bold mb-0">Oops...</h4>',
                        html: '<p class="text-muted">Maaf, Anda harus memesan menu terlebih dahulu sebelum melakukan reservasi.</p>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#9B1B30',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Lihat Menu Sekarang',
                        cancelButtonText: 'Nanti Saja',
                        reverseButtons: true,
                        customClass: {
                            popup: 'rounded-5 border-0 shadow-lg',
                            confirmButton: 'btn btn-primary px-4 py-2 rounded-pill',
                            cancelButton: 'btn btn-light px-4 py-2 rounded-pill'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('menu.index') }}";
                        }
                    });
                }
            });
        });

        function clearPendingOrder() {
            Swal.fire({
                title: '<h4 class="fw-bold mb-0">Batalkan Pesanan?</h4>',
                html: '<p class="text-muted">Apakah Anda yakin ingin membatalkan pesanan menu ini?</p>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Batalkan',
                cancelButtonText: 'Kembali',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-5 border-0 shadow-lg',
                    confirmButton: 'btn btn-danger px-4 py-2 rounded-pill',
                    cancelButton: 'btn btn-light px-4 py-2 rounded-pill'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.removeItem('pending_order_summary');
                    localStorage.removeItem('warkop_cart');
                    location.reload();
                }
            });
        }
    </script>
@endpush
