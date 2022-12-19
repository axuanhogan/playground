<!DOCTYPE html>
<html class="html" lang="zh-TW">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
		<title>@yield('HeadTitle')</title>
		<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script>
			var base_path = "{{ url('/') . '/' . Request::segment(1) }}";
			var tracked = ["{{ __('messages.tracked') }}"];
			var confirm_message = ["{{ __('messages.confirm_message') }}"];
		</script>
		@yield('HeadContent')
	</head>
	<body class="body">
		<header class="header">
			@yield('BodyHeader')
		</header>
		<div class="content">
			@yield('BodyMain')
		</div>
		<footer class="footer">
			@yield('BodyFooter')
		</footer>
		<input type="hidden" id="key" value="{!! csrf_token() !!}">
	</body>
</html>