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
    </style>
@endpush

@section('content')
    <div class="dashboard-container">
        <div class="container">
            <h2 class="section-title" data-aos="fade-right">
                {{ __('Reservasi Saya') }}
            </h2>

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

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 py-3" role="alert" data-aos="zoom-in">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                </div>
            @endif

            <div class="row g-4">
                <!-- Reservation Form -->
                <div class="col-12" data-aos="fade-up">
                    <div class="card-custom">
                        <h4 class="fw-bold mb-4 text-custom-red">
                            <i class="bi bi-calendar-plus me-2"></i> Buat Reservasi Meja
                        </h4>
                        <form action="{{ route('reservasi.store') }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Reservasi</label>
                                    <input type="date" name="tanggal" min="{{ date('Y-m-d') }}" class="form-control" required>
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
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-custom-red w-100 py-3 rounded-pill fw-bold fs-5 shadow">
                                    Konfirmasi Reservasi Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

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
                                                <span class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($res->tanggal)->format('d M Y') }}</span>
                                                <span class="text-muted small">{{ $res->waktu }} WIB</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            @php
                                                $statusClass = $res->status == 'valid' ? 'bg-success text-white' : ($res->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger text-white');
                                                $statusText = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
                                            @endphp
                                            <span class="badge-status {{ $statusClass }} shadow-sm">
                                                {{ $statusText }}
                                            </span>
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
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pendingOrder = JSON.parse(localStorage.getItem('pending_order_summary'));
            const section = document.getElementById('pending-order-section');
            const listContainer = document.getElementById('pending-items-list');
            const totalDisplay = document.getElementById('pending-total');

            if (pendingOrder && pendingOrder.items.length > 0) {
                section.classList.remove('d-none');
                
                listContainer.innerHTML = pendingOrder.items.map(item => `
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-dark">${item.name} <small class="text-muted">(${item.quantity}x)</small></span>
                        <span class="fw-bold">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</span>
                    </div>
                `).join('');

                totalDisplay.innerText = 'Rp ' + pendingOrder.total.toLocaleString('id-ID');
            }
        });

        function clearPendingOrder() {
            if (confirm('Apakah Anda ingin membatalkan pesanan menu ini?')) {
                localStorage.removeItem('pending_order_summary');
                localStorage.removeItem('warkop_cart');
                location.reload();
            }
        }
    </script>
@endpush
