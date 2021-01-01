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
            <h5>{{ __('Product Update') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            
            <div class="col-xl-12 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Update Product') }}</p>
                    </div>

                    

                    <form action="{{ route('ProductUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="row">
                            <label class="col-sm-2 form-control-label" for="title">{{ __('Product Title ') }}<span class="tx-danger"> *</span> :</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="text" placeholder="ex: Blue Shirt" value="{{ $product->title }}" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
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
                                <input type="text" name="price" value="{{ $product->price }}" id="price" class="form-control @error('price') is-invalid @enderror">
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
                                        <option 
                                            @if ($br->id == $product->brand_id)
                                                selected
                                            @endif
                                            value="{{ $br->id }}">{{ $br->brand_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->

                        <div class="row mg-t-20">
                            <label for="category_id" class="col-sm-2 form-control-label">{{ __('Category')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach ($categories as $category)
                                        <option
                                            @if ($category->id == $product->category_id)
                                                selected
                                            @endif
                                            value="{{ $category->id }}">{{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="subcategory_id" class="col-sm-2 form-control-label">{{ __('Sub Category')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    
                                        <option value="{{ $product->subcategory_id }}">{{ $product->subcategory->subcategory_name }}</option>
                            
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="summary" class="col-sm-2 form-control-label">{{ __('Summary')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" id="summary" class="form-control">{{ $product->summary }}</textarea>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="description" class="col-sm-2 form-control-label">{{ __('Description')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
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
                        

                        
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button type="submit" class="btn btn-info mg-r-5">{{ __('Update Product') }}</button>
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

            $('#category_id').change(function(){
                //alert("ok")
                let category_id = $(this).val()

                if(category_id){
                    $.ajax({
                        type:'GET',
                        url:'/product-update/ajax/' + category_id,
                        success:function(data) {
                            //$("#msg").html(data.msg);
                            if (data) {
                                $('#subcategory_id').empty()
                                $('#subcategory_id').append('<option>Select One</option>')
                                $.each(data,function(key,value){
                                    $('#subcategory_id').append('<option value="'+value.id+'">'+ value.subcategory_name +'</option>')
                                })
                            } else {
                                $('#subcategory_id').empty()
                            }
                        }
                    });
                } else{
                    $('#subcategory_id').empty()
                }
            })
        })
    </script>
@endsection