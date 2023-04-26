<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('group');
        return view('admin.role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required|unique:roles',
        ]);

        $role = Role::create(['name' => $request->name]);
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);
        return redirect()->route('role.index')->with('msg','Thêm thanh cong');

    }
    public function edit(Role $role ) {
        return view('admin.role.edit',compact('role'));
    }
    public function update(Request $request, Role $role) {
        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
        ]);

        $role->update($request->all());
        return redirect()->route('role.index')->with('msg','Cap nhap thanh cong');
    }
    public function delete(Role $role) {
        $role->delete();
        return redirect()->route('role.index')->with('msg','Xoa thanh cong');

    }
    public function permission($id) {
        $role = Role::find($id);
        $permissions = Permission::all()->groupBy('group');
        return view('admin.role.permission',compact('permissions','role'));
    }

    public function PostPermission(Request $request, $id) {
        $role = Role::find($id);
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);

        return redirect()->route('role.index')->with('msg','Phan quyen thanh cong');

    }
}
