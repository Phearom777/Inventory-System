<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use SoftDeletes;

   public function purchases()
    {
        return $this->hasMany(Purchases::class);
    }
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
    public function products()
{
    return $this->belongsToMany(
        Products::class,
        'product_supplier',  // same pivot table
        'supplier_id',
        'product_id'
    );
}


}

