@extends('admin.master')
@section('contents')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @if (session('success'))
        <script>
            // notification
            $(document).ready(function() {

                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000",
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success("{{ session('success') }}");
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            // notification
            $(document).ready(function() {

                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000",
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Sale</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/sale" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> View</a>
            <button id="addproduct" data-bs-toggle="modal" data-bs-target="#modal_addsale"
                class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Add Sale</button>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">List View

                        </div>

                        <div class="card-tools d-flex justify-content-end">
                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                <span class="btn-label">
                                    <i class="bi bi-file-earmark-spreadsheet"></i>
                                </span>
                                Export to Excel
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Filter
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <form action="/sale" method="get">
                                        <button type="submit" class="dropdown-item" name="filer">All</button>
                                        @foreach ($customers as $customer)
                                            <button type="submit" class="dropdown-item" name="filter"
                                                value="{{ $customer->id }}">{{ $customer->customer_name }}</button>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sale_table" class="display table table-striped table-hover w-100 text-nowrap ">
                            <thead class="text-center bg-primary text-white">
                                <tr class="table-primary">
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Sale Date</th>
                                    <th>Total Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Actions</th> <!-- Optional for Edit/Delete -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->customer->customer_name }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>${{ number_format($sale->total_amount, 2) }}</td>
                                        <td>
                                            <span
                                                class="badge 
                                                {{ $sale->payment == 'cash' ? 'bg-success' : ($sale->payment == 'credit card' ? 'bg-primary' : 'bg-secondary') }}">
                                                {{ ucfirst($sale->payment) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                class="badge 
                                                {{ $sale->status == 'paid' ? 'bg-success' : ($sale->status == 'unpaid' ? 'bg-danger' : 'bg-secondary') }}">
                                                {{ ucfirst($sale->status) }}
                                            </span>
                                        </td>
                                        {{-- <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($sale->items as $item)
                                                    <li>{{ $item->product->name }} (x{{ $item->quantity }})</li>
                                                @endforeach
                                            </ul>
                                        </td> --}}
                                        <td>
                                            <div class="form-group d-flex justify-content-center gap-2">
                                                {{-- <a href="{{ route('sales.invoice', $sale->id) }}" target="_blank"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-receipt-cutoff"></i>
                                                </a> --}}
                                                <button class="btn btn-primary btn-sm btn-invoice"
                                                    data-id="{{ $sale->id }}">
                                                    <i class="bi bi-receipt-cutoff"></i>
                                                </button>

                                                <button class="btn btn-warning btn-sm btn-edit-sale     "
                                                    data-bs-toggle="modal" data-bs-target="#modal_editsale"
                                                    data-id="{{ $sale->id }}" data-customer="{{ $sale->customer_id }}"
                                                    data-payment="{{ $sale->payment }}" data-status="{{ $sale->status }}"
                                                    data-date="{{ $sale->sale_date }}"
                                                    data-items='@json($sale->items)'>
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-danger  btn-sm" data-id="{{ $sale->id }}"
                                                    id="delete_sale"><i class="bi bi-trash3"></i> </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <button onclick="window.print()">Print Sale</button> --}}

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $sales->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_addsale" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Sale</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addsale" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Customer Selection -->
                            <div class="col-lg-6 col-12">
                                <label for="customer_id" class="form-label fw-bold">Customer Name</label>
                                <select class="form-select" name="customer_id" id="customer_id">
                                    <option selected disabled>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Payment Type -->
                            <div class="col-lg-6 col-12">
                                <label for="payment" class="form-label fw-bold">Payment Type</label>
                                <select class="form-select" name="payment">
                                    <option selected disabled>Select Type of Payment</option>
                                    <option value="cash">Cash</option>
                                    <option value="credit card">Credit Card</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="col-lg-6 col-12">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select class="form-select" name="status">
                                    <option value="" selected disabled>Select Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>

                            <!-- Sale Date -->
                            <div class="col-lg-6 col-12">
                                <label for="sale_date" class="form-label fw-bold">Sale Date</label>
                                <input type="date" class="form-control" name="sale_date" id="sale_date">
                            </div>


                            <!-- Products Section -->
                            <div class="col-12">
                                <div class="row g-3 align-items-end  rounded">
                                    <div class="col-md-6 col-sm-12">
                                        <label for="product_id" class="form-label">Product</label>
                                        <select id="product_id" class="form-select">
                                            <option value="">Select Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                    {{ $product->product_name }} |
                                                    ${{ number_format($product->price, 2) }}
                                                     |Stock have {{ $product->stock }} |
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" id="quantity" class="form-control" value="1"
                                            min="1">
                                    </div>

                                    <div class="col-md-3 col-sm-6 text-md-start text-sm-start">
                                        <button type="button" id="addProductBtn" class="btn btn-primary ">
                                            <i class="bi bi-plus-circle me-1"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Table -->
                            <div class="col-12 mt-3">
                                <div class="table-responsive  rounded">
                                    <table class="table table-bordered align-middle" id="productsTable">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-end">Subtotal</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- dynamically added rows -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Total Amount -->
                            <div class="col-12 text-end fw-bold fs-5 mt-2">
                                Total: $<span id="totalAmount">0.00</span>
                            </div>


                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" id="reset">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button type="submit" name="btnsavesale" class="btn btn-primary">
                            <i class="bi bi-floppy-fill"></i> Save
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- Modal edit-->
    <div class="modal fade" id="modal_editsale" tabindex="-1" aria-labelledby="editSaleLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit Sale</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSaleForm" action="{{route('sale.edit')}}" method="POST">
                    @csrf
                    <input type="hidden" name="sale_id" id="edit_sale_id">

                    <div class="modal-body">
                        <div class="row g-3">

                            <!-- Customer -->
                            <div class="col-lg-6 col-12">
                                <label class="form-label fw-bold">Customer</label>
                                <select class="form-select" name="customer_id" id="edit_customer_id">
                                    <option disabled>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Payment -->
                            <div class="col-lg-6 col-12">
                                <label class="form-label fw-bold">Payment Type</label>
                                <select class="form-select" name="payment" id="edit_payment">
                                    <option disabled>Select Payment</option>
                                    <option value="cash">Cash</option>
                                    <option value="credit card">Credit Card</option>
                                </select>
                            </div>

                            <!-- Status -->
                            <div class="col-lg-6 col-12">
                                <label class="form-label fw-bold">Status</label>
                                <select class="form-select" name="status" id="edit_status">
                                    <option disabled>Select Status</option>
                                    <option value="paid">Paid</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>

                            <!-- Sale Date -->
                            <div class="col-lg-6 col-12">
                                <label class="form-label fw-bold">Sale Date</label>
                                <input type="date" class="form-control" name="sale_date" id="edit_sale_date">
                            </div>

                            <!-- Product Add Section -->
                            <div class="col-12 mt-2">
                                <div class="row g-3 align-items-end rounded">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="form-label">Product</label>
                                        <select id="edit_product_id" class="form-select">
                                            <option value="">Select Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                    {{ $product->product_name }} |
                                                    ${{ number_format($product->price, 2) }}
                                                     |Stock have {{ $product->stock }} |
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" id="edit_quantity" class="form-control" value="1"
                                            min="1">
                                    </div>

                                    <div class="col-md-3 col-sm-6">
                                        <button type="button" id="editAddProductBtn" class="btn btn-primary">
                                            <i class="bi bi-plus-circle"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Table -->
                            <div class="col-12 mt-3">
                                <div class="table-responsive rounded">
                                    <table class="table table-bordered align-middle" id="editProductsTable">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-end">Price</th>
                                                <th class="text-end">Subtotal</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- filled dynamically -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="col-12 text-end fw-bold fs-5 mt-2">
                                Total: $<span id="edit_totalAmount">0.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal show img -->
    <div class="modal fade" id="modal_show_imageProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="text-center w-100 h-0" src="" alt="img" id="show_img">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete-->
    <div class="modal fade" id="modal_delete_sale" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Sale</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/delete_sale" method="POST">
                    @csrf

                    <input type="hidden" name="id" id="id_delete_sale">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="assets/js/core/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        $(".btn-invoice").on("click", function() {
            let saleId = $(this).data("id");

            $.get(`/sales/${saleId}/print`, function(data) {
                let printWindow = window.open('', '', 'width=900,height=650');
                printWindow.document.write(`
                <html>
                    <head>
                        <title>Invoice</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    </head>
                    <body onload="window.print(); window.close();">
                        ${data}
                    </body>
                </html>
            `);
                printWindow.document.close();
            });
        });
    });

    $(document).ready(function() {
        let editItems = [];

        // Function to update table and total
        function updateEditTable() {
            let $tbody = $('#editProductsTable tbody');
            $tbody.empty();
            let total = 0;

            $.each(editItems, function(index, item) {
                let subtotal = item.price * item.quantity;
                total += subtotal;

                let row = `
                <tr>
                    <td>
                        ${item.name}
                        <input type="hidden" name="items[${index}][product_id]" value="${item.product_id}">
                    </td>
                    <td>
                        <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
                        ${item.quantity}
                    </td>
                    <td>
                        <input type="hidden" name="items[${index}][price]" value="${item.price}">
                        $${item.price.toFixed(2)}
                    </td>
                    <td>$${subtotal.toFixed(2)}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm editRemoveBtn" data-index="${index}">Remove</button>
                    </td>
                </tr>
            `;
                $tbody.append(row);
            });

            $('#edit_totalAmount').text(total.toFixed(2));
        }





        // Open modal and load sale data
        $(document).on('click', '.btn-edit-sale', function() {
            let saleId = $(this).data('id');
            let customerId = $(this).data('customer');
            let payment = $(this).data('payment');
            let status = $(this).data('status');
            let saleDate = $(this).data('date');
            let items = $(this).data('items');

            $('#edit_sale_id').val(saleId);
            $('#edit_customer_id').val(customerId);
            $('#edit_payment').val(payment);
            $('#edit_status').val(status);
            $('#edit_sale_date').val(saleDate);

            // Map items to editable array
            editItems = items.map(item => {
                let productName = $('#edit_product_id option[value="' + item.product_id + '"]')
                    .text().split('|')[0].trim();
                return {
                    product_id: item.product_id,
                    name: productName,
                    price: parseFloat(item.price),
                    quantity: item.quantity
                };
            });



            updateEditTable();
        });

        // Add new product to table
        $('#editAddProductBtn').click(function() {
            let productId = $('#edit_product_id').val();
            let productName = $('#edit_product_id option:selected').text();
            let price = parseFloat($('#edit_product_id option:selected').data('price'));
            let quantity = parseInt($('#edit_quantity').val());

            if (!productId) {
                alert('Please select a product.');
                return;
            }

            // Check if product already exists in table
            let existingIndex = editItems.findIndex(item => item.product_id == productId);
            if (existingIndex !== -1) {
                editItems[existingIndex].quantity += quantity;
            } else {
                editItems.push({
                    product_id: productId,
                    name: productName.split('|')[0].trim(), // remove price from text
                    price: price,
                    quantity: quantity
                });
            }

            updateEditTable();

            // Reset select and quantity
            $('#edit_product_id').val('');
            $('#edit_quantity').val(1);
        });

        // Remove product from table
        $(document).on('click', '.editRemoveBtn', function() {
            let index = $(this).data('index');
            editItems.splice(index, 1);
            updateEditTable();
        });
    });
</script>
