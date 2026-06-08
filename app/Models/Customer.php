<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'bank_account',
        'debt',
    ];

    public function salesInvoices()
    {
        return $this->hasMany(SalesInvoice::class);
    }
}
