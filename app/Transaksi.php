<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal_transaksi', 
        'jamaah_id', 
        'paket_umroh_id', 
        'jenis_kamar_id', 
        'jadwal_penerbangan_id', 
        'template_itinerary_id', 
        'deskripsi', 
        'status_transaksi', 
        'user_id', 
    ];

    public function itinerary()
    {
        return $this->hasMany(ItineraryPaketUmroh::class);
    }

    public function paketUmroh()
    {
        // almost correct
        // return $this->belongsToMany(PaketUmroh::class, 'transaksi', 'paket_umroh_id', 'paket_umroh_id', 'id');
    }

    public function jenisKamar()
    {
        return $this->belongsToMany(JenisKamar::class);
    }

    public function jadwalPenerbangan()
    {
        return $this->belongsToMany(JadwalPenerbangan::class);
    }

    public function templateItinerary()
    {
        return $this->belongsToMany(TemplateItinerary::class);
    }
}
