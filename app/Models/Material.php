<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'type',
        'brand',
        'pellet_size',
        'unit',
        'stock_quantity',
        'unit_price',
        'expiration_date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function technicalLogs()
    {
        return $this->belongsToMany(TechnicalLog::class, 'material_usages')
            ->withPivot('quantity_used', 'unit_price')
            ->withTimestamps();
    }

    public function materialUsages()
    {
        return $this->hasMany(MaterialUsage::class);
    }
}
