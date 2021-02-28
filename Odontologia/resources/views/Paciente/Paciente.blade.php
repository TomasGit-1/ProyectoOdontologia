@extends('Paciente.PacienteMaster')
@section('title','Paciente')
@section('mensaje')
          @if(session('Insertar'))
             @php
                  $mensaje=(session('Insertar'));
            @endphp
            <?php
            //Verificar el mensaje
              $folio = substr($mensaje,35); 
            ?>
            <div class="alert alert-success animated bounceInDown" role="alert" align="left" >
              <a  class="btn btn-outline-secondary col-2" href='/prueba/{{$folio}}' value="{{$folio}}" name="pdfR" target='_blank' 
             class='demo'><img src="Imagenes/Iconos/print-3x.png">&nbsp;&nbsp;PDF</a>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                {{session('Insertar')}} 
            </div>
            @endif
            @if(session('eliminar'))
            <div class="alert alert-danger">
                {{session('eliminar')}}
            </div>
            @endif
             @if(session('actualizar'))
              <div class="alert alert-primary">
              {{ session('actualizar')}}
           </div>
            @endif
@endsection
@section('msg')
  @if(count($errors))
    <div align="center">
      <div class="bg-danger text-white rounded" align="center" >
        @foreach($errors->all() as $error)
          @if($error=='fecPerson')
            <small>Campo obligatorio</small>
            @break;
          @endif
        @endforeach
      </div>
    </div> 
  @endif
  <div class="invalid-feedback">
    Campo requerido
  </div>
  <div class="valid-feedback">
    Listo
  </div>
@endsection


@section('ElegirForm')
<?php if(!empty($_GET['modificar'])){ ?>
@include('Paciente.PacienteUpdate')              
<?php }else{ ?>
@include('Paciente.PacienteInsert')              
<?php } ?>
@endsection