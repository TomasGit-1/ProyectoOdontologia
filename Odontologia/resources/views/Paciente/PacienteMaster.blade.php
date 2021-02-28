<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>@yield('title')</title>
  @include('link')
</head>
<body class="bg-light">
<div class="container col-11">
	@include('BarraOpciones.opcionesPa')
	<div class="panel panel-default bg-transparent shadow-lg p-4 mb-4">
  		@yield('ElegirForm')
	</div>
</div>
</body>
</html>