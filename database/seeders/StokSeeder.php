<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Stok Barang dari Supplier 1 (PT Gelang Indah)
            ['stok_id' => 1, 'fk_supplier_id' => 1, 'fk_barang_id' => 101, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 50],
            ['stok_id' => 2, 'fk_supplier_id' => 1, 'fk_barang_id' => 102, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 100],
            ['stok_id' => 3, 'fk_supplier_id' => 1, 'fk_barang_id' => 103, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 70],
            
            // Stok Barang dari Supplier 2 (CV Kalung Mewah)
            ['stok_id' => 4, 'fk_supplier_id' => 2, 'fk_barang_id' => 104, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 120],
            ['stok_id' => 5, 'fk_supplier_id' => 2, 'fk_barang_id' => 105, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 80],
            
            // Stok Barang dari Supplier 3 (UD Anting Cantik)
            ['stok_id' => 6, 'fk_supplier_id' => 3, 'fk_barang_id' => 106, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 60],
            ['stok_id' => 7, 'fk_supplier_id' => 3, 'fk_barang_id' => 107, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 90],
            
            // Stok Barang dari Supplier 4 (PT Cincin Gemilang)
            ['stok_id' => 8, 'fk_supplier_id' => 4, 'fk_barang_id' => 108, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 150],
            ['stok_id' => 9, 'fk_supplier_id' => 4, 'fk_barang_id' => 109, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 100],
            
            // Stok Barang dari Supplier 5 (CV Jam Tangan Elegan)
            ['stok_id' => 10, 'fk_supplier_id' => 5, 'fk_barang_id' => 110, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 200],
            ['stok_id' => 11, 'fk_supplier_id' => 5, 'fk_barang_id' => 111, 'fk_user_id' => 3, 'stok_tanggal' => now(), 'stok_jumlah' => 250],
        ];
        

        DB::table('t_stok')->insert($data);
    }
}
