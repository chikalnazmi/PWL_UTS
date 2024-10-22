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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id');
            $table->unsignedBigInteger('fk_supplier_id')->index();
            $table->unsignedBigInteger('fk_barang_id')->index();
            $table->unsignedBigInteger('fk_user_id')->index(); 
            $table->dateTime('stok_tanggal');
            $table->integer('stok_jumlah');
            $table->timestamps();

            $table->foreign('fk_supplier_id')->references ('supplier_id')->on('m_supplier');
            $table->foreign('fk_barang_id')->references ('barang_id')->on('m_barang');
            $table->foreign('fk_user_id')->references ('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_stok', function (Blueprint $table) {
            //
        });
    }
};
