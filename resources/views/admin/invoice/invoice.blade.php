@extends('admin.master')
@section('contents')


<div id="invoice-content" class="bg-white shadow-sm">
    <div class="mb-4">
        <h2>Invoice: <strong>INV0001</strong></h2>
        <p><strong>Date:</strong> 2025-08-08</p>
        <p><strong>Customer:</strong> John Doe</p>
    </div>

    <table class="table  ">
        <thead class="table-primary">
            <tr>
                <th style="width:5%;">#</th>
                <th style="width:50%;">Product</th>
                <th style="width:15%;">Price</th>
                <th style="width:10%;">Qty</th>
                <th style="width:20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Laptop</td>
                <td>$1200.00</td>
                <td>1</td>
                <td>$1200.00</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Mouse</td>
                <td>$25.00</td>
                <td>2</td>
                <td>$50.00</td>
            </tr>
            <tr>
                <td colspan="4" class="text-end fw-bold fs-5">Total:</td>
                <td class="fw-bold fs-5">$1250.00</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-4">
        <p><strong>Payment Status:</strong> Paid</p>
        <p><strong>Payment Method:</strong> Credit Card</p>
    </div>

    <button id="print-button" onclick="window.print()" class="btn btn-primary mt-3">Print Invoice</button>
</div>

@endsection
