<!-- LOGOS DEL GOBIERNO DEL ESTADO -->
<div style="text-align: center; clear:both;">
  <img style="text-align: center; background-size: cover;"  src="<?php echo base_url(); ?>/assets/img/header.png">
</div>
<div align="center">
  <h3>Sistema Web Integral de Servicios Escolares del CSEIIO (SISE)</h3>
</div>
  <br><br>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><strong>Iniciar Sesión</strong></div>
      <div class="card-body">

        <form method="POST" action="<?php echo base_url() ?>index.php/c_usuario/login">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="Ingrese su usuario" required="required" autofocus="autofocus">
              <label for="inputUsuario">Ingrese su Usuario</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Contraseña</label>
            </div>
          </div>
  
          <button class="btn btn-success btn-block btn-lg" type="submit">Ingresar</button>
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
                      Favor de llamar al numero siguiente:
                      <br>
                      O enviar mensaje al siguiente correo:
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
  </div>
  