@extends('Login.loginMas')
@section('title','Iniciar sesion')
@section('mensaje')
            @if(session('error'))
            <div class="alert alert-danger animated bounceInDown" role="alert" align="center" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{ session('error')}}
            </div>
            @endif
@endsection
@section('detalles')
  <p class="p-2 mb-2 bg-secondary text-white rounded"  align="center">Iniciar sesion</p>
    <div class="form-inline ">
    <hr class="col bg-dark">&nbsp;<img src="Imagenes/user.png">&nbsp;<hr class="col bg-dark">
  </div>
@endsection
@section('login')
@yield('detalles')
<form method="POST" action="/IniciarSesion" >
  <input type="hidden" name="_token" value="{!! csrf_token() !!}">  
  <div class="form-group ">
    <label>Usuario</label>
    <div class="input-group ">
      <div class="input-group-prepend ">
        <span class="input-group-text bg-white"> <i class="fa fa-user"></i></span>
      </div>
      <input type="text" class="form-control" name="USER" required>
    </div>
    <small id="Help" class="form-text text-muted">Ingrese su usuario</small>
  </div>

  <div class="form-group ">
    <label for="exampleInputPassword1">Contraseña</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text bg-white"><i class="fa fa-lock"></i></span>
      </div>
        <input type="password" class="form-control"  name="PASS"  required> 
      </div> 
          <small id="Help" class="form-text text-muted">Ingrese su contraseña</small>
  </div>
  <br>
 <div class="form-group">
   <button type="submit" class="btn btn-primary col">Iniciar</button>
</div>
</form>

@endsection
