<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        \App\Models\User::factory()->create([
            'name' => 'Admin Warkop',
            'email' => 'admin@warkop.com',
            'role' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        ]);

        // Create User
        \App\Models\User::factory()->create([
            'name' => 'Pelanggan',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'password' => \Illuminate\Support\Facades\Hash::make('user123'),
        ]);

        // Create Meja
        \App\Models\Meja::create(['nama_meja' => 'Meja 1 (Indoor AC - Non Smoking)', 'kapasitas' => 4, 'status' => 'tersedia']);
        \App\Models\Meja::create(['nama_meja' => 'Meja 2 (Indoor AC - Non Smoking)', 'kapasitas' => 2, 'status' => 'tersedia']);
        \App\Models\Meja::create(['nama_meja' => 'Meja 3 (Indoor AC - Non Smoking)', 'kapasitas' => 6, 'status' => 'tersedia']);
        \App\Models\Meja::create(['nama_meja' => 'Meja 4 (Outdoor - Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);
        \App\Models\Meja::create(['nama_meja' => 'Meja 5 (Outdoor - Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);
        \App\Models\Meja::create(['nama_meja' => 'Meja 6 (Outdoor - Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);

        // Create Menu - Minuman Warkop
        \App\Models\Menu::create(['nama_menu' => 'Kopi Kapal Api Mix', 'harga' => 5000, 'kategori' => 'minuman', 'deskripsi' => 'Kopi Kapal Api Mix mantap', 'gambar' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Kopi ABC Susu', 'harga' => 5000, 'kategori' => 'minuman', 'deskripsi' => 'Kopi ABC Susu nikmat', 'gambar' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Kopi Susu Warpam', 'harga' => 14000, 'kategori' => 'minuman', 'deskripsi' => 'Spesialnya Warpam', 'gambar' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Es Teh Manis', 'harga' => 5000, 'kategori' => 'minuman', 'deskripsi' => 'Segarnya es teh manis', 'gambar' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Es Jeruk Segar', 'harga' => 7000, 'kategori' => 'minuman', 'deskripsi' => 'Jeruk peras asli', 'gambar' => 'https://images.unsplash.com/photo-1613478223719-2ab802602423?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Thai Tea', 'harga' => 12000, 'kategori' => 'minuman', 'deskripsi' => 'Thai tea original', 'gambar' => 'https://images.unsplash.com/photo-1540713434306-58f05cf816fe?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Matcha Latte', 'harga' => 15000, 'kategori' => 'minuman', 'deskripsi' => 'Matcha premium creamy', 'gambar' => 'https://images.unsplash.com/photo-1515823064-d6e0c04616a7?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Lemon Tea Ice', 'harga' => 8000, 'kategori' => 'minuman', 'deskripsi' => 'Teh lemon segar', 'gambar' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&q=80&w=600']);
        
        // Susu-Susuan
        \App\Models\Menu::create(['nama_menu' => 'Milo Hot/Ice', 'harga' => 8000, 'kategori' => 'minuman', 'deskripsi' => 'Susu Milo segar', 'gambar' => 'https://images.unsplash.com/photo-1544787210-2213d84ad960?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Dancow Vanilla', 'harga' => 10000, 'kategori' => 'minuman', 'deskripsi' => 'Susu Dancow Vanilla', 'gambar' => 'https://images.unsplash.com/photo-1550583760-5868b0d3f73e?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Teh Tarik', 'harga' => 10000, 'kategori' => 'minuman', 'deskripsi' => 'Teh tarik khas warkop', 'gambar' => 'https://images.unsplash.com/photo-1594631252845-29fc4cc8cde9?auto=format&fit=crop&q=80&w=600']);
        
        // Yang Manis-Manis & Cemilan
        \App\Models\Menu::create(['nama_menu' => 'Ketan Susu', 'harga' => 6000, 'kategori' => 'cemilan', 'deskripsi' => 'Ketan susu legit', 'gambar' => 'https://images.unsplash.com/photo-1621510456681-23a2ee09201f?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Kue Pancong', 'harga' => 8000, 'kategori' => 'cemilan', 'deskripsi' => 'Kue pancong lumer', 'gambar' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Kentang Goreng', 'harga' => 12000, 'kategori' => 'cemilan', 'deskripsi' => 'French fries renyah', 'gambar' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Pisang Bakar Coklat', 'harga' => 10000, 'kategori' => 'cemilan', 'deskripsi' => 'Pisang bakar topping melimpah', 'gambar' => 'https://images.unsplash.com/photo-1590004953392-5aba2e72269a?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Roti Bakar Keju', 'harga' => 12000, 'kategori' => 'cemilan', 'deskripsi' => 'Roti bakar keju susu', 'gambar' => 'https://images.unsplash.com/photo-1559181567-c3190ca9959b?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Cireng Rujak', 'harga' => 10000, 'kategori' => 'cemilan', 'deskripsi' => 'Cireng dengan bumbu rujak pedas', 'gambar' => 'https://images.unsplash.com/photo-1541529086526-db283c563270?auto=format&fit=crop&q=80&w=600']);
        
        // Nasi & Mie
        \App\Models\Menu::create(['nama_menu' => 'Nasi Kulit Cabe Garam', 'harga' => 14000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi kulit krispi cabe garam', 'gambar' => 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Nasi Ayam Sambal Bawang', 'harga' => 15000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi ayam dengan sambal bawang', 'gambar' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Mie Jontor!', 'harga' => 16000, 'kategori' => 'makanan', 'deskripsi' => 'Mie pedas nampol', 'gambar' => 'https://images.unsplash.com/photo-1552611052-33e04de081de?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Mie Tek-Tek', 'harga' => 15000, 'kategori' => 'makanan', 'deskripsi' => 'Mie tek-tek spesial', 'gambar' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Nasi Gila', 'harga' => 17000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi gila porsi kenyang', 'gambar' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Indomie Internet', 'harga' => 13000, 'kategori' => 'makanan', 'deskripsi' => 'Indomie telur kornet', 'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Ayam Geprek', 'harga' => 15000, 'kategori' => 'makanan', 'deskripsi' => 'Ayam geprek pedas', 'gambar' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&q=80&w=600']);
        \App\Models\Menu::create(['nama_menu' => 'Nasi Goreng Gila', 'harga' => 18000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi goreng dengan topping melimpah', 'gambar' => 'https://images.unsplash.com/photo-1512058560550-42749359a767?auto=format&fit=crop&q=80&w=600']);
    }
}
