@extends('backend.master')
@section('breadcumb')
    All Sub-Category
@endsection
@section('category_active', 'active show-sub')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('All Sub-Category') }}</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">
            
            <a href="{{ route('SubCategoryAdd') }}" class="p-1 rounded tx-uppercase tx-bold tx-14 mg-b-10 ml-auto btn btn-success btn-icon"> <i class="fa fa-plus"></i> Add</a>

            @if (session('scategory_delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ session('scategory_delete') }}</strong>
                </div>
            @endif
            @if (session('scategory_update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ session('scategory_update') }}</strong>
                </div>
            @endif
           
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Sub Category</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Category Name</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($scategories as $key => $scat)
                            <tr class="text-center">
                                <td>{{ $scategories->firstitem() + $key }}</td>
                                <td>{{ $scat->subcategory_name ?? 'N/A'}}</td>
                                <td>{{ $scat->slug ?? 'N/A'}}</td>
                                <td>{{ $scat->get_category->category_name ?? 'N/A'}}</td>
                                <td>{{ $scat->created_at != null ? $scat->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('SubCategoryEdit', ['id'=>$scat->id]) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ route('SubCategoryDelete', ['id'=>$scat->id]) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              {{ $scategories->links() }}
            </div><!-- table-responsive -->
        </div><!-- card -->

        <div class="sl-page-title pt-5">
            <h5>{{ __('Trashed Sub-Category') }}</h5>
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40 mg-t-50">

            @if (session('scategory_restore'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ session('scategory_restore') }}</strong>
                </div>
            @endif
            @if (session('scategory_permanent_delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{ session('scategory_permanent_delete') }}</strong>
                </div>
            @endif
           
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-danger mg-b-0">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Sub Category</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Category name</th>
                            <th class="text-center">Created at</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($strash as $st_cat)
                            <tr class="text-center">
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{{ $st_cat->subcategory_name ?? 'N/A'}}</td>
                                <td>{{ $st_cat->slug ?? 'N/A'}}</td>
                                <td>{{ $st_cat->category_id ?? 'N/A'}}</td>
                                <td>{{ $st_cat->created_at != null ? $st_cat->created_at->diffForHumans() : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('SubCategoryRestore', ['id'=>$st_cat->id]) }}" class="btn btn-info">Restore</a>
                                    <a href="{{ route('SubCategoryParmanentDelete', ['id'=>$st_cat->id]) }}" class="btn btn-danger">Permanent Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div><!-- card -->
    </div>
@endsection