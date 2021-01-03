@extends('backend.master')
@section('breadcumb')
    Product Add
@endsection

@section('product_active')
    active  show-sub
@endsection

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Product Gallery Update') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            
            <div class="col-xl-12 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Update Product Gallery') }}</p>
                    </div>


                    @if (session('ImageDelete'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>{{ session('ImageDelete') }}</strong>
                        </div>
                    @endif

                    <form action="{{ route('MultiImageUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product_id }}">

                        @foreach ($gallery as $img)

                            {{-- <input type="hidden" name="id" value="{{ $img->id }}"> --}}
                                    
                            <div class="row mg-t-20">
                                <label class="col-sm-2 form-control-label" for="images">{{ __('Product Image ') }}<span class="tx-danger"> *</span> :</label>
                                <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" id="images">
                                </div>
                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                    <img style="width: 100px" src="{{ asset('gallery/'.$img->created_at->format('Y/m/').$img->product_id.'/'.$img->images) }}" alt="">
                                </div>

                                <div class="col-sm-2 mg-t-10 mg-sm-t-0">
                                    <a href="{{ route('GalleryImageDelete', ['id'=>$img->id] ) }}" class="btn btn-outline-danger">Delete</a>
                                </div>
                            </div><!-- row -->

                        @endforeach

                        {{-- Another File --}}
                        <div class="field_wrapper">
                            <div class="row mg-t-20">
                            
                                <label class="col-sm-2 form-control-label" for="images">{{ __('Product Image ') }}<span class="tx-danger"> *</span> :</label>
                                <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                    <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" id="images">
                                    
                                </div>
                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    
                             
                                    {{-- <div class="col-sm-1 mg-t-10 mg-sm-t-0 ">
                                        <a href="#" class=" add_button p-1 rounded tx-uppercase tx-bold tx-14 mg-b-10 ml-auto btn btn-success btn-icon"> <i class="fa fa-plus"></i> Add</a>
                                    </div>
                           --}}
    
                                <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                                    <img style="width: 100px" src="#" alt="">
                                </div>
                            </div>
                        </div>
 
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button type="submit" class="btn btn-info mg-r-5">{{ __('Update Product') }}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
   
@endsection