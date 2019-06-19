<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de usuarios</a>
      </li>
      <li class="breadcrumb-item active">Seleccione que desea hacer</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="agregar_usuario()" style="padding: 1rem"
                id="agregar_usuario">Agregar usuario</button>
            </div>

            <div class="col-md-4 ">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="" style="padding: 1rem"
                id="modificar_usuario">Modificar usuario</button>
            </div>

            <div class="col-md-4">
              <button type="button" class="btn btn-warning btn-lg btn-block" onclick="" style="padding: 1rem"
                id="eliminar_usuario">Eliminar usuario</button>
            </div>
          </div>
        </div>


        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" class="form-control text-uppercase" id="usuario_agregar"
                  placeholder="Nombre de usuario">
                <label for="usuario_agregar">Usuario</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text"  class="form-control text-uppercase" id="password_agregar"
                  placeholder="Contraseña">
                <label for="password_agregar">Contraseña</label>
              </div>
            </div>

            <div class="col-md-4">
              <button type="button"  class="btn btn-primary btn-lg btn-block">Crear contraseña</button>
            </div>

          </div>
        </div>
        
        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="mail"  class="form-control text-uppercase" id="correo_agregar"
                  placeholder="Contraseña">
                <label for="correo_agregar">Correo</label>
              </div>
            </div>

            <div class="col-md-6">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="rol_agregar" name="rol_agregar">
                  <option value="">Seleccione</option>
                  <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                  <option value="CESCOLAR">CONTROL ESCOLAR OFICINAS CENTRALES</option>
                  <option value="PLANTEL">CONTROL ESCOLAR PLANTEL</option>
                </select>
                <span>ROL</span>
              </label>
            </div>



            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel_agregar" name="plantel_agregar">
                  <option value="">Seleccione el plantel </option>

                  <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                                        }
                                        ?>

                </select>
                <span>Plantel</span>
              </label>
            </div>


          </div>

        </div>

      </div>
    </div>



  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<script>
function agregar_usuario(){

let usuario = {
  usuario:document.getElementById("usuario_agregar").value,
  password:document.getElementById("password_agregar").value,
  correo:document.getElementById("correo_agregar").value,
  rol:document.getElementById("rol_agregar").value,
  plantel:document.getElementById("plantel_agregar").value
};


var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_usuario/crear_usuario', true);

    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(xhr.response);
        }
    }
    xhr.send(JSON.stringify(usuario));


}

</script>