<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-gray-900 mb-2">Kelola Meja</h1>
                <p class="text-gray-500 font-medium">Atur ketersediaan dan kapasitas meja untuk reservasi pelanggan.</p>
            </div>
            <button onclick="openAddModal()" class="bg-warkop-red text-white px-8 py-3.5 rounded-2xl text-sm font-black hover:bg-warkop-red-dark transition shadow-lg shadow-warkop-red/20 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Meja Baru
            </button>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="glass-card bg-emerald-50 border-emerald-100 text-emerald-700 px-8 py-4 mb-10 flex items-center gap-4 animate-fade-in" data-aos="fade-up">
            <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                <i class="bi bi-check-lg"></i>
            </div>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="glass-card overflow-hidden premium-shadow" data-aos="fade-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Nama Meja</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Tipe</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Kapasitas</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Status Saat Ini</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($mejas as $meja)
                    @php
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
                        $timeRangeStr = '';
                        $statusLabel = '';
                        
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
                    <tr class="hover:bg-premium-bg/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="font-bold text-gray-900">{{ $meja->nama_meja }}</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">ID: MEJA-{{ $meja->id }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $meja->tipe == 'indoor' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600' }}">
                                {{ $meja->tipe }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <span class="font-bold text-gray-900">{{ $meja->kapasitas }} Orang</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-center">
                            @if($isBooked)
                                <span class="px-4 py-1.5 inline-flex text-[10px] leading-5 font-black rounded-full shadow-sm bg-rose-100 text-rose-700 uppercase tracking-widest border border-rose-200">
                                    {{ $statusLabel }} ({{ $timeRangeStr }})
                                </span>
                            @else
                                @php
                                    $statusClass = $meja->status == 'tersedia' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 'bg-gray-100 text-gray-700 border-gray-200';
                                    $statusText = $meja->status == 'tersedia' ? 'Tersedia' : 'Nonaktif';
                                @endphp
                                <span class="px-4 py-1.5 inline-flex text-[10px] leading-5 font-black rounded-full shadow-sm {{ $statusClass }} uppercase tracking-widest border">
                                    {{ $statusText }}
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <button onclick="openEditModal({{ $meja->id }})" 
                                        class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center hover:bg-amber-100 transition-all shadow-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('mejas.destroy', $meja->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus meja ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center hover:bg-rose-100 transition-all shadow-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Meja Modal -->
    <div class="modal fade" id="mejaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-[2.5rem] border-0 shadow-2xl overflow-hidden bg-white/90 backdrop-blur-xl">
                <form id="mejaForm" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-header border-0 bg-warkop-red p-8">
                        <h5 class="modal-title font-serif font-black text-white text-2xl" id="modalTitle">Tambah Meja Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-10 space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Nama Meja</label>
                            <input type="text" name="nama_meja" id="nama_meja" 
                                   class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Kapasitas (Orang)</label>
                                <input type="number" name="kapasitas" id="kapasitas" min="1" 
                                       class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Tipe Meja</label>
                                <select name="tipe" id="tipe" 
                                        class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                                    <option value="indoor">Indoor (4 Orang)</option>
                                    <option value="outdoor">Outdoor (2 Orang)</option>
                                </select>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Status</label>
                            <select name="status" id="status" 
                                    class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                                <option value="tersedia">Tersedia</option>
                                <option value="tidak tersedia">Tidak Tersedia</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-10 pt-0">
                        <button type="submit" class="w-full bg-warkop-red text-white py-5 rounded-2xl font-black shadow-xl shadow-warkop-red/20 hover:bg-warkop-red-dark transition-all duration-300 uppercase tracking-widest">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalElement = document.getElementById('mejaModal');
        const modal = new bootstrap.Modal(modalElement);
        const form = document.getElementById('mejaForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');

        function openAddModal() {
            modalTitle.innerText = 'Tambah Meja Baru';
            form.action = "{{ route('mejas.store') }}";
            methodField.innerHTML = '';
            form.reset();
            modal.show();
        }

        function openEditModal(id) {
            modalTitle.innerText = 'Edit Meja';
            form.action = `/admin/mejas/${id}`;
            methodField.innerHTML = '@method("PUT")';
            
            fetch(`/admin/mejas/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('nama_meja').value = data.nama_meja;
                    document.getElementById('kapasitas').value = data.kapasitas;
                    document.getElementById('tipe').value = data.tipe;
                    document.getElementById('status').value = data.status;
                    modal.show();
                });
        }
    </script>
    @endpush
</x-admin-layout>
