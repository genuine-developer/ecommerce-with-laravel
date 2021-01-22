@extends('backend.master')
@section('breadcumb')
    Assign Role
@endsection
@section('role_active', 'active show-sub')

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('Role & Permissions') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-8">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
    
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Role Name</th>
                                    <th class="text-center">Permissions</th>
                                    <th class="text-center">Created at</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $role->name ?? 'N/A'}}</td>
                                        <td>
                                            @foreach ($role->getPermissionNames() as $permission)
                                                <li>{{ $permission }}</li>
                                            @endforeach
                                        </td>
                                        <td>{{ $role->created_at != null ? $role->created_at->diffForHumans() : 'N/A' }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info">Edit</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
    
            <div class="col-xl-4 mg-t-25 mg-xl-t-0">
                <div class="card pd-20 pd-sm-40 form-layout">
                    <div class="text-center text-light font-weight-bold">
                        <p class="card-header bg-primary mb-3">{{ __('Add Permission') }}</p>
                    </div>

                    
                    <form action="{{ route('RoleAddPermission') }}" method="POST">
    
                        @csrf
                        <div class="row">
                            <label class="col-sm-5 form-control-label" for="role_name">{{ __('Role Name')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="role_name" id="role_name" class="form-control">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mg-t-10">
                            <label class="col-sm-5 form-control-label" for="permission_name">{{ __('Permission Name')}}<span class="tx-danger">* </span>:</label>
                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                <select name="permission_name" id="permission_name" class="form-control">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="form-layout-footer mg-t-30 text-center">
                            <button class="btn btn-info mg-r-5">Add to Role</button>
                        </div>
    
                    </form>
                </div>
            </div>
        </div>

        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
    
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th class="text-center">Permission Name</th>
                                    <th class="text-center">Created at</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                    <tr class="text-center">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $permission->name ?? 'N/A'}}</td>
                                        <td>{{ $permission->created_at != null ? $permission->created_at->diffForHumans() : 'N/A' }}</td>
                                        <td>
                                            <a href="#" class="btn btn-info">Edit</a>
                                            <a href="#" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
        </div>
    </div>
@endsection