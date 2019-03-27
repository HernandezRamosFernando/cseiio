<title>Menú SISE</title>      
</head>
<body>
     <!-- Barra de arriba -->
        <nav class="navbar navbar-expand navbar-dark static-top" style="background:#545555">
            <a class="navbar-brand mr-1" href="<?php echo base_url();?>/index.php/c_menu/principal">SISE</a>
            
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link disabled" style="color:rgb(182, 197, 193)" href="<?php echo base_url();?>/index.php/c_menu/principal">Sistema integral de servicios escolares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:rgb(150, 163, 159)" >Bienvenido Usuario</a>
                </li>
            </ul>

<!-- eventos de navbar -->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <ul class="navbar-nav ml-auto ml-md-0">
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge badge-danger">9+</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <span class="badge badge-danger">7</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#">Activity Log</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                        </div>
                    </li>
                </ul>
            </form>
        </nav>
          
    <div id="wrapper">
    <!-- Barra de lado derecho 
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="menu.html">
                      <i class="fas fa-fw fa-tachometer-alt"></i>
                      <span>Menú</span>
                    </a>
                  </li>
          
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="extendermenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-fw fa-folder"></i>
                      <span>Inscripción</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="extendermenu">
                      <a class="dropdown-item" href="login.html">Registro de inscripción</a>
                    </div>
                  </li>
          
                     <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="extendermenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-fw fa-folder"></i>
                      <span>Acreditación</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="extendermenu">
                      <a class="dropdown-item" href="login.html">Registro de calificaciones</a>
                      <a class="dropdown-item" href="login.html">Estatus de alumnos</a>
                      <a class="dropdown-item" href="register.html">Formatos</a>
                    </div>
                  </li>
          
                  <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                      <i class="fas fa-fw fa-chart-area"></i>
                      <span>Docentes</span></a>
                  </li>
          
                   <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                      <i class="fas fa-fw fa-chart-area"></i>
                      <span>Grupos</span></a>
                  </li>
          
                </ul>
              -->
                <div id="content-wrapper">
          
                  <div class="container-fluid">
          
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a >INICIO</a>
                      </li>
                      <li class="breadcrumb-item active">Seleccione un elemento de los mostrados</li>
                    </ol>

                    
          
                    <!-- Botones-->
                    <div class="row" style="height: 500px" >
                        <div class="col-md-2 col-lg-4">
                            <a href="<?php echo base_url();?>/index.php/c_menu/inscripcion" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-address-card btn-responsive" 
                            style="height: 80%; background: #1F934C; border-color: #1F934C; padding: 13% " >
                              Inscripción
                            </a>
                         
                        </div>
                        <div class="col-md-2 col-lg-4">
                            <a href="../views/reinscripcion.html" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-chalkboard-teacher btn-responsive" 
                            style="height: 80%; background: #9DBF3B; border-color: #9DBF3B; padding: 13% " >
                              Reinscripción
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="<?php echo base_url();?>/index.php/c_aspirante/control_alumnos" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-list-alt btn-responsive" 
                            style="height: 80%; background: #579A8D; border-color: #579A8D; padding: 13% " >
                              Control de Alumnos
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="<?php echo base_url();?>/index.php/c_acreditacion/acreditacion" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-calendar-check btn-responsive" 
                            style="height: 80%; background: #B7156D; border-color: #B7156D; padding: 13% " >
                              Acreditación
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="../views/reportes.html" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-poll btn-responsive" 
                            style="height: 80%; background: #CD581F; border-color: #CD581F; padding: 13% " >
                              Reportes
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="../views/formatos.html" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-file-alt btn-responsive" 
                            style="height: 80%; background: #E6AD2F; border-color: #E6AD2F; padding: 13% " >
                             Formatos
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="../views/certificacion.html" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-file-signature btn-responsive" 
                            style="height: 80%; background: #8D3B88; border-color: #8D3B88; padding: 13% " >
                              Certificación
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="<?php echo base_url();?>/index.php/c_subir_doc/subir_documentos" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-file-upload btn-responsive" 
                            style="height: 80%; background: #553276; border-color: #553276; padding: 13% " >
                              Control de Documentos
                            </a>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <a href="../views/controlusuarios.html" class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-users btn-responsive" 
                            style="height: 80%; background: #C4131B; border-color: #C4131B; padding: 13% " >
                              Control de Usuarios
                            </a>
                        </div>
                      </div>
                </div>
                <!-- /.content-wrapper -->
              </div>
              <!-- /#wrapper -->
            </div>
          
              <!-- Logout Modal-->
              <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"¿Seguro que deseas salir?</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                  </div>
                </div>
              </div>

   

                  <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/js/sb-admin.min.js"></script>
 
    </body>
</html>
