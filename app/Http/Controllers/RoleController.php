<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('admin.roles.list', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permissions = Permission::get();
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            return $permission->group;
        });
        return view('admin.roles.create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['guard_name' => 'admins', 'name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('admin.roles.list', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            return $permission->group;
        });
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions', 'groupedPermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
