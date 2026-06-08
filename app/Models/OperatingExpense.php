<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperatingExpense extends Model
{
    protected $fillable = [
        'date',
        'expense_type',
        'description',
        'amount',
        'cost_center_type',
        'cost_center_id',
        'allocation_method',
    ];

    public function costCenter()
    {
        return $this->morphTo();
    }
}
