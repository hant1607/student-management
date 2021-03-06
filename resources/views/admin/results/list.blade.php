@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Result
                    <small>List</small>
                </h1>
            </div>
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
                            @can('result-edit')
                                <button><a
                                            href="{{route('results.edit', $result->id)}}">Edit</a></button>
                            @endcan
                        </td>
                        <td class="center">
                            @can('result-delete')
                                {!! Form::open(['method'=>'DELETE', 'route'=>['results.destroy', $result->id]]) !!}
                                <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a>Delete</a>
                                </button>
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $results->links() !!}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
