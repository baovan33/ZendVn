@extends('admin.dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update Role</h1>
    </div>
    @if ($errors->any())
        <div class="alert alerta-danger text-center">Đã có lỗi</div>
    @endif
    <form action="{{route('role.update', $role->id)}}" method="Post">
        @csrf
        <div class="mb-3">
            <label for="">Name:</label>
            <input type="text" name="name" class="form-control"  value="{{old('name')}} {{$role->name}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary" style="margin-top: 13px">Cap nhap</button>

    </form>
@endsection
