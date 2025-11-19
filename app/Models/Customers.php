<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    // app/Models/Customers.php
protected $fillable = [
    'customer_name',
    'phone_number',
    'email',
    'address',
];
    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoices::class);
    }   




}
