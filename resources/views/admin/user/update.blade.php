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
                    {!! Form::label('Name') !!}
                    {!! Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>'Please enter User Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Level') !!}
                    <label class="radio-inline">
                        <input name="level" value="1" type="radio"
                        @if($user->level == 1)
                            {{'checked'}}
                                @endif
                        >Admin
                    </label>
                    <label class="radio-inline">
                        <input name="level" value="0" type="radio"
                        @if($user->level == 0)
                            {{'checked'}}
                                @endif
                        >Member
                    </label>
                </div>
                <div class="form-group">
                    {!! Form::label('Email') !!}
                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder'=>'Please enter email', 'readonly'=>'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Password') !!}
{{--                    {!! Form::password('password', $user->password, ['class'=>'form-control', 'placeholder' => 'Please enter password']) !!}--}}
                    <input class="form-control" type="password" name="password" placeholder="Please enter password" placeholder="Please re-enter password" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    {!! Form::label('Re-enter Password') !!}
{{--                    {!! Form::password('passwordAgain',$user->password, ['class'=>'form-control', 'placeholder' => 'Please re-enter password']) !!}--}}
                    <input class="form-control" type="password" name="passwordAgain"
                           placeholder="Please re-enter password" value="{{$user->password}}">
                </div>
                {!! Form::submit('Edit', ['class'=>'btn btn-default']) !!}
                {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection