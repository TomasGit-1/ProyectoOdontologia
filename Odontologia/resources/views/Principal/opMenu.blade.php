<div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">
                <div class="modal-header">
                  <small class="modal-title text-center text-primary"id="myModalLabel">
                                    <h5 class="text-danger">¿Desea salir?</h5></small>
                </div>
                <div class="modal-footer">
                    <a href="/cerrarSession" id="btnCobrar" class="btn btn-primary col">SI</a>
                    <button type="button" class="btn btn-danger col" data-dismiss="modal">NO</button>
                </div>      
              </div>
        </div>
    </div>
<br>

<div class="container-fluid">
  <div class="row" style="justify-content: center;">
    <div class="col-sm-3 border bg-white"><br>
        <div class="thumbnail text-center">
            <img class="img-thumbnail img-responsive" src="Imagenes/Paciente/add.png" alt="Image"  width="120" height="120">
            <div class="caption">
              <br>
              <a href="/Paciente" class="btn btn-success col-5"><h6 class="text-white">Registro</h6></a>
            </div>
        </div><br>
    </div>&nbsp;
     <div class="col-sm-3 border bg-white">
      <div class="thumbnail text-center" ><br>
        <img class="img-thumbnail img-responsive" src="Imagenes/Paciente/list.png" alt="Image"  width="120" height="120">
        <div class="caption"><br>
          <a href="/PacienteLista" class="btn btn-success col-5"><h6 class="text-white">Pacientes</h6></a>
        </div>
      </div><br>
    </div>&nbsp;
  </div>
  <br>

  <div class="row" style="justify-content: center;">
     <div class="col-sm-3 border bg-white">
      <div class="thumbnail text-center" ><br>
        <img class="img-thumbnail img-responsive" src="Imagenes/Paciente/money.png" alt="Image"  width="120" height="120">
        <div class="caption"><br>
          <a href="{{action('pagos@pagosI')}}" class="btn btn-success col-5"><h6 class="text-white">Pagos</h6></a>
        </div>
      </div><br>
    </div>&nbsp;
    <div class="col-sm-3 border bg-white">
      <div class="thumbnail text-center" ><br>
          <img class="img-thumbnail img-responsive" src="Imagenes/Paciente/mes.png" alt="Image"  width="120" height="120">
          <div class="caption"><br>
            <a href="{{action('historiaClinica@Listar')}}" class="btn btn-success col-6"><h6 class="text-white">Mensualidades</h6></a>
          </div>
      </div><br>
    </div>
  </div>  
</div>      <br>

