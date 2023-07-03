<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RoleController extends Controller
{
    public function allPermission()
    {
        $permissions = Permission::paginate(10);

        return view('backend.permission.index', compact('permissions'));
    }

    public function createPermission()
    {
        return view('backend.permission.create');
    }

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'group_name' => ['required', 'string', 'in:pos,employee,customer,supplier,salary,attendence,category,product,expense,orders,stock,roles']
        ]);

        Permission::create($request->all());

        $notification = [
            'message' => 'Permisison inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('permissions.index')->with($notification);
    }

    public function editPermission(Permission $permission)
    {
        return view('backend.permission.edit', compact('permission'));
    }

    public function updatePermission(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'group_name' => ['required', 'string', 'in:pos,employee,customer,supplier,salary,attendence,category,product,expense,orders,stock,roles']
        ]);

        $permission->update($request->all());

        $notification = [
            'message' => 'Permisison updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('permissions.index')->with($notification);
    }

    public function deletePermission(Permission $permission)
    {
        $permission->delete();

        $notification = [
            'message' => 'Permisison deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('permissions.index')->with($notification);
    }



    public function allRole()
    {
        $roles = Role::paginate(10);

        return view('backend.role.index', compact('roles'));
    }

    public function createRole()
    {
        return view('backend.role.create');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        Role::create($request->all());

        $notification = [
            'message' => 'Role inserted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('roles.index')->with($notification);
    }

    public function editRole(Role $role)
    {
        return view('backend.role.edit', compact('role'));
    }

    public function updateRole(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $role->update($request->all());

        $notification = [
            'message' => 'Role updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('roles.index')->with($notification);
    }

    public function deleteRole(Role $role)
    {
        $role->delete();

        $notification = [
            'message' => 'Role deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('roles.index')->with($notification);
    }

    public function attachPermission(Request $request)
    {
        if ($request->isMethod("post")) {
            $role = Role::findOrFail($request->role);

            $permissions = $request->permission;
            $role->syncPermissions($permissions);

            $notification = [
                'message' => 'Role updated successfully',
                'alert-type' => 'success'
            ];

            return redirect()->route('roles.with.permission')->with($notification);
        }

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('backend.role.attach_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function allRolesWithPermissions()
    {
        $roles = Role::paginate(10);
        return view('backend.role.roles_with_permission', compact('roles'));
    }

    public function editPermissioninRole(Role $role)
    {
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.role.edit_permission', compact('role', 'permissions', 'permission_groups'));
    }


    public function updatePermissioninRole(Role $role, Request $request)
    {
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $role->permissions()->delete();
        }

        $notification = [
            'message' => 'Role permission updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('roles.with.permission')->with($notification);
    }
}
