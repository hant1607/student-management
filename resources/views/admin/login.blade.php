<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Student Management">
    <meta name="author" content="">
    <base href="{{asset("")}}">
    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin_style/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin_style/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin_style/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin_style/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('noti'))
                            {{session('noti')}}
                    @endif
                    {!! Form::open(['method'=>'POST', 'route'=>'admin.login', 'role'=>'form']) !!}
                        <fieldset>
                            <div class="form-group">
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder'=>'Email', 'autofocus'=>'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder' => 'Password']) !!}
                            </div>
                            {!! Form::submit('Login', ['class'=>'btn btn-lg btn-success btn-block']) !!}
                        </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="admin_style/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="admin_style/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="admin_style/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="admin_style/dist/js/sb-admin-2.js"></script>

</body>

</html>

