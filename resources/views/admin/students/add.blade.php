@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header">{{__('Student')}}
                    <small>{{__('Add')}}</small>
                </h1>
            </div>
            <div class="col-lg-5" style="margin-left: 5%">
                <h1 class="page-header">{{__('User')}}
                    <small>{{__('Add')}}</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->


            {!! Form::open(['method'=>'POST', 'route'=>'students.store', 'enctype'=>'multipart/form-data']) !!}
            <div class="col-lg-6" style="padding-bottom:120px">
                <div class="form-group">
                    {!! Form::label('name', __('Student Name')) !!}
                    {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>__('Please enter student name')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(__('Class')) !!}
                    {!! Form::select('class_id', ['' => __('Please choose class')] + $class, old('class_id'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('birthday', __('Birthday')) !!}
                    {!! Form::date('birthday', old('birthday'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(__('Gender')) !!}
                    {!! Form::select('gender', ['' => __('Please choose gender')]+['1' => 'Male', '2'=>'Female'], old('gender'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone', __('Phone')) !!}
                    {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'placeholder'=>__('Please enter phone number')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label(__('Image')) !!}
                    {!! Form::file('image') !!}
                </div>
            </div>

            <div class="col-lg-5" style="padding-bottom:120px; margin-left: 5%">
                <div class="form-group">
                    {!! Form::label('username', __('User Name')) !!}
                    {!! Form::text('username', old('username'), ['class'=>'form-control', 'placeholder'=>__('Please enter User Name')]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
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
                {!! Form::submit(__('Add'), ['class'=>'btn btn-success']) !!}
                {!! Form::reset(__('Reset'), ['class'=>'btn btn-default']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
