<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    @include('link')
</head>
<body class="bg-light">
<div class="container-fluid col-11">
    @include('BarraOpciones.opcionesHCL')
	<div class="form-row">
        <div class="form-group col">  
        </div>
        <div class="form-group ">  
        	@yield('buscar')
		</div>
    </div>
    @yield('mensaje')
  	@yield('Lista')
</div>
@include('linkScrip')
</body>
</html>

