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
{{--                {!! Form::open(['method'=>'PUT', 'route'=>['users.update', 'user'=>$user]]) !!}--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('Name') !!}--}}
{{--                    {!! Form::text('name', $user->name, ['class'=>'form-control', 'placeholder'=>'Please enter User Name']) !!}--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('Level') !!}--}}
{{--                    <label class="radio-inline">--}}
{{--                        <input name="level" value="1" type="radio"--}}
{{--                        @if($user->level == 1)--}}
{{--                            {{'checked'}}--}}
{{--                                @endif--}}
{{--                        >Admin--}}
{{--                    </label>--}}
{{--                    <label class="radio-inline">--}}
{{--                        <input name="level" value="0" type="radio"--}}
{{--                        @if($user->level == 0)--}}
{{--                            {{'checked'}}--}}
{{--                                @endif--}}
{{--                        >Member--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('Email') !!}--}}
{{--                    {!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder'=>'Please enter email'], 'readonly') !!}--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('Password') !!}--}}
{{--                    {!! Form::password('password',$user->password, ['class'=>'form-control', 'placeholder' => 'Please enter password']) !!}--}}
{{--                    <input class="form-control" type="password" name="password" placeholder="Please enter password" placeholder="Please re-enter password" value="{{$user->password}}">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('Re-enter Password') !!}--}}
{{--                    {!! Form::password('passwordAgain',$user->password, ['class'=>'form-control', 'placeholder' => 'Please re-enter password']) !!}--}}
{{--                </div>--}}
{{--                {!! Form::submit('Edit', ['class'=>'btn btn-default']) !!}--}}
{{--                {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}--}}
{{--                {!! Form::close() !!}--}}
                <form action="{{route('users.update', ['user'=>$user])}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter User Name"
                               value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
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
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Please enter email"
                               value="{{$user->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Please enter password"
                               value="{{$user->password}}">
                    </div>
                    <div class="form-group">
                        <label>Re-enter Password</label>
                        <input class="form-control" type="password" name="passwordAgain"
                               placeholder="Please re-enter password" value="{{$user->password}}">
                        <label></label>
                    </div>

                    <button type="submit" class="btn btn-default">Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection