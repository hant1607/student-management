@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Class
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">

                {!! Form::open(['method'=>'POST', 'route'=>'class.store']) !!}
                    <div class="form-group">
                        {!! Form::label('Class Name') !!}
                        {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Please enter class name']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Faculty') !!}
                        <select class="form-control" name="faculty_id">
                            <option value="">Please choose faculty</option>
                            @foreach($facultyData as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
{{--                        {!! Form::select('faculty_id', $facultyData, $facultyData->name, ['class'=>'form-control']) !!}--}}
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
