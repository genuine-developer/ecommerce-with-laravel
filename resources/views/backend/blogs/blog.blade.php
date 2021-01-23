@extends('backend.master')
@section('breadcumb')
    Blogs
@endsection
@section('blog_active', 'active show-sub')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('All Blogs') }}</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">

            <a href="{{ route('blog.create') }}" class="p-1 rounded tx-uppercase tx-bold tx-14 mg-b-10 ml-auto btn btn-success btn-icon"> <i class="fa fa-plus"></i> Add</a>

           
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                    <thead>
                        <tr>
                            {{-- <th class="text-center"><input type="checkbox" id="checkAll">Check All</th> --}}
                            <th class="text-center">SL</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Thumbnail</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('blog.store') }}" method="post">
                            @csrf
                            @foreach ($blogs as $key => $blog)
                                <tr class="text-center">
                                    {{-- <td><input type="checkbox" name="cat_id[]" value="{{ $cat->id }}"></td> --}}
                                    <td>{{ $blogs->firstitem() + $key }}</td>
                                    <td>{{ $blog->category_name ?? 'N/A'}}</td>
                                    <td>{{ $blog->slug ?? 'N/A'}}</td>
                                    <td>{{ $blog->thumbnail ?? 'N/A'}}</td>
                                    <td>{{ $blog->created_at != null ? $blog->created_at->diffForHumans() : 'N/A' }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-center">
                                <td>
                                    <button style="cursor: pointer" type="submit" class="btn btn-danger">Delete Selected</button>
                                </td>
                            </tr>
                        </form> 
                    </tbody>
                </table>
              {{ $blogs->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

        {{-- <div class="sl-page-title pt-5">
            <h5>{{ __('Trashed Category') }}</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-danger mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trash as $t_cat)
                            <tr class="text-center">
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $t_cat->category_name ?? 'N/A'}}</td>
                                <td>{{ $t_cat->slug ?? 'N/A'}}</td>
                                <td>{{ $t_cat->created_at != null ? $t_cat->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('CategoryRestore', ['id'=>$t_cat->id]) }}" class="btn btn-info">Restore</a>
                                    <a href="{{ route('CategoryPermanentDelete', ['id'=>$t_cat->id]) }}" class="btn btn-danger">Permanent Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div><!-- card --> --}}
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
        
        @if (session('category_delete'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('category_delete') }}'
            })
        @endif
        @if (session('ProductAvailable'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('ProductAvailable') }}'
            })
        @endif
        @if (session('category_update'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('category_update') }}'
            })
        @endif
        @if (session('category_restore'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('category_restore') }}'
            })
        @endif
        @if (session('category_permanent_delete'))
            Toast.fire({
                icon: 'sucess',
                title: '{{ session('category_permanent_delete') }}'
            })
        @endif
        @if (session('NotSelected'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('NotSelected') }}'
            })
        @endif
        
    </script>
@endsection