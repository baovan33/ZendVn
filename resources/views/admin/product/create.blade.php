@extends('admin.dashboard')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

    <style>
        .tagify--noTags {
            background-color: #fff ;
        }
    </style>

@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Đã có lỗi</div>
    @endif
    <form method="POST" action="{{route('product.postCreate')}}" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
        @csrf
        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="name" type="text"  id="name">
                @error('name')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="price" type="text"  id="Price">
                @error('price')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control col-md-6 col-xs-12" id="category" name="category_id">
                    @foreach( $getCategory as $category)
                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                    @endforeach
                </select>
                @error('category_id')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="content" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control col-md-6 col-xs-12" id="myTextArea" name="content" type="text" > </textarea>
                @error('content')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="tags" class="control-label col-md-3 col-sm-3 col-xs-12">Tag</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="tags[]" id="tags" value="" multiple="multiple" />

                @error('tags')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control-file col-md-6 col-xs-12" name="feature_image_path" type="file" id="image">
                @error('feature_image_path')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image_detail" class="control-label col-md-3 col-sm-3 col-xs-12">Image detail</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control-file col-md-6 col-xs-12" name="image_path[]" multiple type="file" id="image_path">
                @error('image_path')
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

    <script>
        const input = document.querySelector('#tags');
        new Tagify(input, {
            delimiters: ', ', // phân cách các tag bằng dấu phẩy và khoảng trắng
            maxTags: 5, // giới hạn số lượng tag được thêm vào
            dropdown: {
                enabled: 1, // cho phép hiển thị gợi ý tag
                maxItems: 10, // giới hạn số lượng tag được hiển thị trong danh sách gợi ý
                highlightFirst: true // tự động đánh dấu tag đầu tiên trong danh sách gợi ý
            }
        });
    </script>

    <script>
    const tags = input.value.split(', ');
    </script>


@endsection
