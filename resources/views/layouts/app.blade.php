<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CV Process</title>


    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{asset('/assets/css/librariesV2/bootstrap-3.3.7-dist/css/bootstrap.min.css')}}">
    <!-- Custom CSS -->
    @section('head')
        <link rel="stylesheet" href="{{asset('/assets/css/shared.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/login.css')}}">
        <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    @show
    <link rel="stylesheet" href="{{asset('/css/develop.css')}}">
    <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">

</head>
<body>
<!--start container-->
<div class="container-fluid">
    @include('layouts.partials.header')
    @yield('content')
    @include('layouts.partials.footer')
</div>

<!-- jQuery -->
<script src="{{asset('/assets/css/librariesV2/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('/assets/css/librariesV2/bootstrap-3.3.7-dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/plupload.full.min.js')}}"></script>
<script src="{{asset('/js/plupload.queue.min.js')}}"></script>
<script src="{{asset('/js/select2.full.min.js')}}"></script>
@stack('js')
<script>
    $(function () {
        $('#item').click(function () {
            console.log('test');
            (function () {
                var cookies = document.cookie.split(";");

                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i];
                    var eqPos = cookie.indexOf("=");
                    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                    document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
                }
            })();
        })
    })
</script>
</body>
</html>
