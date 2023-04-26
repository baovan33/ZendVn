@extends('admin.dashboard')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Danh sách slider</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="col-4">
                    <a href="{{{route('slider.create')}}}" class="btn btn-success ">Thêm mới</a>
                </div>

                    <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action table-bordered">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">Slider Info</th>
                                <th class="column-title">Trạng thái</th>
                                <th class="column-title">Thời gian</th>
                                <th class="column-title">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $key => $slider)
                            <tr class="odd pointer">
                                <td>{{$key+1}}</td>
                                <td width="40%">
                                    <p><strong>Name:</strong> {{$slider->name}}</p>
                                    <p><strong>Description:</strong>{{$slider->description}}</p>
                                    <p><strong>Link:</strong> https://zendvn.com/uu-dai-hoc-phi-tai-zendvn/</p>
                                    <p><img src="{{$slider->thumb}}"
                                            alt="{{$slider->name}}" class="zvn-thumb" style="height: 68px;width: 323px;"
></p>
                                </td>
                                <td><a href="http://proj_news.xyz/admin123/slider/change-status-active/3" type="button" style="background-color: {{$slider->status == 1 ? '#26B99A' : '#d9534f'}}"
                                       class="btn btn-round btn-success">
                                        @if( $slider->status == 1)
                                           <span>Đã kích hoạt</span>
                                         @else
                                            <span>Chưa kích hoạt</span>

                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <p><i class="fa fa-user"></i> {{$slider->user->name}}</p>
                                    <p><i class="fa fa-clock-o"></i> {{$slider->created_at}}</p>
                                </td>

                                <td class="last">
                                    <div class="zvn-box-btn-filter">
                                        @can('update-slider')
                                        <a
                                            href="{{route('slider.edit',$slider)}}" type="button"
                                            class="btn btn-icon btn-success" data-toggle="tooltip" data-placement="top"
                                            data-original-title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @endcan
                                        @can('delete-slider')
                                            <a href="{{route('slider.delete',$slider)}}" type="button" onclick="return confirm('Xoá sẽ không hoàn tác được, bạn vận muốn xoá ?')"
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

                        {{$sliders->links()}}
                    </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
