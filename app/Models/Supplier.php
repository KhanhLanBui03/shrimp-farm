<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'bank_account',
        'supply_type',
        'debt',
    ];

    public function seedBatches()
    {
        return $this->hasMany(SeedBatch::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
