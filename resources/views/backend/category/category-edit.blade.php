@extends('backend.master')
@section('breadcumb')
    Category Edit
@endsection
@section('category_active', 'active show-sub')
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Edit Category') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-8">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
    
                    @if (session('category_delete'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>{{ session('category_delete') }}</strong>
                        </div>
                    @endif
                   
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
            </div>
    
            <div class="col-xl-4 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout">

                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Edit Category') }}</p>
                    </div>

                    @if (session('category_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>{{ session('category_update') }}</strong>
                        </div>
                    @endif

                    <form action="{{ route('CategoryUpdate') }}" method="POST">
    
                        @csrf
    
                        <input type="hidden" name="id" value="{{ $edit_category->id }}">
                        <div class="row">
                            <label class="col-sm-5 form-control-label" for="category_name">{{ __('Category Name')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('category_name') is-invalid @enderror" placeholder="ex: Sports" name="category_name" value="{{ $edit_category->category_name }}" id="category_name">
                            </div>
                            @error('category_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- row -->
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button class="btn btn-info mg-r-5">Update Category</button>
                        </div>
    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection