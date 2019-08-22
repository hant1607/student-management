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

        tr button {
            border: none;
            background: none;
        }

        tr:hover {
            background-color: #f5f5f5;
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
                <tr data-username="{{$user->username}}">
                    <th>User name</th>
                    <td class="user-name">{{$user->username}}</td>
                    <td class="edit-button">
                        <button class="fa fa-edit"></button>
                    </td>
                </tr>
                <tr data-name="{{$student->name}}">
                    <th>Full name</th>
                    <td class="name">{{$student->name}}</td>
                    <td class="edit-button">
                        <button class="fa fa-edit"></button>
                    </td>
                </tr>
                <tr data-birthday="{{$student->birthday}}">
                    <th>Birthday</th>
                    <td class="birth-day">{{$student->birthday}}</td>
                    <td class="edit-button">
                        <button class="fa fa-edit"></button>
                    </td>
                </tr>
                <tr data-gender="{{$student->gender}}">
                    <th>Gender</th>
                    <td class="gender">
                        @if($student->gender == 1)
                            {{'Male'}}
                        @else
                            {{'Female'}}
                        @endif
                    </td>
                    <td class="edit-button">
                        <button class="fa fa-edit"></button>
                    </td>
                </tr>
                <tr data-image="{{$student->image}}">
                    <th>Image</th>
                    <td class="image">
                        @if($student->image)
                            <img width="100px" height="70px" src="upload/{{$student->image}}">
                        @endif
                    </td>
                    <td class="edit-button">
                        <button class="fa fa-edit"></button>
                    </td>
                </tr>
                <tr data-phone="{{$student->phone}}">
                    <th>Phone</th>
                    <td class="phone">{{$student->phone}}</td>
                    <td class="edit-button">
                        <button class="fa fa-edit"></button>
                    </td>
                </tr>
                <tr data-email="{{$user->email}}">
                    <th>Email</th>
                    <td>{{$user->email}}</td>
                </tr>
            </table>
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

            $(document).on('click', '.edit-button', function (event) {
                event.preventDefault();

                var username = $(this).parents("tr").attr('data-username');
                var name = $(this).parents("tr").attr('data-name');
                var birthday = $(this).parents("tr").attr('data-birthday');
                var gender = $(this).parents("tr").attr('data-gender');
                var phone = $(this).parents("tr").attr('data-phone');
                var image = $(this).parents("tr").attr('data-image');
                var textGender = (gender == 1) ? '<option value="1" selected>Male</option>' + '<option value="2">Female</option>' : '<option value="1">Male</option>' + '<option value="2" selected>Female</option>';

                $(this).parents("tr").find("td.user-name").html('<input class="form-control" name="edit_username" value="' + username + '">');
                $(this).parents("tr").find("td.name").html('<input class="form-control" name="edit_name" value="' + name + '">');
                $(this).parents("tr").find("td.birth-day").html('<input class="form-control" name="edit_birthday" type="date" value="' + birthday + '">');
                $(this).parents("tr").find("td.gender").html('<select class="form-control" name="edit_gender">' +
                    textGender +
                    '</select>');
                $(this).parents("tr").find("td.phone").html('<input class="form-control" name="edit_phone" value="' + phone + '">');
                $(this).parents("tr").find("td.image").html('<input class="form-control" name="edit_image" type="file"><img src="upload/' + image + '" width="100px" height="70px">');

                $(this).parents("tr").find("td.edit-button").replaceWith('<button class="btn btn-success btn-update" style="margin-top: 5%">Update</button>');
                 $(this).hide();
            });

            $(document).on("click", ".btn-update", function(){
                debugger
                var username = $(this).parents("tr").find("input[name='edit_username']").val();
                var name = $(this).parents("tr").find("input[name='edit_name']").val();
                var birthday = $(this).parents("tr").find("input[name='edit_birthday']").val();
                var gender = $(this).parents("tr").find("input[name='edit_gender']").val();
                var phone = $(this).parents("tr").find("input[name='edit_phone']").val();
                var image = $(this).parents("tr").find("input[name='edit_image']").val();

                $(this).parents("tr").find("td.user-name").text(username);
                $(this).parents("tr").find("td.name").text(name);
                $(this).parents("tr").find("td.birth-day").text(birthday);
                $(this).parents("tr").find("td.gender").text(gender);
                $(this).parents("tr").find("td.phone").text(phone);
                $(this).parents("tr").find("td.image").attr('src');

                // $(this).parents("tr").attr('data-username', username);
                // $(this).parents("tr").attr('data-name', name);
                // $(this).parents("tr").attr('data-birthday', birthday);
                // $(this).parents("tr").attr('data-gender', gender);
                // $(this).parents("tr").attr('data-phone', phone);
                // $(this).parents("tr").attr('data-image', image);

                $(this).parents("tr").find("td.edit-button").show();
                $(this).parents("tr").find(".btn-update").remove();
            });
        });

    </script>
@endsection
