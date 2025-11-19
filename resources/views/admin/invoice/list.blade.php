@extends('admin.master')
@section('contents')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Invoice List

                        </div>

                        <div class="card-tools d-flex justify-content-end">

                            <div class="dropdown">
                                <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sale_table" class="display table table-striped table-hover w-100 text-nowrap ">
                            <thead class="text-center bg-primary text-white">
                                <tr class="bg-primary text-white">
                                    <th class="bg-primary text-light">Invoice No</th>
                                    <th class="bg-primary text-light">Customer Name</th>
                                    <th class="bg-primary text-light">Total Amount</th>
                                    <th class="bg-primary text-light">Status</th>
                                    <th class="bg-primary text-light">action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($invoices as $item)
                                    <tr>
                                        <td>{{ $item->invoice_number }}</td>
                                        <td>{{ $item->customer->customer_name }}</td>
                                        <td>{{ $item->total_amount }}</td>

                                        {{-- <td>
                                            @foreach ($item->sales as $sale)
                                                {{ $sale->product->product_name }}
                                            @endforeach
                                        </td> --}}
                                        <td>
                                            @foreach ($item->sales as $sale)
                                                @if (strtolower($sale->status) == 'paid')
                                                    <span class="badge bg-success">Paid</span>
                                                @elseif(strtolower($sale->status) == 'pending')
                                                    <span class="badge bg-danger">Pending</span>
                                                @else
                                                    <span class="badge bg-warning">Unknown</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td><a href="/invoice" class="btn btn-outline-primary btn-sm"><i class="bi bi-eye"></i> Invoice</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <button onclick="window.print()">Print Sale</button> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
