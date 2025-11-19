@extends('admin.master')
@section('contents')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold ">Product</h3>
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

        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/product-suppliers" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> Product
                Suplier</a>
            <a href="/product" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> View</a>
            <button id="addproduct" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Add Product</button>
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
                                    Filter Category
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <form action="/product" method="get">
                                        <button type="submit" class="dropdown-item" name="filter">All</button>
                                        @foreach ($categories as $category)
                                            <button type="submit" class="dropdown-item" name="filter"
                                                value="{{ $category->id }}">{{ $category->category_name }}</button>
                                        @endforeach
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="products_table" class="display table table-striped table-hover w-100 text-nowrap ">
                            <thead class="text-center bg-primary text-white">
                                <tr class="bg-primary text-white">
                                    <th class="bg-primary text-light">ID</th>
                                    <th class="bg-primary text-light">Name</th>
                                    <th class="bg-primary text-light">PRICE</th>
                                    <th class="bg-primary text-light">STOCK</th>
                                    <th class="bg-primary text-light">Catagory</th>
                                    <th class="bg-primary text-light">IMAGE</th>
                                    <th class="bg-primary text-light">Status</th>
                                    <th class="bg-primary text-light">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="11" class="text-start text-danger">
                                            This Category is have no Product yet!!
                                        </td>
                                    </tr>
                                @else
                                    @php $number = 1; @endphp

                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>$ {{ $product->price }}</td>
                                            <td>{{ $product->stock - ($product->sold_qty ?? 0) }}</td>
                                            <td>{{ $product->category->category_name ?? 'No Category' }}</td>
                                            <td class="overflow-hidden">
                                                @if ($product->image)
                                                    <img id="show_imgproduct" width="50px" height="50px"
                                                        class="rounded-circle  product_img" src="{{ $product->image }}"
                                                        alt="Product Image">
                                                @else
                                                    No Image
                                                @endif
                                            </td>

                                            <td>
                                                <span
                                                    class="badge 
                                      {{ $product->status == 'In Stock' ? 'bg-success' : ($product->status == 'Low Stock' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ $product->status }}
                                                </span>
                                            </td>

                                            <td>
                                                <button class="btn btn-info btn-sm" id="view_product"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                                    data-price="{{ $product->price }}" data-stock="{{ $product->stock }}"
                                                    data-category="{{ $product->category_id }}"
                                                    data-description="{{ $product->description }}"
                                                    data-status="{{ $product->status }}"
                                                    data-image="{{ $product->image }}"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-warning btn-sm" data-id="{{ $product->id }}"
                                                    data-name="{{ $product->product_name }}"
                                                    data-price="{{ $product->price }}" data-stock="{{ $product->stock }}"
                                                    data-category="{{ $product->category_id }}"
                                                    data-description="{{ $product->description }}"
                                                    data-image="{{ $product->image }}"
                                                    data-suppliers={{ $product->suppliers->pluck('id') }}
                                                    id="edit_product"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger btn-sm" name="delete_product"
                                                    data-id="{{ $product->id }}" id="delete_product"><i
                                                        class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modal_addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/addproduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name">
                                </div>
                            </div>
                            <div class="col-6 col-lg-6">
                                <div class="form-group">
                                    <label for="suppliers">Suppliers:</label>
                                    <select name="suppliers[]" class=" form-select  " multiple>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-select" name="category_id" id="category_id">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        value="0" placeholder="$ 0.00">
                                </div>
                            </div>

                            <div class="col-6 col-lg-4">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control stock" value="0" name="stock">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                 <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control " name="image" id="product_image">
                            <img id="productPreview" src="" alt="Image Preview"
                                style="max-width: 200px; display: none;margin-top: 10px;" />

                        </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="stock">Description</label>
                                    <textarea id="description" name="description" rows="4" cols="50" class="form-control"
                                        placeholder="Enter product details..."></textarea>
                                </div>
                            </div>
                        </div>

                       
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" id="reset"><i
                                class="bi bi-arrow-clockwise"></i>
                            Reset</button>
                        <button type="submit" id="btnsave_addproduct" name="btnsaveproduct" class="btn btn-primary"> <i
                                class="bi bi-floppy-fill"></i> Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal edit-->
    <div class="modal fade" id="modal_editproduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/update_product" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="product_name"
                                        id="edit_name_product" value="">
                                    <input type="hidden" name="id" id="id_edit_product">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <select name="suppliers[]" id="edit_suppliers" class="form-select" multiple>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="form-group">
                                    <label for="name">Catagory</label>
                                    <select class="form-select" name="category_id" id="edit_category_product" required>
                                        <option selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" min="0" name="price"
                                        id="edit_price_product" required>
                                </div>
                            </div>

                            <div class="col-6 col-lg-4">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control stock" min="0" name="stock"
                                        id="edit_stock_product">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="img">Image</label>
                                    <input type="hidden" class="form-control " name="imageurl" id="imageurl">
                                    <input type="file" class="form-control " name="image" id="edit_image">
                                    <img id="edit_productPreview" src="{{ $product->image ?? '' }}" alt="Image Preview"
                                        style="max-width: 200px; display: none;margin-top: 10px;" />
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea id="product_desc" name="description" rows="4" cols="50" class="form-control"
                                        placeholder="Enter product details..."></textarea>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i>
                            Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save
                            Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete -->
    <div class="modal fade" id="modal_deleteproduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title_deleteproduct">Are You Sure?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/deleteproduct" method="POST">
                    @csrf

                    <input type="hidden" name="id_delete_product" id="id_delete_product">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="btndelete_category">Yes Delete</button>
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
                    <img class="text-center w-100 h-0" src="" alt="img" id="show_img_product">
                </div>
            </div>
        </div>
    </div>

    <!-- modal view -->
    <div class="modal fade" id="modal_viewproduct" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title_deleteproduct">view </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="view_id"></h5>
                    <h5 id="view_product_name"> </h5>
                    <h5 id="view_category"> </h5>
                    <h5 id="view_price"></h5>
                    <h5 id="view_stock"></h5>
                    <h5 id="view_status"></h5>
                    <h5 id="view_description"></h5>
                    <img src="" alt="" id="view_image_detail"
                        style="max-width: 200px; display: none;margin-top: 10px;">

                </div>

            </div>
        </div>
    </div>


@endsection
