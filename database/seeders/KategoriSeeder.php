<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'A001', 'kategori_nama'=> 'Gelang'],
            ['kategori_id' => 2, 'kategori_kode' => 'B002', 'kategori_nama'=> 'Kalung'],
            ['kategori_id' => 3, 'kategori_kode' => 'C003', 'kategori_nama'=> 'Anting'],
            ['kategori_id' => 4, 'kategori_kode' => 'D004', 'kategori_nama'=> 'Cincin'],
            ['kategori_id' => 5, 'kategori_kode' => 'E005', 'kategori_nama'=> 'Jam Tangan']
        ];
        
        DB::table('m_kategori')->insert($data);
    }
}