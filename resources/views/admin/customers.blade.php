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
            <h3 class="fw-bold mb-3">Customer</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/customer" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> View</a>
            <button id="addcustomer" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Add Customer</button>
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
                    <div class="table-responsive ">
                        <table id="customer_table" class="display table table-striped table-hover w-100 text-nowrap ">
                            <thead class="text-center">
                                <tr>

                                    <th class="bg-primary text-light">ID</th>
                                    <th class="bg-primary text-light">Name</th>
                                    <th class="bg-primary text-light">Phone</th>
                                    <th class="bg-primary text-light">Email</th>
                                    <th class="bg-primary text-light">Address</th>
                                    <th class="bg-primary text-light">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->customer_name }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->address }}</td>

                                        <td>
                                            <div class="form-group d-flex justify-content-center gap-2">
                                                <button class="btn btn-primary  btn-sm" data-id="{{ $customer->id }}"
                                                    id="invoice"><i class="bi bi-receipt-cutoff"></i> </button>
                                                <button id="edit_customer"
                                                   data-id="{{ $customer->id }}"
                                                    data-name="{{ $customer->customer_name }}"
                                                    data-phone="{{ $customer->phone_number }}" 
                                                    data-email="{{ $customer->email }}"
                                                    data-address="{{ $customer->address }}"
                                                    class="btn btn-warning   btn-sm"><i class="bi bi-pencil-square"></i>
                                                    </button>
                                                <button class="btn btn-danger  btn-sm" data-id="{{ $customer->id }}"
                                                    id="delete_customer"><i class="bi bi-trash3"></i> </button>
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
    <!-- Modal -->
    <div class="modal fade" id="modal_addcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <form method="POST" action="/addcustomer">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="customer_name">Name</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name">
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Phone</label>
                            <input type="text" class="form-control" name="phone_number" id="customer_phone_number">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="customer_email">
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Address</label>
                            <textarea id="customer_address" name="address" rows="4" cols="50" class="form-control"
                                placeholder="Enter address..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" id="reset"><i class="bi bi-arrow-clockwise"></i>
                            Reset</button>
                        <button type="submit" class="btn btn-primary" id="btnsavecustomer" name="btnsavecustomer"> <i
                                class="bi bi-floppy-fill"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edit-->
    <div class="modal fade" id="modal_editcustomer" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updatecustomer" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="customer_name" id="edit_name_customer"
                                >
                            <input type="text" name="id" id="id_edit_customer" hidden>
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Phone</label>
                            <input type="text" class="form-control" name="phone_number" id="edit_phone_number"
                                >
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                                id="edit_customer_email" >
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Address</label>
                            <textarea id="edit_customer_address" name="address" rows="4" cols="50" class="form-control"
                                placeholder="Enter address..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>
                            Cancel</button>
                        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy-fill"></i> Save
                            Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal delete-->
    <div class="modal fade" id="modal_deletecustomer" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title_delete">Are you Sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deletecustomer" method="POST">
                    @csrf

                    <input type="hidden" name="id" id="id_delete_customer">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="btndelete_customer">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
