@extends('backend.master')

@section('breadcumb')
    Products
@endsection

@section('product_active')
    active  show-sub
@endsection

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Total Products ') }}({{ $product_count }})</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">

                    @if (session('product_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>{{ session('product_update') }}</strong>
                        </div>
                    @endif

                    <a href="{{ route('ProductAdd') }}" class="p-1 rounded tx-uppercase tx-bold tx-14 mg-b-10 ml-auto btn btn-success btn-icon"> <i class="fa fa-plus"></i> Add</a>
                
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Thumbnail</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Images</th>
                                    {{-- <th class="text-center">Status</th> --}}
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr class="text-center">
                                        <td>{{ $products->firstitem() + $key }}</td>
                                        <td>{{ $product->title ?? 'N/A'}}</td>
                                        <td><img style="width:100px" src="{{ asset('thumbnail/'.$product->created_at->format('Y/m/').$product->id.'/'.$product->thumbnail) }}" alt="thumbnail"></td>
                                        <td>{{ $product->price ?? 'N/A' }}</td>
                                        <td>
                                            @foreach (App\Attribute::where('product_id', $product->id)->get() as $test)
                                            {{-- @foreach ($product->attribute->where(product_id, $product->id)->get() as $test) --}}
                                            {{-- @foreach ($attribute as $test) --}}
                                                <span>Size: {{ $test->size->size_name }}</span>
                                                <span>Color: {{ $test->color->color_name }}</span>
                                                <span>Quantity: {{ $test->quantity }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($product->gallery as $img)
                                                <img style="width:75px" src="{{ asset('gallery/'.$img->created_at->format('Y/m/').$img->product_id.'/'.$img->images) }}" alt="thumbnail">     
                                            @endforeach
                                           
                                        </td>
                                        <td>
                                            <a href="{{ route('ProductEdit', ['slug'=>$product->slug]) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ route('GalleryEdit', ['slug'=>$product->slug]) }}" class="btn btn-info">Gallery Edit</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    {{ $products->links() }}
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection