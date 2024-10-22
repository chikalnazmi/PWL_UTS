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
        Schema::create('t_penjualan_detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('fk_penjualan_id')->index();
            $table->unsignedBigInteger('fk_barang_id')->index();  
            $table->integer('harga');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('fk_penjualan_id')->references ('penjualan_id')->on('t_penjualan');
            $table->foreign('fk_barang_id')->references ('barang_id')->on('m_barang');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_penjualan_detail', function (Blueprint $table) {
            //
        });
    }
};
