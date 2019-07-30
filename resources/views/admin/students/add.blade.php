@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Student
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                {!! Form::open(['method'=>'POST', 'route'=>'students.store', 'enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('Student Name') !!}
                    {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Please enter student name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Class') !!}
                    <select class="form-control" name="class_id">
                        <option value="">Please choose class</option>
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Birthday') !!}
                    {!! Form::date('birthday', old('birthday'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Gender') !!}
                    <select class="form-control" name="gender" value="{{old('gender')}}">
                        <option value="Nam">Nam</option>
                        <option value="Nu">Nu</option>
                    </select>
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
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
