<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryTemplateDetail extends Model
{
    protected $fillable = ['itinerary_templates_id', 'hari_ke', 'kegiatan', 'keterangan', 'tipe', 'estimasi'];

    public function masterTemplate()
    {
        return $this->belongsTo(ItineraryTemplate::class);
    }
}
