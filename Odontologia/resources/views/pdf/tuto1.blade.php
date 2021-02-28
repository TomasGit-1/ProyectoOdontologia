@extends('pdf.tutoMs')
@section('title','Historia Clinica PDF')
 @section('ver')
 @foreach ($datos as $value)  
    <?php $rfc=$value->rfc; ?>
    <?php $nombres=$value->nombres;?>
    <?php $apMat=$value->apMat; ?>
    <?php $apPat=$value->apPat; ?>
    <?php $telefono=$value->telefono; ?>
    <?php $sexo=$value->sexo;?>
    <?php $fechaNac=$value->fechaNac;?>  
    <?php $folio=$value->folio; ?>
    <?php $tipoSangui=$value->tipoSangui;?>
    <?php $estadoCivil=$value->estadoCivil; ?>
    <?php $idMunicipio=$value->idMunicipio; ?>
    <?php $municipio=$value->NombreMunicipio; ?>
    <?php $colonia=$value->colonia;?>
    <?php $calle=$value->calle;?>  
    <?php $numeroInt=$value->numeroInt; ?>
    <?php $numeroExt=$value->numeroExt;?>
    <?php $cp=$value->cp; ?>
    <?php $diabetes=$value->diabetes;?>
    <?php $diabetesDescr=$value->diabetesDescr;?>
    <?php $hpertension=$value->hpertension;?>
    <?php $hpertensionDescr=$value->hpertensionDescr;?>
    <?php $cardiopatia=$value->cardiopatia;?>
    <?php $cardiopatiaDescr=$value->cardiopatiaDescr;?>
    <?php $cancer=$value->cancer;?>
    <?php $cancerDescr=$value->cancerDescr;?>
    <?php $otros=$value->otros; ?>
    <?php $toxicomanias=$value->toxicomanias;?>
    <?php $especifique=$value->especifique;?>  
    <?php $cepilladas=$value->cepilladas;?>  
    <?php $cepillo=$value->cepillo;?>  
    <?php $hiloDental=$value->hiloDental;?>  
    <?php $enjuague=$value->enjuague;?>  
    <?php $enfermedadesA=$value->enfermedadesA;?>  
    <?php $inmunizaciones=$value->inmunizaciones;?>  
    <?php $alergias=$value->alergias;?>  
    <?php $fechaR=$value->fecha;?>  
    <?php $partos=$value->partos;?>  
    <?php $abortos=$value->abortos;?>  
    <?php $cesareas=$value->cesareas;?>  
    <?php $embarazoActual=$value->embarazoActual;?>  
    <?php $motivoVisita=$value->motivoVisita;?>    
@endforeach
<?php 
$dia=date("d");
$mes=date("m");
$ano=date("Y");
$dianaz=date("d",strtotime($fechaNac));
$mesnaz=date("m",strtotime($fechaNac));
$anonaz=date("Y",strtotime($fechaNac));
if (($mesnaz == $mes) && ($dianaz > $dia)){
    $ano=($ano-1); 
}
if ($mesnaz > $mes) {
    $ano=($ano-1);}
    $edad=($ano-$anonaz);
    $edad=abs($edad);
?>
<img src="Imagenes/enc.png">
<h4 align="center">HISTORIA CLINICA GENERAL</h4>
<p style="background-color:gray;color:white;">FICHA DE IDENTIFICACION</p>
<b>RFC:</b>&nbsp;&nbsp;{{$rfc}}
<br>
<b>NOMBRE:</b>&nbsp;&nbsp;{{$nombres.' '.$apPat.' '.$apMat}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<b>EDAD:</b>&nbsp;&nbsp;{{$edad}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>SEXO:</b>&nbsp;&nbsp;{{$sexo}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>ESTADO CIVIL:</b>&nbsp;&nbsp;{{$estadoCivil}}
<br>
<p style="background-color:gray;color:white;">DOMICILIO</p>
<b>CALLE:</b>&nbsp;&nbsp;{{$calle}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 
<b>NUMERO EXTERIOR:</b>&nbsp;&nbsp;{{$numeroExt}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<b>NUMERO INTERIOR:</b>&nbsp;&nbsp;{{$numeroInt}}
<br>
<b>COLONIA:</b>&nbsp;&nbsp;{{$colonia}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>C.P:</b>&nbsp;&nbsp;{{$cp}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>MUNICIPIO:</b>&nbsp;&nbsp;{{$municipio}}
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>TELEFONO:</b>&nbsp;&nbsp;{{$telefono}}
<p style="background-color:gray;color:white;">ANTECEDENTES HEREDERO FAMILIARES</p>
<!-- OPCION METERLO A TABLE-->
<!--Diabetes-->
<?php if($diabetes=="1"){ ?>
    <b>DIABETES:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$diabetesDescr}}
<?php } else{ ?>
    <b>DIABETES:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$diabetesDescr}}
<?php } ?>
<br>
<!--HIPERTENSION-->
<?php if($hpertension=="1"){ ?>
    <b>HIPERTENSION:</b>&nbsp;&nbsp;&nbsp;&nbsp;SI
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$hpertensionDescr}}
<?php } else{ ?>
    <b>HIPERTENSION:</b>&nbsp;&nbsp;&nbsp;&nbsp;NO
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$hpertensionDescr}}
<?php } ?>
<br>
<!--CARDIOPATIA-->
<?php if($cardiopatia=="1"){ ?>
    <b>CARDIOPATIA:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$cardiopatiaDescr}}
<?php } else{ ?>
    <b>CARDIOPATIA:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$cardiopatiaDescr}}
<?php } ?>
<br>
<!--CARDIOPATIA-->
<?php if($cancer=="1"){ ?>
    <b>CANCER :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$cancerDescr}}
<?php } else{ ?>
    <b>CANCER :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>PARENTESCO</b>&nbsp;&nbsp;{{$cancerDescr}}
<?php } ?>
<br>
<b>OTROS:</b>&nbsp;&nbsp;{{$otros}}
<p style="background-color:gray;color:white;">ANTECEDENTES PERSONALES NO PATOLOGICOS</p>
<!--TOXICOMANIAS-->
<?php if($toxicomanias=="1"){ ?>
    <b>TOXICOMANIAS:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>ESPECIFIQUE</b>&nbsp;&nbsp;{{$especifique}}
<?php } else{ ?>
    <b>TOXICOMANIAS:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>ESPECIFIQUE</b>&nbsp;&nbsp;{{$especifique}}
<?php } ?>
<br>
<b>HIGIENE BUCAL</b><br>
<b>CUANTAS VECES CEPILLA SUS DIENTES AL DIA:</b>&nbsp;&nbsp;{{$cepilladas}}<br>
<b>EN EL PROCESO OCUPA</b><br>
<!--cepillo-->
<?php if($cepillo=="1"){ ?>
    <b>CEPILLO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
<?php } else{ ?>
    <b>CEPILLO:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
<?php } ?>
<br>
<!--hilo-->
<?php if($hiloDental=="1"){ ?>
    <b>HILO DENTAL :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
<?php } else{ ?>
    <b>HILO DENTAL :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
<?php } ?>
<br>
<!--enjuague-->
<?php if($enjuague=="1"){ ?>
    <b>ENJUAGUE:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI
<?php } else{ ?>
    <b>ENJUAGUE:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO
<?php } ?>
<br>
<b>TIPO SANGUINEO:</b>&nbsp;&nbsp;{{$tipoSangui}}
<p style="background-color:gray;color:white;">ANTECEDENTES PERSONALES PATOLOGICOS</p>
<b>EMFERMEDADES ACTUALES:</b>&nbsp;&nbsp;{{$enfermedadesA}}<br>
<b>INMUNIZACIONES:</b>&nbsp;&nbsp;{{$inmunizaciones}}<br>
<b>ALERGIAS:</b>&nbsp;&nbsp;{{$alergias}}<br>
<?php if($sexo=="M"){ ?>
    <b>FECHA DE ULTIMA REGLA:</b>&nbsp;&nbsp;{{$fechaR}}<br>
    <b>PARTOS:</b>&nbsp;&nbsp;{{$partos}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>ABORTOS:</b>&nbsp;&nbsp;{{$abortos}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>CESAREAS:</b>&nbsp;&nbsp;{{$cesareas}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>EMBARAZO ACTUAL:</b>&nbsp;&nbsp;
    <?php if($embarazoActual=="1"){ ?>
        SI
        <b>NUMERO DE EMBARAZOS:</b>&nbsp;&nbsp;{{$partos+$abortos+$cesareas+1}}<br>
    <?php } else{ ?>
        NO
        <b>NUMERO DE EMBARAZOS:</b>&nbsp;&nbsp;{{$partos+$abortos+$cesareas}}<br>
    <?php } ?>
<br>
<?php }?>
<b>MOTIVO:</b>&nbsp;&nbsp;{{$motivoVisita}}<br>
@endsection