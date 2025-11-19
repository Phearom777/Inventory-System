<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Suppliers;

class ProductsController extends Controller
{
    
    public function product_list(Request $request)
    {
        $categories = Category::all();
        $suppliers = Suppliers::all();

        $category_id = $request->input('filter');

            if($category_id && $category_id != 'all') {
                 $products = Products::with('category')
                    ->where('category_id', $category_id)
                    ->orderBy('id', 'desc')
                    ->paginate(5)
                    ->appends(['filter' => $category_id]); // keep filter in pagination links
            } else {
                $products = Products::query()
                ->with('category')
                ->orderBy('products.id', 'desc')
                ->paginate(5);
            }
        
        return view('admin.products', compact('products', 'categories','suppliers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_product(Request $request)
    {
        $data=$request->validate([
            'category_id' => 'required', // or 'integer' if you want only a numeric check
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer',
            'description' => 'nullable|string', // you can increase the max limit here if needed
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'suppliers' => 'required|array',
        ]);
        if ($request->hasFile('image')) {
            $filename = date('y-m-d_H-i-s') . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/product'), $filename);
            $data['image'] = url('uploads/product/' . $filename);
        }      
        $result=Products::create( $data );
        
        if( $result ) {
            $result->suppliers()->attach($data['suppliers']);
            return redirect('/product')->with('success','Product ADD Successfully');
        }else{
            echo 'error';
        }

        
    }

    public function delete_product(Request $request)
    {
        $id= $request->input('id_delete_product');
        Products::where('id',$id)->delete();
        return redirect('/product')->with('success','Product Delete Successfully');
    }
    
    public function edit_product($id)
    {
        $product = Products::where('id', $id)->first();
        return view('admin.products', compact('product'));
    }
    public function update_product(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|integer',
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'suppliers' => 'required|array',
        ]);
        $id = $request->id;

        $product = Products::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found.'], 404);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $filename = date('Ymd_His') . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/product'), $filename);
            $data['image'] = url('uploads/product/' . $filename);
        }

        $product->update($data);

        // Sync suppliers
        $product->suppliers()->sync($request->suppliers);

        // Optional response
        return redirect('/product')->with('success', 'Product updated successfully.');
    }




    
}

