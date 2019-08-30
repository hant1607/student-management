@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Roles
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($roles as $role)
                    <tr class="even gradeC" align="center">
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td class="center">
                            <button><a href="{{route('roles.edit', $role->id)}}">Edit</a></button>
                        </td>

                        <td class="center">
                            <form action="{{route('roles.destroy', $role->id)}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit"
                                        onclick="return confirm('Do you want to delete this field?')">
                                    <a>Delete</a></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
{{--            {{$users->links()}}--}}
        </div>
    </div>
@endsection

