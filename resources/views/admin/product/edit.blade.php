@extends('admin.dashboard')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('admin/product/add/add.css') }}">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger text-center">Đã có lỗi</div>
    @endif
    <form method="POST" action="{{route('product.update',$product)}}" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
        @csrf
        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="name" type="text"  id="name" value="{{$product->name}}">
                @error('name')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control col-md-6 col-xs-12" name="price" type="text"  id="Price" value="{{$product->price}}">
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
                        <option value="{{$category['id']}}" {{$product->category_id == $category['id'] ? 'selected' : false }}>{{$category['name']}}</option>
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
                <textarea class="form-control col-md-6 col-xs-12" id="myTextArea"  name="content" type="text" > {{$product->content}}</textarea>
                @error('content')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="tags" class="control-label col-md-3 col-sm-3 col-xs-12">Tag</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="tags[]" multiple="multiple" class="form-control tags_select_choose select2">
                       @foreach($product->tags as $tag)
                        <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                      @endforeach
                </select>
                @error('tags')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control-file col-md-6 col-xs-12" name="feature_image_path" type="file" id="image">
                <div class="col-md-12">
                    <div class="row">
                        <img src="{{$product->feature_image_path}}" class="feature_image_path" alt="">
                    </div>
                </div>
                @error('feature_image_path')
                <span style="color: red">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image_detail" class="control-label col-md-3 col-sm-3 col-xs-12">Image detail</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input class="form-control-file col-md-6 col-xs-12" name="image_path[]" multiple type="file" id="image_path">
                <div class="col-md-12">
                    <div class="row">
                        @foreach($product->images as $productImageDetail)
                            <div class="col-md-3">
                                <img class="image_detail_product" src="{{$productImageDetail->image_path}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(".tags_select_choose").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    </script>
@endsection
