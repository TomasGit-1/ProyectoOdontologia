 @foreach ($datos as $value)  
    <?php $rfc=$value->rfc; ?>
    <?php $nombres=$value->nombres;?>
    <?php $apMat=$value->apMat; ?>
    <?php $apPat=$value->apPat; ?>
    <?php $telefono=$value->telefono; ?>
    <?php $sexo=$value->sexo;?>
    <?php $fechaNac=$value->fechaNac;?>  
@endforeach
<form class="needs-validation" novalidate method="post" action="/Paciente/Actualizar" >
 <input type="hidden" name="_token" value="{!! csrf_token() !!}">    
    <div class="form-row">
        <div class="form-group col" >
            <label>RFC:</label>
            <input class="form-control" type="text"  value="{{ $rfc }}" disabled />
        </div>
        <div class="form-group col" >     
        </div>
        <div class="form-group col" >
        </div>
    </div>   
    <div class="form-row">
        <div class="form-group col" >
            <label>Nombre:</label>
            <input class="form-control" type="text" name="nomPaciente" value="{{$nombres}}" onkeyup="javascript:this.value=this.value.toUpperCase();"
            required />
            @yield('msg')

        </div>
         <div class="form-group col">
            <label>Apellido paterno:</label>
            <input class="form-control" type="text" name="apPat" value="{{$apPat}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required/> 
            @yield('msg')

        </div>
        <div class="form-group col">
            <label>Apellido materno:</label>
            <input class="form-control" type="text" name="apMat" value="{{$apMat}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required/>
            @yield('msg')
        </div>
       
    </div>   
    <div class="form-row">
        <div class="form-group col" >
            <label>Telefono:</label>
            <input class="form-control" type="number"value="{{$telefono}}"  name="telPerson" min=0 required/>
            @yield('msg')
        </div>
        <div class="form-group col">
            <label>Fecha de nacimiento:</label>
            <input class="form-control" type="date" value="{{$fechaNac}}" name="fecPerson" required /> 
           @yield('msg')
        </div>
        <div class="form-group col">
            <?php if($sexo=='H'){
            echo('<label>Sexo:</label>
            <select class="custom-select"  name="persona">
                <option value="H">Hombre</option>
                <option value="M">Mujer</option>
            </select> ');
           }else{
            echo('<label>Sexo:</label>
            <select class="custom-select"  name="persona">
                <option value="M">Mujer</option>
                <option value="H">Hombre</option>
            </select> '); 
           }?>
            @yield('msg')
        </div>
    </div><br>
    <div class="form-row">
 
        <div class="form-group col"> 
            <a href="PacienteLista" class="btn btn-danger col"><img src="Imagenes/Iconos/reply-3x.png">&nbsp;&nbsp;Regresar</a>  
        </div>
        <div class="form-group col">  
            <button class=" btn btn-primary col" target='_blank' type="submit" name="rfcPaciente"  value="{{ $rfc }}"> 
                <img src="Imagenes/Iconos/save-3x.png">&nbsp;&nbsp;Actualizar</button >
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