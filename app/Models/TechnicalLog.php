<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalLog extends Model
{
    protected $fillable = [
        'cultivation_cycle_id',
        'pond_id',
        'date',
        'doc',
        'water_level',
        'ph',
        'feed_amount',
        'siphon_amount',
        'shrimp_size',
        'adg',
        'fcr',
        'mortality',
        'transfer_log',
        'notes',
    ];

    public function cultivationCycle()
    {
        return $this->belongsTo(CultivationCycle::class);
    }

    public function pond()
    {
        return $this->belongsTo(Pond::class);
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'material_usages')
            ->withPivot('quantity_used', 'unit_price')
            ->withTimestamps();
    }

    public function materialUsages()
    {
        return $this->hasMany(MaterialUsage::class);
    }
}
