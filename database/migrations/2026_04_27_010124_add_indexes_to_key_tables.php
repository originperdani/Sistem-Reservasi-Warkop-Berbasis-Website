<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            // Index untuk mempercepat pengecekan jadwal bentrok (overlapping)
            $table->index(['tanggal', 'waktu', 'meja_id', 'status'], 'idx_reservasi_overlap');
            // Index untuk pencarian berdasarkan user (history)
            $table->index('user_id');
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            // Index untuk filter status pembayaran (terutama di dashboard admin)
            $table->index('status');
        });

        Schema::table('menus', function (Blueprint $table) {
            // Index untuk kategori (filter menu)
            $table->index('kategori');
        });

        Schema::table('mejas', function (Blueprint $table) {
            // Index untuk status meja (cek ketersediaan)
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropIndex('idx_reservasi_overlap');
            $table->dropIndex(['user_id']);
        });

        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropIndex(['kategori']);
        });

        Schema::table('mejas', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
