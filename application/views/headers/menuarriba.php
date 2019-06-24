
<body>

<div class="div_carga"id="div_carga">
<img class="cargador" id="cargador" src="<?php echo base_url();?>assets/img/loading-63.gif"/>
</div>
  <!-- Barra de arriba -->
  <nav class="navbar navbar-expand navbar-dark static-top" style="background:#545555">
    <a class="navbar-brand mr-1" href="<?php echo base_url();?>index.php/c_menu/principal">SISE</a>
    <button class="btn btn-link btn-sm valign-center text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="material-icons">menu</i>
    </button>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link disabled" style="color:rgb(182, 197, 193)" href="<?php echo base_url();?>index.php/c_menu/principal">Sistema integral de
          servicios escolares</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:rgb(150, 163, 159)">Bienvenido <?=$this->session->userdata('user')['usuario'];?></a>
      </li>
    </ul>



    <!-- eventos de navbar -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle valign-center" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="material-icons"  id="ic_notificacion">notifications</i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" id="icononotificacion" aria-labelledby="alertsDropdown">
          <span class="dropdown-item-text selcolor " style="font-weight: bold;";  >Notificaciones</a>
          <div class="dropdown-divider"></div>
        
          </div>
        </li>
        
        <li class="nav-item ">
          <a class="nav-link valign-center" href="#"  data-toggle="modal" data-target="#logoutModal" id="userDropdown" role="button" ">
            <i style="color: #F83D3D;"class="material-icons">phonelink_erase</i>
            <i>Cerrar sesión</i>
          </a>
        </li>
      </ul>
    </form>
  </nav>

   <!-- Logout Modal-->
   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"¿Seguro que deseas salir?</h5>
                    </div>
                    <div class="modal-body">Presione confirmar para salir de la sesión actual.</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                      <a class="btn btn-warning" href="<?php echo base_url();?>index.php/c_usuario/logout">Confirmar</a>
                    </div>
                  </div>
                </div>
              </div>
