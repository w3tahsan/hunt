<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function role_manager(){
        $permissions = Permission::all();
        $roles = Role::all();
        $users = User::all();
        return view('backend.role.role', [
            'permissions'=> $permissions,
            'roles'=> $roles,
            'users'=> $users,
        ]);
    }
    function permission_store(Request $request){
        Permission::create(['name' => $request->permission_name]);
        return back();
    }
    function role_store(Request $request){
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission_name);
        return back();
    }
    function assign_role(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role_id);

        return back();
    }

    function remove_role($id){
        $user = User::find($id);
        $user->syncRoles([]);
        $user->syncPermissions([]);

        return back();
    }
    function edit_role($id){
        $permissions = Permission::all();
        $role = Role::find($id);
        return view('backend.role.edit_role', [
            'role'=>$role,
            'permissions'=> $permissions,
        ]);
    }

    function update_role(Request $request){
        $role = Role::find($request->role_id);
        $role->syncPermissions([$request->permission_name]);
        return back();
    }
}
