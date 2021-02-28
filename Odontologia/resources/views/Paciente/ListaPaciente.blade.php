@extends('Paciente.ListaPacienteMaster')
@section('title','Paciente')
@section('mensaje')
            <?php if(!empty($_GET['nombrePaciente'])){?>
              <div class="form-row">
                <div class="col" align="left">
                      <h3>Resultados de Busqueda:<?php echo(" {$_GET['nombrePaciente']}");?></h3></a>
                </div>
                <div class="col-2">
                 <a href="PacienteLista" class="btn btn-danger col"><img src="Imagenes/Iconos/reply-3x.png">&nbsp;&nbsp;Regresar</a><br>
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
  <form class="form-inline my-2 my-lg-0" action="/PacienteLista" method="get">
      <?php  $datosP = DB::select('SELECT * FROM  personas  per  INNER JOIN pacientes pac ON per.rfc=pac.rfc;');?>
        <div class="form-group col" >
            <?php if(!empty($_GET['nombrePaciente'])){?>
            <?php }else{?>
            <input class="form-control" type="text" name="nombrePaciente" list="nombres1" placeholder="Buscar" />
            <?php }?>
            <?php if(sizeof($datosP)>0){?>
            <datalist id="nombres1">
                <select class="custom-select" required>
                @foreach ($datosP as $value)  
                    <?php $rfc=$value->rfc; ?>
                    <?php $nombre=$value->nombres; ?>
                    <?php $apPat=$value->apPat; ?>
                    <option value="{{$nombre}}"><?php print($rfc.' '.$nombre.' '.$apPat);?></option>
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
            <?php if(!empty($_GET['nombrePaciente'])){?>
                
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
            <th scope="col">Rfc</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Telefono</th>
            <th scope="col">Sexo</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col" colspan="2">Accion</th>
       </tr>
      </thead>
    @foreach ($datos as $value)
    <tbody class="contenidobusqueda">
      <tr  class="bg-light">
          <th scope="col">{{$value->rfc}}</th>
          <th scope="col">{{$value->nombres." ".$value->apPat." ".$value->apMat}}</th>        
          <th scope="col">{{$value->telefono}}</th>        
          <th scope="col">{{$value->sexo}}</th>        
          <th scope="col">{{$value->fechaNac}}</th>        
          <td> 
            <form method="get" action="/Paciente" >
               <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
                <button class="btn btn-primary" type="submit" name="modificar" value="{{$value->rfc}}">
                <img src="Imagenes/Iconos/update-3x.png"></button>
            </form>
          </td>
          <td> 
             <a  class="btn btn-outline-secondary col" href='/PDFP/{{$value->rfc}}' value="{{$value->rfc}}" name="pdfR" target='_blank' 
             class='demo'><img src="Imagenes/Iconos/print-3x.png">&nbsp;&nbsp;PDF</a>

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
            <th scope="col">Rfc</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Telefono</th>
            <th scope="col">Sexo</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col" colspan="3">Accion</th>
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