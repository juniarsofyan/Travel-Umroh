<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    protected $table = 'maskapai';
    
    protected $fillable = ['kode_maskapai', 'nama', 'user_id'];
}
