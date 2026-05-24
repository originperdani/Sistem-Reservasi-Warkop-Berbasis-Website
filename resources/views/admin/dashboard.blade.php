<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-black text-gray-900 mb-2">Ringkasan Performa</h1>
        <p class="text-gray-500 font-medium">Pantau statistik reservasi dan pendapatan warkop secara real-time.</p>
    </x-slot>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="glass-card p-8 premium-shadow border-l-4 border-warkop-red hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-warkop-red/10 rounded-2xl text-warkop-red">
                    <i class="bi bi-graph-up-arrow text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Pemasukan</p>
                    <h3 class="text-2xl font-black text-gray-900">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-8 premium-shadow border-l-4 border-warkop-red hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-warkop-red/10 rounded-2xl text-warkop-red">
                    <i class="bi bi-bookmark-check-fill text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Reservasi</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $total_reservasi }}</h3>
                </div>
            </div>
        </div>
        <div class="glass-card p-8 premium-shadow border-l-4 border-warkop-red hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-warkop-red/10 rounded-2xl text-warkop-red">
                    <i class="bi bi-person-badge-fill text-2xl"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Pelanggan</p>
                    <h3 class="text-2xl font-black text-gray-900">{{ $total_pelanggan }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 glass-card p-8 premium-shadow">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-bold text-gray-900">Tren Pendapatan</h3>
                <select class="text-xs font-bold border-none bg-gray-50 rounded-lg px-3 py-2">
                    <option>6 Bulan Terakhir</option>
                </select>
            </div>
            <div class="h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Performance Stats -->
        <div class="space-y-8">
            <div class="glass-card p-8 premium-shadow">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Okupansi Meja</h3>
                <div class="flex items-center justify-center relative h-48">
                    <canvas id="occupancyChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pt-4">
                        <span class="text-3xl font-black text-gray-900">78%</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Utilisasi</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-8 premium-shadow">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aktivitas Terkini</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-warkop-red"></div>
                        <p class="text-xs font-medium text-gray-600">Reservasi baru oleh <span class="font-bold">Budi</span></p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                        <p class="text-xs font-medium text-gray-600">Pembayaran dikonfirmasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Reservations Table -->
    <div class="glass-card overflow-hidden premium-shadow">
        <div class="p-8 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-900">Reservasi Terbaru</h3>
            <a href="{{ route('admin.reservasis') }}" class="text-sm font-bold text-warkop-red hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Meja</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Tanggal</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recent_reservasis as $res)
                    <tr class="hover:bg-premium-bg/50 transition-colors">
                        <td class="px-8 py-5">
                            <div class="font-bold text-gray-900">{{ $res->user->name }}</div>
                            <div class="text-xs text-gray-500 font-medium">WA: {{ $res->whatsapp }}</div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 bg-warkop-red/5 text-warkop-red text-xs font-bold rounded-lg">
                                {{ $res->meja->nama_meja }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-sm font-semibold text-gray-600">{{ $res->tanggal->format('d/m/Y') }}</td>
                        <td class="px-8 py-5 text-center">
                            @php
                                $statusClass = $res->status == 'valid' ? 'bg-green-100 text-green-700' : ($res->status == 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700');
                                $statusLabel = $res->status == 'valid' ? 'Berhasil' : ($res->status == 'pending' ? 'Menunggu' : 'Dibatalkan');
                            @endphp
                            <span class="px-4 py-1.5 inline-flex text-[10px] leading-5 font-black rounded-full uppercase tracking-widest {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        // Revenue Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_labels) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chart_data) !!},
                    borderColor: '#9B1B30',
                    backgroundColor: 'rgba(155, 27, 48, 0.1)',
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#9B1B30',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                        ticks: { font: { weight: 'bold' } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { weight: 'bold' } }
                    }
                }
            }
        });

        // Occupancy Chart (Gauge)
        const ctx2 = document.getElementById('occupancyChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [78, 22],
                    backgroundColor: ['#9B1B30', '#F1F5F9'],
                    borderWidth: 0,
                    circumference: 180,
                    rotation: 270,
                    cutout: '85%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                }
            }
        });
    </script>
    @endpush
</x-admin-layout>
