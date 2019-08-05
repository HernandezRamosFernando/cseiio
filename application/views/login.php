
<div class="div_carga"id="div_carga">
<img class="cargador" id="cargador" src="<?php echo base_url();?>assets/img/loading-63.gif"/>
</div>
<!-- LOGOS DEL GOBIERNO DEL ESTADO -->
<div style="text-align: center; clear:both;">
  <img style="text-align: center; background-size: cover; max-width:100%; " src="<?php echo base_url(); ?>/assets/img/header.png">
</div>
<div style="text-align:center">
  <h3>Sistema Web Integral de Servicios Escolares del CSEIIO (SISE)</h3>
</div>
  <br><br>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><strong>Iniciar Sesión</strong></div>
      <div class="card-body">

      <form id="formulario">

          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsuario" 
              name="usuario" class="form-control" placeholder="Ingrese su usuario" required="required" autofocus="autofocus">
              <label for="inputUsuario">Ingrese su Usuario</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password"
              id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Contraseña</label>
            </div>
          </div>
  
          <button class="btn btn-success btn-block btn-lg" type="submit" id="ingresar" >Ingresar</button>
        </form>
        <hr>



        <div class="text-center">
          <a class="d-block small"  data-toggle="modal" data-target="#modalcontraseña">¿Olvidaste tu contraseña?</a>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Modal -->
  <div class="modal fade" id="modalcontraseña" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content card">
              <div class="modal-body">
                  <div class="container-fluid">
                      Favor de llamar al numero siguiente: (951) 5203924/5203925 EXT: 4
                      <br>
                      O enviar mensaje al siguiente correo: controlescolarcseiio@oaxaca.gob.mx
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
  </div>

  <script>
  var form = document.getElementById("formulario");
  form.onsubmit =  function (e) {
    e.preventDefault();
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_usuario/login", true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
    xhr.error = function (){
        console.log("error de conexion");
      }
    xhr.onreadystatechange = async function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        //console.log(xhr.responseText);
        $('#div_carga').hide();
        if (xhr.responseText === "") {
          Swal.fire({
            type: 'success',
            title: 'Ingreso exitoso',
            showConfirmButton: false,
            timer: 3500
          });
          await sleep(600);
          window.location.replace("<?php echo base_url();?>index.php/c_menu/principal");
          
        }

        else {
          Swal.fire({
            type: 'error',
            title: 'Usuario o Contraseña incorrecto',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }
    }
    xhr.send(formdata);
    

  }

    </script>