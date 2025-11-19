<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
   protected $table = 'invoices';

protected $fillable = [
    'customer_id',
    'invoice_number',
    'note',
    'total_amount',
    'payment',
];

public function customer()
{
    return $this->belongsTo(Customers::class, 'customer_id', 'id');
}

public function sales()
{
    return $this->hasMany(Sales::class, 'invoice_id', 'id');
}

}
