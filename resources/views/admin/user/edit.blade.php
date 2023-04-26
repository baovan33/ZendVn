@extends('admin.dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Đã có lỗi</div>
    @endif
    <form action="{{route('users.update',$user)}}" method="Post">
        @csrf
        <div class="mb-3">
            <label for="">Ten</label>
            <input type="text" name="name" class="form-control" placeholder="Ten..." value="{{$user->name}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email..." value="{{$user->email}}">
            @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Mat Khau</label>
            <input type="password" name="password" class="form-control" placeholder="Mat Khau..."  >
            @error('password')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Role</label>
            <select name="role" id="" class="form-control">
                <option value="0">Chon Role</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}" {{$user->role_id == $role->id || old('role') == $role->id ? 'selected' : false}}> {{$role->name}}</option>
                @endforeach
            </select>
            @error('role')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Cap nhap</button>
    </form>
@endsection
