<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redis;

class CategoryController extends Controller
{
   public function category_list()
{
    $categories = Category::orderBy('id', 'desc')->get();
    
    return view('admin.category', ['categories' => $categories]);
}

    public function create(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
        $name=$request->category_name;
        Category::create([
            'category_name' => $name,
        ]);
        echo 1;
        

    }
    // delete category
    public function delete_category(Request $request)
    {
        $id= $request->input('id_delete_cat');
        Category::where('id', $id)->delete(); // soft delete;
        return redirect('/category')->with('success','Category Delete Successfully');
    }
    // update category
   public function update_category(Request $request){
        $id = $request->input('id_edit_cat');
        $name =$request->input('edit_name_category');
        $result=Category::where('id', $id)->update([
            'category_name' => $name,
        ]);
        if($result){
            return redirect('/category')->with('success','Category Edit successfully');
        }else{
            echo 0;
        }

            // session()->flash('success','Category Update Successfully ');
            // return redirect('/category');
            // dd($id);
        }
    
}
