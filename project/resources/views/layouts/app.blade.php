
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	@include('partials.styles')
	@yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		@include('partials.header')
		@include('partials.sidebar')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@yield('modal')
		@include('partials.footer')
	</div>
	@include('partials.scripts')
	@yield('script')
</body>
</html>
