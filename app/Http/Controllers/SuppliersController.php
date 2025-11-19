<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function supplier_list()
    {
        $suppliers = Suppliers::orderBy('id', 'desc')->paginate(10);
        return view('admin.supplier',compact('suppliers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function addsupplier(Request $request)
    {
        $data=$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);
        

        Suppliers::create($data);

        return redirect('/supplier')->with('success', 'Supplier added successfully');
    }

    public function delete_supplier(Request $request){
        $id= $request->input('id_delete_supplier');
        Suppliers::where('id', $id)->delete();
        return redirect('/supplier')->with('success','Supplier Delete Successfully');
    }

    
     public function update_supplier(Request $request){
        // // if (Suppliers::where('email',  $email)->exists()) {
        // //     return redirect('/supplier')->with('error','Email already exists. Try again')->withInput();
        // // }

        $data=$request->validate([
            'edit_name_supplier' => 'required|string|max:255',
            'edit_supplier_email' => 'required|email',
            'edit_phone' => 'required|string|max:20',
            'edit_supplier_address' => 'required|string|max:20',
        ]);
        // dd($data);
        $id=$request->input('id_edit_supplier');
        $result = Suppliers::where('id', $id)->update([
        'name' => $data['edit_name_supplier'],
        'email' => $data['edit_supplier_email'],
        'phone' => $data['edit_phone'],
        'address' => $data['edit_supplier_address'],
    ]);
        if($result){
            return redirect('/supplier')->with('success','Supplier Update Successfully');
        }else{
            echo'error';
        }
    }
}
