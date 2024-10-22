<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'S001', 'supplier_nama' => 'PT Gelang Indah', 'supplier_alamat' => 'Jl. Merdeka No. 10, Jakarta'],
            ['supplier_id' => 2, 'supplier_kode' => 'S002', 'supplier_nama' => 'CV Kalung Mewah', 'supplier_alamat' => 'Jl. Pahlawan No. 23, Bandung'],
            ['supplier_id' => 3, 'supplier_kode' => 'S003', 'supplier_nama' => 'UD Anting Cantik', 'supplier_alamat' => 'Jl. Cendana No. 45, Surabaya'],
            ['supplier_id' => 4, 'supplier_kode' => 'S004', 'supplier_nama' => 'PT Cincin Gemilang', 'supplier_alamat' => 'Jl. Sudirman No. 12, Yogyakarta'],
            ['supplier_id' => 5, 'supplier_kode' => 'S005', 'supplier_nama' => 'CV Jam Tangan Elegan', 'supplier_alamat' => 'Jl. Kartini No. 78, Bali']
        ];
        
        DB::table('m_supplier')->insert($data);
    }
}