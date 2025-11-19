<div id="invoice-content">
    <h2 class="text-center">Invoice</h2>
    <hr>
    <p><strong>Customer:</strong> {{ $sale->customer->customer_name }}</p>
    <p><strong>Phone:</strong> {{ $sale->customer->phone_number }}</p>
    <p><strong>Address:</strong> {{ $sale->customer->address }}</p>
    <p><strong>Date:</strong> {{ $sale->sale_date }}</p>
    <p><strong>Status:</strong> {{ ucfirst($sale->status) }}</p>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->product->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->product->price, 2) }}</td>
                    <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <h4 class="text-end">Total: ${{ number_format($sale->total_amount, 2) }}</h4>
</div>


