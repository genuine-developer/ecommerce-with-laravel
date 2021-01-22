<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function Role(){
        //For Add Role
        //$role = Role::create(['name' => 'Subscriber']);
        //For Add Permission
        //$permission = Permission::create(['name' => 'restore category']);


        return view('backend.users.role',
            [
                'roles' => Role::all(),
                'permissions' => Permission::all(),
            ]
        );
    }

    /**
     * Give Role Permission
     */
    function RoleAddPermission(Request $request){
        $role_name = $request->role_name;
        $permission_name = $request->permission_name;

        $role = Role::where('name', $role_name)->first();
        //Multiple Permission
        $role->givePermissionTo($permission_name);
        //Single Permission
        //$role->syncPermissions($permission_name);
        return back();
    }

    /**
     * Give Role user
     */
    function UserAddRole(Request $request){
        
        $role_name = $request->role_name;
        $user_id = $request->user_id;

        $user = User::findOrFail($user_id);
        //return $user;
        //Multiple Permission
        $user->syncRoles($role_name);
        //Single Permission
        //$role->syncPermissions($permission_name);
        return back();
    }
}
