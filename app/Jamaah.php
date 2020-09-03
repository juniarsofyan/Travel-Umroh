<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    protected $table = 'jamaah';

    protected $fillable = ['nama', 'tanggal_lahir', 'jenis_kelamin', 'telepon', 'email', 'alamat', 'user_id'];    
}
