@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Level</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr class="even gradeC" align="center">
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>
                            @if($user->level == 1)
                                {{"Admin"}}
                            @else
                                {{"Member"}}
                            @endif
                        </td>
                        <td>{{$user->email}}</td>
                        <td class="center">
                            <button><a href="{{route('users.edit', ['user'=>$user])}}">Edit</a></button>
                        </td>
                        <td class="center">
                            <form action="{{route('users.destroy', ['user'=>$user])}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a> Delete</a></button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
