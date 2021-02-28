@yield('mensaje')
<br>
<form class="needs-validation" novalidate method="post" action="/Paciente/Insertar" class="needs-validation" >
 <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
    <div class="form-row">
        <div class="form-group col" >
            <label>Nombre:</label>
            <input class="form-control" type="text" 
            name="nomPaciente" value="{{old('nomPaciente')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required />
            @yield('msg')
        </div>
        <div class="form-group col">
            <label>Apellido paterno:</label>    
            <input class="form-control" type="text"
            name="apPat" value="{{old('apPat')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required /> 
            @yield('msg')
        </div>
        <div class="form-group col">
            <label>Apellido materno:</label>
            <input class="form-control" type="text" name="apMat" value="{{old('apMat')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required /> 
             @yield('msg')
        </div>
    </div>   
    <div class="form-row">
        <div class="form-group col" >
            <label>Telefono:</label>
            <input class="form-control" type="number" name="telPerson" maxlength="10" value="{{old('telPerson')}}" required />@yield('msg')
        </div>
        <div class="form-group col">
            <label>Fecha de nacimiento:</label>
            <?php $fechaActual=date("Y-m-d");
                  $fechaMax=date("Y-m-d",strtotime($fechaActual."-2 year"));
                  $fechaMin=date("Y-m-d",strtotime($fechaActual."-100 year"));?>
            <input class="form-control" type="date" name="fecPerson"
                                                    min="<?php echo $fechaMin;?>" 
                                                    max="<?php echo $fechaMax;?>" 
                                                    value="{{old('fecPerson')}}"
                                                     required/> 
            @yield('msg')
        </div>
        <div class="form-group col">
                <label>Sexo:</label>
                <select class="custom-select" name="persona" value="{{old('persona')}}" required >
                    <option value="">Elige una opcion</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                </select>
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
        </div>
        <div class="form-group col-4"> 
            <a href="#!" class=" btn btn-success col" data-toggle="modal" data-target="#modalLog"
                onclick="document.getElementById('btnCobrar').disabled= true;
                         document.getElementById('activar').checked=false;
                         <?php
                            $tratamiento=DB::select('SELECT * FROM  catalogoservicios WHERE claveServicio=8');  
                            $precio=array_column($tratamiento,"costo");
                         ?>
                         document.getElementById('txtMonto').innerHTML='$'+<?php echo "".$precio[0]; ?>;

                        " 
            ><img src="Imagenes/Iconos/save-3x.png">&nbsp;&nbsp;Registrar Paciente</a>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true" >
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
                <div class="modal-header">
                  <small class="modal-title text-center text-primary"id="myModalLabel">
                                    <p class="text-danger h4">Atencion!</p>
                                    <p class="text-dark h4" align="justify">
                                      Si desea continuar con el registro del paciente se cobrar un monto de 
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
                    $('#modalLog').modal('hide');
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