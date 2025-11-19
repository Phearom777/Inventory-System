<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Invoices;
use App\Models\Sales;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // InvoiceController.php
    
    public function invoiceList()
{
    // Get all invoices with related customer and their sales & products eager loaded
    $invoices = Invoices::with(['customer', 'sales.products'])->get();

    $sales = Sales::all();

    return view('admin.invoice.list', compact('invoices',  'sales'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices $invoices)
    {
        //
    }
}
