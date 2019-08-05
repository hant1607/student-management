@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'POST', 'route'=>'users.store']) !!}
                <div class="form-group">
                    {!! Form::label('User Name') !!}
                    {!! Form::text('username', old('name'), ['class'=>'form-control', 'placeholder'=>'Please enter User Name']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Level') !!}
                    {!! Form::radio('level', '1', ['class' => 'radio-inline']) !!} Admin
                    {!! Form::radio('level', '0', ['class' => 'radio-inline']) !!} Member
                </div>
                <div class="form-group">
                    {!! Form::label('Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>'Please enter email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Password') !!}
                    {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'Please enter password']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Re-enter Password') !!}
                    {!! Form::password('passwordAgain', ['class'=>'form-control', 'placeholder' => 'Please re-enter password']) !!}
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
