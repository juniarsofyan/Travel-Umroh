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
            $table->string('keterangan');
            $table->time('waktu');
            $table->integer('paket_umroh_id');
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
        Schema::dropIfExists('itinerary_paket_umroh');
    }
}
