@extends('admin.dashboard')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif
    <div class="container">

        <div class="row">
        <div class="card">
                <div class="col-8">
                    <h1>Role List</h1>
                </div>
                <div class="col-4">
                    @can('create-role')
                    <a href="{{{route('role.create')}}}" class="btn btn-primary ">Thêm mới</a>
                    @endcan

                </div>

        </div>
            <div>
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Manage</th>


                    </tr>
                    @foreach($roles as $key => $role)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                               @can('permission-role')
                                <a href="{{route('role.permission',$role->id)}}" class="btn btn-primary"> Phân Quyền </a>
                             @endcan
                                @can('update-role')
                                <a href="{{route('role.edit',$role)}}" class="btn btn-success"> Chinh sua </a>
                                @endcan
                                @can('delete-role')
                                <a onclick="return confirm('Xoá role này sẽ xoá tất cả người dùng thuộc role này, bạn vẫn muốn xoá ?')" href="{{route('role.delete',$role)}}" class="btn btn-warning">Xoa</a>
                                @endcan

                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>

@endsection
