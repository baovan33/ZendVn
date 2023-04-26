@extends('admin.dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Slider</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Đã có lỗi</div>
    @endif
    <form method="POST" action="{{route('slider.update',$slider)}}" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
        @csrf
        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="name" type="text" value="{{$slider->name}}" id="name">
                @error('name')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="description" type="text" value="{{$slider->description}}" id="description">
                @error('description')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-6 col-xs-12" id="status" name="status">
                    <option value="1" {{ $slider->status == 1 ? 'selected' : false }} selected="selected">Kích hoạt</option>
                    <option value="0" {{ $slider->status == 0 ? 'selected' : false }}>Chưa kích hoạt</option>
                </select>
                @error('status')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="link" type="text" value="{{$slider->link}}" id="link">
                @error('link')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>

        </div>
        <div class="form-group">
            <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb" placeholder="Chọn file ảnh của bạn">
                <p> Không chọn ảnh nếu muốn giữ nguyên ảnh cũ </p>
                <div class="col-md-12">
                    <div class="row">
                        <img src="{{$slider->thumb}}" alt="" style=" height: 160px; width: 70%;">
                    </div>
                </div>
                @error('thumb')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>

        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <input class="btn btn-success" type="submit" value="Save">
            </div>
        </div>
    </form>
@endsection
