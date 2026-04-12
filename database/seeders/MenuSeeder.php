<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Yang Manis-Manis & Cemilan
        Menu::updateOrCreate(['nama_menu' => 'Ketan Susu'], ['harga' => 6000, 'kategori' => 'cemilan', 'deskripsi' => 'Ketan susu legit', 'gambar' => 'https://images.unsplash.com/photo-1621510456681-23a2ee09201f?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Kue Pancong'], ['harga' => 8000, 'kategori' => 'cemilan', 'deskripsi' => 'Kue pancong lumer', 'gambar' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Kentang Goreng'], ['harga' => 12000, 'kategori' => 'cemilan', 'deskripsi' => 'French fries renyah', 'gambar' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Pisang Bakar Coklat'], ['harga' => 10000, 'kategori' => 'cemilan', 'deskripsi' => 'Pisang bakar topping melimpah', 'gambar' => 'https://images.unsplash.com/photo-1590004953392-5aba2e72269a?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Roti Bakar Keju'], ['harga' => 12000, 'kategori' => 'cemilan', 'deskripsi' => 'Roti bakar keju susu', 'gambar' => 'https://images.unsplash.com/photo-1559181567-c3190ca9959b?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Cireng Rujak'], ['harga' => 10000, 'kategori' => 'cemilan', 'deskripsi' => 'Cireng dengan bumbu rujak pedas', 'gambar' => 'https://images.unsplash.com/photo-1541529086526-db283c563270?auto=format&fit=crop&q=80&w=600']);
        
        // Nasi & Mie
        Menu::updateOrCreate(['nama_menu' => 'Nasi Kulit Cabe Garam'], ['harga' => 14000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi kulit krispi cabe garam', 'gambar' => 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Nasi Ayam Sambal Bawang'], ['harga' => 15000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi ayam dengan sambal bawang', 'gambar' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Mie Jontor!'], ['harga' => 16000, 'kategori' => 'makanan', 'deskripsi' => 'Mie pedas nampol', 'gambar' => 'https://images.unsplash.com/photo-1552611052-33e04de081de?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Mie Tek-Tek'], ['harga' => 15000, 'kategori' => 'makanan', 'deskripsi' => 'Mie tek-tek spesial', 'gambar' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Nasi Gila'], ['harga' => 17000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi gila porsi kenyang', 'gambar' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Indomie Internet'], ['harga' => 13000, 'kategori' => 'makanan', 'deskripsi' => 'Indomie telur kornet', 'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Ayam Geprek'], ['harga' => 15000, 'kategori' => 'makanan', 'deskripsi' => 'Ayam geprek pedas', 'gambar' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&q=80&w=600']);
        Menu::updateOrCreate(['nama_menu' => 'Nasi Goreng Gila'], ['harga' => 18000, 'kategori' => 'makanan', 'deskripsi' => 'Nasi goreng dengan topping melimpah', 'gambar' => 'https://images.unsplash.com/photo-1512058560550-42749359a767?auto=format&fit=crop&q=80&w=600']);
    }
}
