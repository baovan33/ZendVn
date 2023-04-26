@extends('admin.dashboard')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách Category</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="col-4">
                    @can('create-category')
                    <a href="{{{route('category.create')}}}" class="btn btn-success ">Thêm mới</a>
                    @endcan
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action table-bordered">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">Name</th>
                                <th class="column-title">Parent</th>
                                <th class="column-title">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $key => $category)
                                <tr class="odd pointer">
                                    <td>{{$key+1}}</td>
                                   <td>{{$category->name}}</td>
                                    <td>{{$category->parent_name}}</td>

                                    <td class="last">
                                        <div class="zvn-box-btn-filter">
                                            @can('update-category')
                                                <a href="{{route('category.edit',$category)}}" type="button"
                                                    class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                                    data-original-title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            @endcan
                                            @can('delete-category')
                                                <a href="{{route('category.delete',$category)}}" type="button" onclick="return confirm('Nếu xoá sẽ xoá tất cả danh mục con của danh mục này, bạn vẫn muốn xoá ?')"
                                                   class="btn btn-icon btn-danger btn-delete" data-toggle="tooltip"
                                                   data-placement="top" data-original-title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                             @endcan


                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$categories->links()}}

                    </div>
                </div>

            </div>
        </div>
    </div>
 @endsection
