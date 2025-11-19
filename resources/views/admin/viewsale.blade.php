@extends('admin.master')
@section('contents')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Sale Detail</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="/sale" class="btn btn-label-info btn-round me-2 "><i class="bi bi-eye"></i>Back to Sale</a>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">List View

                            </div>

                            <div class="card-tools d-flex justify-content-end">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Filter
                                    </button>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <form action="/sale" method="get">
                                            <button type="submit" class="dropdown-item" name="filer">All</button>
                                            @foreach ($customers as $customer)
                                                <button type="submit" class="dropdown-item" name="filter"
                                                    value="{{ $customer->id }}">{{ $customer->customer_name }}</button>
                                            @endforeach
                                        </form> --}}
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
                                        <th>Sale ID</th>
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
                                                    <button class="btn btn-info btn-sm" id="view_product"><i
                                                            class="bi bi-eye"></i></button>
                                                    <button data-bs-toggle="modal" data-bs-target="#modal_editsale"
                                                        class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button class="btn btn-danger  btn-sm"><i class="bi bi-trash3"></i>
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
    @endsection
