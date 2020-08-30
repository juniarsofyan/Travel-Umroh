<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateItineraryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_itinerary_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('template_itinerary_id');
            $table->integer('hari_ke');
            $table->string('kegiatan');
            $table->string('keterangan')->nullable();
            $table->string('tipe')->default('SETELAH PENERBANGAN');
            $table->float('estimasi');
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
        Schema::dropIfExists('template_itinerary_detail');
    }
}
