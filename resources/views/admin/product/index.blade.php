@extends('admin.dashboard')


@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Product</h1>
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
                    <h2>Danh sách</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="col-4">
                    <a href="{{{route('product.create')}}}" class="btn btn-success ">Thêm mới</a>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action table-bordered">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">Name</th>
                                <th class="column-title">Price</th>
                                <th class="column-title">Image</th>
                                <th class="column-title">Danh mục</th>
                                <th class="column-title">Hành động</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr class="even pointer">
                                    <td class="">{{$key + 1}}</td>
                                    <td width="10%">{{$product->name}}</td>
                                    <td>{{number_format($product->price)}}</td>
                                    <td style="width: 15%">
                                        <img src="{{$product->feature_image_path}}" alt="" style="width: 200px; height: 130px; object-fit: cover;">
                                    </td>
                                    <td>{{$product->category->name}}</td>

                                    <td class="last">
                                        <div class="zvn-box-btn-filter">
{{--                                            @can('update-user')--}}
                                                <a
                                                    href="{{route('product.edit',$product)}}"
                                                    type="button" class="btn btn-icon btn-success" data-toggle="tooltip"
                                                    data-placement="top" data-original-title="Edit">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
{{--                                            @endcan--}}

{{--                                            @can('delete-user')--}}
{{--                                                @if( Auth::user()->id !== $product->id )--}}
                                                    <a href="" onclick="return confirm('Xoá sẽ không hoàn tác được, bạn vẫn muốn xoá ?')"
                                                       type="button" class="btn btn-icon btn-danger btn-delete"
                                                       data-toggle="tooltip" data-placement="top"
                                                       data-original-title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
{{--                                                @endif--}}
{{--                                            @endcan--}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                {{$products->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection


