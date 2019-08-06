@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Result
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'POST', 'route'=>'results.store']) !!}
                <div class="form-group">
                    {!! Form::label('Student Name') !!}
                    {!! Form::select('student_id', [''=>'Please choose student']+$student, old('student_id'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Subject') !!}
                    {!! Form::select('subject_id', [''=>'Please choose subject']+$subject, old('subject_id'), ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Mark') !!}
                    {!! Form::text('mark', old('mark'), ['class'=>'form-control', 'placeholder'=>'Please enter mark']) !!}
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
