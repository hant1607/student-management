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
                    <select class="form-control" name="student_id">
                        <option value="{{$result->student_id}}">{{$result->student->name}}</option>
                        @foreach($students as $student)
                            <option value="{{$student->id}}">{{$student->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Subject') !!}
                    <select class="form-control" name="subject_id">
                        <option value="{{$result->subject_id}}">{{$result->subject->name}}</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Mark') !!}
                    {!! Form::text('mark', $result->mark, ['class'=>'form-control', 'placeholder'=>'Please enter mark']) !!}
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