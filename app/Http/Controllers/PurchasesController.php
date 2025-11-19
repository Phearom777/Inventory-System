<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Purchases;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function purchase_list()
    {
        $purchases = Purchases::with('suppliers')
        ->orderBy('id', 'desc') // Sort descending by ID
        ->get();
        $products = Products::orderBy('id', 'desc')->get();
        $suppliers = Suppliers::orderBy('id', 'desc')->get();

        return view('admin.purchase', compact('purchases', 'suppliers','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addpurchase(Request $request)
    {
        $data=$request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'purchase_date' => 'required|date',
            'payment' => 'required|string|max:50',
            'description' => 'nullable',
        ]);
        Purchases::create($data);
        return redirect()->back()->with('success', 'Purchase added successfully');

    }
    public function delete_purchase(Request $request){
        $id= $request->id;
        Purchases::where('id', $id)->delete();
        return redirect('/purchese')->with('success','Purchase Delete Successfully');
    }
    public function update_purchase(Request $request)
    {
        $data=$request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:0',
            'qty' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'purchase_date' => 'required|date',
            'payment' => 'required|string|max:50',
            'description' => 'nullable',
        ]);
        $id=$request->id;
       $purchase = Purchases::find($id);
       
        if ($data['status'] === 'Delivered' && $purchase->status !== 'Delivered') {
            $product = Products::find($data['product_id']);
            if ($product) {
                $product->increaseStock($data['qty']);
            }
        }
       $purchase->update($data);
       return redirect('/purchese')->with('success','Purchase updated successfully');

   
    }


}