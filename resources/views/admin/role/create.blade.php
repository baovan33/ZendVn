@extends('admin.dashboard')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Role</h1>
    </div>
    @if ($errors->any())
        <div class="alert alerta-danger text-center">Đã có lỗi</div>
    @endif
    <form action="{{route('role.store')}}" method="Post">
        @csrf
        <div class="mb-3">
            <label for="">Name:</label>
            <input type="text" name="name" class="form-control"  value="{{old('name')}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3" style="margin-top: 13px">
            <label for="">Permission:</label>
            <table class="table table-bordered">
            @foreach($permissions as $group => $permission)
                <tr>
                    <th> {{$group}}</th>

              @foreach($permission as $item)
                  <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$item->id}}" name="permissions[]">
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            {{$item->name}}
                        </label>
                    </div>
                  </td>
                @endforeach
                </tr>

            @endforeach
            </table>

        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 13px">Them Moi</button>

    </form>
@endsection
