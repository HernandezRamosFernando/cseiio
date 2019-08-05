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
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="agregar()" style="padding: 1rem"
                id="agregar_usuario">Agregar usuario</button>
            </div>

            <div class="col-md-4 ">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="modificar()" style="padding: 1rem"
                id="modificar_usuario">Modificar usuario</button>
            </div>

            <div class="col-md-4">
              <button type="button" class="btn btn-warning btn-lg btn-block" onclick="eliminar()" style="padding: 1rem"
                id="eliminar_usuario">Eliminar usuario</button>
            </div>
          </div>
        </div>

        <div id="divagregar_usuario" style="display: none">

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="text" class="form-control " id="usuario_agregar"
                    placeholder="Nombre de usuario">
                  <label for="usuario_agregar">Usuario</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="text" class="form-control" id="password_agregar" placeholder="Contraseña">
                  <label for="password_agregar">Contraseña</label>
                </div>
              </div>

              <div class="col-md-4">
                <button type="button" onclick="generar()" class="btn btn-primary btn-lg btn-block">Crear
                  contraseña</button>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="mail" class="form-control " id="correo_agregar" placeholder="Contraseña">
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
                    <option value="CESCOLAR">Control Escolar oficinas centrales </option>

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

          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <button type="button" class="btn btn-success btn-lg btn-block" onclick="agregar_usuario()" style="padding: 1rem">Guardar usuario</button>
              </div>
            </div>
          </div>

        </div> <!-- cerrar agregar -->

        <div id="divmodificar_usuario" style="display: none">
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" onchange="cargar_usuario()" id="lista_modificar"
                    name="lista_modificar">
                    <option value="">Seleccione un usuario </option>

                    <?php
                                        foreach ($usuarios as $usuario)
                                        {
                                          if($usuario->usuario!='depto_tecnologia'){
                                            echo '<option value="'.$usuario->id_usuario.'">'.$usuario->usuario.'</option>';

                                          }
                                          
                                        }
                                        ?>

                  </select>
                  <span>Lista de usuarios</span>
                </label>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="text" class="form-control " id="usuario_modificar"
                    placeholder="Nombre de usuario">
                  <label for="usuario_modificar">Usuario</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="text" class="form-control " id="password_modificar"
                    placeholder="Contraseña (No escribir)">
                  <label for="password_modificar">Contraseña (No escribir)</label>
                </div>
              </div>

              <div class="col-md-4">
                <button type="button" onclick="generar()" class="btn btn-primary btn-lg btn-block">Crear
                  contraseña</button>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="mail" class="form-control " id="correo_modificar" placeholder="Contraseña">
                  <label for="correo_modificar">Correo</label>
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" disabled id="rol_modificar" name="rol_modificar">
                    <option value="">Seleccione</option>
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    <option value="CESCOLAR">CONTROL ESCOLAR OFICINAS CENTRALES</option>
                    <option value="PLANTEL">CONTROL ESCOLAR PLANTEL</option>
                  </select>
                  <span>ROL</span>
                </label>
              </div>

              <div class="col-md-8" id="plantel_modificar_oculto" style="display: none">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="plantel_modificar" name="plantel_modificar">
                    <option value="">Seleccione el plantel </option>
                    <option value="CESCOLAR">Control Escolar oficinas centrales </option>

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

          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <button type="button" class="btn btn-info btn-lg btn-block" onclick="modificar_usuario()" style="padding: 1rem">Modificar usuario</button>
              </div>
            </div>
          </div>

        </div> <!-- cerrar modificar -->

        <div id="diveliminar_usuario" style="display: none">
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor"  id="lista_eliminar"
                    name="lista_eliminar">
                    <option value="">Seleccione un usuario </option>

                    <?php
                                        foreach ($usuarios as $usuario)
                                        {
                                          if($usuario->usuario!='depto_tecnologia'){
                                          echo '<option value="'.$usuario->id_usuario.'">Usuario: '.$usuario->usuario.' || Rol:  '.$usuario->rol.'</option>';
                                          }
                                        }
                                        ?>

                  </select>
                  <span>Lista de usuarios</span>
                </label>
              </div>

            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <button type="button" class="btn btn-warning btn-lg btn-block" onclick="borrar_usuario()" style="padding: 1rem">Eliminar usuario</button>
              </div>
            </div>
          </div>
        </div> <!-- cerrar eliminar -->

      </div>
    </div>



  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<script>

  function agregar() {
    document.getElementById("divagregar_usuario").style.display = "";
    document.getElementById("divmodificar_usuario").style.display = "none";
    document.getElementById("diveliminar_usuario").style.display = "none";
    document.getElementById("password_agregar").value = "";
  }
  function modificar() {
    document.getElementById("password_modificar").value = "";
    document.getElementById("divagregar_usuario").style.display = "none";
    document.getElementById("divmodificar_usuario").style.display = "";
    document.getElementById("diveliminar_usuario").style.display = "none";
  }

  function eliminar() {
    document.getElementById("divagregar_usuario").style.display = "none";
    document.getElementById("divmodificar_usuario").style.display = "none";
    document.getElementById("diveliminar_usuario").style.display = "";
  }

  function cargar_usuario() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", '<?php echo base_url();?>index.php/c_usuario/usuarios_registrados_id?id_usuario=' + document.getElementById("lista_modificar").value, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      document.getElementById("usuario_modificar").value = "";
      document.getElementById("correo_modificar").value = "";
      document.getElementById("rol_modificar").value = "";
      document.getElementById("plantel_modificar").value = "";
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        document.getElementById("usuario_modificar").value = valor.usuario;
        document.getElementById("correo_modificar").value = valor.correo;
        document.getElementById("rol_modificar").value = valor.rol;
        if (valor.plantel != null) {
          document.getElementById("plantel_modificar").value = valor.plantel;
          document.getElementById("plantel_modificar_oculto").style.display = "";
        } else {
          document.getElementById("plantel_modificar_oculto").style.display = "none";
        }


      });
    }
    xhr.send(null);

  }

  function generar() {
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
    var contraseña = "";
    var longitud = getRandomInt(14);
    for (i = 0; i < longitud; i++) contraseña += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    document.getElementById("password_modificar").value = contraseña;
    document.getElementById("password_agregar").value = contraseña;
  }



  function agregar_usuario() {

    let usuario = {
      usuario: document.getElementById("usuario_agregar").value,
      password: document.getElementById("password_agregar").value,
      correo: document.getElementById("correo_agregar").value,
      rol: document.getElementById("rol_agregar").value,
      plantel: document.getElementById("plantel_agregar").value
    };


    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_usuario/crear_usuario', true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Usuario agregado correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta
              location.reload();

            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
        }
      }
    }
    xhr.send(JSON.stringify(usuario));


  }


  function modificar_usuario(){
    if(document.getElementById("rol_modificar").value!="PLANTEL"){
      var datos = {
      id_usuario:document.getElementById("lista_modificar").value,
      usuario:document.getElementById("usuario_modificar").value,
      correo:document.getElementById("correo_modificar").value,
      rol:document.getElementById("rol_modificar").value,
      password:document.getElementById("password_modificar").value
    };
    }

    else{
      var datos = {
      id_usuario:document.getElementById("lista_modificar").value,
      usuario:document.getElementById("usuario_modificar").value,
      correo:document.getElementById("correo_modificar").value,
      rol:document.getElementById("rol_modificar").value,
      password:document.getElementById("password_modificar").value,
      plantel:document.getElementById("plantel_modificar").value
    };
    }
    

    var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_usuario/editar_usuario', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(xhr.response);
                if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Usuario modificado correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta
              location.reload();

            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
        }
            }
        }
        xhr.send(JSON.stringify(datos));

  }


  function borrar_usuario(){

    let datos={
      id_usuario:document.getElementById("lista_eliminar").value
    }

    var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_usuario/borrar_usuario', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(xhr.response);
                if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Usuario eliminado correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta
              location.reload();

            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
        }
            }
        }
        xhr.send(JSON.stringify(datos));

  }

</script>