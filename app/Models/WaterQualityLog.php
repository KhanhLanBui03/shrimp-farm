<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterQualityLog extends Model
{
    protected $fillable = [
        'date',
        'time',
        'sampling_location',
        'salinity',
        'ph',
        'transparency',
        'tidal_peak',
        'water_level',
    ];
}
