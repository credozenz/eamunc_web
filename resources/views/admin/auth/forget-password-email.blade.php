<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E.A.MUNC - Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{asset('css/admin/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/admin/login.css')}}" rel="stylesheet">
</head>
<body>
@if (Session::has('message'))
        <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
@endif
<h1>Set Password Email</h1>

You can reset password from bellow link:
<a href="{{ url('admin/reset-password/'.$token) }}">Set Password</a>
</body>

<script src="{{asset('js/admin/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/admin/apexcharts.js')}}"></script>
<script src="{{asset('js/admin/pages/dashboard.js')}}"></script>
<script src="{{asset('js/admin/sidebar.js')}}"></script>
<script src="{{asset('js/admin/admin.js')}}"></script>

</html>