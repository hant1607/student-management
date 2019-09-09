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

            {{--            {!! Form::open(['method'=>'GET', 'route'=>'students.index', 'class'=>'form-inline']) !!}--}}
            {{--            <div class="sidebar-search" style="margin-bottom: 5%; display: block">--}}
            {{--                <div class="col-sm-4">--}}
            {{--                    <div>--}}
            {{--                        {!! Form::label('min_mark', "From mark:") !!}--}}
            {{--                        {!! Form::text('min_mark',\Request::get('min_mark'), ['class'=>'form-control']) !!}--}}
            {{--                    </div>--}}
            {{--                    <div style="margin-top: 5%">--}}
            {{--                        {!! Form::label('min_age',"From age:") !!}--}}
            {{--                        {!! Form::text('min_age',\Request::get('min_age'), ['class'=>'form-control']) !!}--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-sm-4">--}}
            {{--                    <div>--}}
            {{--                        {!! Form::label('max_mark', "To mark:") !!}--}}
            {{--                        {!! Form::text('max_mark',\Request::get('max_mark'), ['class'=>'form-control']) !!}--}}
            {{--                    </div>--}}
            {{--                    <div style="margin-top: 5%">--}}
            {{--                        {!! Form::label('max_age', "To age:") !!}--}}
            {{--                        {!! Form::text('max_age',\Request::get('max_age'), ['class'=>'form-control']) !!}--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-sm-4">--}}
            {{--                    {!! Form::label('Subject:') !!}--}}
            {{--                    {!! Form::select('subject_id', ['' => 'Subject'] + $sj,\Request::get('subject_id'), ['class'=>'form-control']) !!}--}}
            {{--                    <span class="input-group-btn" style="float:right; margin-right: 25%">--}}
            {{--                                                <button class="btn btn-default btn-primary" type="submit"--}}
            {{--                                                        name="btnSearch">--}}
            {{--                                                    <i class="fa fa-search"></i>--}}
            {{--                                                </button>--}}
            {{--                                            </span>--}}
            {{--                    {!! Form::label('Finish all subject:',null, ['style' => 'margin-top:5%']) !!}--}}
            {{--                    <label class="radio-inline">--}}
            {{--                        <input name="finish" value="1" type="radio" {{(\Request::get('finish') == 1) ? 'checked' : ''}}>Yes--}}
            {{--                    </label>--}}
            {{--                    <label class="radio-inline">--}}
            {{--                        <input name="finish" value="2" type="radio" {{(\Request::get('finish') == 2) ? 'checked' : ''}}>No--}}
            {{--                    </label>--}}
            {{--                </div>--}}

            {{--                <div class="col-sm-12" style="margin-top: 1%">--}}
            {{--                    <label style="margin-right: 1%">Phone:</label>--}}
            {{--                    <label class="checkbox-inline">--}}
            {{--                        <input name="phones[1]" value="1"--}}
            {{--                               type="checkbox" {{isset(\Request::get('phones')[1]) ? 'checked': ''}}>Viettel--}}
            {{--                    </label>--}}
            {{--                    <label class="checkbox-inline">--}}
            {{--                        <input name="phones[2]" value="2"--}}
            {{--                               type="checkbox" {{isset(\Request::get('phones')[2]) ? 'checked': ''}}>Mobiphone--}}
            {{--                    </label>--}}
            {{--                    <label class="checkbox-inline">--}}
            {{--                        <input name="phones[3]" value="3"--}}
            {{--                               type="checkbox" {{isset(\Request::get('phones')[3]) ? 'checked': ''}}>Vinaphone--}}
            {{--                    </label>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            {!! Form::close() !!}--}}

            {{--            {!! Form::open(['method'=>'post', 'route'=>'students.sendEmail']) !!}--}}
            {{--            <div class="col-sm-2" style="float:right; margin-bottom: 2%">--}}
            {{--                <button class="btn btn-danger">Send warning email</button>--}}
            {{--            </div>--}}
            {{--            {!! Form::close() !!}--}}

            {{--            {!! Form::open(['method'=>'get', 'route'=>'students.index']) !!}--}}
            {{--            <div class="col-sm-12" style="margin-bottom: 2%">--}}
            {{--                <label style="display: inline-block;">--}}
            {{--                    {!! Form::select('record', ['50'=> '50', '100'=>'100', '500'=>'500'],\Request::get('record'), ['class'=>'form-control', 'onchange'=>'this.form.submit();']) !!}--}}
            {{--                </label>--}}
            {{--            </div>--}}
            {{--            {!! Form::close() !!}--}}

            <table class="table table-striped table-bordered table-hover" style="margin-top: 25%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Class</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Result</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $value)
                    <tr class="even gradeC" align="center">
                        <td>{{$value['id']}}</td>
                        <td>{{$value['name']}}</td>
                        <td>
                            {{--                            @if(!empty($value['user_id']))--}}
                            {{--                                {{$value->user->username}}--}}
                            {{--                            @endif--}}
                        </td>
                        <td>
                            {{--                            @if(!empty($value['class_id']))--}}
                            {{--                                {{$value->class->name}}--}}
                            {{--                            @endif--}}
                        </td>
                        <td>{{$value['birthday']}}</td>
                        <td>@if($value['gender'] == 1)
                                {{"Male"}}
                            @else
                                {{"Female"}}
                            @endif</td>
                        <td>{{$value['phone']}}</td>
                        <td>
                            @if($value['image'])
                                <img class="image" width="100px" height="70px" src="upload/{{$value['image']}}">
                            @endif
                        </td>
                        <td>
                            <button><a href="{{route('students.show', $value['id'])}}">Mark</a></button>
                        </td>
                        <td class="center">
                            @can('student-edit')
                                <button><a href="{{route('students.edit', $value['id'])}}">Edit</a></button>
                            @endcan
                        </td>
                        <td class="center">
                            @can('student-delete')
                                {!! Form::open(['method'=>'DELETE', 'route'=>['students.destroy', $value['id']]]) !!}
                                <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a>Delete</a>
                                </button>
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{--            {!! $students->appends(request()->input())->links() !!}--}}
        </div>
    </div>

@endsection