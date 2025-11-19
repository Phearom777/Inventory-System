@extends('admin.master')
@section('contents')

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Product Supplier</h3>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">List View</div>
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
                                    <th class="bg-primary text-light">Image</th>
                                    <th class="bg-primary text-light">Product</th>
                                    <th class="bg-primary text-light">Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img id="show_imgproduct" width="50px" height="50px"
                                                        class="rounded-circle  product_img" src="{{ $product->image }}"
                                                        alt="Product Image">
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>
                                            @foreach ($product->suppliers as $supplier)
                                                <span class="badge bg-primary">{{ $supplier->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
