


  <title>Crear grupo</title>
</head>

<body>
  <!-- Barra de arriba -->
  <nav class="navbar navbar-expand navbar-dark static-top" style="background:#545555">
    <a class="navbar-brand mr-1" href="/cseiio/index.php/c_menu/principal">SISE</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link disabled" style="color:rgb(182, 197, 193)" href="/cseiio/index.php/c_menu/principal">Sistema
          integral de
          servicios escolares</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:rgb(150, 163, 159)">Bienvenido Usuario</a>
      </li>
    </ul>

    <!-- eventos de navbar -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
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
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
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
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
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


    <!-- Barra de lado derecho -->
    <ul class="sidebar navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-align-justify "></i>
          <span>Menú</span>
        </a>
      </li>

      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle  fas fa-fw fa-address-card" data-toggle="dropdown" href="#" role="button">
          <span class="font-weight-light">Inscripción<span>
        </a>
        <div class="dropdown-menu ">
          <a class="dropdown-item btn-responsive btn-primary fas fa-id-card "
            href="/cseiio/index.php/c_aspirante/nuevo_ingreso">
            <span class="font-weight-light">Inscripción Nuevo Ingreso</span>
          </a>
          <a class="dropdown-item btn-responsive fas fa-id-card-alt" href="/cseiio/index.php/c_aspirante/portabilidad">
            <span class="font-weight-light">Inscripción Portabilidad</span>
          </a>
          <a class="dropdown-item btn-responsive fas fa-user-check "
            href="/cseiio/index.php/c_aspirante/asignar_matricula">
            <span class="font-weight-light">Asignar Matrícula</span>
          </a>
          <a class="dropdown-item btn-responsive fas fa-clipboard-check "
            href="/cseiio/index.php/c_aspirante/carta_compromiso">
            <span class="font-weight-light">Generación de Carta Compromiso</span>
          </a>
        </div>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-chalkboard-teacher"></i>
          <span>Reinscripción</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_aspirante/control_alumnos">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Control de Alumnos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link bg-info text-white" href="/cseiio/index.php/c_acreditacion/acreditacion">
          <i class="fas fa-fw fa-calendar-check"></i>
          <span>Acreditación</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-poll"></i>
          <span>Reportes</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Formatos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-file-signature "></i>
          <span>Certificación</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_subir_doc/subir_documentos">
          <i class="fas fa-fw fa-file-upload"></i>
          <span>Carga de documentos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-users "></i>
          <span>Control de usuarios</span>
        </a>
      </li>

    </ul>


    <div id="content-wrapper">

      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Crear grupos</a>
          </li>
          <li class="breadcrumb-item active">Ingrese los datos requeridos</li>
        </ol>


        <form id="formulario">
        <div class="form-group">

            <div class="row">
              <div class="col-md-8">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="aspirante_plantel"
                    name="aspirante_plantel">
                    <option value="">Seleccione el plantel donde creara el grupo</option>

                    <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct.'</option>';
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
              <label class="form-group has-float-label">
                <select class="form-control form-control-lg" onchange="numero_alumnos(this)" name="semestre_grupo" id="semestre_grupo">
                <option value="0">Seleccione uno</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
                <span>Seleccione el semestre del grupo a crear</span>
              </label>
            </div>
          

          <div class="col-md-4">
              <label class="form-group has-float-label">
                <select class="form-control form-control-lg" name="" id="">
                <option value="NO">No</option>
                </select>
                <span>¿Es de especialidad?</span>
              </label>
            </div>

          <div class="col-md-4">
          <label id="cantidad_alumnos">Cantidad de alumnos:</label>
          </div>


          </div>
        </div>

          <div class="row">
          <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="grupo_ciclo_escolar"
                    name="grupo_ciclo_escolar">
                    <option>Seleccione el ciclo del grupo <i class="fa fa-graduation-cap" aria-hidden="true"></i></option>

                    <?php
                                        foreach ($ciclo_escolar as $ciclo)
                                        {
                                          echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->nombre_ciclo_escolar.'</option>';
                                        }
                                        ?>

                  </select>
                  <span>Ciclo escolar</span>
                </label>
              </div>

          </div>

          <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" required="required" title="Introduzca solo letras" class="form-control"
                  id="grupo_nombre" name="grupo_nombre" placeholder="Nombre de grupo">
                <label for="grupo_nombre">Ingrese el nombre del grupo</label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" required="required" title="Introduzca solo letras" class="form-control"
                  id="grupo_periodo" name="grupo_periodo" placeholder="Periodo del grupo(s)">
                <label for="grupo_periodo">Perido del grupo</label>
              </div>
            </div>

            <div class="col-md-4 offset-md-3">
              <button type="submit" class="btn btn-success btn-lg btn-block" style="padding: 1rem">Crear grupo</button>
            </div>
          </div>
        </div>
      </form>





      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" ¿Seguro que deseas salir?</h5> <button class="close"
            type="button" data-dismiss="modal" aria-label="Close">
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
  <script src="/cseiio/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/cseiio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/cseiio/assets/vendor/jquery-easing/jquery.easing.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="/cseiio/assets/js/sb-admin.min.js"></script>



</body>


<script>

function numero_alumnos(e){
if(document.getElementById("aspirante_plantel").value===""){
alert("debe seleecionar un plantel");
}

else{
          var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/c_acreditacion/numero_estudiantes_semestre_plantel?semestre='+e.value+'&cct='+document.getElementById("aspirante_plantel").value, true);

        xhr.onload = function () {
         console.log(xhr.response);
         document.getElementById("cantidad_alumnos").innerHTML = "Cantidad de Alumnos: "+JSON.parse(xhr.response)[0].total_estudiante;
        };

        xhr.send(null);
}


}
</script>


<script>   

var form = document.getElementById("formulario");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","/cseiio/index.php/c_acreditacion/agregar_grupo",true);
    xhr.onreadystatechange = function() { 
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      //console.log();
      if(xhr.responseText.trim()==="si"){
        Swal.fire({
            type: 'success',
            title: 'Registro exitoso',
            showConfirmButton: false,
            timer: 2500 
          });

          document.getElementById("formulario").reset();
          document.getElementById("selector_municipio_aspirante").value="";
          document.getElementById("selector_localidad_aspirante").value="";
      }

      else{
        Swal.fire({
            type: 'error',
            title: 'No se puede crear el grupo',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
		xhr.send(formdata);
		
	}

</script>
</html>