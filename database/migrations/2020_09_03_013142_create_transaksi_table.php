<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal_transaksi');
            $table->integer('jamaah_id');
            $table->integer('paket_umroh_id');
            $table->integer('jenis_kamar_id');
            $table->integer('jadwal_penerbangan_id');
            $table->integer('template_itinerary_id');
            $table->string('deskripsi')->nullable();
            $table->string('status_transaksi')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
