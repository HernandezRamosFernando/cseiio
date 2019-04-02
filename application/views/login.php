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

        <form method="POST" action="/cseiio/c_usuario/login">
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
  
          <button type="submit">Ingresar</button>
        </form>



        <div class="text-center">
          <a class="d-block small" href="forgot-password.html">¿Olvidaste tu contraseña?</a>
        </div>
      </div>
    </div>
  </div>