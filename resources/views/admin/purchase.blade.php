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
            <h3 class="fw-bold mb-3">Purchase</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/purchese" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> View</a>
            <button id="addproduct"data-bs-toggle="modal" data-bs-target="#modal_addpurchase"
                class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Add Purchase</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">List View

                        </div>

                        <div class="card-tools">
                            <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                                <span class="btn-label">
                                    <i class="bi bi-file-earmark-spreadsheet"></i>
                                </span>
                                Export to Excel
                            </a>
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="purchase_table" class="display table table-striped table-hover w-100 text-nowrap ">
                            <thead class="text-center">
                                <tr>
                                    <th class="bg-primary text-light">ID</th>
                                    <th class="bg-primary text-light">Supplier Name</th>
                                    <th class="bg-primary text-light">Product Name</th>
                                    <th class="bg-primary text-light">IMAGE</th>
                                    <th class="bg-primary text-light">Payment</th>
                                    <th class="bg-primary text-light">Status</th>
                                    <th class="bg-primary text-light">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                        
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->suppliers->name ?? 'No Supplier' }}</td>
                                        <td>{{ $purchase->products->product_name ?? 'No prodcut' }}</td>
                                        <td>
                                            <img id="showimage" width="50px" height="50px"
                                                class="rounded-circle product_img"
                                                src="{{ $purchase->products->image ?? 'No img' }}">
                                        </td>

                                        <td>
                                            @if ($purchase->payment === 'paid')
                                                <span class="badge bg-success">{{ $purchase->payment }}</span>
                                            @else
                                                <span class="badge bg-danger">{{ $purchase->payment }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($purchase->status === 'Delivered')
                                                <span class="badge bg-success">{{ $purchase->status }}</span>
                                            @elseif ($purchase->status === 'Order placed')
                                                <span class="badge bg-danger">{{ $purchase->status }}</span>
                                            @else
                                                <span class="badge bg-secondary">{{ $purchase->status }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="form-groupd-flex gap-2">
                                                <button class="btn btn-info btn-sm" data-id="{{ $purchase->id }}"
                                                    data-supplier="{{ $purchase->suppliers->name }}"
                                                    data-product="{{ $purchase->products->product_name }}"
                                                    data-image="{{ $purchase->products->image }}"
                                                    data-qty="{{ $purchase->qty }}" data-price="{{ $purchase->price }}"
                                                    data-totalprice="{{ $purchase->total_price }}"
                                                    data-description="{{ $purchase->description }}"
                                                    data-status="{{ $purchase->status }}"
                                                    data-payment="{{ $purchase->payment }}"
                                                    data-date="{{ $purchase->purchase_date }}" id="view_purchas_detail"><i
                                                    class="bi bi-eye"></i></button>
                                                <button id="editpurchase" class="btn btn-warning btn-sm"
                                                    data-id="{{ $purchase->id }}"
                                                    data-supplier="{{ $purchase->supplier_id }}"
                                                    data-product="{{ $purchase->product_id }}"
                                                    data-qty="{{ $purchase->qty }}" data-price="{{ $purchase->price }}"
                                                    data-totalprice="{{ $purchase->total_price }}"
                                                    data-description="{{ $purchase->description }}"
                                                    data-status="{{ $purchase->status }}"
                                                    data-payment="{{ $purchase->payment }}"
                                                    data-date="{{ $purchase->purchase_date }}">
                                                    <i class="bi bi-pencil-square"></i> </button>
                                                <button class="btn btn-danger btn-sm" data-id="{{ $purchase->id }}"
                                                    name="btndelete" id="btndelete_purchase"><i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal addpurchase-->
    <div class="modal fade" id="modal_addpurchase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Purchase</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addpurchase" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="supplier_name">Supplier Name</label>
                                    <select class="form-select" name="supplier_id" id="supplier_id">
                                        <option selected disabled>Select Supplier </option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="products_name">Product Name</label>
                                    <select class="form-select" name="product_id" id="product_id">
                                        <option selected disabled>Select Product </option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" min="1" step="0.01"
                                        name="price" id="purchase_price" require>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" class="form-control" min="1" name="qty"
                                        id="purchase_qty" require>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="total_price">Total Amount</label>
                                    <input type="number" readonly class="form-control" name="total_price"
                                        id="total">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option selected disabled>Select Status</option>
                                        <option value="Order Placed">Order Placed</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="status">Payment</label>
                                    <select class="form-select" name="payment" id="payment">
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="date">Purchase Date</label>
                                    <input type="date" style="cursor: pointer;" class="form-control "
                                        name="purchase_date" id="purchase_date" require>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" rows="4" cols="50" class="form-control"
                                placeholder="Enter Description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" id="reset"><i
                                class="bi bi-arrow-clockwise"></i> Reset</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy-fill"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal edit-->
    <div class="modal fade" id="modal_editpurchase" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Purchase</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/update_purchase" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="purchase_id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="supplier_id">Supplire Name</label>
                                    <select class="form-select" name="supplier_id" id="edit_purchase_supplier" required>
                                        <option selected disabled>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <select class="form-select" name="product_id" id="edit_products_id">
                                        <option selected disabled>Select Product </option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" step="0.01" name="price"
                                        id="price" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Qty</label>
                                    <input type="number" class="form-control" name="qty" id="qty" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Total Amount</label>
                                    <input type="number" readonly class="form-control" name="total_price"
                                        id="total_price">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-select" name="status" id="edit_status" required>
                                        <option selected disabled>Select Status</option>
                                        <option value="Order Placed">Order Placed</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="status">Payment</label>
                                    <select class="form-select" name="payment" id="edit_purchase_payment">
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="date">Purchase Date</label>
                                    <input type="date" style="cursor: pointer;" class="form-control "
                                        name="purchase_date" id="edit_purchase_date"required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="edit_description" name="description" rows="4" cols="50" class="form-control"
                                placeholder="Enter Description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger"><i class="bi bi-x-lg"></i>
                            Cancel</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy-fill"></i> Save
                            Change</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="modal_deletepurchase" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title_deleteproduct">Are You Sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/delete_purchase" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" name="id" id="id_delete_purchase">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal view -->
    <div class="modal fade" id="modal_viewpurchase_detail" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title_deleteproduct">Purchse View Detail </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <h5 >ID: <b id="view_id"></b></h5>
                    <h5 > Supplier: <b id="view_supplier_name"></b></h5>
                    <h5 > Product: <b id="view_product_name"></b></h5>
                    <h5 >Price: <b id="view_price"></b></h5>
                    <h5 >Quantities: <b id="view_qty"></b></h5>
                    <h5 >Total Price: <b id="view_total"></b></h5>
                    <h5 >Payment: <b id="view_payment"></b></h5>
                    <h5 >Status: <b id="view_status"></b></h5>
                    <h5> Purchase Date: <b id="view_date"></b></h5>
                    <h5 >Description: <b id="view_description"></b></h5>
                    <img src="" alt="" id="view_image_detail"
                        style="max-width: 200px; display: none;margin-top: 10px;">
                </div>

            </div>
        </div>
    </div>

    <!-- modal show img -->
    <div class="modal fade" id="modal_show_imageProduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="text-center w-100 h-0" src="" alt="img" id="show_img_product">
                </div>
            </div>
        </div>
    </div>
@endsection
