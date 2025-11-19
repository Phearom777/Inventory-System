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
            <h3 class="fw-bold mb-3">Supplier</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/supplier" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> View</a>
            <button type="button" class="btn btn-primary btn-round" data-bs-toggle="modal"
                data-bs-target="#modal_addsupplier"><i class="fa fa-plus"></i> Add Supplire</button>
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

                        <table id="supplier_table"
                            class=" table table-striped text-center align-middle  table-hover text-nowrap  ">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-light">ID</th>
                                    <th class="bg-primary text-light">Name</th>
                                    <th class="bg-primary text-light">Phone</th>
                                    <th class="bg-primary text-light">Email</th>
                                    <th class="bg-primary text-light">Address</th>
                                    <th class="bg-primary text-light">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                               

                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->phone }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->address }}</td>
                                        <td>
                                            <div class="form-group d-flex justify-content-center gap-2">
                                                <button id="edit_supplier" class="btn btn-warning   btn-sm"><i
                                                        class="bi bi-pencil-square"></i> Edit</button>
                                                <button class="btn btn-danger  btn-sm" name="delete_supplier"
                                                    id="delete_supplier"><i class="bi bi-trash3"></i> Delete</button>
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
    <div class="modal fade" id="modal_addsupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Supplier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/addsupplier" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" rows="4" cols="50" class="form-control"
                                placeholder="Enter address..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" id="reset"><i class="bi bi-arrow-clockwise"></i>
                            Reset</button>
                        <button type="submit" class="btn btn-primary" id="btnsavecustomer" name="btnsavesupplier"> <i
                                class="bi bi-floppy-fill"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal edit-->
    <div class="modal fade" id="modal_editsupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/updatesupplier" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="edit_name_supplier" id="edit_name_supplier"
                                require>
                            <input type="hidden" name="id_edit_supplier" id="id_edit_supplier">
                        </div>
                        <div class="form-group">
                            <label for="edit_phone">Phone</label>
                            <input type="text" class="form-control" name="edit_phone" id="edit_phone" require>
                        </div>
                        <div class="form-group">
                            <label for="edit_supplier_email">Email</label>
                            <input type="email" class="form-control" name="edit_supplier_email"
                                id="edit_supplier_email" require>
                        </div>
                        <div class="form-group">
                            <label for="edit_supplier_address">Address</label>
                            <input type="text" class="form-control" name="edit_supplier_address"
                                id="edit_supplier_address" require>
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
    <div class="modal fade" id="modal_deletesupplier" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title_delete">Are you Sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deletesupplier" method="POST">
                    @csrf
                    <input type="hidden" name="id_delete_supplier" id="id_delete_supplier">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Yes Delete</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
