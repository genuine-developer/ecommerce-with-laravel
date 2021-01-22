@extends('backend.master')
@section('breadcumb')
    Users Permission
@endsection

@section('role_active')
    active  show-sub
@endsection

@section('content')
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>{{ __('User Permissions') }}</h5>
        </div><!-- sl-page-title -->
        <div class="row row-sm mg-t-20">
            <div class="col-xl-8">
                <div class="card pd-20 pd-sm-40 form-layout form-layout-4">
                   
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-primary mg-b-0 mb-3">
                            <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">User Role</th>
                                    <th class="text-center">User Permission</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Registered Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    <tr class="text-center">
                                        <td>{{ $users->name ?? 'N/A'}}</td>
                                        <td>
                                            @foreach ($users->getRoleNames() as $user)
                                                <li>{{ $user }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($users->getAllPermissions() as $user)
                                                <li>{{ $user->name }}</li>
                                            @endforeach
                                        </td>
                                        <td>{{ $users->email ?? 'N/A' }}</td>
                                        <td>{{ $users->created_at != null ? $users->created_at : 'N/A' }}</td>
                                    </tr>
                                
                            </tbody>
                        </table>
                     
                    </div><!-- table-responsive -->
                </div><!-- card -->
            </div>
            <div class="col-xl-4">
                <div class="row">
                    {{-- Permission Add Form --}}
                    <div class="col-xl-12 mg-t-25 mg-xl-t-0">
                        <div class="card pd-20 pd-sm-40 form-layout">
                            <div class="text-center text-light font-weight-bold">
                                <p class="card-header bg-primary mb-3">{{ __('Add Permission') }}</p>
                            </div>

                            
                            <form action="{{ route('UserAddPermission') }}" method="POST">
            
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $users->id }}">
                                <div class="row mg-t-10">
                                    <label class="col-sm-5 form-control-label" for="permission_name">{{ __('Permission Name')}}<span class="tx-danger">* </span>:</label>
                                    <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                            
                                            @foreach ($permissions as $permission)
                                               <li class="list-unstyled">
                                                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}"  {{ $users->hasPermissionTo($permission->name) ? "checked" : " " }}><span>{{ $permission->name }}</span>
                                                </li>
                                            @endforeach
                                    </div>
                                </div><!-- row -->
                                <div class="form-layout-footer mg-t-30 text-center">
                                    <button class="btn btn-info mg-r-5">Add Permission</button>
                                </div>
            
                            </form>
                        </div>
                    </div>
                </div><!-- Row End-->
            </div>
            
        </div>
    </div>
@endsection                