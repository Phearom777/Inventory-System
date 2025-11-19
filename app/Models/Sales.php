<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB; // ✅ Needed for transaction
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use SoftDeletes;
    protected $table = 'sales';

    protected $fillable = [
        'customer_id',
        'invoice_id',
        'payment',
        'status',
        'total_amount',
        'sale_date',

    ];
     // Automatically generate invoice number when creating
   

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
    public function items()
    {
        return $this->hasMany(Sale_items::class,'sale_id','id');
    }

    public function invoices()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id', 'id');
    }
    public static function createWithItems(array $data){
        return DB::transaction(function() use ($data){
            $sale=self::create([
               'customer_id' => $data['customer_id'],
                'sale_date'=>$data['sale_date'],
                'payment'=>$data['payment'],
                'status'=>$data['status'],
                'total_amount'=>$data['total_amount'],
            ]);
            $items=collect($data['items'])->map(fn($item)=> new Sale_items([
                'product_id' =>$item['product_id'],
                'quantity' =>$item['quantity'],
                'price' =>$item['price'],
                'subtotal' =>$item['quantity'] * $item['price'],
            ]));
            $sale->items()->saveMany($items);
            return $sale;
        });
    }


public function editSale(Request $request, $id)
{
    $data = $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'sale_date' => 'required|date',
        'payment' => 'required',
        'status' => 'required|string',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0',
    ]);

    // Calculate total amount
    $totalAmount = collect($data['items'])->sum(fn($item) => $item['quantity'] * $item['price']);
    $data['total_amount'] = $totalAmount;

    $sale = Sales::findOrFail($id);

    DB::transaction(function() use ($sale, $data) {
        // Update main sale
        $sale->update([
            'customer_id' => $data['customer_id'],
            'sale_date' => $data['sale_date'],
            'payment' => $data['payment'],
            'status' => $data['status'],
            'total_amount' => $data['total_amount'],
        ]);

        // Delete old items and add new ones
        $sale->items()->delete();
        $items = collect($data['items'])->map(fn($item) => new Sale_items([
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'subtotal' => $item['quantity'] * $item['price'],
        ]));
        $sale->items()->saveMany($items);
    });

    return redirect('/sale')->with('success', 'Sale updated successfully');
}


public function products()
{
    return $this->belongsToMany(Products::class, 'sale_items', 'sale_id', 'product_id')
                ->withPivot('quantity', 'price', 'subtotal')
                ->withTimestamps();
}


}
