@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Role
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'POST', 'route'=>'roles.store']) !!}
                <div class="form-group">
                    {!! Form::label('Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control', 'placeholder'=>'Please enter name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Permission:') !!}<br>
                    @foreach($permission as $value)
                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}
                        <br/>
                    @endforeach
                </div>
                {!! Form::submit('Add', ['class'=>'btn btn-success']) !!}
                {!! Form::reset('Reset', ['class'=>'btn btn-default']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

