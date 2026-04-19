<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-gray-900 tracking-tight">
                {{ __('Kelola Menu') }}
            </h2>
            <button onclick="openAddModal()" class="bg-warkop-red text-white px-6 py-2.5 rounded-full text-sm font-black hover:bg-warkop-red-dark transition shadow-lg hover:shadow-warkop-red/20 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Menu Baru
            </button>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Menu</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 divide-y divide-gray-100">
                            @foreach($menus as $menu)
                            <tr class="hover:bg-white transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="relative group">
                                        <img src="{{ $menu->gambar ?? 'https://via.placeholder.com/50' }}" class="w-14 h-14 rounded-2xl object-cover shadow-sm group-hover:shadow-md transition-shadow duration-200" alt="{{ $menu->nama_menu }}">
                                        <div class="absolute inset-0 rounded-2xl border border-black/5"></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900">{{ $menu->nama_menu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-[10px] font-black rounded-full bg-warkop-red/5 text-warkop-red uppercase tracking-wider">
                                        {{ $menu->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-black">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openEditModal({{ $menu->id }})" class="p-2.5 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-xl transition shadow-sm hover:shadow-md"><i class="bi bi-pencil-square"></i></button>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
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

    <!-- Menu Modal (Add/Edit) -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-[2rem] border-0 shadow-2xl overflow-hidden">
                <form id="menuForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-header border-0 bg-warkop-red p-6">
                        <h5 class="modal-title font-black text-white text-xl" id="modalTitle">Tambah Menu Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-8 space-y-4">
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">Nama Menu</label>
                            <input type="text" name="nama_menu" id="nama_menu" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-wider text-gray-400">Kategori</label>
                                <select name="kategori" id="kategori" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200" required>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Cemilan">Cemilan</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-black uppercase tracking-wider text-gray-400">Harga (Rp)</label>
                                <input type="number" name="harga" id="harga" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200" required>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full rounded-2xl border-gray-100 bg-gray-50 focus:border-warkop-red focus:ring-warkop-red/10 transition duration-200"></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase tracking-wider text-gray-400">Gambar Menu</label>
                            <div class="flex items-center gap-4">
                                <div id="imagePreview" class="w-20 h-20 rounded-2xl bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-200 overflow-hidden">
                                    <i class="bi bi-image text-gray-300 text-2xl"></i>
                                </div>
                                <input type="file" name="gambar" id="gambar" class="text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-warkop-red/10 file:text-warkop-red hover:file:bg-warkop-red/20 transition cursor-pointer" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-8 pt-0">
                        <button type="submit" class="w-full bg-warkop-red text-white py-4 rounded-2xl font-black shadow-lg shadow-warkop-red/20 hover:bg-warkop-red-dark transition duration-300">Simpan Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const modal = new bootstrap.Modal(document.getElementById('menuModal'));
        const form = document.getElementById('menuForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const imagePreview = document.getElementById('imagePreview');

        function openAddModal() {
            modalTitle.innerText = 'Tambah Menu Baru';
            form.action = "{{ route('menus.store') }}";
            methodField.innerHTML = '';
            form.reset();
            imagePreview.innerHTML = '<i class="bi bi-image text-gray-300 text-2xl"></i>';
            modal.show();
        }

        function openEditModal(id) {
            modalTitle.innerText = 'Edit Menu';
            form.action = `/admin/menus/${id}`;
            methodField.innerHTML = '@method("PUT")';
            
            fetch(`/admin/menus/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('nama_menu').value = data.nama_menu;
                    document.getElementById('kategori').value = data.kategori;
                    document.getElementById('harga').value = data.harga;
                    document.getElementById('deskripsi').value = data.deskripsi;
                    
                    if (data.gambar) {
                        imagePreview.innerHTML = `<img src="${data.gambar}" class="w-full h-full object-cover">`;
                    } else {
                        imagePreview.innerHTML = '<i class="bi bi-image text-gray-300 text-2xl"></i>';
                    }
                    
                    modal.show();
                });
        }

        document.getElementById('gambar').onchange = evt => {
            const [file] = evt.target.files;
            if (file) {
                imagePreview.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
            }
        }
    </script>
    @endpush
</x-app-layout>
