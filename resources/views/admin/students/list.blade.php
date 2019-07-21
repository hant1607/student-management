@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Students
                    <small>List</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                <tr class="even gradeC" align="center">
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    @if(empty($student->class_id))
                        <td>{{''}}</td>
                    @else
                        <td>{{$student->class->name}}
                    @endif
                    <td>{{$student->birthday}}</td>
                    <td>{{$student->gender}}</td>
                    <td><img width="100px" height="70px" src="upload/{{$student->image}}"></td>
                    <td class="center"><button><a href="{{route('students.edit', ['student' => $student])}}">Edit</a></button></td>
                    <td class="center">
                        <form action="{{route('students.destroy', ['student'=>$student])}}" method="post">
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
