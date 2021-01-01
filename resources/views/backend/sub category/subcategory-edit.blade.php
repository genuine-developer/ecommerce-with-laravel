@extends('backend.master')
@section('breadcumb')
    Sub Category Edit
@endsection
@section('category_active', 'active show-sub')

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Edit Sub Category') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-8">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
    
                    @if (session('scategory_delete'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>{{ session('scategory_delete') }}</strong>
                        </div>
                    @endif
                   
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
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
            </div>
    
            <div class="col-xl-4 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout">

                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Edit Sub Category') }}</p>
                    </div>

                    @if (session('scategory_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>{{ session('scategory_update') }}</strong>
                        </div>
                    @endif

                    <form action="{{ route('SubCategoryUpdate') }}" method="POST">
    
                        @csrf
    
                        <input type="hidden" name="id" value="{{ $edit_subcategory->id }}">
                        <div class="row">
                            <label class="col-sm-4 form-control-label" for="subcategory_name">{{ __('Sub Category Name')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" placeholder="ex: Sports" name="subcategory_name" value="{{ $edit_subcategory->subcategory_name }}" id="subcategory_name">
                            </div>
                            @error('subcategory_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div><!-- row -->
                        <div class="row mg-t-20">
                            <label for="category_id" class="col-sm-4 form-control-label">{{ __('Category')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option @if($category->id == $edit_subcategory->category_id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button class="btn btn-info mg-r-5">Update Sub Category</button>
                        </div>
    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection