@extends('backend.master')
@section('breadcumb')
    Orders
@endsection

@section('order_active')
    active  show-sub
@endsection

@section('content')
    <div class="sl-pagebody">
        {{-- <div class="sl-page-title">
            <h5>{{ __('Total Orders ') }}({{ $total_user }})</h5>
        </div> --}}
        <div class="row row-sm mg-t-20">
            <form action="{{ route('CategoryImport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="excel">
                <input type="submit" value="Upload Excel" class="btn btn-success">
            </form>
            <br>
            <form action="{{ route('SelectedDateExcelDownload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="date" class="form-control" name="start">
                <input type="date" class="form-control" name="end">
                <input type="submit" value="Selected Date" class="btn btn-success">
            </form>
            
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                    <a href="{{ route('ExcelDownload') }}" class="p-1 rounded tx-uppercase tx-bold tx-14 mg-b-10 ml-auto btn btn-success btn-icon "> <i class="icon ion-share"></i> Export</a>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Unit Price</th>
                                    <th class="text-center">Total Price</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr class="text-center">
                                        <td>{{ $orders->firstitem() + $key }}</td>
                                        <td>{{ $order->product->title ?? 'N/A'}}</td>
                                        <td>{{ $order->quantity ?? 'N/A'}}</td>
                                        <td>{{ $order->product_unit_price ?? 'N/A'}}</td>
                                        <td>{{ $order->quantity * $order->product_unit_price ?? 'N/A'}}</td>
                                        <td>{{ $order->created_at->format('d-M-Y l') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-success">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      {{ $orders->links() }}
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection