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
        'tanggal_mulai', 
        'jam_mulai', 
        'tanggal_selesai', 
        'jam_selesai', 
        'paket_umroh_id'
    ];
}
