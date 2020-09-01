<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPenerbangan extends Model
{
    protected $table = 'jadwal_penerbangan';

    protected $fillable = [
        'tanggal',
        'nomor_pesawat',
        'bandara_takeoff',
        'bandara_landing',
        'waktu_takeoff',
        'waktu_landing',
        'maskapai_id',
        'user_id'
    ];

    public function maskapai()
    {
        return $this->belongsTo(Maskapai::class);
    }
}
