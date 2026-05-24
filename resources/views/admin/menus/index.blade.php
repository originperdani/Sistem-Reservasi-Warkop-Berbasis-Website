<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-gray-900 mb-2">Kelola Menu</h1>
                <p class="text-gray-500 font-medium">Atur daftar makanan dan minuman yang tersedia di warkop.</p>
            </div>
            <button onclick="openAddModal()" class="bg-warkop-red text-white px-8 py-3.5 rounded-2xl text-sm font-black hover:bg-warkop-red-dark transition shadow-lg shadow-warkop-red/20 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Menu Baru
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
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Gambar</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Nama Menu</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Kategori</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest">Harga</th>
                        <th class="px-8 py-5 text-xs font-bold text-gray-500 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($menus as $menu)
                    <tr class="hover:bg-premium-bg/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="relative group w-16 h-16">
                                <img src="{{ $menu->gambar ?? 'https://via.placeholder.com/100' }}" 
                                     class="w-full h-full rounded-2xl object-cover shadow-sm group-hover:shadow-md transition-all duration-300" 
                                     alt="{{ $menu->nama_menu }}">
                                <div class="absolute inset-0 rounded-2xl border border-black/5"></div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="font-bold text-gray-900">{{ $menu->nama_menu }}</div>
                            <div class="text-[10px] text-gray-400 font-medium line-clamp-1">{{ $menu->deskripsi }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <span class="px-3 py-1 text-[10px] font-black rounded-lg bg-warkop-red/5 text-warkop-red uppercase tracking-wider border border-warkop-red/10">
                                {{ $menu->kategori }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-gray-900 font-black">
                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <button onclick="openEditModal({{ $menu->id }})" 
                                        class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center hover:bg-amber-100 transition-all shadow-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
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

    <!-- Menu Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-[2.5rem] border-0 shadow-2xl overflow-hidden bg-white/90 backdrop-blur-xl">
                <form id="menuForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="methodField"></div>
                    <div class="modal-header border-0 bg-warkop-red p-8">
                        <h5 class="modal-title font-serif font-black text-white text-2xl" id="modalTitle">Tambah Menu Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-10 space-y-6">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Nama Menu</label>
                            <input type="text" name="nama_menu" id="nama_menu" 
                                   class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Kategori</label>
                                <select name="kategori" id="kategori" 
                                        class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Cemilan">Cemilan</option>
                                </select>
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Harga (Rp)</label>
                                <input type="number" name="harga" id="harga" 
                                       class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all" required>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" 
                                      class="w-full rounded-2xl border-none bg-gray-50 focus:ring-2 focus:ring-warkop-red/20 py-4 px-6 font-bold text-gray-900 transition-all"></textarea>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Gambar Menu</label>
                            <div class="flex items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                <div id="imagePreview" class="w-24 h-24 rounded-xl bg-white flex items-center justify-center overflow-hidden shadow-sm border border-gray-100">
                                    <i class="bi bi-image text-gray-200 text-3xl"></i>
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="gambar" id="gambar" 
                                           class="text-[10px] font-bold text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:bg-warkop-red file:text-white hover:file:bg-warkop-red-dark transition-all cursor-pointer" accept="image/*">
                                    <p class="text-[10px] text-gray-400 mt-2 font-medium">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
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
        const modalElement = document.getElementById('menuModal');
        const modal = new bootstrap.Modal(modalElement);
        const form = document.getElementById('menuForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const imagePreview = document.getElementById('imagePreview');

        function openAddModal() {
            modalTitle.innerText = 'Tambah Menu Baru';
            form.action = "{{ route('menus.store') }}";
            methodField.innerHTML = '';
            form.reset();
            imagePreview.innerHTML = '<i class="bi bi-image text-gray-200 text-3xl"></i>';
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
                        imagePreview.innerHTML = '<i class="bi bi-image text-gray-200 text-3xl"></i>';
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
</x-admin-layout>
