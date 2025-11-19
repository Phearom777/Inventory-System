<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $table = 'purchases';

    protected $fillable = [
        'supplier_id',
        'product_id',
        'price',
        'qty',
        'total_price',
        'status',
        'purchase_date',
        'payment',
        'description',

    ];

    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id', 'id');
    }
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
