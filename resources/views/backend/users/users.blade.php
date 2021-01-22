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
            <div class="col-xl-8">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                   
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">User Role</th>
                                    <th class="text-center">User Permission</th>
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
                                        <td>
                                            @foreach ($user->getRoleNames() as $ur)
                                                <li>{{ $ur }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($user->getAllPermissions() as $per)
                                                <li>{{ $per->name }}</li>
                                            @endforeach
                                        </td>
                                        <td>{{ $user->email ?? 'N/A' }}</td>
                                        <td>{{ $user->created_at != null ? $user->created_at : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('EditPermission', ['user_id'=> $user->id])}}" class="btn btn-info">Edit Permission</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      {{ $users->links() }}
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
            @can('add users')
                
            
            <div class="col-xl-4">
                <div class="row">
                    {{-- Role ADD Form --}}
                    <div class="col-xl-12 mg-t-25 mg-xl-t-0 mg-b-25">
                        <div class="card pd-20 pd-sm-40 form-layout">
                            <div class="text-center text-light font-weight-bold">
                                <p class="card-header bg-primary mb-3">{{ __('Add Role') }}</p>
                            </div>

                            
                            <form action="{{ route('UserAddRole') }}" method="POST">
            
                                @csrf
                                <div class="row">
                                    <label class="col-sm-5 form-control-label" for="user_id">{{ __('User Name')}}<span class="tx-danger">* </span>:</label>
                                    <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                        <select name="user_id" id="user_id" class="form-control">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- row -->
                                <div class="row mg-t-10">
                                    <label class="col-sm-5 form-control-label" for="role_name">{{ __('Role Name')}}<span class="tx-danger">* </span>:</label>
                                    <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                        <select name="role_name" id="role_name" class="form-control">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!-- row -->
                                <div class="form-layout-footer mg-t-30 text-center">
                                    <button class="btn btn-info mg-r-5">Add Role</button>
                                </div>
            
                            </form>
                        </div>
                    </div>
                </div><!-- Row End-->
            </div>
            @endcan
        </div>
    </div>
@endsection