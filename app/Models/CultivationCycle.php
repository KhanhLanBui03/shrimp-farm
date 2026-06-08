<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultivationCycle extends Model
{
    protected $fillable = [
        'code',
        'name',
        'start_date',
        'expected_end_date',
        'status',
    ];

    public function ponds()
    {
        return $this->belongsToMany(Pond::class, 'cultivation_cycle_pond');
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
