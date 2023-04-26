@extends('admin.dashboard')
@section('content')
    <form action="{{route('role.PostPermission',$role->id)}}" method="post">
        <h3>Phan quyen cho nhom {{$role->name}}</h3>
        @csrf
        <div class="mb-3" style="margin-top: 13px">
        <label for="">Permission:</label>
        <table class="table table-bordered">
            @foreach($permissions as $group => $permission)
                <tr>
                    <th> {{$group}}</th>

                    @foreach($permission as $item)
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$item->id}}" {{$role->permissions->contains('name',$item->name )  ? 'checked' : false}} name="permissions[]">
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
