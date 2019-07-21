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
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Student</th>
                    <th>Mark</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr class="even gradeC" align="center">
                        <td>{{$result->id}}</td>
                        <td>{{$result->subject->name}}</td>
                        <td>{{$result->student->name}}</td>
                        <td>{{$result->mark}}</td>
                        <td class="center"><button><a
                                    href="{{route('results.edit', ['result'=>$result])}}">Edit</a></button></td>
                        <td class="center">
                            <form action="{{route('results.destroy', ['result'=>$result])}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a>Delete</a></button>
                            </form>
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
