<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Barang untuk Kategori Gelang (Kategori ID 1)
            ['barang_id' => 101, 'fk_kategori_id' => 1, 'barang_kode' => 'ACC001', 'barang_nama' => 'Aurora Charm', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_id' => 102, 'fk_kategori_id' => 1, 'barang_kode' => 'ACC002', 'barang_nama' => 'Lunar Grace', 'harga_beli' => 1500000, 'harga_jual' => 1800000],
            ['barang_id' => 103, 'fk_kategori_id' => 1, 'barang_kode' => 'ACC003', 'barang_nama' => 'Ethereal Dream', 'harga_beli' => 500000, 'harga_jual' => 700000],
            ['barang_id' => 104, 'fk_kategori_id' => 1, 'barang_kode' => 'ACC004', 'barang_nama' => 'Mystic Halo', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 105, 'fk_kategori_id' => 1, 'barang_kode' => 'ACC005', 'barang_nama' => 'Serenity Loop', 'harga_beli' => 250000, 'harga_jual' => 400000],
        
            // Barang untuk Kategori Kalung (Kategori ID 2)
            ['barang_id' => 106, 'fk_kategori_id' => 2, 'barang_kode' => 'ACC006', 'barang_nama' => 'Celestial Aura', 'harga_beli' => 5000000, 'harga_jual' => 5500000],
            ['barang_id' => 107, 'fk_kategori_id' => 2, 'barang_kode' => 'ACC007', 'barang_nama' => 'Eclipse Jewel', 'harga_beli' => 4500000, 'harga_jual' => 5000000],
            ['barang_id' => 108, 'fk_kategori_id' => 2, 'barang_kode' => 'ACC008', 'barang_nama' => 'Starlight Whisper', 'harga_beli' => 2500000, 'harga_jual' => 3000000],
            ['barang_id' => 109, 'fk_kategori_id' => 2, 'barang_kode' => 'ACC009', 'barang_nama' => 'Twilight Reflection', 'harga_beli' => 3500000, 'harga_jual' => 4000000],
            ['barang_id' => 110, 'fk_kategori_id' => 2, 'barang_kode' => 'ACC010', 'barang_nama' => 'Silver Mirage', 'harga_beli' => 1200000, 'harga_jual' => 1500000],
        
            // Barang untuk Kategori Anting (Kategori ID 3)
            ['barang_id' => 111, 'fk_kategori_id' => 3, 'barang_kode' => 'ACC011', 'barang_nama' => 'Ocean Breeze', 'harga_beli' => 1000000, 'harga_jual' => 1500000],
            ['barang_id' => 112, 'fk_kategori_id' => 3, 'barang_kode' => 'ACC012', 'barang_nama' => 'Velvet Horizon', 'harga_beli' => 1200000, 'harga_jual' => 1700000],
            ['barang_id' => 113, 'fk_kategori_id' => 3, 'barang_kode' => 'ACC013', 'barang_nama' => 'Obsidian Glow', 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_id' => 114, 'fk_kategori_id' => 3, 'barang_kode' => 'ACC014', 'barang_nama' => 'Crystal Dawn', 'harga_beli' => 500000, 'harga_jual' => 800000],
            ['barang_id' => 115, 'fk_kategori_id' => 3, 'barang_kode' => 'ACC015', 'barang_nama' => 'Jade Harmony', 'harga_beli' => 750000, 'harga_jual' => 1000000],
        
            // Barang untuk Kategori Cincin (Kategori ID 4)
            ['barang_id' => 116, 'fk_kategori_id' => 4, 'barang_kode' => 'ACC016', 'barang_nama' => 'Solstice Radiance', 'harga_beli' => 7000000, 'harga_jual' => 7500000],
            ['barang_id' => 117, 'fk_kategori_id' => 4, 'barang_kode' => 'ACC017', 'barang_nama' => 'Golden Ember', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 118, 'fk_kategori_id' => 4, 'barang_kode' => 'ACC018', 'barang_nama' => 'Eternal Flame', 'harga_beli' => 6000000, 'harga_jual' => 6500000],
            ['barang_id' => 119, 'fk_kategori_id' => 4, 'barang_kode' => 'ACC019', 'barang_nama' => 'Sapphire Horizon', 'harga_beli' => 4000000, 'harga_jual' => 4500000],
            ['barang_id' => 120, 'fk_kategori_id' => 4, 'barang_kode' => 'ACC020', 'barang_nama' => 'Moonlit Silver', 'harga_beli' => 1500000, 'harga_jual' => 2000000],
        
            // Barang untuk Kategori Jam Tangan (Kategori ID 5)
            ['barang_id' => 121, 'fk_kategori_id' => 5, 'barang_kode' => 'ACC021', 'barang_nama' => 'Timeless Elegance', 'harga_beli' => 10000000, 'harga_jual' => 12000000],
            ['barang_id' => 122, 'fk_kategori_id' => 5, 'barang_kode' => 'ACC022', 'barang_nama' => 'Midnight Glow', 'harga_beli' => 1500000, 'harga_jual' => 2000000],
            ['barang_id' => 123, 'fk_kategori_id' => 5, 'barang_kode' => 'ACC023', 'barang_nama' => 'Glimmering Wave', 'harga_beli' => 2500000, 'harga_jual' => 3000000],
            ['barang_id' => 124, 'fk_kategori_id' => 5, 'barang_kode' => 'ACC024', 'barang_nama' => 'Seaside Horizon', 'harga_beli' => 4000000, 'harga_jual' => 4500000],
            ['barang_id' => 125, 'fk_kategori_id' => 5, 'barang_kode' => 'ACC025', 'barang_nama' => 'Whispering Sands', 'harga_beli' => 3500000, 'harga_jual' => 4000000],
        ];
        

        DB::table('m_barang')->insert($data);
    }
}

