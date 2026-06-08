<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    protected $fillable = [
        'farming_zone_id',
        'code',
        'name',
        'mouth_diameter',
        'bottom_diameter',
        'border_exclusion',
        'area',
        'pond_type',
        'status',
    ];

    public function farmingZone()
    {
        return $this->belongsTo(FarmingZone::class);
    }

    public function cultivationCycles()
    {
        return $this->belongsToMany(CultivationCycle::class, 'cultivation_cycle_pond');
    }

    public function seedBatches()
    {
        return $this->hasMany(SeedBatch::class);
    }

    public function technicalLogs()
    {
        return $this->hasMany(TechnicalLog::class);
    }

    public function harvests()
    {
        return $this->hasMany(Harvest::class);
    }

    public function operatingExpenses()
    {
        return $this->morphMany(OperatingExpense::class, 'cost_center');
    }
}
