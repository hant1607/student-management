@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Faculty
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
                @foreach($facultyData as $value)
                    <tr class="odd gradeX" align="center">
                        <td>{{$value->id}}</td>
                        <td>{{$value->name}}</td>
                        <td class="center"><button><a href="{{route('faculty.update', ['faculty'=>$value ])}}">Edit</a></button></td>
                        <td class="center"><button><a
                                    onclick="return confirm('Do you want to delete this field?')"
                                    href="{{route('faculty.delete', [$value->id])}}"> Delete</a></button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection
