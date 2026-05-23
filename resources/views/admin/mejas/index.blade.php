<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-900 tracking-tight">
                {{ __('Kelola Meja') }}
            </h2>
            <button onclick="openAddModal()" class="bg-warkop-red text-white px-6 py-2.5 rounded-full text-sm font-black hover:bg-warkop-red-dark transition shadow-lg hover:shadow-warkop-red/20 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Meja Baru
            </button>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-[1200px] mx-auto px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-xl rounded-3xl border border-white/50 p-8">
                <div class="overflow-x-auto rounded-2xl border border-gray-100">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Meja</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kapasitas</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-100">
                            @foreach($mejas as $meja)
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
                            <tr class="hover:bg-white transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">{{ $meja->nama_meja }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-black">
                                    <div class="flex items-center gap-2">
                                        <i class="bi bi-people-fill text-gray-400"></i>
                                        {{ $meja->kapasitas }} orang
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($isBooked)
                                        <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-black rounded-full shadow-sm bg-rose-100 text-rose-800">
                                            {{ $statusLabel }} ({{ $timeRangeStr }})
                                        </span>
                                    @else
                                        @php
                                            $statusClass = $meja->status == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
                                            $statusText = $meja->status == 'tersedia' ? 'Tersedia' : 'Rusak / Nonaktif';
                                        @endphp
                                        <span class="px-4 py-1.5 inline-flex text-xs leading-5 font-black rounded-full shadow-sm {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openEditModal({{ $meja->id }})" class="p-2.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-xl transition shadow-sm hover:shadow-md"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('mejas.destroy', $meja->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus meja ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2.5 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-xl transition shadow-sm hover:shadow-md"><i class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Meja Modal (Add/Edit) -->
    <div class="modal fade" id="mejaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-[2rem] border-0 shadow-2xl overflow-hidden">
                <form id="mejaForm" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-header border-0 bg-warkop-red p-6">
                        <h5 class="modal-title font-black text-white text-xl" id="modalTitle">Tambah Meja Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-8 space-y-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">Nama Meja</label>
                            <input type="text" name="nama_meja" id="nama_meja" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-wider text-gray-400">Kapasitas (Orang)</label>
                                <input type="number" name="kapasitas" id="kapasitas" min="1" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-wider text-gray-400">Status</label>
                                <select name="status" id="status" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200" required>
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak tersedia">Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-8 pt-0">
                        <button type="submit" class="w-full bg-warkop-red text-white py-4 rounded-2xl font-black shadow-lg shadow-warkop-red/20 hover:bg-warkop-red-dark transition duration-300">Simpan Meja</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const modal = new bootstrap.Modal(document.getElementById('mejaModal'));
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
                    document.getElementById('status').value = data.status;
                    modal.show();
                });
        }
    </script>
    @endpush
</x-app-layout>
