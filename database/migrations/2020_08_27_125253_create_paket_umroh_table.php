<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaketUmrohTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_umroh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_paket');
            $table->date('tanggal');
            $table->integer('jumlah_hari');
            $table->integer('jumlah_orang');
            $table->integer('harga');
            $table->integer('hotel_makkah');
            $table->integer('hotel_madinah');
            $table->integer('maskapai_id');
            $table->integer('jenis_kamar_id');
            $table->text('deskripsi');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_umroh');
    }
}
