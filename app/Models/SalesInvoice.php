<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'harvest_id',
        'invoice_date',
        'total_amount',
        'paid_amount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function harvest()
    {
        return $this->belongsTo(Harvest::class);
    }
}
