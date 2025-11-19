<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Invoices;
use App\Models\Products;
use App\Models\Sale_items;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sale_list(Request $request)
    {
        $customer_id = $request->input('filter');

        // Use singular model names (Sale, Customer, SaleItem, Product)
        // Make sure your models are named exactly like this

        $query = Sales::with(['customer', 'items.product']) // eager load customer and products via items
            ->orderBy('id', 'desc');

        if ($customer_id && $customer_id !== 'all') {
            $query->where('customer_id', $customer_id);
        }

        $sales = $query->paginate(10);
        $customers = Customers::all();
        $products = Products::all();

        // You do NOT need to load all items and products separately, they are loaded with sales above
        // Remove $items and $products from compact unless you actually need them separately

        return view('admin.sale', compact('sales', 'customers', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    // public function addsale(Request $request)
    // {
    //     $data = $request->validate([
    //         'customer_id' => 'required|exists:customers,id',  // Use existing customer id
    //         'sale_date' => 'required|date',
    //         'payment' => 'required', // adjust payment types as needed
    //         'status' => 'required|string', // adjust statuses as needed
    //         'items' => 'required|array|min:1',
    //         'items.*.product_id' => 'required|exists:products,id',
    //         'items.*.quantity' => 'required|integer|min:1',
    //         'items.*.price' => 'required|numeric|min:0',
    //     ]);

    //     // Calculate total amount
    //     $totalAmount = collect($data['items'])->sum(fn($item) => $item['quantity'] * $item['price']);
    //     $data['total_amount'] = $totalAmount;

    //     // call the model method
    //     $result = Sales::createWithItems($data);
    //     if ($result) {
    //         return redirect('/sale')->with('success', 'Sale add Successfully');
    //     } else {
    //         echo "error";
    //     }
    // }

    public function addSale(Request $request)
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

    try {
        DB::transaction(function () use ($data) {

            // 1. Check stock for each item
            foreach ($data['items'] as $item) {
                $product = Products::findOrFail($item['product_id']);
                if ($item['quantity'] > $product->stock) {
                    // Stop transaction and show friendly message
                    throw new \Exception("Stock of {$product->product_name} is only {$product->stock}");
                }
            }

            // 2. Calculate total amount
            $totalAmount = collect($data['items'])->sum(fn($item) => $item['quantity'] * $item['price']);
            $data['total_amount'] = $totalAmount;

            // 3. Create sale
            $sale = Sales::create([
                'customer_id' => $data['customer_id'],
                'sale_date' => $data['sale_date'],
                'payment' => $data['payment'],
                'status' => $data['status'],
                'total_amount' => $data['total_amount'],
            ]);

            // 4. Add sale items and reduce stock
            foreach ($data['items'] as $item) {
                $product = Products::findOrFail($item['product_id']);

                $saleItem = new Sale_items([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);
                $sale->items()->save($saleItem);

                // Reduce stock
                $product->decrement('stock', $item['quantity']);
            }

        }, 5); // retry 5 times if deadlock occurs

        return redirect('/sale')->with('success', 'Sale added successfully');

    } catch (\Exception $e) {
        // Friendly message for stock error
        return redirect()->back()->with('error', $e->getMessage())->withInput();
    }
}




    public function delete_sale(Request $request)
    {
        $id = $request->id;
        Sales::where('id', $id)->delete();
        return redirect('/sale')->with('success', 'Sale Delete Successfully');
    }


    public function print($id)
    {
        $sale = Sales::with(['customer', 'items.product'])->findOrFail($id);
        return view('admin.invoice', compact('sale')); // this will only be invoice layout
    }


public function editSale(Request $request)
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

    $sale = Sales::findOrFail($request->sale_id);
    $oldItems = $sale->items()->get()->keyBy('product_id'); // old items

    // 1. Check stock for each updated item
    foreach ($data['items'] as $item) {
        $product = Products::findOrFail($item['product_id']);

        $oldQty = $oldItems->has($item['product_id']) ? $oldItems[$item['product_id']]->quantity : 0;
        $newQty = $item['quantity'];

        $availableStock = $product->stock + $oldQty; // include oldQty

        if ($newQty > $availableStock) {
            // Friendly error message
            return redirect()->back()->with('error', "Stock of {$product->product_name} is have only  {$product->stock}");
        }
    }

    DB::transaction(function () use ($sale, $data, $oldItems) {

        // 2. Update main sale
        $totalAmount = collect($data['items'])->sum(fn($i) => $i['quantity'] * $i['price']);
        $sale->update([
            'customer_id' => $data['customer_id'],
            'sale_date' => $data['sale_date'],
            'payment' => $data['payment'],
            'status' => $data['status'],
            'total_amount' => $totalAmount,
        ]);

        // 3. Delete old items (do NOT restore stock for deleted items)
        $sale->items()->delete();

        // 4. Add new items and adjust stock
        foreach ($data['items'] as $item) {
            $product = Products::findOrFail($item['product_id']);
            $oldQty = $oldItems->has($item['product_id']) ? $oldItems[$item['product_id']]->quantity : 0;
            $newQty = $item['quantity'];

            // Adjust stock
            if ($newQty > $oldQty) {
                $diff = $newQty - $oldQty;
                $product->decrement('stock', $diff);
            } elseif ($newQty < $oldQty) {
                $diff = $oldQty - $newQty;
                $product->increment('stock', $diff);
            }

            // Save updated sale item
            $saleItem = new Sale_items([
                'product_id' => $item['product_id'],
                'quantity' => $newQty,
                'price' => $item['price'],
                'subtotal' => $newQty * $item['price'],
            ]);
            $sale->items()->save($saleItem);
        }

    }, 5);

    return redirect('/sale')->with('success', 'Sale updated successfully');
}


}
