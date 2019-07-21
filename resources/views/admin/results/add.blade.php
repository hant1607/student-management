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
                    {!! Form::label('Subject') !!}
                    <select class="form-control" name="subject_id">
                        <option value="">Please choose subject</option>
                        @foreach($results as $result)
                            <option value="{{$result->subject_id}}">{{$result->subject->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Student Name') !!}
                    <select class="form-control" name="student_id">
                        <option value="">Please choose student</option>
                        @foreach($results as $result)
                            <option value="{{$result->student_id}}">{{$result->student->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label('Mark') !!}
                    {!! Form::text('mark', old('mark'), ['class'=>'form-control', 'placeholder'=>'Please enter mark']) !!}
                </div>

                {!! Form::submit('Add', ['class'=>'btn btn-default']) !!}
                {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
