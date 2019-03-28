
  <title>Generación de Carta Compromiso</title>
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
        <a class="nav-link disabled" style="color:rgb(182, 197, 193)" href="/cseiio/index.php/c_menu/principal">Sistema integral de
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
      <a class="nav-link dropdown-toggle bg-info text-white fas fa-fw fa-address-card" data-toggle="dropdown" href="#" role="button" > 
      <span class="font-weight-light">Inscripción<span>
      </a>
      <div class="dropdown-menu bg-info">
      <a class="dropdown-item btn-responsive fas fa-id-card " href="/cseiio/index.php/c_aspirante/nuevo_ingreso"> <span class="font-weight-light">Inscripción Nuevo Ingreso</span></a>
      <a class="dropdown-item btn-responsive fas fa-id-card-alt" href="/cseiio/index.php/c_aspirante/portabilidad"> <span class="font-weight-light">Inscripción Portabilidad</span></a>
      <a class="dropdown-item btn-responsive fas fa-user-check" href="/cseiio/index.php/c_aspirante/asignar_matricula"> <span class="font-weight-light">Asignar Matrícula</span></a>
      <a class="dropdown-item btn-responsive fas fa-clipboard-check" href="/cseiio/index.php/c_aspirante/carta_compromiso"> <span class="font-weight-light">Generación de Carta Compromiso</span></a>
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
        <a class="nav-link" href="/cseiio/index.php/c_acreditacion/acreditacion">
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
          <span>Control de documentos</span>
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
            <a>Generacion de Carta Compromiso</a>
          </li>
          <li class="breadcrumb-item active">Ingrese el Aspirante que desee:</li>
        </ol>

        <div class="card">
          <div class="card-body">



            <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                      id="aspirante_curp_busqueda" placeholder="CURP">
                    <label for="aspirante_curp_busqueda">CURP</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">


                <div class="col-md-8">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" id="aspirante_plantel_busqueda"
                      name="aspirante_plantel">
                      <option value="">Buscar en todos los planteles</option>

                      <?php
            foreach ($planteles as $plantel)
            {
                    echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.'</option>';
            }
            ?>

                    </select>
                    <span>Plantel</span>
                  </label>

                </div>

                <div class="col-md-4">
                  <button type='button' class="btn btn-success btn-lg btn-block" id="btn_buscar" onclick='buscar()'>Buscar</button>
                </div>

              </div>
            </div>



          </div>
        </div>
      </div>


      <div class="container">
        <div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_completa" style="width: 100%">
            <caption>Lista de Alumnos que generan carta compromiso</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre completo</th>
                  <th scope="col" class="col-md-1">CURP</th>
                  <th scope="col" class="col-md-1">N° control</th>
                  <th scope="col" class="col-md-1">Semestre</th>
                  <th scope="col" class="col-md-1">Plantel CCT</th>
                  <th scope="col" class="col-md-1">Editar</th>
                </tr>
              </thead>



              <tbody id="tabla">

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->
  
  <!-- Modal -->
  <div class="modal fade" id="generarobservacion" tabindex="-1" role="dialog" aria-labelledby="generarobservacion "
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 75% !important;" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Agregar las observaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
          <div class="container-fluid">
          <table class="table table-hover" id="tabla_documentos" style="width: 100%">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">N° control</th>
                  <th scope="col" class="col-md-1">Documento</th>
                  <th scope="col" class="col-md-3">Observación</th>
                </tr>
              </thead>
              <tbody id="tabla_observacion">

              </tbody>
          </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-warning"  onclick="generar_carta_compromiso(this)">Generar carta comprimiso</button>
        </div>
      </div>
    </div>
  </div>
  

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

  <input type="text" id="no_control" display="none">


  <script src="/cseiio/assets/js/sweetalert2.all.min.js"></script>
  <script>
  
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success btn-block',
    cancelButton: 'btn btn-secondary btn-block'
  },
  buttonsStyling: false,
});

function aspirante_input(e){

        var dias = new XMLHttpRequest();
      dias.open('GET', '/cseiio/index.php/c_documentacion/fecha_ultima_carta_compromiso_aspirante?no_control='+e.value, true);

      dias.onload = function () {
        console.log(JSON.parse(dias.response)[0].dias);
        if(JSON.parse(dias.response)[0].dias===null || JSON.parse(dias.response)[0].dias>30){

            //abre modal
            $("#generarobservacion").modal("show");

          document.getElementById("no_control").value = e.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/index.php/c_aspirante/get_aspirantes_nombre_documentos?no_control='+e.value, true);

        xhr.onload = function () {
          console.log(JSON.parse(xhr.response));      
          document.getElementById('tabla_observacion').innerHTML = "";
          JSON.parse(xhr.response).forEach(function(valor, indice){
            document.getElementById('tabla_observacion').innerHTML += "<tr><td>"+valor.Aspirante_no_control+"</td><td>"+valor.nombre_documento+'</td><td><input id="'+valor.id_documento+'" type="text" class="form-control"></td></tr>';
          });

        }

        xhr.send(null);
        }

        else{
          swalWithBootstrapButtons.fire({
          title: 'Error!',
          text: "Ya cuenta con una carta compromiso vigente, dias restantes: "+(30-parseInt(JSON.parse(dias.response)[0].dias)),
          type: 'warning',
          showConfirmButton: false,
          showCancelButton: true,
         cancelButtonText: 'Cerrar'
          })
         // alert("Ya cuenta con una carta compromiso vigente, dias restantes: "+(30-parseInt(JSON.parse(dias.response)[0].dias)));

        }
      };

      dias.send(null);
  /*

data-target="#generarobservacion"


        */
}


function generar_carta_compromiso(e){
      //console.log(e.value);

      var tabla = document.getElementById('tabla_observacion');
      //console.log(tabla.childNodes);
      var json_observaciones = Array();

      //console.log(json_observaciones[0]);
      tabla.childNodes.forEach(function(input,indice){
 
            json_observaciones.push({"id":parseInt(input.childNodes[2].childNodes[0].id),
            "observacion":input.childNodes[2].childNodes[0].value,
            "no_control":document.getElementById("no_control").value});

      });

      //console.log(JSON.stringify(json_observaciones));

      //insertar observaciones en la base de datos
      var observaciones = new XMLHttpRequest();
          observaciones.open('POST', '/cseiio/index.php/c_aspirante/agregar_observaciones', true);
          observaciones.setRequestHeader("Content-Type", "application/json");

          observaciones.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(observaciones.response);
            }
        }
        observaciones.send(JSON.stringify(json_observaciones));
        //console.log(JSON.stringify(json_observaciones));

      
      

      
      var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/index.php/c_aspirante/get_aspirantes_nombre_documentos?no_control='+document.getElementById("no_control").value, true);
        
        xhr.onload = function () {
          var documentos = JSON.parse(xhr.response);
          if(documentos.length===4){
          }
          else{
            var carta_compromiso = new XMLHttpRequest();
            carta_compromiso.open('GET', '/cseiio/index.php/c_aspirante/generar_carta_compromiso?no_control='+document.getElementById("no_control").value, true);
            carta_compromiso.responseType = "arraybuffer";
            carta_compromiso.onload = function () {
              //console.log(carta_compromiso.responseText);
              if (this.status === 200) {
                    var blob = new Blob([carta_compromiso.response], {type: "application/pdf"});
                    var objectUrl = URL.createObjectURL(blob);
                    window.open(objectUrl);
                }
              
            };

            carta_compromiso.send(null);
          }
        };
        xhr.send(null);
        
    }
    
    function formato_tabla() {
      $('#tabla_completa').DataTable({
        //"order": [[ 0, 'desc' ]],
        "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar específico:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
    }
    function buscar() {
      document.getElementById("aspirante_plantel_busqueda").disabled=true;
      document.getElementById("aspirante_curp_busqueda").disabled=true;
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      var curp = document.getElementById("aspirante_curp_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;
      var query = 'curp=' + curp + '&plantel=' + plantel;
      xhr.open('GET', '/cseiio/index.php/c_aspirante/aspirantes_carta_compromiso?' + query, true);
      xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));
        ////console.log(query);
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var fila = '<tr>';
          fila += '<td>';
          fila += valor.nombre + " " + valor.apellido_paterno + " " + valor.apellido_materno;
          fila += '</td>';
          fila += '<td>';
          fila += valor.curp;
          fila += '</td>';
          fila += '<td>';
          fila += valor.no_control;
          fila += '</td>';
          fila += '<td>';
          fila += valor.semestre;
          fila += '</td>';
          fila += '<td>';
          fila += valor.Plantel_cct;
          fila += '</td>';
          fila += '<td>';
          fila += '<button class="btn btn-warning" type="button" value="'+valor.no_control+'" onclick="aspirante_input(this)" class="btn btn-primary" data-toggle="modal">Generar Carta Compromiso</button>';
          fila += '</td>';
          fila += '</tr>';
          document.getElementById("tabla").innerHTML += fila;
        });
        formato_tabla();
      };
      xhr.send(null);
      document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
      document.getElementById('btn_buscar').innerHTML='Limpiar Busqueda';
      document.getElementById('btn_buscar').classList.remove('btn-success');
      document.getElementById('btn_buscar').classList.add('btn-danger');
    }
    function limpiar() {
      $('#aspirante_curp_busqueda').val('');
      location.reload();  
      
    }
    
  </script>



