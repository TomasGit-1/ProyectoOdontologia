 @foreach ($datos as $value)  
    <?php $rfc=$value->rfc; ?>
    <?php $nombres=$value->nombres;?>
    <?php $apMat=$value->apMat; ?>
    <?php $apPat=$value->apPat; ?>
    <?php $telefono=$value->telefono; ?>
    <?php $sexo=$value->sexo;?>
    <?php $fechaNac=$value->fechaNac;?>  
    <?php $folio=$value->folio; ?>
    <?php $claveSangui=$value->claveSangui;?>
    <?php $estadoCivil=$value->estadoCivil; ?>
    <?php $idMunicipio=$value->idMunicipio; ?>
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
    $ano=($ano-1);
}
    $edad=($ano-$anonaz);
    $edad=abs($edad);
?>
<form class="needs-validation" novalidate action="/HistoriaActualizar" method="POST">
<p class="alert-dark ">FICHA DE IDENTIFICACION</p>
  <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
      <div class="form-row">
        <div class="form-group col-5">
            <label>RFC:</label>
            <input class="form-control" type="search" placeholder="Rfc" aria-label="rfc" value="{{$rfc??''}}" name="rfcB" disabled required>
        </div>
      </div>
    <div class="form-row">
        <div class="form-group col">
            <label>Nombre:</label>
            <input class="form-control" type="text" name="nomPaciente" value="{{$nombres.' '.$apMat.' '.$apMat}}" onkeyup="javascript:this.value=this.value.toUpperCase();" disabled required/>@yield('msg')
        </div>
        <div class="form-group col">
            <label>Edad:</label>
            <input class="form-control" type="text" value="{{$edad}}" name="fecPerson" disabled required /> @yield('msg')
        </div>
        <div class="form-group col">
            <label>Estado Civil:</label>
            <!--<input class="form-control" type="text" name="estadoCivil" value="{{$estadoCivil}}" list="estadoC"  required/>@yield('msg')-->
            <?php if($estadoCivil=='soltero'){
                    echo('<label>Sexo:</label>
                    <select class="custom-select"  name="estadoCivil" required>
                        <option value="soltero">soltero(a)</option>
                        <option value="casado">casado(a)</option>
                        <option value="divorciado">divorciado(a)</option>
                        <option value="viudo">viudo(a)</option>
                    </select> ');
             }else if($estadoCivil=="casado"){ 
                echo('<label>Sexo:</label>
                     <select class="custom-select"  name="estadoCivil" required>
                        <option value="casado">casado(a)</option>
                        <option value="soltero">soltero(a)</option>
                        <option value="divorciado">divorciado(a)</option>
                        <option value="viudo">viudo(a)</option>
                    </select>');
                   
             }else if($estadoCivil=="divorciado"){
             echo('<label>Sexo:</label>
                      <select class="custom-select"  name="estadoCivil" required>
                        <option value="divorciado">divorciado(a)</option>
                        <option value="soltero">soltero(a)</option>
                        <option value="casado">casado(a)</option>
                        <option value="viudo">viudo(a)</option>
                    </select>');                   
            }else{
                echo('<label>Sexo:</label>
                      <select class="custom-select"  name="estadoCivil" required>
                        <option value="viudo">viudo(a)</option>
                        <option value="soltero">soltero(a)</option>
                        <option value="casado">casado(a)</option>
                        <option value="divorciado">divorciado(a)</option>                   
                    </select>'); 
            } ?>
        </div>
        <div class="form-group col" >
            <label>Telefono:</label>
            <input class="form-control" type="number" name="telPerson" value="{{$telefono}}" min=0  disabled/>@yield('msg')
        </div>
    </div>
    <p class="alert-dark ">DOMICILIO </p>
    <div class="form-row">
        <div class="form-group col" >
            <label>Calle:</label>
            <input class="form-control" type="text"  value="{{$calle}}" name="callePaciente" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg')
        </div>
        <div class="form-group col">
            <label>Numero Exterior:</label>
            <input class="form-control" type="number"  name="numExterior" value="{{$numeroExt}}" min="0" required />@yield('msg')
        </div>
        <div class="form-group col">
            <label>Numero Interior:</label>
            <input class="form-control" type="number" name="numInterior" min="0" value="{{$numeroInt}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg') 
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col" >
            <label>Colonia:</label>
            <input class="form-control" type="text" name="colonia" value="{{$colonia}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg')
        </div>
        <div class="form-group col" >
            <label>Codigo Postal:</label>
            <input class="form-control" type="number"  name="codigoPost"  value="{{$cp}}" min=0  required/>@yield('msg')
        </div>
        <?php  $datosM2 = DB::select('select * from Municipios where idMunicipio="'.$idMunicipio.'"');?>
        <?php  $datosM = DB::select('select * from Municipios where idMunicipio!="'.$idMunicipio.'"');?>
        <div class="form-group col" >
            <label>Municipio:</label>
            @foreach ($datosM2 as $value)  
                    <?php $nomMunicipio2=$value->NombreMunicipio; ?>
            @endforeach
            <select class="custom-select" name="municipo"  required>
                <?php $nomMunicipio=$value->NombreMunicipio; ?>
                <?php $muni=substr($nomMunicipio, 4); ?>  
                <option value="{{$nomMunicipio2}}"><?php print($muni); ?></option>
                @foreach ($datosM as $value)  
                    <?php $nomMunicipio=$value->NombreMunicipio; ?>
                    <?php $muni=substr($nomMunicipio, 4); ?>  
                    <?php $nomMunicipio=$value->NombreMunicipio; ?>
                    <option value="{{$nomMunicipio}}"><?php print($muni); ?></option>
                @endforeach
            </select> 
        </div>
    </div>
    <div class="form-row ">
            <div class="form-group col alert-dark">
                ANTECEDENTES HEREDO FAMILIARES 
            </div>
            <div class="form-group col alert-dark">
                PARENTESCO
            </div>
    </div>
    <!-- Validar que existan campos -->
   <div class="form-row">
        <div class="col-2">
           <label>Diabetes:</label>
        </div>                   
    <?php if($diabetes=="1"){?>
        <div class="col-2">
            <SELECT class="custom-select" name="opDiabetes"  onchange="if(this.value=='1') {document.getElementById('parenDia').disabled = false} 
                                           else {document.getElementById('parenDia').disabled = true} " required>
                <OPTION value="1">Si</OPTION>
                <OPTION value="0">No</OPTION>
             </SELECT>@yield('msg')
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenDia"  type="text" name="txtDiab" value="{{$diabetesDescr}}" onkeyup="javascript:this.value=this.value.toUpperCase();"  required />@yield('msg')
        </div>
    </div><br>
    <?php }else{?>
                <div class="col-2">
                    <SELECT class="custom-select" name="opDiabetes"  onchange="if(this.value=='1') {document.getElementById('parenDia').disabled = false} 
                                                   else {document.getElementById('parenDia').disabled = true} " required>
                        <OPTION value="0">No</OPTION>
                        <OPTION value="1">Si</OPTION>
                     </SELECT>@yield('msg')
                </div>
                <div class="col-sm">
                    <input class="form-control" id="parenDia"  type="text" name="txtDiab" disabled onkeyup="javascript:this.value=this.value.toUpperCase();"  required />
                </div>
            </div><br>
    <?php }?>
    <div class="form-row">
        <div class="col-2">
            <label>Hipertension: </label>
        </div>
    <?php if($hpertension=="1"){?>
        <div class="col-2">
             <SELECT class="custom-select" name="opHiper" required onchange="if(this.value=='1') {document.getElementById('parenHiper').disabled = false} 
                                           else {document.getElementById('parenHiper').disabled = true} ">
                <OPTION value="1">Si</OPTION>
                <OPTION value="0">No</OPTION>
             </SELECT>@yield('msg')    
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenHiper" type="text" name="txtHiper" value="{{$hpertensionDescr}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required />@yield('msg')
        </div>
    </div><br>
    <?php }else{?>
        <div class="col-2">
             <SELECT class="custom-select" name="opHiper" required onchange="if(this.value=='1') {document.getElementById('parenHiper').disabled = false} 
                                           else {document.getElementById('parenHiper').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>@yield('msg')    
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenHiper" type="text" name="txtHiper"onkeyup="javascript:this.value=this.value.toUpperCase();" required disabled />@yield('msg')
        </div>
    </div><br>
    <?php }?>
<div class="form-row">
        <div class="col-2">
            <label>Cardiopatia:</label>
        </div>
    <?php if($cardiopatia=="1"){?>
        <div class="col-2">
            <SELECT class="custom-select" name="opCardio" required onchange="if(this.value=='1') {document.getElementById('parenCardio').disabled = false} 
                                           else {document.getElementById('parenCardio').disabled = true} ">
                <OPTION value="1">Si</OPTION>
                <OPTION value="0">No</OPTION>
             </SELECT>@yield('msg')  
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenCardio" type="text" name="txtCard" value="{{$cardiopatiaDescr}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required />@yield('msg')
        </div>
    </div><br>
    <?php }else{?>
        <div class="col-2">
            <SELECT class="custom-select" name="opCardio" required onchange="if(this.value=='1') {document.getElementById('parenCardio').disabled = false} 
                                           else {document.getElementById('parenCardio').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>@yield('msg')  
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenCardio" type="text" name="txtCard" onkeyup="javascript:this.value=this.value.toUpperCase();" required disabled />@yield('msg')
        </div>
    </div><br>
    <?php }?>
 <div class="form-row">
    <div class="col-2">
        <label>Cancer:</label>
    </div>
    <?php if($cancer=="1"){?>
        <div class="col-2">
            <SELECT class="custom-select" name="opCancer" required onchange="if(this.value=='1') {document.getElementById('parenCancer').disabled = false} 
                                           else {document.getElementById('parenCancer').disabled = true} ">
                <<OPTION value="1">Si</OPTION>
                <OPTION value="0">No</OPTION>
             </SELECT>@yield('msg')  
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenCancer" type="text" name="txtCancer" value="{{$cancerDescr}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg')
        </div>
    </div><br>
    <?php }else{?>
        <div class="col-2">
            <SELECT class="custom-select" name="opCancer" required onchange="if(this.value=='1') {document.getElementById('parenCancer').disabled = false} 
                                           else {document.getElementById('parenCancer').disabled = true} ">
                <OPTION value="0">No</OPTION>
                 <OPTION value="1">Si</OPTION>

             </SELECT>@yield('msg')  
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenCancer" type="text" name="txtCancer" onkeyup="javascript:this.value=this.value.toUpperCase();" required disabled/>@yield('msg')
        </div>
    </div><br>
    <?php }?>
    <div class="form-row">
        <div class="col-2">
        <label>Otros:</label>
        </div>
        <div class="col-sm">
            <input class="form-control" type="text" name="txtOtro"  value="{{$otros}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required />@yield('msg')
        </div>
    </div><br>

    <div class="form-row ">
            <div class="form-group col alert-dark">
                ANTECEDENTES PERSONALES NO PATOLOGICOS 
        </div>
    </div>
    <div class="form-row">
        <div class="col-2">
            <label>Toxicomanias:</label>
        </div>
    <?php if($toxicomanias=="1"){?>
        <div class="col-2">
            <SELECT class="custom-select" name="opToxi" required onchange="if(this.value=='1') {document.getElementById('toximania').disabled = false} 
                                           else {document.getElementById('toximania').disabled = true} ">
                <OPTION value="1">Si</OPTION>
                <OPTION value="0">No</OPTION>
             </SELECT>@yield('msg') 
        </div>
        <div class="col-1">
            <label>Especifique:</label>
        </div>
        <div class="col-sm">
            <input class="form-control" id="toximania" type="text" name="txtToxi" value="{{$especifique}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required />@yield('msg')
        </div>
    </div><br>
    <?php }else{?>
        <div class="col-2">
            <SELECT class="custom-select" name="opToxi" required onchange="if(this.value=='1') {document.getElementById('toximania').disabled = false} 
                                           else {document.getElementById('toximania').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT> @yield('msg')
        </div>
        <div class="col-1">
            <label>Especifique:</label>
        </div>
        <div class="col-sm">
            <input class="form-control" id="toximania" type="text" name="txtToxi" onkeyup="javascript:this.value=this.value.toUpperCase();" required disabled/>@yield('msg')
        </div>
    </div><br>
    <?php }?>

    <!-- Vlidar Campos -->
    <div class="form-row">
        <div class="col-2">
            <label>Higiene Bucal:</label>
        </div>
        <div class="col-4">
            <label>Cuantas veces se cepilla sus dientes al dia:</label>
        </div>
        <div class="col-2">
             <select class="custom-select"  name="numCep" required  >
                <?php if($cepilladas=="1"){?>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>  
                <?php }else if($cepilladas=="2"){ ?>
                    <option value="2">2</option>
                    <option value="1">1</option>
                    <option value="3">3</option>  
                <?php }else if($cepilladas=="3"){?>
                    <option value="3">3</option> 
                    <option value="1">1</option>
                    <option value="2">2</option>
                <?php }?>
            </select> @yield('msg')  
        </div>
    </div><br>
    <div class="form-row">
        <div class="col-2">
            <label></label>
        </div>
        <div class="col-3">
            <label>En el proceso ocupa:</label>
        </div>
        <div class="form-group col-2">
            <label>Cepillo</label>
             <SELECT class="custom-select" name="cepillo" required>
                <?php if($cepillo=="1"){?>
                    <OPTION value="1">Si</OPTION>
                    <OPTION value="0">No</OPTION>
                <?php }else{ ?>
                    <OPTION value="0">No</OPTION>
                    <OPTION value="1">Si</OPTION>
                <?php } ?>

             </SELECT> @yield('msg')
        </div>
        <div class="group col-2">
            <label>Hilo dental</label>
            <SELECT class="custom-select" name="hDental" required>
                 <?php if($hiloDental=="1"){?>
                    <OPTION value="1">Si</OPTION>
                    <OPTION value="0">No</OPTION>
                <?php }else{ ?>
                    <OPTION value="0">No</OPTION>
                    <OPTION value="1">Si</OPTION>
                <?php } ?>
             </SELECT>@yield('msg') 
        </div>
        <div class="col-2">
            <label>Enjuage</label>
            <SELECT class="custom-select" name="enjuage" required>
                 <?php if($enjuague=="1"){?>
                    <OPTION value="1">Si</OPTION>
                    <OPTION value="0">No</OPTION>
                <?php }else{ ?>
                    <OPTION value="0">No</OPTION>
                    <OPTION value="1">Si</OPTION>
                <?php } ?>
             </SELECT>@yield('msg')
        </div>
    </div>
    <div class="form-row">
        <div class="col-3">
            <label>Grupo y tipo sanguineo:</label>
        </div>
        <div class="col-3">
            <?php  $datosS = DB::select('select * from tiposanguineo  where claveSangui!="'.$claveSangui.'"');?>
            <?php  $datosS2 = DB::select('select * from tiposanguineo where claveSangui="'.$claveSangui.'"');?>
            <div class="form-group" >
            @foreach ($datosS2 as $value)  
               <?php $tiposangui2=$value->tipoSangui; ?>
            @endforeach
            <!--<input class="form-control" type="text" name="tipoSan" list="sanguineo" value="{{$tiposangui2}}" placeholder="Tipo Sanguineo" required />-->
            <select class="custom-select" name="tipoSan" required>
                <option value="{{$tiposangui2}}"><?php print($tiposangui2); ?></option>
                @foreach ($datosS as $value)  
                    <?php $tiposangui=$value->tipoSangui; ?>
                    <option value="{{$tiposangui}}"><?php print($tiposangui); ?></option>
                @endforeach
            </select> 
            @yield('msg')
        </div>
        </div>
    </div><br>
     <div class="form-row ">
            <div class="form-group col alert-dark">
                ANTECEDENTES PERSONALES PATOLOGICOS 
            </div>
    </div>
    <div class="form-row">
        <div class="col-3">
            <label>Enfermedades actuales:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtEnfer" value="{{$enfermedadesA}}"  onkeyup="javascript:this.value=this.value.toUpperCase();"/>@yield('msg')
        </div>
    </div><br>
    <div class="form-row">
        <div class="col-3">
            <label>Inmunizaciones:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtImmu" value="{{$inmunizaciones}}"  onkeyup="javascript:this.value=this.value.toUpperCase();" />@yield('msg')
        </div>
    </div><br>
    <div class="form-row">
        <div class="col-3">
            <label>Alergias:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtAlegias" value="{{$alergias}}"  onkeyup="javascript:this.value=this.value.toUpperCase();" />@yield('msg')
        </div>
    </div><br>
    <?php if(($sexo=="M")) { ?>
    <div class="form-row">
        <div class="col-3">
            <label>Fecha de ultima regla:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="date" name="fechaRegla" value="{{$fechaR}}" onkeyup="javascript:this.value=this.value.toUpperCase();" />
        </div>
        <div class="col-3">
            <label>Numero de partos:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="number" name="txtParto" min="0" value="{{$partos}}" max="10" onkeyup="javascript:this.value=this.value.toUpperCase();" />@yield('msg')
        </div>
    </div><br>
    <div class="form-row">
       <div class="col-3">
            <label>Numero de abortos:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="number" name="txtAborto" value="{{$abortos}}" min="0" max="10" onkeyup="javascript:this.value=this.value.toUpperCase();" />@yield('msg')
        </div>
        <div class="col-3">
            <label>Numero de cesareas:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="number" name="txtCesarea" value="{{$cesareas}}" min="0" max="10" onkeyup="javascript:this.value=this.value.toUpperCase();"/>@yield('msg')
        </div>
        
    </div><br>
     <div class="form-row">
       <div class="col-3">
            <label>Embarazo Actual</label>
        </div>
        <div class="col-3">
            <SELECT class="custom-select" name="embActual" required>
               <?php if($embarazoActual=="1"){?>
                <OPTION value="1">Si</OPTION>
                 <OPTION value="0">No</OPTION>

            <?php }else{?>
                 <OPTION value="0">No</OPTION>
                                 <OPTION value="1">Si</OPTION>

            <?php }?>
             </SELECT>@yield('msg') 
        </div>
    </div><br>
    <?php } ?>
    <div class="form-row">
        <div class="col-3">
            <label>Motivo:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtMotivo" value="{{$motivoVisita}}" required onkeyup="javascript:this.value=this.value.toUpperCase();" />@yield('msg')
        </div>
    </div><br>
    <br>
    <div class="form-row">
        <div class="form-group col">  
            <a href="HistoriaLista" class="btn btn-danger col"><img src="Imagenes/Iconos/reply-3x.png">&nbsp;&nbsp;Regresar</a>  
        </div>
        <div class="form-group col-6">  
           <button class="btn btn-primary col" value="{{$rfc}}" type="submit" name="Actualizar" >
                <img src="Imagenes/Iconos/save-3x.png">&nbsp;&nbsp;Actualizar</button>
            <!--<button class=" btn btn-outline-success col" value="{{$rfc}}" type="submit" name="guardar" >Guardar</button >-->
        </div>
    </div>
</form>
<script>
(
   function() //Evento
   {
     'use strict';
     //Manejadores de Eventos Dom
      window.addEventListener('load', function() 
      {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function(form) 
        {
            form.addEventListener('submit', function(event) 
            {
                if (form.checkValidity() === false)
                {
                    //$('#modalLog2').modal('hide');
                    alert("Campos requeridos");
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
      },false);
   }
)();
</script>