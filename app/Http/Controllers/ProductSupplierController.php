<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductSupplierController extends Controller
{
    public function index(){
        $products = Products::with('suppliers')->get();
        return view('admin.product_supplier', compact('products'));
    }
}
