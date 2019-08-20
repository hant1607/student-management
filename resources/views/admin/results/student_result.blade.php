@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Result
                    <small>@if(!empty($results->student_id))
                            {{$results->student->name}}
                        @endif</small>
                </h1>
            </div>

            @can('can-delete', 'user')
                <div class="col-sm-2">
                    <button type="button" style="margin-bottom: 20px;" class="btn btn-success"
                            onclick="location.href='{{route('results.addResult', $id)}}'">+ Add mark
                    </button>
                </div>
        @endcan
        <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Mark</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)

                    <tr class="even gradeC" align="center">
                        <td>{{$result->id}}</td>
                        <td>{{$result->student->name}}</td>
                        <td>{{$result->subject->name}}</td>
                        <td>{{$result->mark}}</td>
                        <td class="center">
                            <button><a
                                        href="{{route('results.edit', ['result'=>$result])}}">Edit</a></button>
                        </td>
                        <td class="center">
                            {!! Form::open(['method'=>'DELETE', 'route'=>['results.destroy', 'result'=>$result]]) !!}
                            <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a>Delete</a>
                            </button>
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