@extends('pdf.tutoMs')
@section('title','PACIENTE PDF')
@section('ver')
@foreach ($datos as $value)  
    <?php $rfc=$value->rfc;?>
    <?php $nombres=$value->nombres;?>
    <?php $apMat=$value->apMat; ?>
    <?php $apPat=$value->apPat; ?>
    <?php $telefono=$value->telefono; ?>
    <?php $sexo=$value->sexo;?>
    <?php $fechaNac=$value->fechaNac;?>  
@endforeach
<img src="Imagenes/enc.png">
<br><br><br><br>
<b>RFC:</b>&nbsp;&nbsp;{{$rfc}}<br><br>
<b>NOMBRE:</b>&nbsp;&nbsp;{{$nombres.' '.$apPat.' '.$apMat}}<br><br>
<b>SEXO:</b>&nbsp;&nbsp;{{$sexo}}<br><br>
<b>TELEFONO:</b>&nbsp;&nbsp;{{$telefono}}<br><br>
<b>FECHA DE NACIMIENTO:</b>&nbsp;&nbsp;{{$fechaNac}}<br><br>
@endsection