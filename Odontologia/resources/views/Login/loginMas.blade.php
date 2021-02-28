<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    @include('link')
</head>
<body class="bg-light"><br>
<div class="container col-3">
		    @yield('mensaje')

    <div class="shadow p-3 mb-5 bg-white rounded">
  	@yield('login')
    </div>
</div>
@include('linkScrip')
</body>
</html>

