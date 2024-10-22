<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['penjualan_id' => 1, 'fk_user_id' => 1, 'pembeli' => 'Budi Santoso', 'penjualan_kode' => 'PJ001', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 2, 'fk_user_id' => 2, 'pembeli' => 'Siti Nurhaliza', 'penjualan_kode' => 'PJ002', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 3, 'fk_user_id' => 3, 'pembeli' => 'Andi Saputra', 'penjualan_kode' => 'PJ003', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 4, 'fk_user_id' => 1, 'pembeli' => 'Joko Widodo', 'penjualan_kode' => 'PJ004', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 5, 'fk_user_id' => 2, 'pembeli' => 'Lina Susanti', 'penjualan_kode' => 'PJ005', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 6, 'fk_user_id' => 3, 'pembeli' => 'Toni Suryana', 'penjualan_kode' => 'PJ006', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 7, 'fk_user_id' => 1, 'pembeli' => 'Aisyah Putri', 'penjualan_kode' => 'PJ007', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 8, 'fk_user_id' => 2, 'pembeli' => 'Ahmad Dani', 'penjualan_kode' => 'PJ008', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 9, 'fk_user_id' => 3, 'pembeli' => 'Bambang Hartono', 'penjualan_kode' => 'PJ009', 'penjualan_tanggal' => now()],
            ['penjualan_id' => 10, 'fk_user_id' => 1, 'pembeli' => 'Slamet Riyadi', 'penjualan_kode' => 'PJ010', 'penjualan_tanggal' => now()],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
