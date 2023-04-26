<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
    }
    public function index(){
        $users = User::paginate(5);
        return view('admin.user.index',compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('admin.user.create',compact('roles'));

    }

    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email|email',
                'password' => 'required',
                'role' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }]
            ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã được sử dụng',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Mật khẩu không được để trống',
                'role.required' => 'Role không được để trống'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);
        return redirect()->route('users.index')->with('msg','Thêm người dùng thành công');
    }

    public function edit(User $user) {
        $roles = Role::all();
        return view('admin.user.edit', compact('user','roles'));
    }

    public function update(User $user, Request $request) {

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$user->id,
                'password' => 'required',
                'role' => ['required', function ($attribute, $value, $fail) {
                    if ($value == 0) {
                        $fail('Vui lòng chọn nhóm');
                    }
                }]
            ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required' => 'Email không được để trống',
                'email.unique' => 'Email đã được sử dụng',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Mật khẩu không được để trống',
                'role.required' => 'Role không được để trống'
            ]
        );

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('msg','Cap nhap nguoi dùng thành công');
    }

    public function delete(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('msg','Xoa nguoi dùng thành công');

    }
}
