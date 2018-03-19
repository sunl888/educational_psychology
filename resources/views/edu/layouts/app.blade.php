<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="@section('description')@show">
    <meta name="keywords" content="@section('keywords')@show">
    <title>@section('title') @show 教育心理学</title>
    <link rel="stylesheet" type="text/css" href="{{cdn('edu/css/comm.css')}}">
</head>
<body>
@yield('content')
<script type="text/javascript" src="{!! cdn('edu/lib/jquery/jquery.min.js') !!}"></script>
@stack('js')
</body>
</html>