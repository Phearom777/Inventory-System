<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    
    // Define the inverse relationship (one category has many products)
    public function products()
    {
        return $this->hasMany(Products::class);
    }
    protected $table ='categories';
    protected $fillable = ['category_name'];

}
