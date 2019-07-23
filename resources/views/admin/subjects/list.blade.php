@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Subject
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                <tr class="even gradeC" align="center">
                    <td>{{$subject->id}}</td>
                    <td>{{$subject->name}}</td>
                    <td class="center">
                        <button type="submit"><a href="{{route('subjects.edit', ['subject'=>$subject])}}">Edit</a></button>
                    </td>
                    <td class="center">
                        {!! Form::open(['method'=>'DELETE', 'route'=>['subjects.destroy', 'subject'=>$subject]]) !!}
                        <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a>Delete</a></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    @endsection
