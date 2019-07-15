@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Class
                    <small>Add</small>
                </h1>
            </div>

            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                            @endforeach
                    </div>
                    @endif
                @if(session('noti'))
                    <div class="alert alert-success">
                        {{session('noti')}}
                    </div>
                @endif

                <form action="admin/class/add" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">

                        <label>Class Name</label>
                        <input class="form-control" name="className" placeholder="Please Enter Class Name" />

                        <label>Faculty</label>
                        <select class="form-control" name="facultyID">
                            <option value="">Please choose faculty</option>
                            @foreach($facultyData as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default">Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
    @endsection
