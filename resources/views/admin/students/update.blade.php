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
                    <select class="form-control" name="class_id">
                        @if($student->class)
                            <option value="{{$student->class_id}}">{{$student->class->name}}</option>
                        @endif
                        @foreach($classes as $class)
                            <option value="{{$class->id}}">{{$class->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Birthday') !!}
                    {!! Form::date('birthday', $student->birthday, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Gender') !!}
                    <select class="form-control" name="gender">
                        <option value="{{$student->gender}}">{{$student->gender}}</option>
                        <option value="Nam">Nam</option>
                        <option value="Nu">Nu</option>
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Image') !!}
                    {!! Form::file('image') !!}
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