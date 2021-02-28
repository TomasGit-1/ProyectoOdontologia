@foreach ($datos as $value)  
  <?php $rfc=$value->rfc; ?>
    <?php $nombres=$value->nombres;?>
        <?php $apMat=$value->apMat; ?>
        <?php $apPat=$value->apPat; ?>
@endforeach
<div class="alert alert-primary animated bounceInDown" role="alert" align="center" >
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    Paciente Encontrado
</div>
<br>
<form class="needs-validation" novalidate method="post" action="/pagosIns" >
<input type="hidden" name="_token" value="{!! csrf_token() !!}">   
<input type="hidden" name="rfcB" value="{{$rfc}}">   
<div class="form-row">
  <div class="form-group col" >
    <input class="form-control mr-sm-2 col" type="text-center" value="{{$rfc}}" aria-label="rfc"  name="rfcB" disabled >
  </div>
  <div class="form-group col">
    <a href="/Pagos" class="btn btn-danger"><img src="Imagenes/Iconos/cancel-3x.png">&nbsp;&nbsp;Cancelar</a>  
  </div>
</div>
 <div class="form-row">
  <div class="form-group col" >
      <label>Nombre:</label>
      <input class="form-control" type="text" name="nomPaciente" value="{{$nombres.' '.$apMat.' '.$apPat}}" disabled />
  </div>
</div>
<div class="form-row">
        <div class="form-group col" >
           <?php  $servicio = DB::select('select * from catalogoservicios');?>
            <label>Tratamiento:</label>
            <select class="custom-select" name="opTra" onchange="myPrecio()" id="opcion" required>   
              <option value="">Elige un opcion</option>

              @foreach ($servicio as $value)  
                    <?php $nomSer=$value->nombreServicio; ?>
                    <?php $claveSer=$value->claveServicio; ?>
                    <?php $precio=$value->costo; ?>
                    <option value="{{$claveSer}}"><?php print($nomSer);?></option>
                @endforeach
            </select>
            @yield('msg')
        </div>
        <div class="form-group col">
            <label>Precio:</label>    
            <input class="form-control" id="cambio" type="text" value="" name="precioTra" disabled /> 
            @yield('msg')
        </div>
</div>   
<div class="form-row">
    <div class="form-group col" >
        <label>Alumno:</label>
        <?php  $alum = DB::select('select * from alumnos inner join personas on alumnos.rfc=personas.rfc');?>
        <select class="custom-select" name="opAlum" required>
          <option value="">Elije un opcion</option>
          @foreach ($alum as $value)  
            <?php $nomAlu=$value->nombres; ?>
            <?php $apPat=$value->apPat; ?>
            <?php $apMat=$value->apMat; ?>
            <?php $matricula=$value->matricula; ?>
            <option value="{{$matricula}}"><?php print($matricula." ".$nomAlu." ".$apPat." ".$apMat); ?></option>
          @endforeach
        </select>
        @yield('msg')
    </div>
</div>
<div class="form-row">
    <div class="form-group col" >
        <label>Maestro:</label>
        <?php  $maestro = DB::select('select * from profesores inner join personas on profesores.rfc=personas.rfc');?>
        <select class="custom-select" name="opMaestro" required>
          <option value="">Elije un opcion</option>

          @foreach ($maestro as $value)  
            <?php $nomMaestro=$value->nombres; ?>
            <?php $apPatM=$value->apPat; ?>
            <?php $apMatM=$value->apMat; ?>
            <?php $cedula=$value->cedula; ?>
            <option value="{{$cedula}}"><?php print($cedula." ".$nomMaestro." ".$apPatM." ".$apMatM); ?></option>
          @endforeach
        </select>
        @yield('msg')
    </div>
</div>
<div class="form-row">
  <div class="form-group col">
        <label>Observaciones:</label>    
        <input class="form-control" type="text" name="observacion" >
            @yield('msg')
    </div>
</div>
<div class="form-row">
    <div class="form-group col">   
    </div>
    <div class="form-group col-4"> 
        <a href="#!" class=" btn btn-success col" data-toggle="modal" data-target="#modalLog"
                onclick=" document.getElementById('btnCobrar').disabled= true;
                          document.getElementById('activar').checked=false;
                          document.getElementById('txtMonto').innerHTML=document.getElementById('cambio').value;

                        " 
        ><img src="Imagenes/Iconos/save-3x.png">&nbsp;&nbsp;Generar Recibo</a>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <small class="modal-title text-center text-primary"id="myModalLabel">
                                    <p class="text-danger h4">Atencion!</p>
                                    <p class="text-dark h4" align="justify">
                                      Si desea continuar con el pago del servicio se cobrar un monto de 
                                      <label class="text-danger" id="txtMonto"></label>
                                       y se generara el ticket correspondiente.
                                    </p>

                                    <h6>Active la casilla si esta seguro <br>realizar esta operacion</h6>
                                    <input  type="checkbox" id="activar" class="form-group" required 
                                            onchange="if(this.checked==true){
                                                            document.getElementById('btnCobrar').disabled = false
                                                        }else {
                                                            document.getElementById('btnCobrar').disabled = true}" 
                                    />&nbsp;&nbsp;<label>Activar</label></small>
      </div>
      <div class="modal-footer">
          <button type="submit" id="btnCobrar" class="btn btn-primary col" name="btninser" disabled>Cobrar</button>
          <button type="button" class="btn btn-danger col" data-dismiss="modal">Cancelar</button>
      </div>      
    </div>
  </div>
</div>
<script type="text/javascript">
  function myPrecio(){
        <?php $datos = DB::select('select costo from catalogoservicios');?>
        var arrayDatos=<?php echo json_encode($datos);?>;
     
        <?php  
            echo 'var id=document.getElementById("opcion").value;
                  document.getElementById("cambio").value="$"+Object.values(arrayDatos[id-1]);
            ';
        ?>

  }
</script>
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
                    //$('#modalLog').modal('hide');
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