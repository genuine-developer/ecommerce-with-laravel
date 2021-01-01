@extends('backend.master')
@section('breadcumb')
    Users 
@endsection

@section('user_active')
    active  show-sub
@endsection

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Total Users ') }}({{ $total_user }})</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                   
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Registered Date</th>
                                    {{-- <th class="text-center">Status</th> --}}
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr class="text-center">
                                        <td>{{ $users->firstitem() + $key }}</td>
                                        <td>{{ $user->name ?? 'N/A'}}</td>
                                        <td>{{ $user->email ?? 'N/A'}}</td>
                                        <td>{{ $user->created_at != null ? $user->created_at : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('CategoryEdit', ['id'=>$user->id]) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ route('CategoryDelete', ['id'=>$user->id]) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      {{ $users->links() }}
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection