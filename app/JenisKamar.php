<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisKamar extends Model
{
    protected $table = 'jenis_kamar';

    protected $fillable = [
        'nama', 
        'jumlah_orang', 
        'jumlah_kasur', 
        'user_id'
    ];
}
