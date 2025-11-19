<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Invoices;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function customer_list()
    {
        $customers = Customers::orderBy('id', 'desc')->get();
        return view('admin.customers',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addcustomer(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required',
            'email' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Create the customer
        $customer = Customers::create($data);

        // Generate invoice number
        $lastInvoice = Invoices::latest()->first();
        $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;
        $invoiceNumber = 'INV-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Create invoice for the new customer
        Invoices::create([
            'customer_id' => $customer->id,
            'invoice_number' => $invoiceNumber,
            'total_amount' => 0,
        ]);

        return redirect('/customer')->with('success', 'Customer and invoice added successfully');
    }


    // delete customer
    public function delete_customer(Request $request){
        $id= $request->id;
        Customers::where('id',operator: $id)->delete();
        return redirect('/customer')->with('success','Customer Delete Successfully');
    }

    // update customer
    public function update_customer(Request $request){
       $data=$request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required',
            'email' => 'required|string|max:20',
            'address' => 'required|string|max:20',
        ]);
        $id= $request->id;
        Customers::where('id', $id)->update($data);
        return redirect('/customer')->with('success','Customer Update Successfully');
        
    }

}