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
            {!! Form::open(['method'=>'GET', 'route'=>'students.index', 'class'=>'form-inline']) !!}
            <div class="sidebar-search" style="margin-bottom: 5%; display: block">
                <div class="col-sm-4">
                    <div>
                        {!! Form::label('min_mark', "From mark:") !!}
                        {!! Form::text('min_mark',\Request::get('min_mark'), ['class'=>'form-control']) !!}
                    </div>
                    <div style="margin-top: 5%">
                        {!! Form::label('min_age',"From age:") !!}
                        {!! Form::text('min_age',\Request::get('min_age'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div>
                        {!! Form::label('max_mark', "To mark:") !!}
                        {!! Form::text('max_mark',\Request::get('max_mark'), ['class'=>'form-control']) !!}
                    </div>
                    <div style="margin-top: 5%">
                        {!! Form::label('max_age', "To age:") !!}
                        {!! Form::text('max_age',\Request::get('max_age'), ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    {!! Form::label('Subject:') !!}
                    {!! Form::select('subject_id', ['' => 'Subject'] + $sj,\Request::get('subject_id'), ['class'=>'form-control']) !!}
                    <span class="input-group-btn" style="float:right; margin-right: 25%">
                                    <button class="btn btn-default btn-primary" type="submit" name="btnSearch">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    {!! Form::label('Finish all subject:',null, ['style' => 'margin-top:5%']) !!}
                    <label class="radio-inline">
                        <input name="finish" value="1" type="radio" {{(\Request::get('finish') == 1) ? 'checked' : ''}}>Yes
                    </label>
                    <label class="radio-inline">
                        <input name="finish" value="2" type="radio" {{(\Request::get('finish') == 2) ? 'checked' : ''}}>No
                    </label>
                </div>

                <div class="col-sm-12" style="margin-top: 1%">
                    <label style="margin-right: 1%">Phone:</label>
                    <label class="checkbox-inline">
                        <input name="phones[1]" value="1"
                               type="checkbox" {{isset(\Request::get('phones')[1]) ? 'checked': ''}}>Viettel
                    </label>
                    <label class="checkbox-inline">
                        <input name="phones[2]" value="2"
                               type="checkbox" {{isset(\Request::get('phones')[2]) ? 'checked': ''}}>Mobiphone
                    </label>
                    <label class="checkbox-inline">
                        <input name="phones[3]" value="3"
                               type="checkbox" {{isset(\Request::get('phones')[3]) ? 'checked': ''}}>Vinaphone
                    </label>
                </div>
            </div>

            <div class="col-sm-12" style="margin-bottom: 2%">
                <label style="display: inline-block;">
                    {!! Form::select('record', ['50'=> '50', '100'=>'100', '500'=>'500'],\Request::get('record'), ['class'=>'form-control', 'onchange'=>'this.form.submit();']) !!}
                </label>
            </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'post', 'route'=>'students.sendEmail']) !!}
            <div class="col-sm-2" style="float:right; margin-bottom: 2%">
                <button class="btn btn-danger">Send warning email</button>
            </div>
            {!! Form::close() !!}

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
                @foreach($students as $student)
                    <tr class="even gradeC" align="center" id="id_{{ $student->id }}">
                        <td>{{$student->id}}</td>
                        <td class="name">{{$student->name}}</td>
                        <td>
                            @if(!empty($student->user_id))
                                {{$student->user->username}}
                            @endif
                        </td>
                        <td class="class-name">
                            @if(!empty($student->class_id))
                                {{$student->class->name}}
                            @endif
                        </td>
                        <td class="birth-day">{{$student->birthday}}</td>
                        <td class="gender">@if($student->gender == 1)
                                {{"Male"}}
                            @else
                                {{"Female"}}
                            @endif</td>
                        <td class="phone">{{$student->phone}}</td>
                        <td>
                            @if($student->image)
                                <img class="image" width="100px" height="70px" src="upload/{{$student->image}}">
                            @endif
                        </td>
                        <td>
                            <button><a href="{{route('students.show', $student->id)}}">Mark</a></button>
                        </td>
                        <td class="center">
                            {{--                            <button><a href="{{route('students.edit', ['student' => $student])}}">Edit</a></button>--}}
                            @can('student-edit')
                                <button><a href="javascript:void(0)" id="edit-student"
                                           data-id="{{ $student->id }}">Edit</a>
                                </button>
                            @endcan
                        </td>
                        <td class="center">
                            @can('student-delete')
                                {!! Form::open(['method'=>'DELETE', 'route'=>['students.destroy', 'student'=>$student]]) !!}
                                <button type="submit" onclick="return confirm('Do you want to delete this field?')"><a>Delete</a>
                                </button>
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $students->appends(request()->input())->links() !!}
        </div>
    </div>

    <div class="modal fade" id="ajax-student-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="studentCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="studentForm" name="studentForm" class="form-horizontal"
                          enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-4">Student Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Enter Student Name" value="" maxlength="50">
                                <span id="name-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4">Class</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="class_id" id="class_id">
                                    <option value="">Choose class</option>

                                    @foreach($classes as $class)
                                        <option value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>
                                <span id="class-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="birthday" class="col-sm-4">Birthday</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                       placeholder="Enter Birthday" value="">
                                <span id="birthday-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4">Gender</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                                <span id="gender-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-4">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="Enter Phone" value="">
                                <span id="phone-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4">Image</label>
                            <div class="col-sm-12">
                                <input type="file" id="image" name="image">
                                <img id="student_img" width="100px" height="70px" src="">
                                <span id="image-error"></span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="btn-cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#btn-cancel').click(function () {
                $('#ajax-student-modal').modal('hide');
            });

            $('body').on('click', '#edit-student', function () {
                var id = $(this).data('id');
                $.get('admin/students/' + id + '/edit', function (data) {
                    $('#btn-save').val("edit-student");
                    $('#studentCrudModal').html("Edit Student");
                    $('#ajax-student-modal').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#class_id').val(data.class_id);
                    $('#birthday').val(data.birthday);
                    $('#gender').val(data.gender);
                    $('#phone').val(data.phone);
                    if (data.image) {
                        $('img#student_img').attr('src', 'upload/' + data.image);
                    }

                })
            });
        });

        $(document).on("submit", "#studentForm", function (event) {
            event.preventDefault();

            //$('#ajax-student-modal').modal('hide');

            $('#btn-save').html('Sending..');

            $.ajax({
                data: new FormData(this),
                url: "admin/students/ajaxUpdate",
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#id_" + data.id).find('.name').html(data.name);
                    $("#id_" + data.id).find('.class-name').html(data.class_id);
                    $("#id_" + data.id).find('.birth-day').html(data.birthday);
                    $("#id_" + data.id).find('.gender').html(data.gender);
                    $("#id_" + data.id).find('.phone').html(data.phone);
                    if (data.image) {
                        $("#id_" + data.id).find('.image').attr('src', 'upload/' + data.image);
                    }
                    $('#studentForm').trigger("reset");
                    $('#ajax-student-modal').modal('hide');
                    $('#btn-save').html('Save Changes');
                    $('.loading').hide();
                },
                error: function (data) {
                    var errors = data.responseJSON.errors;
                    if (errors) {
                        $('#name-error').html(errors.name);
                        $('#class-error').html(errors.class_id);
                        $('#birthday-error').html(errors.birthday);
                        $('#gender-error').html(errors.gender);
                        $('#phone-error').html(errors.phone);
                        $('#image-error').html(errors.image);
                        $('#btn-save').html('Save Changes');
                    }
                }
            });
        });

    </script>
@endsection
