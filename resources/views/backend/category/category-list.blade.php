@extends('backend.master')
@section('breadcumb')
    All Category
@endsection
@section('category_active', 'active show-sub')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('All Category') }}</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">

            <a href="{{ route('CategoryAdd') }}" class="p-1 rounded tx-uppercase tx-bold tx-14 mg-b-10 ml-auto btn btn-success btn-icon"> <i class="fa fa-plus"></i> Add</a>

           
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
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
                        @foreach ($categories as $key => $cat)
                            <tr class="text-center">
                                <td>{{ $categories->firstitem() + $key }}</td>
                                <td>{{ $cat->category_name ?? 'N/A'}}</td>
                                <td>{{ $cat->slug ?? 'N/A'}}</td>
                                <td>{{ $cat->created_at != null ? $cat->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('CategoryEdit', ['id'=>$cat->id]) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('CategoryDelete', ['id'=>$cat->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              {{ $categories->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

        <div class="sl-page-title pt-5">
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
        </div><!-- card -->
    </div>
@endsection

@section('footer_js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
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
        
    </script>
@endsection