<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateItineraryDetail extends Model
{
    protected $table = 'template_itinerary_detail';

    protected $fillable = [
        'template_itinerary_id', 
        'hari_ke', 
        'kegiatan', 
        'keterangan', 
        'tipe', 
        'estimasi'
    ];

    public function masterTemplate()
    {
        return $this->belongsTo(TemplateItinerary::class);
    }
}
