<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedBatch extends Model
{
    protected $fillable = [
        'cultivation_cycle_id',
        'pond_id',
        'supplier_id',
        'lot_number',
        'quantity',
        'stocking_date',
        'stocking_density',
        'seed_type',
    ];

    public function cultivationCycle()
    {
        return $this->belongsTo(CultivationCycle::class);
    }

    public function pond()
    {
        return $this->belongsTo(Pond::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
