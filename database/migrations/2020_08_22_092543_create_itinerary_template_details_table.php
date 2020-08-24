<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItineraryTemplateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary_template_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('itinerary_template_id');
            $table->integer('hari_ke');
            $table->string('kegiatan');
            $table->string('keterangan');
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
        Schema::dropIfExists('itinerary_template_details');
    }
}
