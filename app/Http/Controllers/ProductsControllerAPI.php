<?php

namespace App\Http\Controllers;

use App\Models\Products;

class ProductsControllerAPI extends Controller
{
    public function products(){
        $result = Products::orderBy('id', 'desc')->get();
        return response()->json($result);
    }
}
