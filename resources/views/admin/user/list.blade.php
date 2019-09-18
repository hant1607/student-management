@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{__('Users')}}
                    <small>{{__('List')}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr align="center">
                    <th>{{__('ID')}}</th>
                    <th>{{__('User Name')}}</th>
                    <th>{{__('Role')}}</th>
                    <th>{{__('Email')}}</th>
                    <th>{{__('Edit')}}</th>
                    <th>{{__('Delete')}}</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr class="even gradeC" align="center">
                        <td>{{$user->id}}</td>
                        <td>{{$user->username}}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $role)
                                    {{ $role }}
                                @endforeach
                            @endif
                        </td>
                        <td>{{$user->email}}</td>
                        <td class="center">
                            @can('user-edit')
                                <button><a href="{{route('users.edit', ['user'=>$user])}}">{{__('Edit')}}</a></button>
                            @endcan
                        </td>
                        <td class="center">
                            @can('user-delete')
                                <form action="{{route('users.destroy', ['user'=>$user])}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" onclick="return confirm('Do you want to delete this field?')">
                                        <a>
                                            {{__('Delete')}}</a></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
@endsection
