<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_items extends Model
{
    protected $table = 'sale_items';

    protected $fillable = [
        'sale_id', 'product_id', 'quantity', 'price', 'subtotal'
    ];

    public function sale()
    {
        return $this->belongsTo(Sales::class,'sale_id','id');
    }

    
    public function product()
    {
        return $this->belongsTo(Products::class,'product_id','id');
    }
}
