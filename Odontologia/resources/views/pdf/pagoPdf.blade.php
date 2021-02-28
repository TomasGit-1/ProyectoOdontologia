@extends('pdf.tutoMs')
@section('title','Pagos PDF')
@section('ver')
@foreach ($datos as $value)  
    <?php $folio=$value->folio;?>
    <?php $rfcPaciente=$value->rfcPaciente;?>
    <?php $claveServicio=$value->claveServicio;?>
    <?php $matricula=$value->matricula;?>
    <?php $cedula=$value->cedula;?>
    <?php $observacion=$value->observacion;?>
    <?php $precio=$value->precio;?>
    <?php $fecha=$value->fecha;?>
    <?php $hora=$value->hora;?>
@endforeach
<img src="Imagenes/enc.png">
<br><br><br><br>
<b>FECHA:</b>&nbsp;&nbsp;{{$fecha}}<br><br>
<b>Folio:</b>&nbsp;&nbsp;{{$folio}}<br><br>

<?php  $datos = DB::select('select * from personas where rfc="'.$rfcPaciente.'"; ');?>
@foreach ($datos as $value)  
    <?php $nombres=$value->nombres;?>
    <?php $apPat=$value->apPat;?>
    <?php $apMat=$value->apMat;?>
@endforeach
<b>NOMBRE DEL PACIENTE:</b>&nbsp;&nbsp;{{$nombres.' '.$apPat.' '.$apMat}}<br><br>

<?php  $datos = DB::select('select * from alumnos inner join personas on alumnos.rfc=personas.rfc and matricula="'.$matricula.'";');?>
@foreach ($datos as $value)  
    <?php $nombres=$value->nombres;?>
    <?php $apPat=$value->apPat;?>
    <?php $apMat=$value->apMat;?>
    <?php $semestre=$value->semestre;?>
@endforeach
<b>NOMBRE DEL ALUMNO:</b>&nbsp;&nbsp;{{$nombres.' '.$apPat.' '.$apMat}}<br><br><b>Semestre{{$semestre}}</b>

<?php  $datos = DB::select('select * from profesores inner join personas on profesores.rfc=personas.rfc and cedula="'.$cedula.'";');?>
@foreach ($datos as $value)  
    <?php $nombres=$value->nombres;?>
    <?php $apPat=$value->apPat;?>
    <?php $apMat=$value->apMat;?>
@endforeach

<b>NOMBRE DEL PROFESOR:</b>&nbsp;&nbsp;{{$nombres.' '.$apPat.' '.$apMat}}<br><br>


<?php  $datos = DB::select('select * from catalogoservicios where claveServicio="'.$claveServicio.'";');?>
@foreach ($datos as $value)  
    <?php $nombreServicio=$value->nombreServicio;?>
@endforeach

<b>TRATAMIENTO:</b>&nbsp;&nbsp;{{$nombreServicio}}<br><br>
@endsection