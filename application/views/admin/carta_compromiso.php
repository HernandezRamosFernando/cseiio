<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Generación de Carta Compromiso</title>

  <!-- Bootstrap core CSS-->
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="/cseiio/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="/cseiio/assets/css/sb-admin.css" rel="stylesheet">
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">
  <link href="/cseiio/assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="/cseiio/assets/css/main.css">

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
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-chalkboard-teacher"></i>
          <span>Menú</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cseiio/index.php/c_menu/inscripcion">
          <i class="fas fa-fw fa-address-card"></i>
          <span>Inscripción</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/cseiio/index.php/c_aspirante/carta_compromiso">
          <i class="fas fa-fw fa-clipboard-check "></i>
          <span>Generación de Carta Compromiso</span>
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


                <div class="col-md-6">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" id="aspirante_plantel_busqueda"
                      name="aspirante_plantel">

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
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre</th>
                  <th scope="col" class="col-md-1">Apellido Paterno</th>
                  <th scope="col" class="col-md-1">Apellido Materno</th>
                  <th scope="col" class="col-md-1">CURP</th>
                  <th scope="col" class="col-md-1">Semestre</th>
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
  <script src="/cseiio/assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/cseiio/assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <script src="/cseiio/assets/js/cambio_estado.js"></script>
  <script src="/cseiio/assets/js/cambio_municipio.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>



  <script>
function imprimir() {
var doc = new jsPDF()
doc.text('Hello world!', 10, 10)
doc.save('a4.pdf')
}
function generar_carta_compromiso(e){
      //console.log(e.value);
      var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/index.php/c_aspirante/get_aspirantes_nombre_documentos?no_control='+e.value, true);
        xhr.onload = function () {
          var documentos = JSON.parse(xhr.response);
          if(documentos.length===4){
              alert("No se puede generar carta compromiso porque ya cuenta con la documentacion completa");
          }
          else{
            imprimir();
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
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
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
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      var curp = document.getElementById("aspirante_curp_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;
      //var query = 'nombre=' + nombre + '&apellido_paterno=' + apellido_paterno + '&apellido_materno=' + apellido_materno + '&plantel=' + plantel;
      xhr.open('GET', '/cseiio/index.php/c_aspirante/aspirantes_carta_compromiso?cct=' + plantel, true);
      xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));
        ////console.log(query);
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var fila = '<tr>';
          fila += '<td>';
          fila += valor.nombre;
          fila += '</td>';
               
          fila += '<td>';
          fila += valor.apellido_paterno;
          fila += '</td>';
          fila += '<td>';
          fila += valor.apellido_materno;
          fila += '</td>';
          fila += '<td>';
          fila += valor.curp;
          fila += '</td>';
          fila += '<td>';
          fila += valor.semestre;
          fila += '</td>';
          fila += '<td>';
          fila += '<button class="btn btn-warning" type="button" value="' + valor.no_control + '" onclick="generar_carta_compromiso(this)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Generar Carta Compromiso</button>';
          fila += '</td>';
          fila += '</tr>';
          document.getElementById("tabla").innerHTML += fila;
        });
        formato_tabla();
      };
      xhr.send(null);
      document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
      document.getElementById('btn_buscar').innerHTML='Limpiar Busqueda';
    }
    function limpiar() {
      location.reload();  
      
    }
    
  </script>




</body>

</html>