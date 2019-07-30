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
                    <select class="form-control" name="faculty_id">
                        @if($classData->faculty)
                            <option value="{{$classData->faculty_id}}">{{$classData->faculty->name}}</option>
                        @endif
                        @foreach($facultyData as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>

                {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection