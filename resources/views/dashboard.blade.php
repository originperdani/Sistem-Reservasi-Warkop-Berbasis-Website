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
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }
        .meja-card {
            border-radius: 15px;
            padding: 8px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            position: relative;
            background: white;
            overflow: visible;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
        }
        .meja-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        }
        .meja-tersedia {
            /* No border-bottom */
        }
        .meja-terisi {
            /* No border-bottom */
            background: #fffafa;
        }
        .meja-card i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            display: block;
            transition: transform 0.3s ease;
        }
        .meja-card:hover i {
            transform: scale(1.1);
        }
        .meja-indoor i { color: #0d6efd; }
        .meja-outdoor i { color: #fd7e14; }
        
        .meja-card h5 {
            font-size: 1.1rem;
            margin-bottom: 5px;
            font-weight: 800;
        }
        .meja-card .tipe-badge {
            font-size: 0.65rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 10px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: inline-block;
        }
        .bg-indoor { background: #e7f1ff; color: #0d6efd; }
        .bg-outdoor { background: #fff5eb; color: #fd7e14; }

        /* Floor Plan Styling - Clean No-Line Style */
        .floor-plan-container {
            background: #ffffff;
            border-radius: 40px;
            padding: 25px;
            position: relative;
            min-height: 500px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        }
        .floor-zone {
            position: relative;
            padding: 15px;
            height: 100%;
        }
        .zone-label {
            position: absolute;
            top: -10px;
            left: 15px;
            font-weight: 900;
            font-size: 0.7rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #94a3b8;
            background: white;
            padding: 0 10px;
            z-index: 5;
        }
        .zone-indoor { background: transparent; }
        .zone-outdoor { background: transparent; }

        .floor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 10px;
            align-content: start;
        }

        .entrance-point {
            background: #9B1B30;
            color: white;
            padding: 20px 8px;
            border-radius: 10px;
            font-size: 0.65rem;
            font-weight: 900;
            z-index: 10;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(155, 27, 48, 0.3);
            height: 120px;
            letter-spacing: 2px;
            align-self: center;
            white-space: nowrap;
            position: relative;
            right: -15px;
        }

        .meja-card.meja-tersedia {
            cursor: pointer;
        }
        .meja-card.meja-tersedia:active {
            transform: scale(0.95);
        }

        .outdoor-door {
            background: #64748b;
            color: white;
            padding: 6px 20px;
            border-radius: 10px;
            font-size: 0.6rem;
            font-weight: 900;
            white-space: nowrap;
            display: inline-block;
            margin-bottom: 20px;
        }

        .mushola-wc {
            background: #f8fafc;
            border-radius: 20px;
            padding: 10px 20px;
            text-align: center;
            font-size: 0.65rem;
            font-weight: 900;
            color: #94a3b8;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
        }

        .lesehan-area-box {
            background: #fffcf0;
            border-radius: 25px;
            padding: 20px;
            position: relative;
        }

        .non-smoking-area-box {
            background: #f0f7ff;
            border-radius: 25px;
            padding: 20px;
            position: relative;
        }

        /* Smaller Sketch sizes for airy look */
        .sketch-table {
            background: #ffffff;
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .meja-terisi .sketch-table {
            background: #fff5f5;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1);
        }
        .sketch-chair {
            position: absolute;
            background: #f1f5f9;
            border-radius: 4px;
            z-index: 1;
            transition: all 0.3s ease;
        }
        .meja-terisi .sketch-chair {
            background: #feb2b2;
        }

        .lesehan-door {
            position: absolute;
            top: -15px;
            right: 40px;
            background: #94a3b8;
            color: white;
            padding: 3px 12px;
            border-radius: 8px;
            font-size: 0.5rem;
            font-weight: 900;
            z-index: 10;
        }

        /* Lesehan Visual - No Lines */
        .lesehan-table {
            width: 40px;
            height: 40px;
            background: #ffffff;
            border: none;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }
        .lesehan-mat {
            position: absolute;
            inset: -4px;
            background: #fef3c7;
            border-radius: 10px;
            z-index: -1;
            opacity: 0.5;
        }
        .meja-terisi .lesehan-table { background: #fff5f5; }
        .meja-terisi .lesehan-mat { background: #feb2b2; opacity: 0.3; }

        .partition-wall {
            background: transparent;
            width: 100%;
            height: 20px;
            margin: 25px 0;
            position: relative;
        }
        .partition-label {
            position: absolute;
            left: 30px;
            top: 0;
            background: #f1f5f9;
            color: #94a3b8;
            padding: 4px 15px;
            border-radius: 20px;
            font-size: 0.6rem;
            font-weight: 900;
            letter-spacing: 2px;
            white-space: nowrap;
        }

        .bar-counter {
            background: #f8fafc;
            border: none;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: #94a3b8;
            font-size: 0.7rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.02);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .floor-plan-container { padding: 20px; }
            .floor-grid { grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Table Sketch Styling - Ultra Premium 3D Realistic */
        .sketch-container {
            width: 100%;
            height: 95px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            position: relative;
            perspective: 300px;
        }
        .sketch-table {
            background: linear-gradient(145deg, #f5d07a 0%, #d4a84b 40%, #c9963e 60%, #b8863a 100%);
            border: none;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 2;
            box-shadow:
                0 2px 0 #a07030,
                0 4px 0 #8a6028,
                0 6px 15px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255,255,255,0.4),
                inset 0 -1px 0 rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sketch-table::before {
            content: '';
            position: absolute;
            inset: 3px;
            border-radius: 8px;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 8px,
                rgba(139, 90, 43, 0.08) 8px,
                rgba(139, 90, 43, 0.08) 9px
            );
            pointer-events: none;
        }
        .sketch-table::after {
            content: '';
            position: absolute;
            inset: 2px;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 9px;
            pointer-events: none;
        }
        .meja-terisi .sketch-table {
            background: linear-gradient(145deg, #f9a8a8 0%, #e87878 40%, #d96666 60%, #cc5555 100%);
            box-shadow:
                0 2px 0 #b04040,
                0 4px 0 #993535,
                0 6px 15px rgba(220, 53, 69, 0.2),
                inset 0 1px 0 rgba(255,255,255,0.3),
                inset 0 -1px 0 rgba(0,0,0,0.1);
        }
        .meja-terisi .sketch-table::before {
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 8px,
                rgba(180, 50, 50, 0.06) 8px,
                rgba(180, 50, 50, 0.06) 9px
            );
        }
        .sketch-chair {
            position: absolute;
            background: linear-gradient(180deg, #8b7355 0%, #6d5a44 50%, #5c4a38 100%);
            border-radius: 5px;
            z-index: 1;
            transition: all 0.4s ease;
            box-shadow:
                0 2px 0 #4a3b2d,
                0 3px 6px rgba(0, 0, 0, 0.12),
                inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .sketch-chair::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 15%;
            right: 15%;
            height: 2px;
            background: rgba(255,255,255,0.12);
            border-radius: 2px;
        }
        .meja-terisi .sketch-chair {
            background: linear-gradient(180deg, #e07070 0%, #c55050 50%, #b04545 100%);
            box-shadow:
                0 2px 0 #8a3030,
                0 3px 6px rgba(220, 53, 69, 0.15),
                inset 0 1px 0 rgba(255,255,255,0.15);
        }
        
        /* Specific Table Types - Enlarged & Fixed Clipping */
        .indoor-table { width: 62px; height: 36px; }
        .indoor-bench-top { width: 52px; height: 13px; top: -18px; left: 5px; border-radius: 5px 5px 3px 3px; }
        .indoor-bench-bottom { width: 52px; height: 13px; bottom: -18px; left: 5px; border-radius: 3px 3px 5px 5px; }
        
        .outdoor-table { 
            width: 48px; 
            height: 48px; 
            border-radius: 50%; 
            background: linear-gradient(145deg, #93d5ed 0%, #5bb8d4 40%, #4da8c4 60%, #3d98b4 100%);
            box-shadow:
                0 2px 0 #2d7a92,
                0 4px 0 #256a80,
                0 6px 15px rgba(0, 0, 0, 0.12),
                inset 0 2px 0 rgba(255,255,255,0.35),
                inset 0 -2px 0 rgba(0,0,0,0.08);
        }
        .outdoor-table::before {
            background: radial-gradient(circle at 35% 35%, rgba(255,255,255,0.15) 0%, transparent 60%);
            border-radius: 50%;
        }
        .outdoor-chair-top { width: 26px; height: 11px; top: -16px; left: 11px; border-radius: 5px 5px 3px 3px; }
        .outdoor-chair-bottom { width: 26px; height: 11px; bottom: -16px; left: 11px; border-radius: 3px 3px 5px 5px; }

        /* Lesehan Visual - Ultra Premium with Cushion Effect */
        .lesehan-table {
            width: 50px;
            height: 50px;
            background: linear-gradient(145deg, #f5d07a 0%, #d4a84b 40%, #c9963e 60%, #b8863a 100%);
            border: none;
            border-radius: 10px;
            position: relative;
            box-shadow:
                0 2px 0 #a07030,
                0 3px 8px rgba(0, 0, 0, 0.12),
                inset 0 1px 0 rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .lesehan-table::before {
            content: '';
            position: absolute;
            inset: 3px;
            border-radius: 8px;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 6px,
                rgba(139, 90, 43, 0.06) 6px,
                rgba(139, 90, 43, 0.06) 7px
            );
        }
        .lesehan-mat {
            position: absolute;
            inset: -12px;
            background: linear-gradient(135deg, #d4956a 0%, #c48050 30%, #b8733f 70%, #a86530 100%);
            border-radius: 16px;
            z-index: -1;
            opacity: 0.85;
            box-shadow:
                inset 0 2px 4px rgba(255,255,255,0.2),
                inset 0 -2px 4px rgba(0,0,0,0.15),
                0 4px 12px rgba(0, 0, 0, 0.08);
            border: 2px solid rgba(180, 120, 60, 0.3);
        }
        .lesehan-mat::before {
            content: '';
            position: absolute;
            inset: 4px;
            border: 1px dashed rgba(255,255,255,0.15);
            border-radius: 12px;
        }
        .meja-terisi .lesehan-table { 
            background: linear-gradient(145deg, #f9a8a8 0%, #e87878 40%, #d96666 100%); 
            box-shadow: 0 2px 0 #b04040, 0 3px 8px rgba(220, 53, 69, 0.15);
        }
        .meja-terisi .lesehan-mat { 
            background: linear-gradient(135deg, #e8a0a0 0%, #d48080 50%, #c07070 100%); 
            opacity: 0.6; 
            border-color: rgba(220, 80, 80, 0.3); 
        }

        .meja-card:hover .sketch-table {
            transform: scale(1.12) translateY(-3px);
            box-shadow:
                0 4px 0 #a07030,
                0 6px 0 #8a6028,
                0 10px 25px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255,255,255,0.5);
        }
        .meja-card:hover .sketch-chair {
            background: linear-gradient(180deg, #9B1B30 0%, #7a1526 50%, #5f1020 100%);
            box-shadow:
                0 2px 0 #4a0c18,
                0 3px 8px rgba(155, 27, 48, 0.2),
                inset 0 1px 0 rgba(255,255,255,0.15);
        }
        .meja-card:hover .lesehan-table {
            transform: scale(1.08) translateY(-2px);
        }
        .meja-card:hover .lesehan-mat {
            background: linear-gradient(135deg, #9B1B30 0%, #7a1526 50%, #5f1020 100%);
            opacity: 0.35;
            border-color: rgba(155, 27, 48, 0.3);
        }

        .tab-nav {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            background: #f1f5f9;
            padding: 6px;
            border-radius: 15px;
            width: fit-content;
        }
        .tab-btn {
            padding: 10px 25px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            color: #64748b;
            background: transparent;
        }
        .tab-btn.active {
            background: white;
            color: #9B1B30;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
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
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                    <h4 class="fw-bold mb-0 text-dark">
                        <i class="bi bi-map-fill me-2 text-custom-red"></i> Denah & Penataan Meja
                    </h4>
                    <div class="d-flex gap-3 align-items-center">
                        <div class="tab-nav mb-0">
                            <button class="tab-btn active" onclick="filterMeja('all')">Seluruh Area</button>
                            <button class="tab-btn" onclick="filterMeja('indoor')">Indoor</button>
                            <button class="tab-btn" onclick="filterMeja('outdoor')">Outdoor</button>
                        </div>
                    </div>
                </div>

                <div class="floor-plan-container">
                    <!-- Indoor Zone Section -->
                    <div class="floor-zone zone-indoor mb-4">
                        <span class="zone-label">Indoor Area</span>
                        
                        <!-- Top Row: Mushola, Bar, Dapur -->
                        <div class="row g-2 mb-4">
                            <div class="col-2 text-center">
                                <div class="mushola-wc w-full h-14">
                                    <div class="text-[10px]">MUSHOLA | WC</div>
                                </div>
                            </div>
                            <div class="col-7 text-center">
                                <div class="bar-counter w-full h-14 bg-slate-50 border-0 text-[10px]">BAR & KASIR</div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="bar-counter w-full h-14 bg-slate-100 border-0 opacity-50 text-[10px]">DAPUR</div>
                            </div>
                        </div>

                        <!-- Middle Row: Smoking Area & Entrance (Higher & Far Right) -->
                        <div class="row g-2 mb-4 align-items-center">
                            <div class="col-11">
                                <div class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-3 text-center">Smoking Area</div>
                                <div class="floor-grid" style="grid-template-columns: repeat(6, 1fr); gap: 10px;">
                                    @foreach(\App\Models\Meja::where('tipe', 'indoor')->where('sub_tipe', 'smoking')->get() as $meja)
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $isBooked = $meja->reservasis()->where('tanggal', $now->toDateString())->where('status', 'valid')->get()->filter(function($res) use ($now) {
                                                $start = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                                return $now->between($start, $start->copy()->addHours($res->durasi));
                                            })->isNotEmpty();
                                        @endphp
                                        <div class="meja-card {{ $isBooked ? 'meja-terisi' : 'meja-tersedia' }} p-2" 
                                             @if(!$isBooked) onclick="selectMeja({{ $meja->id }}, '{{ $meja->nama_meja }}')" @endif>
                                            <div class="sketch-container" style="height: 55px;">
                                                <div class="sketch-table indoor-table">
                                                    <div class="sketch-chair indoor-bench-top"></div>
                                                    <div class="sketch-chair indoor-bench-bottom"></div>
                                                </div>
                                            </div>
                                            <h5 style="font-size: 11px; font-weight: 800;" class="mb-1">{{ $meja->nama_meja }}</h5>
                                            <span class="badge rounded-pill {{ $isBooked ? 'bg-danger' : 'bg-success' }}" style="font-size: 7px; padding: 2px 4px;">
                                                {{ $isBooked ? 'Terisi' : 'Ready' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Entrance (Higher Position) -->
                            <div class="col-1 d-flex justify-content-end">
                                <div class="entrance-point">PINTU MASUK</div>
                            </div>
                        </div>

                        <!-- Bottom Row: Non-Smoking & Lesehan -->
                        <div class="row g-2 align-items-stretch">
                            <!-- Non-Smoking Area -->
                            <div class="col-3">
                                <div class="non-smoking-area-box p-3 h-100">
                                    <div class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3">Non-Smoking</div>
                                    <div class="floor-grid" style="grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                        @foreach(\App\Models\Meja::where('tipe', 'indoor')->where('sub_tipe', 'non-smoking')->get() as $meja)
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $isBooked = $meja->reservasis()->where('tanggal', $now->toDateString())->where('status', 'valid')->get()->filter(function($res) use ($now) {
                                                    $start = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                                    return $now->between($start, $start->copy()->addHours($res->durasi));
                                                })->isNotEmpty();
                                            @endphp
                                            <div class="meja-card {{ $isBooked ? 'meja-terisi' : 'meja-tersedia' }} p-2 bg-transparent shadow-none" 
                                                 @if(!$isBooked) onclick="selectMeja({{ $meja->id }}, '{{ $meja->nama_meja }}')" @endif>
                                                <div class="sketch-container" style="height: 45px;">
                                                    <div class="sketch-table indoor-table" style="width: 35px; height: 18px;">
                                                        <div class="sketch-chair indoor-bench-top" style="width: 25px; height: 5px; top: -8px;"></div>
                                                        <div class="sketch-chair indoor-bench-bottom" style="width: 25px; height: 5px; bottom: -8px;"></div>
                                                    </div>
                                                </div>
                                                <h5 style="font-size: 11px; font-weight: 800;" class="mb-0">{{ $meja->nama_meja }}</h5>
                                                <span class="badge rounded-pill {{ $isBooked ? 'bg-danger' : 'bg-success' }}" style="font-size: 7px; padding: 2px 4px; margin-top: 2px;">
                                                    {{ $isBooked ? 'Terisi' : 'Ready' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Lesehan Area -->
                            <div class="col-9">
                                <div class="lesehan-area-box p-3 h-100">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div style="width: 18px; height: 18px; background: linear-gradient(135deg, #d4956a, #a86530); border-radius: 5px;"></div>
                                        <div class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-0">Area Lesehan (Lantai)</div>
                                    </div>
                                    @php
                                        $lesehanMejas = \App\Models\Meja::where('tipe', 'indoor')->where('sub_tipe', 'lesehan')->get();
                                        $halfCount = ceil($lesehanMejas->count() / 2);
                                        $row1 = $lesehanMejas->take($halfCount);
                                        $row2 = $lesehanMejas->slice($halfCount);
                                    @endphp
                                    <!-- Row 1 -->
                                    <div class="floor-grid" style="grid-template-columns: repeat({{ $row1->count() }}, 1fr); gap: 14px; margin-bottom: 14px;">
                                        @foreach($row1 as $index => $meja)
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $isBooked = $meja->reservasis()->where('tanggal', $now->toDateString())->where('status', 'valid')->get()->filter(function($res) use ($now) {
                                                    $start = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                                    return $now->between($start, $start->copy()->addHours($res->durasi));
                                                })->isNotEmpty();
                                            @endphp
                                            <div class="meja-card {{ $isBooked ? 'meja-terisi' : 'meja-tersedia' }} p-2 bg-transparent shadow-none" 
                                                 @if(!$isBooked) onclick="selectMeja({{ $meja->id }}, '{{ $meja->nama_meja }}')" @endif>
                                                <div class="sketch-container" style="height: 50px;">
                                                    <div class="lesehan-table">
                                                        <div class="lesehan-mat"></div>
                                                    </div>
                                                </div>
                                                <h5 style="font-size: 11px; font-weight: 800;" class="mb-0 text-amber-800">L{{ $index + 1 }}</h5>
                                                <span class="badge rounded-pill {{ $isBooked ? 'bg-danger' : 'bg-success' }}" style="font-size: 7px; padding: 2px 4px; margin-top: 2px;">
                                                    {{ $isBooked ? 'Terisi' : 'Ready' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Separator -->
                                    <div style="height: 1px; background: linear-gradient(90deg, transparent, rgba(180,120,60,0.2), transparent); margin: 4px 0 14px;"></div>
                                    <!-- Row 2 -->
                                    <div class="floor-grid" style="grid-template-columns: repeat({{ $row2->count() }}, 1fr); gap: 14px;">
                                        @foreach($row2 as $index => $meja)
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $isBooked = $meja->reservasis()->where('tanggal', $now->toDateString())->where('status', 'valid')->get()->filter(function($res) use ($now) {
                                                    $start = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                                    return $now->between($start, $start->copy()->addHours($res->durasi));
                                                })->isNotEmpty();
                                            @endphp
                                            <div class="meja-card {{ $isBooked ? 'meja-terisi' : 'meja-tersedia' }} p-2 bg-transparent shadow-none" 
                                                 @if(!$isBooked) onclick="selectMeja({{ $meja->id }}, '{{ $meja->nama_meja }}')" @endif>
                                                <div class="sketch-container" style="height: 50px;">
                                                    <div class="lesehan-table">
                                                        <div class="lesehan-mat"></div>
                                                    </div>
                                                </div>
                                                <h5 style="font-size: 11px; font-weight: 800;" class="mb-0 text-amber-800">L{{ $halfCount + $index + 1 }}</h5>
                                                <span class="badge rounded-pill {{ $isBooked ? 'bg-danger' : 'bg-success' }}" style="font-size: 7px; padding: 2px 4px; margin-top: 2px;">
                                                    {{ $isBooked ? 'Terisi' : 'Ready' }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Outdoor Zone Section -->
                    <div class="floor-zone zone-outdoor pt-5 border-top">
                        <span class="zone-label text-orange-400">Outdoor Area</span>
                        <div class="floor-grid" style="grid-template-columns: repeat(5, 1fr); gap: 15px;">
                            @foreach(\App\Models\Meja::where('tipe', 'outdoor')->get() as $meja)
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $isBooked = $meja->reservasis()->where('tanggal', $now->toDateString())->where('status', 'valid')->get()->filter(function($res) use ($now) {
                                        $start = \Carbon\Carbon::parse($res->tanggal->format('Y-m-d') . ' ' . $res->waktu);
                                        return $now->between($start, $start->copy()->addHours($res->durasi));
                                    })->isNotEmpty();
                                @endphp
                                <div class="meja-card {{ $isBooked ? 'meja-terisi' : 'meja-tersedia' }} p-2" 
                                     @if(!$isBooked) onclick="selectMeja({{ $meja->id }}, '{{ $meja->nama_meja }}')" @endif>
                                    <div class="sketch-container" style="height: 55px;">
                                        <div class="sketch-table outdoor-table">
                                            <div class="sketch-chair outdoor-chair-top"></div>
                                            <div class="sketch-chair outdoor-chair-bottom"></div>
                                        </div>
                                    </div>
                                    <h5 style="font-size: 11px; font-weight: 800;" class="mb-1">{{ $meja->nama_meja }}</h5>
                                    <span class="badge rounded-pill {{ $isBooked ? 'bg-danger' : 'bg-success' }}" style="font-size: 7px; padding: 2px 4px;">
                                        {{ $isBooked ? 'Terisi' : 'Ready' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="mt-5 pt-3 border-top d-flex justify-content-center gap-5">
                    <small class="fw-bold text-muted"><span class="status-dot bg-success"></span> Meja Tersedia</small>
                    <small class="fw-bold text-muted"><span class="status-dot bg-danger"></span> Sedang Digunakan</small>
                    <small class="fw-bold text-muted"><i class="bi bi-info-circle me-1"></i> Klik meja untuk memilih di form bawah</small>
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
                                            <td class="py-4 px-4 fw-bold text-dark" data-label="Meja">{{ $res->meja->nama_meja }}</td>
                                            <td class="py-4 px-4" data-label="Waktu">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-semibold text-dark">{{ $res->tanggal->format('d/m/Y') }}</span>
                                                    <span class="text-muted small">{{ $res->waktu }} WIB</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-center" data-label="Status">
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
        function selectMeja(mejaId, namaMeja) {
            const select = document.querySelector('select[name="meja_id"]');
            if (select) {
                // Check if the option exists, if not add it temporarily or handle it
                let option = select.querySelector(`option[value="${mejaId}"]`);
                if (!option) {
                    // This case happens if the table is available in floor plan but not in the dropdown for some reason
                    const newOpt = document.createElement('option');
                    newOpt.value = mejaId;
                    newOpt.text = namaMeja;
                    select.add(newOpt);
                }
                
                select.value = mejaId;
                select.dispatchEvent(new Event('change'));
                
                // Scroll to form
                document.getElementById('reservasiForm').scrollIntoView({ behavior: 'smooth' });
                
                // Visual feedback
                Swal.fire({
                    title: 'Meja Terpilih!',
                    html: `Anda telah memilih <b>${namaMeja}</b>.`,
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                    customClass: {
                        popup: 'rounded-4 shadow-lg border-0'
                    }
                });
            }
        }

        function filterMeja(tipe) {
            const indoorZone = document.querySelector('.zone-indoor');
            const outdoorZone = document.querySelector('.zone-outdoor');
            const btns = document.querySelectorAll('.tab-btn');
            
            btns.forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            if (tipe === 'all') {
                indoorZone.style.display = '';
                outdoorZone.style.display = '';
                indoorZone.style.animation = 'none';
                outdoorZone.style.animation = 'none';
                setTimeout(() => {
                    indoorZone.style.animation = 'fadeIn 0.4s ease forwards';
                    outdoorZone.style.animation = 'fadeIn 0.4s ease forwards';
                }, 10);
            } else if (tipe === 'indoor') {
                indoorZone.style.display = '';
                outdoorZone.style.display = 'none';
                indoorZone.style.animation = 'none';
                setTimeout(() => {
                    indoorZone.style.animation = 'fadeIn 0.4s ease forwards';
                }, 10);
            } else if (tipe === 'outdoor') {
                indoorZone.style.display = 'none';
                outdoorZone.style.display = '';
                outdoorZone.style.animation = 'none';
                setTimeout(() => {
                    outdoorZone.style.animation = 'fadeIn 0.4s ease forwards';
                }, 10);
            }
        }

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
