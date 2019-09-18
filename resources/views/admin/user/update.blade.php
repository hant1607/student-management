@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'PUT', 'route'=>['users.update', 'user'=>$user]]) !!}
                <div class="form-group">
                    {!! Form::label('username', 'User Name') !!}
                    {!! Form::text('username', $user->username, ['class'=>'form-control', 'placeholder'=>'Please enter User Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder'=>'Please enter email', 'readonly'=>'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {{--                    {!! Form::password('password', $user->password, ['class'=>'form-control', 'placeholder' => 'Please enter password']) !!}--}}
                    <input class="form-control" type="password" name="password" id="password"
                           placeholder="Please enter password" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    {!! Form::label('confirm_password', 'Confirm Password') !!}
                    {{--                    {!! Form::password('passwordAgain',$user->password, ['class'=>'form-control', 'placeholder' => 'Please re-enter password']) !!}--}}
                    <input class="form-control" type="password" name="confirm_password" id="confirm_password"
                           placeholder="Please enter confirm password" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    {!! Form::label('Role') !!}
                    {!! Form::select('roles', $roles, $userRole, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    @if(!empty($otherPermissions))
                        {!! Form::label('Bonus Permission') !!}<br>
                        @foreach($otherPermissions as $value)
                            {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $userPermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}
                            <br/>
                        @endforeach
                    @endif
                </div>
                {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection