@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Class
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7">
                    @if(session('noti'))
                        <div class="alert alert-success">
                            {{session('noti')}}
                        </div>
                    @endif
                </div>

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Faculty</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($classData as $value)
                        <tr class="odd gradeX" align="center">
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>
                                @if(empty($value->faculty_id))
                                    {{"NULL"}}
                                @else
                                    {{$value->faculty->name}}
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a
                                        href="admin/class/update/{{$value->id}}">Edit</a></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a
                                        onclick="return confirm('Do you want to delete this field?')"
                                        href="admin/class/delete/{{$value->id}}"> Delete</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
