<div align="center">
      @yield('mensaje')
</div>
<?php   
if(!empty($_GET['rfcB'])) { ?>
    <div class="alert alert-primary animated bounceInDown" role="alert" align="center" >
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        Paciente Encontrado
    </div>

    <p class="alert-dark ">FICHA DE IDENTIFICACION</p>
     @foreach ($datos as $value)  
        <?php $rfc=$value->rfc; ?>
        <?php $nombres=$value->nombres;?>
        <?php $apMat=$value->apMat; ?>
        <?php $apPat=$value->apPat; ?>
        <?php $telefono=$value->telefono; ?>
        <?php $sexo=$value->sexo;?>
        <?php $fechaNac=$value->fechaNac;?>  
    @endforeach
    <form class="form-inline" action="/UsuarioBuscar" method="GET">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
        <input class="form-control mr-sm-2 col-5" type="search" placeholder="Rfc" aria-label="rfc" value="{{$rfc??''}}" name="rfcB" disabled required>
        <button class="btn btn-success my-2 my-sm-0" name="buscar" type="submit" hidden>Buscar</button>&nbsp;
        <a href="HistoriaClinica" class="btn btn-danger"><img src="Imagenes/Iconos/cancel-3x.png">&nbsp;&nbsp;Cancelar</a>  
    </form><br>
    <form class="needs-validation" novalidate action="/HistoriaInsertar" method="POST">
      <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
    <div class="form-row">
            <div class="form-group col-4" >
                <label>Nombre:</label>
                <input class="form-control col" type="text" name="nomPaciente" value="{{$nombres.' '.$apMat.' '.$apPat}}" disabled />
            </div>
            <div class="form-group col-1">
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
            <label>Edad:</label>
             <input class="form-control" type="text" value="{{$edad}}"name="fecPerson" disabled /> 
            </div>
            <div class="form-group col">
                <label>Estado Civil:</label>
                <!--<input class="form-control" type="text" name="estadoCivil" list="estadoCi" value="{{old('estadoCivil')}}"  placeholder="Estado Civil" required/>-->
                <!--<datalist id="estadoCi">-->
                    <select class="custom-select" name="estadoCivil">
                    <option value="soltero">Soltero(a)</option>
                    <option value="casado">casado(a)</option>
                    <option value="divorciado">divorciado(a)</option>
                    <option value="viudo">viudo(a)</option>
                    </select>
                                    @yield('msg')

            </div>
            <div class="form-group col" >
                <label>Telefono:</label>
                <input class="form-control" type="number"   value="{{$telefono}}" name="telPerson" min=0 disabled/>            
                @yield('msg')

            </div>
    </div>
<?php }else{ ?>
<p class="alert-dark ">FICHA DE IDENTIFICACION</p>
<form class="form-inline" action="/UsuarioBuscar" method="GET">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
    <input class="form-control mr-sm-2 col-5" type="search" placeholder="Rfc" aria-label="rfc"  name="rfcB" >
    <button class="btn btn-success my-2 my-sm-0" name="buscar" type="submit">
    <img src="Imagenes/Iconos/search-3x.png">&nbsp;&nbsp;Buscar</button>
</form>
<br>
<form class="needs-validation" novalidate>
  <input type="hidden" name="_token" value="{!! csrf_token() !!}"> 
    <div class="form-row">
        <div class="form-group col">
            <label>Nombre:</label>
            <input class="form-control" type="text" name="nomPaciente" onkeyup="javascript:this.value=this.value.toUpperCase();" />           
        </div>
        <div class="form-group col">
            <label>Edad:</label>
            <input class="form-control" type="text" name="fecPerson"/> 

        </div>
        <div class="form-group col">
           <label>Estado Civil:</label>     
                <select class="custom-select" name="estadoCivil">
                    <option value="soltero">Soltero(a)</option>
                    <option value="casado">casado(a)</option>
                    <option value="divorciado">divorciado(a)</option>
                    <option value="viudo">viudo(a)</option>
                    </select>               @yield('msg')

        </div>
        <div class="form-group col" >
            <label>Telefono:</label>
            <input class="form-control" type="tel"  maxlength="10" name="telPerson" min=0 />
        </div>
    </div>
<?php 
} ?>
    <p class="alert-dark ">DOMICILIO </p>
    <div class="form-row">
        <div class="form-group col" >
            <label>Calle:</label>
            <input class="form-control" type="text"  name="callePaciente" value="{{old('callePaciente')}}"  onkeyup="javascript:this.value=this.value.toUpperCase();"
            required />
            @yield('msg')

        </div>
        <div class="form-group col">
            <label>Numero Exterior:</label>
            <input class="form-control" type="number"  name="numExterior" value="{{old('numExterior')}}" min="0"
            required  />     
             @yield('msg')

        </div>
        <div class="form-group col">
            <label>Numero Interior:</label>
            <input class="form-control" type="number" name="numInterior" value="{{old('numInterior')}}" min="0" onkeyup="javascript:this.value=this.value.toUpperCase();" 
            required/>
            @yield('msg')
 
        </div>
    </div>
    <div class="form-row">
      <div class="form-group col" >
            <label>Colonia:</label>
            <input class="form-control" type="text" name="colonia"  value="{{old('colonia')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"
            required />            
            @yield('msg')

        </div>
        <div class="form-group col" >
            <label>Codigo Postal:</label>
            <input class="form-control" type="number"  name="codigoPost"  value="{{old('codigoPost')}}"  min=0 required />            
            @yield('msg')

        </div>
        <?php  $datosM = DB::select('select * from Municipios ');?>

        <div class="form-group col" >
            <label>Municipio:</label>
           <!-- <input class="form-control" type="text" name="municipo" list="municipos" value="{{old('municipo')}}"  placeholder="Escriba un municipio" required/>-->        
                <select class="custom-select"  name="municipo" required >
                @foreach ($datosM as $value)  
                    <?php $nomMunicipio=$value->NombreMunicipio; ?>
                    <?php $muni=substr($nomMunicipio, 4); ?>
                    <option value="{{$nomMunicipio}}"><?php print($muni); ?></option>
                @endforeach
                </select> 
                @yield('msg')
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
    <div class="form-row">
        <div class="col-2">
            <label for="parenDia">Diabetes:</label>
        </div>
        <div class="col-2">
            <SELECT class="custom-select" name="opDiabetes"  value="{{old('opDiabetes')}}" onchange="if(this.value=='1') {document.getElementById('parenDia').disabled = false} 
                 else {document.getElementById('parenDia').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>
            @yield('msg')
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenDia"  type="text" name="txtDiab" value="{{old('txtDiab')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"   disabled required />            
            @yield('msg')

        </div>
    </div><br>
    <div class="form-row">
        <div class="col-2">
            <label>Hipertension: </label>
        </div>
        <div class="col-2">
             <SELECT class="custom-select" name="opHiper" value="{{old('opHiper')}}"  onchange="if(this.value=='1') {document.getElementById('parenHiper').disabled = false} 
                                           else {document.getElementById('parenHiper').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>    
             @yield('msg')
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenHiper" value="{{old('txtHiper')}}" type="text" name="txtHiper"  onkeyup="javascript:this.value=this.value.toUpperCase();"  disabled required />            
            @yield('msg')
        </div>
    </div><br>
    <div class="form-row">
        <div class="col-2">
            <label>Cardiopatia:</label>
        </div>
        <div class="col-2">
            <SELECT class="custom-select" name="opCardio"  value="{{old('opCardio')}}" onchange="if(this.value=='1') {document.getElementById('parenCardio').disabled = false} 
                                           else {document.getElementById('parenCardio').disabled = true} ">
                <<OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>
            @yield('msg')
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenCardio" type="text" value="{{old('txtCard')}}" name="txtCard" onkeyup="javascript:this.value=this.value.toUpperCase();"  disabled required />            
            @yield('msg')

        </div>
    </div><br>
    <div class="form-row">
        <div class="col-2">
            <label>Cancer:</label>
        </div>
        <div class="col-2">
            <SELECT class="custom-select" name="opCancer" value="{{old('opCancer')}}" onchange="if(this.value=='1') {document.getElementById('parenCancer').disabled = false} 
                                           else {document.getElementById('parenCancer').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>            
             @yield('msg')
  
        </div>
        <div class="col-sm">
            <input class="form-control" id="parenCancer" type="text" name="txtCancer" value="{{old('txtCancer')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"  disabled required/>            
            @yield('msg')

        </div>
    </div><br>
    <div class="form-row">
        <div class="col-2">
            <label>Otros:</label>
        </div>
        <div class="col-sm">
            <input class="form-control" type="text" name="txtOtro" value="{{old('txtOtro')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>            @yield('msg')

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
        <div class="col-2">
            <SELECT class="custom-select" name="opToxi" value="{{old('opToxi')}}" onchange="if(this.value=='1') {document.getElementById('toximania').disabled = false} 
                                           else {document.getElementById('toximania').disabled = true} ">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT> 
        </div>
        <div class="col-1">
            <label>Especifique:</label>
        </div>
        <div class="col-sm">
            <input class="form-control" id="toximania" type="text" value="{{old('txtToxi')}}" name="txtToxi" onkeyup="javascript:this.value=this.value.toUpperCase();"  disabled required/>           
             @yield('msg')

        </div>
    </div><br>
    <div class="form-row">
        <div class="col-2">
            <label>Higiene Bucal:</label>
        </div>
        <div class="col-4">
            <label>Cuantas veces se lava  sus dientes al dia:</label>
        </div>
        <div class="col-2">
             <select class="custom-select"  name="numCep"   >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            @yield('msg')
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
             <SELECT class="custom-select" name="cepillo" >
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT> 
            @yield('msg')

        </div>
        <div class="group col-2">
            <label>Hilo dental</label>
            <SELECT class="custom-select" name="hDental" >
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT> 
            @yield('msg')

        </div>
        <div class="col-2">
            <label>Enjuage</label>
            <SELECT class="custom-select" name="enjuage" >
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>
            @yield('msg')
        </div>
    </div>
    <div class="form-row">
        <div class="col-3">
            <label>Grupo y tipo sanguineo:</label>
        </div>
        <div class="col-3">
            <?php  $datosS = DB::select('select * from tiposanguineo ');?>
            <div class="form-group" >
            <!--<input class="form-control" type="text" name="tipoSan"  value="{{old('tipoSan')}}" list="sanguineo" placeholder="Tipo Sanguineo" required  /> -->           @yield('msg')
                <select class="custom-select" name="tipoSan">
                @foreach ($datosS as $value)  
                    <?php $tiposangui=$value->tipoSangui; ?>
                    <option value="{{$tiposangui}}"><?php print($tiposangui); ?></option>
                @endforeach
                </select> 
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
            <input class="form-control" type="text" name="txtEnfer" value="{{old('txtEnfer')}}"  onkeyup="javascript:this.value=this.value.toUpperCase();"/>            @yield('msg')

        </div>
    </div><br>
    <div class="form-row">
        <div class="col-3">
            <label>Inmunizaciones:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtImmu" value="{{old('txtImmu')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" />            @yield('msg')
        </div>
    </div><br>
    <div class="form-row">
        <div class="col-3">
            <label>Alergias:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtAlegias" value="{{old('txtAlegias')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" />            @yield('msg')
        </div>
    </div><br>
<?php if((!empty($_GET['rfcB']))&&($sexo=="M")) { ?>
    <div class="form-row">
        <div class="col-3">
            <label>Fecha de ultima regla:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="date" require name="fechaRegla" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg')
        </div>
        <div class="col-3">
            <label>Numero de partos:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="number"  name="txtParto"  min="0" max="10" value="0" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg')
        </div>
    </div><br>
    <div class="form-row">
       <div class="col-3">
            <label>Numero de abortos:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="number"  name="txtAborto"  min="0" max="10" value="0" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>@yield('msg')
        </div>
        <div class="col-3">
            <label>Numero de cesareas:</label>
        </div>
        <div class="col-3">
            <input class="form-control" type="number"  name="txtCesarea"  min="0" max="10" value="0" 
            onkeyup="javascript:this.value=this.value.toUpperCase();" required/>            
            @yield('msg')
        </div>
    </div><br>
     <div class="form-row">
       <div class="col-3">
            <label>Embarazo Actual</label>
        </div>
        <div class="col-3">
            <SELECT class="custom-select" name="embActual"  value="{{old('embActual')}}">
                <OPTION value="0">No</OPTION>
                <OPTION value="1">Si</OPTION>
             </SELECT>            
             @yield('msg')
        </div>
    </div><br>
    <?php } ?>
    <div class="form-row">
        <div class="col-3">
            <label>Motivo:</label>
        </div>
        <div class="col">
            <input class="form-control" type="text" name="txtMotivo"  value="{{old('txtMotivo')}}"  onkeyup="javascript:this.value=this.value.toUpperCase();" required/>  @yield('msg')
        </div>
    </div><br>

<?php if(!empty($_GET['rfcB'])) {             
?>
<br>
<div class="form-row">
    <div class="form-group col">   
    </div>
    <div class="form-group col-4">  
        <a href="#!" class="btn btn-success col" data-toggle="modal" data-target="#modalLog2">
        <img src="Imagenes/Iconos/save-3x.png">&nbsp;&nbsp;Guardar historia clinica</a>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalLog2" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center text-primary" id="myModalLabel" align="text-center">¿Guardar datos?</h4>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary col" value="{{$rfc}}" type="submit" name="guardar" >Guardar</button >
                <button type="button" class="btn btn-danger col" data-dismiss="modal">Cancelar</button>
            </div>      
          </div>
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
                    alert("Campos requeridos");
                    //$('#modalLog2').modal('hide');
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
<?php }?>
