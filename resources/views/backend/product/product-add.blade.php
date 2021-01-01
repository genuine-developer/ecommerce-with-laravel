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
            <h5>{{ __('Add Product') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            
            <div class="col-xl-12 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Add product') }}</p>
                    </div>

                    @if (session('product_add'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>{{ session('product_add') }}</strong>
                        </div>
                    @endif

                    <form action="{{ route('ProductPost') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <label class="col-sm-2 form-control-label" for="title">{{ __('Product Title ') }}<span class="tx-danger"> *</span> :</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="ex: Blue Shirt" name="title" id="title">
                            </div>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-2 form-control-label" for="title">{{ __('Product Price ') }}<span class="tx-danger"> *</span> :</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
                            </div>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="brand_id" class="col-sm-2 form-control-label">{{ __('Brand')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    @foreach ($brand as $br)
                                        <option value="{{ $br->id }}">{{ $br->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div id="items">
                            <div class="row mg-t-20 attri">
                                <label for="color_id" class="col-sm-2 form-control-label">{{ __('Color')}}<span class="tx-danger">* </span>:</label>
                                <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                                    <select name="color_id[]" id="color_id" class="form-control">
                                        @foreach ($color as $cl)
                                            <option value="{{ $cl->id }}">{{ $cl->color_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="size_id" class="col-sm-2 form-control-label">{{ __('Size')}}<span class="tx-danger">* </span>:</label>
                                <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                                    <select name="size_id[]" id="size_id" class="form-control">
                                        @foreach ($size as $sz)
                                            <option value="{{ $sz->id }}">{{ $sz->size_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="quantity" class="col-sm-2 form-control-label">{{ __('Quantity')}}<span class="tx-danger">* </span>:</label>
                                <div class="col-sm-1 mg-t-10 mg-sm-t-0">
                                   <input type="text" name="quantity[]" class="form-control" placeholder="30">
                                </div>
                                {{-- ADD Button --}}
                                <span id="add" class="btn add-more button-blue tx-uppercase mr-2"><i class="fa fa-plus"></i> ADD</span>
                                <span class="delete btn button-blue tx-uppercase mr-2"><i class="fa fa-times"></i></span>
                            </div><!-- row -->
                        </div>
                        <div class="row mg-t-20">
                            <label for="category_id" class="col-sm-2 form-control-label">{{ __('Category')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="subcategory_id" class="col-sm-2 form-control-label">{{ __('Category')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    @foreach ($scat as $scategory)
                                        <option value="{{ $scategory->id }}">{{ $scategory->subcategory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="summary" class="col-sm-2 form-control-label">{{ __('Summary')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" id="summary" class="form-control"></textarea>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="description" class="col-sm-2 form-control-label">{{ __('Description')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-2 form-control-label" for="thumbnail">{{ __('Product Thumbnail ') }}<span class="tx-danger"> *</span> :</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" id="thumbnail">
                            </div>
                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label class="col-sm-2 form-control-label" for="images">{{ __('Product Images ') }}<span class="tx-danger"> *</span> :</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="file" multiple class="form-control @error('images') is-invalid @enderror" name="images[]" id="images">
                            </div>
                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- row -->

                        
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button type="submit" class="btn btn-info mg-r-5">{{ __('Add Product') }}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        
        $(document).ready(function(){
            
            $(".delete").hide();

            $("#add").click(function(e){
                $(".delete").fadeIn("1500");

                $("#items").append(
                    '<div class="row mg-t-20 attri">'+
                        '<label for="color_id" class="col-sm-2 form-control-label">{{ __('Color')}}<span class="tx-danger">* </span>:</label>'+
                        '<div class="col-sm-1 mg-t-10 mg-sm-t-0">'+
                            '<select name="color_id[]" id="color_id" class="form-control">'+
                                '@foreach ($color as $cl)'+
                                '<option value="{{ $cl->id }}">{{ $cl->color_name }}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<label for="size_id" class="col-sm-2 form-control-label">{{ __('Size')}}<span class="tx-danger">* </span>:</label>'+
                        '<div class="col-sm-1 mg-t-10 mg-sm-t-0">'+
                            '<select name="size_id[]" id="size_id" class="form-control">'+
                                '@foreach ($size as $sz)'+
                                    '<option value="{{ $sz->id }}">{{ $sz->size_name }}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<label for="quantity" class="col-sm-2 form-control-label">{{ __('Quantity')}}<span class="tx-danger">* </span>:</label>'+
                            '<div class="col-sm-1 mg-t-10 mg-sm-t-0">'+
                                '<input type="text" name="quantity[]" class="form-control" placeholder="30">'+
                            '</div>'+
                    '</div>'
                );
            });
            $("body").on("click", ".delete", function(e){
                $(".attri").last().remove();
            });
        });
    </script>
@endsection