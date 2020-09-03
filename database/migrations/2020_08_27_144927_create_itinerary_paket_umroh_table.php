<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItineraryPaketUmrohTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_paket_umroh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('hari_ke');
            $table->string('kegiatan');
            $table->string('keterangan')->nullable();
            $table->date('tanggal_mulai');
            $table->time('jam_mulai');
            $table->date('tanggal_selesai');
            $table->time('jam_selesai');
            $table->integer('paket_umroh_id');
            $table->integer('jamaah_id');
            $table->integer('paket_umroh_id');
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
        Schema::dropIfExists('itinerary_paket_umroh');
    }
}
