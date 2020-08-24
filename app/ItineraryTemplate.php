<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryTemplate extends Model
{
    protected $fillable = ['kode_template', 'jumlah_hari'];

    public function detailTemplate()
    {
        return $this->hasMany(ItineraryTemplateDetail::class);
    }
}
