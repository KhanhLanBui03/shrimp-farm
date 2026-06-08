<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmingZone extends Model
{
    protected $fillable = [
        'code',
        'name',
        'total_area',
        'location',
        'status',
    ];

    public function ponds()
    {
        return $this->hasMany(Pond::class);
    }

    public function operatingExpenses()
    {
        return $this->morphMany(OperatingExpense::class, 'cost_center');
    }
}
