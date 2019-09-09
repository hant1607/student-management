@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{__('User')}}
                    <small>{{__('Add')}}</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'POST', 'route'=>'users.store']) !!}
                <div class="form-group">
                    <label for="username">{{__('User Name')}}</label>
                    <input class="form-control" placeholder="{{__('Please enter User Name')}}" name="username" type="text" id="username" value="{{old('username')}}">
{{--                    {!! Form::label('username', 'User Name') !!}--}}
{{--                    {!! Form::text('username', old('name'), ['class'=>'form-control', 'placeholder'=>'Please enter User Name']) !!}--}}
                </div>
                <div class="form-group">
                    <label for="email">{{__('Email')}}</label>
                    <input class="form-control" placeholder="{{__('Please enter Email')}}" name="email" type="email" id="email" value="{{old('email')}}">
{{--                    {!! Form::label('email', 'Email') !!}--}}
{{--                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>'Please enter email']) !!}--}}
                </div>
                <div class="form-group">
                    <label for="password">{{__('Password')}}</label>
                    <input class="form-control" placeholder="{{__('Please enter password')}}" name="password" type="password" id="password">
{{--                    {!! Form::label('password', 'Password') !!}--}}
{{--                    {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'Please enter password']) !!}--}}
                </div>
                <div class="form-group">
                    <label for="confirm_password">{{__('Confirm Password')}}</label>
                    <input class="form-control" placeholder="{{__('Please enter confirm password')}}" name="confirm_password" type="password" id="confirm_password">
{{--                    {!! Form::label('confirm_password', 'Confirm Password') !!}--}}
{{--                    {!! Form::password('confirm_password', ['class'=>'form-control', 'placeholder' => 'Please enter confirm password']) !!}--}}
                </div>
                <div class="form-group">
                    <label for="">{{__('Role')}}</label>
{{--                     {!! Form::label('Role') !!}--}}
                    @if(\Illuminate\Support\Facades\Auth::user()->getRoleNames()->first() == 'admin')
                        {!! Form::select('roles', $roles, ['class'=>'form-control']) !!}
                    @else
                        {!! Form::select('roles', $userRole, ['class'=>'form-control']) !!}
                    @endif
                </div>
                <input class="btn btn-success" type="submit" value="{{__('Add')}}">
                <input class="btn btn-default" type="reset" value="{{__('Reset')}}">
{{--                {!! Form::submit('Add', ['class'=>'btn btn-success']) !!}--}}
{{--                {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}--}}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

