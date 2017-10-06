<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>知明科技</title>
	<link rel="stylesheet" type="text/css" href="{{asset(mix('static/css/app.css'))}}">
</head>
<body>
	@yield('content')
	<script src="{{asset(mix('static/js/app.js'))}}"></script>
	@yield('js')
</body>
</html>