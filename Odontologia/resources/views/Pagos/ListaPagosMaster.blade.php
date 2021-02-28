<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    @include('link')
<script type="text/javascript">
  function click(){
    alert("cambio de precio");
  }
</script>

</head>

<body class="bg-light">
    <div class="container-fluid">
                @include('BarraOpciones.opcionesPagosLista')

	    <div class="form-row">
        	<div class="form-group col">  
        	</div>
        	<div class="form-group">  
        		@yield('buscar')
			</div>
        </div>
        @yield('mensaje')
  	    @yield('Lista')
	</div>
@include('linkScrip')
</body>
</html>

