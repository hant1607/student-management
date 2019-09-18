@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Subject
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'POST', 'route'=>'subjects.store']) !!}
                <div class="form-group">
                    {!! Form::label('Subject name') !!}
                    {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'Please enter Subject Name']) !!}
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
