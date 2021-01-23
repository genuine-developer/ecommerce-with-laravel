@extends('backend.master')
@section('breadcumb')
    Blogs
@endsection
@section('blog_active', 'active show-sub')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Add Blogs') }}</h5>
        </div><!-- sl-page-title -->

        <div class="row row-sm mg-t-20">
            
            <div class="col-xl-12 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Add Blog') }}</p>
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

                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <label class="col-sm-2 form-control-label" for="title">{{ __('Blog Title ') }}<span class="tx-danger"> *</span> :</label>
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
                            <label for="my-editor" class="col-sm-2 form-control-label">{{ __('Summary')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <textarea name="summary" id="my-editor" class="form-control"></textarea>
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
                            <button type="submit" class="btn btn-info mg-r-5">{{ __('Add Blog') }}</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

       
    </div>
@endsection

@section('footer_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">

        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        @if (session('blog_add'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('blog_add') }}'
            })
        @endif
       
    </script>


    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
          filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
          filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
          filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
          filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace('my-editor', options);
    </script>
@endsection