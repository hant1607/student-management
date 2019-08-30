@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Role
                    <small>Edit</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                {!! Form::open(['method'=>'PUT', 'route'=>['roles.update', $role->id]]) !!}
                <div class="form-group">
                    {!! Form::label('Name:') !!}
                    {!! Form::text('name', $role->name, ['class'=>'form-control', 'placeholder'=>'Please enter Name']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('Permission:') !!}<br>
                    @foreach($permission as $value)
                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermission) ? true : false, array('class' => 'name')) }}
                        {{ $value->name }}
                        <br/>
                    @endforeach
                </div>
            {!! Form::submit('Edit', ['class'=>'btn btn-success']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
