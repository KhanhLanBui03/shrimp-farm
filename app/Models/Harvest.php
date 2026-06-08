<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    protected $fillable = [
        'cultivation_cycle_id',
        'pond_id',
        'harvest_date',
        'doc',
        'harvest_type',
        'shrimp_condition',
        'weight',
        'quantity',
        'size_range',
        'unit_price',
        'total_amount',
        'net_rental_fee',
        'net_amount',
    ];

    public function cultivationCycle()
    {
        return $this->belongsTo(CultivationCycle::class);
    }

    public function pond()
    {
        return $this->belongsTo(Pond::class);
    }

    public function salesInvoices()
    {
        return $this->hasMany(SalesInvoice::class);
    }
}
