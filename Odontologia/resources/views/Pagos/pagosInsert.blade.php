@yield('mensaje')<br> 
<?php if(!empty($_GET['rfcB'])) { ?>
  @include('pagos.encontrado')
<?php }else{?> 
	<label>Buscar paciente</label>
<form class="form-inline" action="/UsuarioB" method="GET">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
    <input class="form-control mr-sm-2 col-4" type="search" placeholder="Rfc" aria-label="rfc"  name="rfcB" required >
    <button class="btn btn-success my-2 my-sm-0" name="buscar" type="submit">
    <img src="Imagenes/Iconos/search-3x.png">&nbsp;&nbsp;Buscar</button>
</form>

<?php }?>

