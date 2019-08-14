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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <link href="admin_style/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="admin_style/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="admin_style/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="admin_style/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="admin_style/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

    <style>
        .table-bordered th {
            text-align: center;
        }
    </style>
</head>

<body>
<div id="wrapper">
    @include('admin.layout.header')

    <div id="page-wrapper">
        <div class="col-lg-7">
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
        </div>
        @yield('content')
    </div>
</div>
</body>

<script src="admin_style/bower_components/jquery/dist/jquery.min.js"></script>
<script src="admin_style/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="admin_style/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="admin_style/dist/js/sb-admin-2.js"></script>
<script src="admin_style/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="admin_style/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

@yield('script')
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
</html>