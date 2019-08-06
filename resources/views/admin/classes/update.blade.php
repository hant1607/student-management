@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Class
                    <small>{{$classData->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                {!! Form::open(['method'=>'POST', 'route'=>['class.update', $classData->id]]) !!}
                <div class="form-group">
                    {!! Form::label('Class Name') !!}
                    {!! Form::text('name', $classData->name, ['class'=>'form-control', 'placeholder'=>'Please enter class name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Faculty') !!}
                    {!! Form::select('faculty_id', $faculty, $classData->faculty_id, ['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection