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
                    {!! Form::label('username', __('User Name')) !!}
                    {!! Form::text('username', old('name'), ['class'=>'form-control', 'placeholder'=>__('Please enter User Name')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', __('Email')) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>__('Please enter Email')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', __('Password')) !!}
                    {!! Form::password('password', ['class'=>'form-control', 'placeholder' => __('Please enter password')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('confirm_password', __('Confirm Password')) !!}
                    {!! Form::password('confirm_password', ['class'=>'form-control', 'placeholder' => __('Please enter confirm password')]) !!}
                </div>
                <div class="form-group">
                     {!! Form::label(__('Role')) !!}
                    @if(\Illuminate\Support\Facades\Auth::user()->getRoleNames()->first() == 'admin')
                        {!! Form::select('roles', $roles, ['class'=>'form-control']) !!}
                    @else
                        {!! Form::select('roles', $userRole, ['class'=>'form-control']) !!}
                    @endif
                </div>
                {!! Form::submit(__('Add'), ['class'=>'btn btn-success']) !!}
                {!! Form::reset(__('Reset'), ['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

