@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Result
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'PUT', 'route'=>['results.update', 'result'=>$result]]) !!}
                <div class="form-group">
                    {!! Form::label('Student Name') !!}
                    {!! Form::select('student_id', [''=>'Please choose student']+$student, $result->student_id, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Subject') !!}
                    {!! Form::select('subject_id', [''=>'Please choose subject']+$subject, $result->subject_id, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Mark') !!}
                    {!! Form::text('mark', $result->mark, ['class'=>'form-control', 'placeholder'=>'Please enter mark']) !!}
                </div>
                {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection