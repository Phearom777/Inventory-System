<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_name',
        'price',
        'stock',
        'description',
        'status',
        'image'
    ];

      protected static function booted()
    {
        static::saving(function ($product) {
            if ($product->stock > 5) {
                $product->status = 'In Stock';
            } elseif ($product->stock > 0) {
                $product->status = 'Low Stock';
            } else {
                $product->status = 'Out of Stock';
            }
        });
    }
     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

     public function saleItems()
    {
        return $this->hasMany(Sale_items::class);
    }
    public function purchases()
{
    return $this->hasMany(Purchases::class);
}
     public function suppliers()
    {
        return $this->belongsToMany(
            Suppliers::class,      // related model
            'product_supplier', // custom pivot table name
            'product_id',         // foreign key on pivot table for this model
            'supplier_id'         // foreign key on pivot table for related model
        );
    }
     public function increaseStock($amount)
    {
        $this->stock += $amount;
        $this->save();
    }
     public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->purchases()->delete();
            $product->suppliers()->detach();
        });
    }

}
