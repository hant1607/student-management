@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{$student->name}}
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'PUT', 'route'=>['students.update', $student->id], 'enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('Student Name') !!}
                    {!! Form::text('name', $student->name, ['class'=>'form-control', 'placeholder'=>'Please enter student name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Class') !!}
                    {!! Form::select('class_id', $class, $student->class_id, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Birthday') !!}
                    {!! Form::date('birthday', $student->birthday, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Gender') !!}
                    {!! Form::select('gender', ['1' => 'Male', '2'=>'Female'],$student->gender, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Phone') !!}
                    {!! Form::text('phone', $student->phone, ['class'=>'form-control', 'placeholder'=>'Please enter phone number']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Image') !!}
                    {!! Form::file('image') !!}
                    <img width="100px" height="70px" src="upload/{{$student->image}}">
                </div>
                {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection