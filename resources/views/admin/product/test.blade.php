@extends('admin.dashboard')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')

<select name="tags[]" multiple="multiple" class="form-control tags_select_choose select2">
    <!-- Lấy các tags từ database và hiển thị ra -->
    <option value="fgdf"></option>

</select>
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
