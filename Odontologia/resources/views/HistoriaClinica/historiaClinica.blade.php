@extends('HistoriaClinica.historiaClinicaMaster')
@section('title','Historia Clinica')
@section('mensaje')
            @if(session('insertar'))
             <div class="alert alert-success animated bounceInDown" role="alert" align="center" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               {{session('insertar')}}
            </div>
            @endif
            @if(session('existe'))
           <div class="alert alert-success animated bounceInDown" role="alert" align="center" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                 {{session('existe')}}
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger animated bounceInDown" role="alert" align="center" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  {{ session('error')}}
            </div>
            @endif
            @if(count($errors))
                <div class="alert alert-danger animated bounceInDown" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
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
@section('historiaC')
<?php if(!empty($_GET['modificar'])){
?>    
 @include('HistoriaClinica.HCUpdate')
<?php }else{ ?>
 @include('HistoriaClinica.HCInsertar')
<?php } ?>
@endsection


