@extends('admin.dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List User</h1>
    </div>
    @if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif
    @if ($errors->any())
        <div class="alert alerta-danger text-center">Đã có lỗi</div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bộ lọc</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6"><a

                            @can('create-user')
                            <a href="{{route('users.create')}}"
                                   type="button" class="btn btn-success">
                                Add User <span class="badge bg-white"> +</span>
                            </a>
                            @endcan

                        </div>
                        <div class="col-md-6">
                            <div class="input-group">

                                <input type="text" class="form-control" name="search_value" value="">
                                <span class="input-group-btn">
                                    <button id="btn-clear" type="button" class="btn btn-success"
                                            style="margin-right: 0px">Xóa tìm kiếm</button>
                                    <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                                    </span>
                                <input type="hidden" name="search_field" value="all">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--box-lists-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action table-bordered">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">Username</th>
                                <th class="column-title">Email</th>
                                <th class="column-title">Level</th>
                                <th class="column-title">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                            <tr class="even pointer">
                                <td class="">{{$key + 1}}</td>
                                <td width="10%">{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role->name}}</td>
                                <td class="last">
                                    <div class="zvn-box-btn-filter">
                                        @can('update-user')
                                        <a
                                            href="{{route('users.edit',$user)}}"
                                            type="button" class="btn btn-icon btn-success" data-toggle="tooltip"
                                            data-placement="top" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @endcan

                                        @can('delete-user')
                                        @if( Auth::user()->id !== $user->id )
                                        <a href="{{route('users.delete',$user)}}" onclick="return confirm('Xoá sẽ không hoàn tác được, bạn vẫn muốn xoá ?')"
                                               type="button" class="btn btn-icon btn-danger btn-delete"
                                               data-toggle="tooltip" data-placement="top"
                                               data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                         @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}

                </div>
            </div>
        </div>
    </div>

@endsection
