<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketUmroh extends Model
{
    protected $table = 'paket_umroh';

    protected $fillable = [
        'nama_paket',
        'tanggal',
        'jumlah_hari', 
        'jumlah_orang', 
        'harga', 
        'deskripsi',
        'hotel_makkah', 
        'hotel_madinah', 
        'maskapai_id', 
        'jenis_kamar_id', 
        'user_id'
    ];
}
