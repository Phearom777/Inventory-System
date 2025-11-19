@extends('admin.master')
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">List View
                        </div>
                    </div>
                </div>

                <div class="card-body">
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
                           

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" 
                                        name="price" id="price" value="0" placeholder="$ 0.00">
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                    <select class="form-select" name="category_id" id="category_id">
                                        <option selected disabled>Select Category</option>
                                      
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control stock"  value="0" name="stock">
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

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">List View
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive ">
                        <table id="customer_table" class="display table table-striped table-hover w-100 text-nowrap ">
                            <thead class="text-center table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
