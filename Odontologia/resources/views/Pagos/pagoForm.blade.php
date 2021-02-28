@extends('Pagos.pagos')
@section('title','Pagos')
@section('mensaje')
	@if(session('Insertar'))
     @php
      $mensaje=(session('Insertar'));
    @endphp
    <?php
      //Verificar el mensaje
      $folio = substr($mensaje,35);   
    ?>
    
	  <div class="alert alert-success animated bounceInDown" role="alert" align="center">
    <a  class="btn btn-outline-secondary col-2" href='/PDFPA/{{$folio}}' value="{{$folio}}" name="pdfR" target='_blank' 
             class='demo'><img src="Imagenes/Iconos/print-3x.png">&nbsp;&nbsp;PDF</a>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">×</span></button>
	         {{session('Insertar')}} 
	  </div>
	@endif
	@if(session('error'))
        <div class="alert alert-danger animated bounceInDown" role="alert" align="center" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
           {{ session('error')}}
        </div>
    @endif
@endsection
@section('msg')
  <div class="invalid-feedback">
    Campo requerido
  </div>
  <div class="valid-feedback">
    Listo
  </div>
@endsection
@section('formulario')
	@include('Pagos.pagosInsert')              
@endsection
