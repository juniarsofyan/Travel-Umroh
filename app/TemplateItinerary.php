<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateItinerary extends Model
{
    protected $table = 'template_itinerary';

    protected $fillable = [
        'kode_template',
        'jumlah_hari',
        'user_id'
    ];

    public function detailTemplate()
    {
        return $this->hasMany(TemplateItineraryDetail::class);
    }
}
