@extends('admin.layout.index')
@section('content')
    <style>
        .table-profile {
            border-collapse: collapse;
            width: 100%;
        }

        .table-profile th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            width: 30%;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .result td {
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile
                    <small>{{$user->username}}</small>
                </h1>
            </div>

            <div class="col-lg-12">
                <h3 class="page-header">Information</h3>
            </div>
            <table class="table-profile">
                <tr class="userId_{{ $user->id }}">
                    <th>User name</th>
                    <td class="user-name">{{$user->username}}</td>
                </tr>
                @if($student)
                    <tr id="studentName_{{ $student->id }}">
                        <th>Full name</th>
                        <td class="name">{{$student->name}}</td>
                    </tr>
                    <tr id="studentBirthday_{{ $student->id }}">
                        <th>Birthday</th>
                        <td class="birth-day">{{$student->birthday}}</td>
                    </tr>
                    <tr id="studentGender_{{ $student->id }}">
                        <th>Gender</th>
                        <td class="gender">
                            @if($student->gender == 1)
                                {{'Male'}}
                            @else
                                {{'Female'}}
                            @endif
                        </td>
                    </tr>
                    <tr id="studentImage_{{ $student->id }}">
                        <th>Image</th>
                        <td>
                            @if($student->image)
                                <img class="image" width="100px" height="70px" src="upload/{{$student->image}}">
                            @endif
                        </td>
                    </tr>
                    <tr id="studentPhone_{{ $student->id }}">
                        <th>Phone</th>
                        <td class="phone">{{$student->phone}}</td>
                    </tr>
                @endif
                <tr>
                    <th>Email</th>
                    <td>{{$user->email}}</td>
                </tr>
            </table>
            <button class="btn btn-success" style="margin-top: 2%; margin-left: 30%"
                    onclick="location.href = 'javascript:void(0)'" id="edit-user" data-id="{{$user->id}}">Edit
            </button>

            @if($student)
                @if($subjects)
                    {!! Form::open(['method'=>'POST', 'route'=>['users.updateResult', $student->id]]) !!}
                    <h3>Subjects which student has not studied yet:</h3>
                    <table class="table table-striped table-bordered table-hover result" style="margin-top: 3%">
                        <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Choose</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr class="even gradeC" align="center">
                                <td>{{$subject->id}}</td>
                                <td>{{$subject->name}}</td>
                                <td><input type="checkbox" value="{{$subject->id}}" name="subject_id[]"
                                           class="check-subject"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! Form::submit('Update', ['class'=>'btn btn-success', 'style'=>'float:right; margin-right: 10%']) !!}
                    {!! Form::close() !!}
                    {!! $subjects->links() !!}
                @else
                    <h3>You are study enough subject!</h3>
                @endif
            @endif
        </div>
    </div>

    <div class="modal fade" id="user-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="userForm" name="userForm" class="form-horizontal"
                          enctype="multipart/form-data">
                        <input type="hidden" name="userId" class="userId">
                        <input type="hidden" name="studentId" id="studentId">
                        <div class="form-group">
                            <label for="username" class="col-sm-4">User name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="username" id="username"
                                       placeholder="Enter User Name" value="" maxlength="50">
                                <span class="username-error"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-4">Full name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Enter User Name" value="" maxlength="50">
                                <span id="name-error"></span>
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
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="small-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="smallModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="smallForm" name="smallForm" class="form-horizontal">
                        <input type="hidden" name="userId" class="userId">

                        <div class="form-group">
                            <label for="username" class="col-sm-4">User name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="username" id="user-name"
                                       placeholder="Enter User Name" value="" maxlength="50">
                                <span class="username-error"></span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="btn-small-cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="btn-small-save" value="create">Save
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
                $('#user-modal').modal('hide');
            });

            $('#btn-small-cancel').click(function () {
                $('#small-modal').modal('hide');
            });

            $('body').on('click', '#edit-user', function () {
                var userId = $(this).data('id');
                $.get('admin/users/' + userId + '/edit-profile', function (data) {
                    if (data[1]) {
                        $('#btn-save').val("edit-user");
                        $('#userModal').html("Edit profile");
                        $('#user-modal').modal('show');
                        $('.userId').val(data[0].id);
                        $('#studentId').val(data[1].id);
                        $('#username').val(data[0].username);
                        $('#name').val(data[1].name);
                        $('#birthday').val(data[1].birthday);
                        $('#gender').val(data[1].gender);
                        $('#phone').val(data[1].phone);
                        if (data[1].image) {
                            $('img#student_img').attr('src', 'upload/' + data[1].image);
                        }
                    } else {
                        $('#btn-save').val("edit-user");
                        $('#smallModal').html("Edit profile");
                        $('#small-modal').modal('show');
                        $('.userId').val(data[0].id);
                        $('#user-name').val(data[0].username);
                    }
                })
            });
        });

        $(document).on('submit', '#userForm', function (event) {
            event.preventDefault();
            $('#btn-save').html("Sending...");
            $.ajax({
                data: new FormData(this),
                url: 'admin/users/update-profile',
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('.userId_' + data[0].id).find('.user-name').html(data[0].username);
                    $('#studentName_' + data[1].id).find('.name').html(data[1].name);
                    $('#studentBirthday_' + data[1].id).find('.birth-day').html(data[1].birthday);
                    $('#studentGender_' + data[1].id).find('.gender').html(data[1].gender);
                    $('#studentPhone_' + data[1].id).find('.phone').html(data[1].phone);
                    if (data[1].image) {
                        $("#studentImage_" + data[1].id).find('.image').attr('src', 'upload/' + data[1].image);
                    }
                    $('#userForm').trigger('reset');
                    $('#user-modal').modal('hide');
                    $('#btn-save').html("Save change");
                    $('.loading').hide();
                },
                error: function (data) {
                    var errors = data.responseJSON.errors;
                    $('.username-error').html((errors.username == undefined) ? '' : errors.username);
                    $('#name-error').html((errors.name == undefined) ? '' : errors.name);
                    $('#birthday-error').html((errors.birthday == undefined) ? '' : errors.birthday);
                    $('#gender-error').html((errors.gender == undefined) ? '' : errors.gender);
                    $('#phone-error').html((errors.phone == undefined) ? '' : errors.phone);
                    $('#image-error').html((errors.image == undefined) ? '' : errors.image);
                    $('#btn-save').html('Save Changes');
                }
            });
        });

        $(document).on('submit', '#smallForm', function (event) {
            event.preventDefault();
            $('#btn-small-save').html("Sending...");
            $.ajax({
                data: new FormData(this),
                url: 'admin/users/update-profile',
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    $('.userId_' + data.id).find('.user-name').html(data.username);
                    $('#smallForm').trigger('reset');
                    $('#small-modal').modal('hide');
                    $('#btn-small-save').html("Save change");
                    $('.loading').hide();

                },
                error: function (data) {
                    var errors = data.responseJSON.errors;
                    $('.username-error').html(errors.username);
                    $('#btn-save').html('Save Changes');
                }
            });
        });
    </script>
@endsection
