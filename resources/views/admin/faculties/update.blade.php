@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Faculty
                    <small>{{$facultyData->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'POST', 'route'=>['faculty.update', $facultyData->id]]) !!}
                <div class="form-group">
                    {!! Form::label('Faculty Name') !!}
                    {!! Form::text('name', $facultyData->name, ['class'=>'form-control', 'placeholder'=>'Please enter faculty name']) !!}
                </div>
                {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection