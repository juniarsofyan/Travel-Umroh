<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryPaketUmroh extends Model
{
    protected $table = 'itinerary_paket_umroh';

    protected $fillable = [
        'hari_ke', 
        'kegiatan', 
        'keterangan', 
        'waktu', 
        'paket_umroh_id', 
        'user_id'
    ];
}
