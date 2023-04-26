@extends('admin.dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Đã có lỗi</div>
    @endif
    <form method="POST" action="{{route('category.update', $category)}}" accept-charset="UTF-8"  class="form-horizontal form-label-left" id="main-form">
        @csrf
        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="name" type="text"  id="name" value="{{$category->name}}">
                @error('name')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>

        </div>

        <div class="form-group">
            <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Danh mục cha</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-6 col-xs-12" id="parent_id" name="parent_id">
                    <option value="0" selected="selected">Không thuộc danh mục cha nào</option>
                    @foreach($data as $item)
                        <option value="{{$item['id']}}" {{$category->id == $item['id'] ? 'selected' : false}} >{{$item['name']}}</option>
                    @endforeach

                </select>
                @error('parent_id')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <input class="btn btn-success" type="submit" value="Save">
            </div>
        </div>
    </form>
@endsection
