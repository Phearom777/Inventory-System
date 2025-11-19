
@extends('admin.master')
@section('contents')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  @if(session('success'))
    <script>
        $(document).ready(function () {
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
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
              >
              <div>
                <h3 class="fw-bold ">Category</h3>
                
              </div>
              
              <div class="ms-md-auto py-2 py-md-0">
                <a href="/category" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i> View</a>
                <button id="addcategory" class="btn btn-primary btn-round"><i class="fa fa-plus"></i> Add Category</button>
              </div>
            </div>
                <div class="row">
              <div class="col-md-12">
                <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                      <div class="card-title">View  
                     
                      </div>

                      <div class="card-tools">
                        <a
                          href="#"
                          class="btn btn-label-success btn-round btn-sm me-2"
                        >
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
                      <table
                        id="category_table"
                        class="display table table-striped table-hover w-100 text-nowrap "
                      
                        >
                        <thead class="text-center">
                          <tr>
                            <th class="bg-primary text-light">ID</th>
                            <th class="bg-primary text-light">Category Name</th>
                            <th class="bg-primary text-light">INSERT AT</th>
                            <th class="bg-primary text-light">UPDATE AT</th>
                            <th class="bg-primary text-light">ACTION</th>
                          </tr>
                        </thead>
                        <tbody class="text-center" >

                        @foreach ($categories as $category)
                        <tr>
                                  <td  >{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <div class="form-group d-flex justify-content-center gap-2">
                                            <button id="edit_category"  class="btn btn-warning btn-sm" ><i class="bi bi-pencil-square"></i> Edit</button>
                                            <button class="btn btn-danger  btn-sm" name="delete_category" id="delete_category"><i class="bi bi-trash3"></i> Delete</button>
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
<div class="modal fade" id="modal_addcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" >
      <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" require >
            </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-danger"  id="reset"><i class="bi bi-arrow-clockwise"></i> Reset</button>
        <button type="button" class="btn btn-primary" id="btnsave" name="btnsave"> <i class="bi bi-floppy-fill"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal edit-->
<div class="modal fade" id="modal_editcategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/updatecategory" method="POST" >
        @csrf
      <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="edit_name_category" id="edit_name_category" require >
                
                <input type="hidden" name="id_edit_cat" id="id_edit_cat"  >
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Cancel</button>
        <button type="submit" class="btn btn-primary"> <i class="bi bi-floppy-fill"></i> Save Change</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal delete-->
<div class="modal fade" id="modal_deletecategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="title_delete"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/deletecategory" method="POST">
        @csrf
    
      <input type="text" name="id_delete_cat" id="id_delete_cat"   hidden>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="btndelete_category">Yes Delete</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
