@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="page-header">Student
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->


            {!! Form::open(['method'=>'POST', 'route'=>'students.store', 'enctype'=>'multipart/form-data']) !!}
            <div class="col-lg-7" style="padding-bottom:120px">
                <div class="form-group">
                    {!! Form::label('Student Name') !!}
                    {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Please enter student name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Class') !!}
                    {!! Form::select('class_id', ['' => 'Please choose faculty'] + $class, old('class_id'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Birthday') !!}
                    {!! Form::date('birthday', old('birthday'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Gender') !!}
                    {!! Form::select('gender', ['' => 'Please choose gender']+['1' => 'Male', '2'=>'Female'], old('gender'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Phone') !!}
                    {!! Form::text('phone', old('phone'), ['class'=>'form-control', 'placeholder'=>'Please enter phone number']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Image') !!}
                    {!! Form::file('image') !!}
                </div>
                {!! Form::submit('Add', ['class'=>'btn btn-success']) !!}
                {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
            {!! Form::close() !!}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
