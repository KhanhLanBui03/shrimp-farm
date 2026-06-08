<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialUsage extends Model
{
    protected $fillable = [
        'technical_log_id',
        'material_id',
        'quantity_used',
        'unit_price',
    ];

    public function technicalLog()
    {
        return $this->belongsTo(TechnicalLog::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
