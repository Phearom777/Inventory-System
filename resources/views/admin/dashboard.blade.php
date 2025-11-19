
@extends('admin.master')
@section('contents')
<div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
              >
              <div>
                <h3 class="fw-bold ">Dashboard</h3>
              </div>
              
            </div>
            <div class="row">
            
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <div class="icon-big text-center">
                          <i class="bi bi-tags-fill"></i>
                        </div>
                      </div>
                      <div class="col-8 col-stats">
                        <div class="numbers">
                          <p class="card-category">Total Categories</p>
                          <h4 class="card-title">
                              {{ $totalCategories ?? 'Undefined' }}
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-danger card-round">
                  <div class="card-body">
                    <div class="row ">
                      <div class="col-4">
                        <div class="icon-big text-center">
                          <i class="bi bi-exclude"></i>
                        </div>
                      </div>
                      <div class="col-8 col-stats">
                        <div class="numbers">
                          <p class="card-category">Total Products</p>
                          <h4 class="card-title">
                              {{ $totalProducts ?? 'Undefined' }}
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-warning card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <div class="icon-big text-center">
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col-8 col-stats">
                        <div class="numbers">
                          <p class="card-category">Total Customers</p>
                          <h4 class="card-title">
                              {{ $totalCustomers ?? 'Undefined' }}
                            
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-info card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <div class="icon-big text-center">
                          <i class="fas fa-truck-moving"></i>

                        </div>
                      </div>
                      <div class="col-8 col-stats">
                        <div class="numbers">
                          <p class="card-category">Total Suppliers</p>
                          <h4 class="card-title">
                              {{ $totalSupplier ?? 'Undefined' }}
                            
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-secondary	 card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <div class="icon-big text-center">
                         <i class="bi bi-cart-plus-fill"></i>

                        </div>
                      </div>
                      <div class="col-8 col-stats">
                        <div class="numbers">
                          <p class="card-category"> Total Purchase</p>
                          <h4 class="card-title">
                              {{ $totalPurchases ?? 'Undefined' }}
                            
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-success	 card-round">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <div class="icon-big text-center">
                         <i class="bi bi-cart-plus-fill"></i>

                        </div>
                      </div>
                      <div class="col-8 col-stats">
                        <div class="numbers">
                          <p class="card-category">Sale</p>
                          <h4 class="card-title">
                           $ {{ $totalRevenue ?? 'Undefined' }}
                          </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
             
            </div>
           
@endsection