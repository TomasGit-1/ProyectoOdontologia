@extends('Pagos.ListaPagosMaster')
@section('title','Pagos')
@section('mensaje')
            <?php if(!empty($_GET['folio'])){?>
              <div class="form-row">
                <div class="col" align="left">
                      <h3>Resultados de Busqueda:<?php echo(" {$_GET['folio']}");?></h3></a>
                </div>
                <div class="col-2">
                 <a href="/PagosLista" class="btn btn-danger col"><img src="Imagenes/Iconos/reply-3x.png">&nbsp;&nbsp;Regresar</a><br>
                </div>
              </div>
            <?php }?> 
             @if(session('actualizar'))
             <div class="alert alert-primary animated bounceInDown" role="alert" align="center" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                {{session('actualizar')}}
            </div>
            @endif
@endsection
@section('buscar')
<nav class="navbar navbar-light bg-light">
  <form class="form-inline my-2 my-lg-0" action="/PagosLista" method="get">
      <?php  $datosP = DB::select('select * from pagos inner join personas 
                  on pagos.rfcPaciente=personas.rfc');?>
        <div class="form-group col" >
            <?php if(!empty($_GET['folio'])){?>
            <?php }else{?>
              <input class="form-control" type="text" name="folio" list="nombres1" placeholder="Buscar" />
            <?php }?>
            <?php if(sizeof($datosP)>0){?>
            <datalist id="nombres1">
                <select class="custom-select" required>
                @foreach ($datosP as $value)  
                    <?php $folio=$value->folio; ?>
                    <?php $rfc=$value->rfcPaciente; ?>
                    <?php $nombre=$value->nombres; ?>
                    <?php $apPat=$value->apPat; ?>
                    <?php $apMat=$value->apMat; ?>
                    <option value="{{$folio}}"><?php print($rfc.' '.$nombre.' '.$apPat);?></option>
                @endforeach
                </select> 
            </datalist>
            <?php }else{?>
            <datalist id="nombres1">
              <select class="custom-select"  name="nombrePaci" required>
                    <option></option>
              </select> 
            </datalist>
            <?php }?>
            <?php if(!empty($_GET['folio'])){?>
            <?php }else{?>&nbsp;
                <button class="btn btn-success" type="submit">
                  <img src="Imagenes/Iconos/search-3x.png">&nbsp;&nbsp;Buscar</button>
            <?php }?>

        </div>
  </form>
</nav>
@endsection
@section('Lista')
<?php if(sizeof($datos)>0){?>
<table class="table table-striped col border" >
      <thead class="thead-dark">
       <tr>
            <th scope="col">Folio</th>
            <th scope="col">Rfc paciente</th>
            <th scope="col">Servicio</th>
            <th scope="col">Alumno</th>
            <th scope="col">Maestro</th>
            <th scope="col">Observacion</th>
            <th scope="col">Precio</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Reimprimir</th>
       </tr>
      </thead>
    @foreach ($datos as $value)
    <tbody class="contenidobusqueda">
      <tr  class="bg-light">
          <th scope="col">{{$value->folio}}</th> 
          <th scope="col">{{$value->rfcPaciente}}</th>
          <!--*********************************-->
          <?php $claveSer=$value->claveServicio;?>
          <?php $servicio=DB::select('select * from catalogoservicios WHERE claveServicio="'.$claveSer.'"');
                $servicio=array_column($servicio,"nombreServicio");?>
          <th scope="col">{{$servicio[0]}}</th>
          <!--*********************************-->
          <?php $claveAlum=$value->matricula;?>
          <?php $alumno=DB::select('select * from alumnos inner join personas 
                                                        on alumnos.rfc=personas.rfc and  
                                                        alumnos.matricula="'.$claveAlum.'"');
                $nombreA=array_column($alumno,"nombres");
                $apPatA=array_column($alumno,"apPat");
                $apMatA=array_column($alumno,"apMat");
          ?>
          <th scope="col">{{$nombreA[0]." ".$apPatA[0]." ".$apMatA[0]}}</th>
          <!--*********************************-->
          <?php $cedula=$value->cedula;?>
          <?php $profe=DB::select('select * from profesores inner join personas 
                                    on profesores.rfc=personas.rfc and  
                                    profesores.cedula="'.$cedula.'"');
                $nombreP=array_column($profe,"nombres");
                $apPatP=array_column($profe,"apPat");
                $apMatP=array_column($profe,"apMat");
          ?>
          <th scope="col">{{$nombreP[0]." ".$apPatP[0]." ".$apMatP[0]}}</th>
          <th scope="col">{{$value->observacion}}</th>
          <th scope="col">{{$value->precio}}</th>
          <th scope="col">{{$value->fecha}}</th>
          <th scope="col">{{$value->hora}}</th>
            <!--<form method="get" action="/Paciente" >
               <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
                <button class="btn btn-primary" type="submit" name="modificar" value="">
                <img src="Imagenes/Iconos/update-3x.png"></button>
            </form>-->
          <td> 
             <a  class="btn btn-outline-secondary col" href='/PDFPA/{{$value->folio}}' value="" name="pdfR" target='_blank' 
             class='demo'><img src="Imagenes/Iconos/print-3x.png"></a>
         </td>
      </tr>
    </tbody>
    @endforeach
  </table>
<?php }else{?>
  <div class="alert alert-danger animated bounceInDown" role="alert" align="center" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        No se encontraron resultados
   </div>
<table class="table table-striped col" >
      <thead class="thead-dark">
       <tr>
            <th scope="col">Folio</th>
            <th scope="col">Rfc paciente</th>
            <th scope="col">Servicio</th>
            <th scope="col">Alumno</th>
            <th scope="col">Maestro</th>
            <th scope="col">Observacion</th>
            <th scope="col">Precio</th>
            <th scope="col" colspan="2">Accion</th>
       </tr>
      </thead>
    <tbody class="contenidobusqueda">
      <tr  class="bg-white">
          <th scope="col"></th>
          <th scope="col"></th>        
          <th scope="col"></th>        
          <th scope="col"></th>        
          <th scope="col"></th>        
      </tr>
    </tbody>
  </table>
<?php }?>
@endsection