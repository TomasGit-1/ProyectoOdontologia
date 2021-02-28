<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<style type="text/css">
		@page{
			margin: 0cm 0.4cm;
		}
	</style>
  <title>@yield('title')</title>
    @include('link')

</head>
<body class="bg-light"><br>
<div class="container-fluid col-10">
	<div class="panel panel-default   shadow p-4 mb-2 bg-light rounded">
  		@yield('ver')
	</div>
</div>
</body>
</html>