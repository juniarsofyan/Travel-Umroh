<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketUmroh extends Model
{
    protected $table = 'paket_umroh';

    protected $fillable = [
        'nama_paket',
        'jumlah_hari', 
        'jumlah_orang', 
        'harga', 
        'deskripsi',
        'hotel_makkah', 
        'hotel_madinah', 
        'maskapai_id', 
        'user_id'
    ];

    public function maskapai()
    {
        return $this->belongsToMany(Maskapai::class, 'paket_umroh', 'maskapai_id');
    }
    
    public function hotelMakkah()
    {
        return $this->belongsToMany(Hotel::class, 'paket_umroh', 'hotel_makkah', 'hotel_makkah', 'id');
    }
    
    public function hotelMadinah()
    {
        return $this->belongsToMany(Hotel::class, 'paket_umroh', 'hotel_madinah', 'hotel_madinah', 'id');
    }
}
