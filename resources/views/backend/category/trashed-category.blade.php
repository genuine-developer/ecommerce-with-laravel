@extends('backend.master')
@section('breadcumb')
    Category
@endsection
@section('category_active')
    active
@endsection
@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
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