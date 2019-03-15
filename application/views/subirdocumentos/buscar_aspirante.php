<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Subir Documentos</title>

  <!-- Bootstrap core CSS-->
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="/cseiio/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="/cseiio/assets/css/sb-admin.css" rel="stylesheet">
  <link rel="icon" href="/cseiio/assets/img/favicon.ico">

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
    <ul class="sidebar navbar-nav flex-column">
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-align-justify "></i>
          <span>Menú</span>
        </a>
      </li>

      <li class="nav-item dropdown ">
      <a class="nav-link dropdown-toggle fas fa-fw fa-address-card" data-toggle="dropdown" href="#" role="button" > 
      <span class="font-weight-light">Inscripción<span>
      </a>
      <div class="dropdown-menu">
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
        <a class="nav-link " href="/cseiio/index.php/c_aspirante/control_alumnos">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Control de Alumnos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
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
        <a class="nav-link bg-info text-white" href="/cseiio/index.php/c_subir_doc/subir_documentos">
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
            <a>Inscripción</a>
          </li>
          <li class="breadcrumb-item active">Seleccione un elemento de los mostrados</li>
        </ol>

        <div class="card">
          <div class="card-body">



            <div class="form-group">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                      id="aspirante_nombre_busqueda" placeholder="Nombre(s)">
                    <label for="aspirante_nombre_busqueda">Nombre(s)</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                      id="aspirante_apellido_paterno_busqueda" placeholder="Apellido Paterno">
                    <label for="aspirante_apellido_paterno_busqueda">Apellido Paterno</label>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                      id="aspirante_apellido_materno_busqueda" placeholder="Apellido Materno">
                    <label for="aspirante_apellido_materno_busqueda">Apellido Materno</label>
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
                  <button type='button' class="btn btn-success btn-lg btn-block" onclick='buscar()'>Buscar</button>
                </div>

              </div>
            </div>



          </div>
        </div>
      </div>



        <div class="container">

      <div class="card-body">
        <table class="table table-bordered" id="tabla_completa">
          <thead>
            <tr>
              <th scope="col" class="col-md-1">Nombre</th>
              <th scope="col" class="col-md-1">Apellido Paterno</th>
              <th scope="col" class="col-md-1">Apellido Materno</th>
              
              <th scope="col" class="col-md-1">Subir documentación</th>
            </tr>
          </thead>



          <tbody id="tabla">
            <?php
                                    
                  foreach($laspirante as $a){
                                      
                    echo '<tr class="odd gradeA">';
                    echo '<td class="text-center">'.$a->nombre.'</td>';
                    echo '<td class="text-center">'.$a->apellido_paterno.'</td>';
                    echo '<td class="text-center">'.$a->apellido_materno.'</td>';  
                    
                    
                    echo '<td class="text-center"><button type="button" value="'.$a->no_control.'" onclick="cargar_doc_aspirante(this,\''.$a->nombre.'\',\''.$a->apellido_paterno.'\',\''.$a->apellido_materno.'\')" class="btn btn-primary" data-toggle="modal" data-target="#modalsubirdocumentos">Editar</button></td>';                  
                    echo '</tr>';
                                          
                    }

            ?>

          </tbody>
        </table>
      </div>
    
  </div>
      

        

      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->


   <!-- Inicia modal
https://www.youtube.com/watch?v=pTfVK73CUk8

https://www.youtube.com/watch?v=EraNFJiY0Eg


https://www.youtube.com/results?search_query=+AJAX+File+Upload+with+Progress



    de carga de documentos por aspirante-->
 <!-- Modal -->
  <!-- Modal -->
<div class="modal fade" id="modalsubirdocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir Documentos de Aspirante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="ajaxsubirdoc">
    
          

            <!--documentos solicitados------------------------------------------------------>
          <p>Nombre: <span id="nombrecompleto"></span>
        </p>
      <input type="hidden" id="numcontrol" name="numcontrol" value="">

    <form id="subir_doc" enctype="multipart/form-data" method="post">
      
          <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" name="aspirante_documento_acta_nacimiento"
                                id="aspirante_documento_acta_nacimiento" value="1"  onclick="activarFile(this,'file1')" unchecked>
                              Acta de Nacimiento
                            </label>
                  </div>
                </div>

              <div class="col-md-6">
                   <input type="file" name="file1" id="file1" onchange="validarArchivo(this,'status','status_error','boton1')" required/><br>
                   <span class="badge badge-danger">* El archivo debe estar en formato PDF, JPG y PNG.</span>
                    <progress id="progressBar" value="0" max="100"></progress>

                    <span id="status" class="status_upload"></span>
                    <span id="status_error" class="status_upload_error"></span>
                    <p><a id="enlace_act_naci" href=""></a></p>
                    <p id="loaded_n_total"></p>

                </div>

                <div class="col-md-3">
                    <input  id="boton1" class="btn btn-primary" type="button" value="Cargar archivo" onclick="uploadFile()">
                </div>

            </div>
          </div>

    </form>


 <form id="subir_doc2" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="aspirante_documento_curp" id="aspirante_documento_curp" value="2" onclick="activarFile(this,'file2')" unchecked>
                        CURP
                      </label>
                    </div>
                </div>

          <div class="col-md-6">
                   <input type="file" name="file2" id="file2" onchange="validarArchivo(this,'status2','status_error2','boton2')" required=""><br>
                   <span class="badge badge-danger">* El archivo debe estar en formato PDF, JPG y PNG.</span>
                    <progress id="progressBar2" value="0" max="100"></progress>

                    <span id="status2" class="status_upload"></span>
                    <span id="status_error2" class="status_upload_error"></span>
                    <p><a id="enlace2" href=""></a></p>
                    <p id="loaded_n_total2"></p>

                </div>

                <div class="col-md-3">
                    <input  id="boton2" class="btn btn-primary" type="button" value="Cargar archivo" onclick="uploadFile2()">
                </div>


            
            </div>
          </div>
    </form>


  <form id="subir_doc3" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_secundaria"
                        id="aspirante_documento_certificado_secundaria" value="3" onclick="activarFile(this,'file3')" unchecked>
                      Certificado de Secundaria
                    </label>
                    </div>
                </div>

                  
                  <div class="col-md-6">
                   <input type="file" name="file3" id="file3" onchange="validarArchivo(this,'status3','status_error3','boton3')" required=""><br>
                   <span class="badge badge-danger">* El archivo debe estar en formato PDF, JPG y PNG.</span>
                    <progress id="progressBar3" value="0" max="100"></progress>

                    <span id="status3" class="status_upload"></span>
                    <span id="status_error3" class="status_upload_error"></span>
                    <p><a id="enlace3" href=""></a></p>
                    <p id="loaded_n_total3"></p>

                </div>

                <div class="col-md-3">
                    <input  id="boton3" class="btn btn-primary" type="button" value="Cargar archivo" onclick="uploadFile3()">
                </div>

            </div>
          </div>
</form>


<form id="subir_doc4" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="aspirante_documento_fotos"
                        id="aspirante_documento_fotos" value="4" onclick="activarFile(this,'file4')" unchecked>
                      Fotos
                    </label>
                  </div>
                </div>

                <div class="col-md-6">
                   <input type="file" name="file4" id="file4" onchange="validarArchivo(this,'status4','status_error4','boton4')" required=""><br>
                   <span class="badge badge-danger">* El archivo debe estar en formato PDF, JPG y PNG.</span>
                    <progress id="progressBar4" value="0" max="100"></progress>

                    <span id="status4" class="status_upload"></span>
                    <span id="status_error4" class="status_upload_error"></span>
                    <p><a id="enlace4" href=""></a></p>
                    <p id="loaded_n_total4"></p>

                </div>

                <div class="col-md-3">
                    <input  id="boton4" class="btn btn-primary" type="button" value="Cargar archivo" onclick="uploadFile4()">
                </div>


          </div>  
          </div>
  </form>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
<!-- Termina modal de carga de documentos por aspirante-->

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>
    <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin.min.js"></script>

    <script src="../assets/js/cambio_estado.js"></script>
    <script src="../assets/js/cambio_municipio.js"></script>

    <script>

    function activarFile(campo,campoArchivo){
      var checkBox = document.getElementById(campo.name);
      var archivo = document.getElementById(campoArchivo);
        if (checkBox.checked == true){
            archivo.disabled = false;
        } 
        else {
            archivo.disabled = true;
        }
        
    }

       function limpiarmodal(){

            document.getElementById("subir_doc").reset();
            document.getElementById("subir_doc2").reset();
            document.getElementById("subir_doc3").reset();
            document.getElementById("subir_doc4").reset();

            document.getElementById("aspirante_documento_acta_nacimiento").checked=false;
            document.getElementById("progressBar").value=0;
            document.getElementById("status").innerHTML = "";
            document.getElementById("status_error").innerHTML = "";
            document.getElementById("enlace_act_naci").innerHTML = "";
            document.getElementById("loaded_n_total").innerHTML = "";
            document.getElementById("boton1").disabled =true;
            document.getElementById("file1").disabled =true;


            document.getElementById("aspirante_documento_curp").checked=false;
            document.getElementById("progressBar2").value=0;
            document.getElementById("status2").innerHTML = "";
            document.getElementById("status_error2").innerHTML = "";
            document.getElementById("enlace2").innerHTML = "";
            document.getElementById("loaded_n_total2").innerHTML = "";
            document.getElementById("boton2").disabled =true;
            document.getElementById("file2").disabled =true;



            document.getElementById("aspirante_documento_certificado_secundaria").checked=false;
            document.getElementById("progressBar3").value=0;
            document.getElementById("status3").innerHTML = "";
            document.getElementById("status_error3").innerHTML = "";
            document.getElementById("enlace3").innerHTML = "";
            document.getElementById("loaded_n_total3").innerHTML = "";
            document.getElementById("boton3").disabled =true;
            document.getElementById("file3").disabled =true;
            

            document.getElementById("aspirante_documento_fotos").checked=false;
            document.getElementById("progressBar4").value=0;
            document.getElementById("status4").innerHTML = "";
            document.getElementById("status_error4").innerHTML = "";
            document.getElementById("enlace4").innerHTML = "";
            document.getElementById("loaded_n_total4").innerHTML = "";
            document.getElementById("boton4").disabled =true;
            document.getElementById("file4").disabled =true;

       }

      function cargar_doc_aspirante(e,e2,e3,e4){
         limpiarmodal();
         
       
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/c_aspirante/get_docxaspirante/'+e.value+'/'+e2+'/'+e3+'/'+e4, true);

        xhr.onload = function () {
          console.log(JSON.parse(xhr.response));
 
          var datos = JSON.parse(xhr.response);
          //datos personales
          document.getElementById("numcontrol").value = datos.numcontrol;
          document.getElementById("nombrecompleto").innerHTML=datos.nombre_completo;
          //documentos
          datos.documentacion_aspirante.forEach(function(valor,indice){
            console.log(valor.Documento_id_documento);
              switch(parseInt(valor.Documento_id_documento)){
                case 1:
                document.getElementById("aspirante_documento_acta_nacimiento").checked=true;
                document.getElementById("enlace_act_naci").innerHTML = valor.ruta;
                document.getElementById("enlace_act_naci").href="/cseiio/C_subir_doc/descargar/"+valor.ruta;
                document.getElementById("file1").disabled =false;
                break;

                case 2:
                document.getElementById("aspirante_documento_curp").checked=true;
                document.getElementById("enlace2").innerHTML = valor.ruta;
                document.getElementById("enlace2").href="/cseiio/C_subir_doc/descargar/"+valor.ruta;
                document.getElementById("file2").disabled =false;
                break;

                case 3:
                document.getElementById("aspirante_documento_certificado_secundaria").checked=true;
                document.getElementById("enlace3").innerHTML = valor.ruta;
                document.getElementById("enlace3").href="/cseiio/C_subir_doc/descargar/"+valor.ruta;
                document.getElementById("file3").disabled =false;
                break;

                case 4:
                document.getElementById("aspirante_documento_fotos").checked=true;
                document.getElementById("enlace4").innerHTML = valor.ruta;
                document.getElementById("enlace4").href="/cseiio/C_subir_doc/descargar/"+valor.ruta;
                document.getElementById("file4").disabled =false;
                break;
                
              }
          });
          

        };

        xhr.send(null);
    }






      
      //function formato_tabla() {
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
          "sSearch": "Buscar:",
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
   // }
   /* formato_tabla();*/


       function elementoid(el){
      return document.getElementById(el);
    }
    function uploadFile(){
      var file = elementoid("file1").files[0];

      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();
      
      formdata.append("iddocumento",elementoid('aspirante_documento_acta_nacimiento').value);
      formdata.append("numcontrol",elementoid('numcontrol').value);
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler, false);
      ajax.addEventListener("load", completeHandler, false);
      ajax.addEventListener("error", errorHandler, false);
      ajax.addEventListener("abort", abortHandler, false);
      ajax.open("POST", "/cseiio/C_subir_doc/subir_doc/");
      ajax.send(formdata);
      ajax.onload = function () {
          console.log(JSON.parse(ajax.response));
          
          var datos = JSON.parse(ajax.response);

          if(datos.status_error!==undefined){
            elementoid("status_error").innerHTML=datos.status_error;
          }

          if(datos.status!==undefined){
            elementoid("status").innerHTML=datos.status;
            elementoid('enlace_act_naci').innerHTML="<br>"+datos.ruta;
            elementoid('enlace_act_naci').href="/cseiio/C_subir_doc/descargar/"+datos.ruta;
          }
          


       };


    }
    function progressHandler(event){
      //elementoid("loaded_n_total").innerHTML = "Cargando "+event.loaded+" de bytes: "+event.total;
      var percent = (event.loaded / event.total) * 100;
      elementoid("progressBar").value = Math.round(percent);
      elementoid("status").innerHTML = Math.round(percent)+"% Cargando...espere.";

    }
    function completeHandler(event){
      elementoid("status").innerHTML = event.target.responseText;
      elementoid("progressBar").value = 0;
      
    }
    function errorHandler(event){
      elementoid("status_error").innerHTML = "No se subió el archivo, vuelva a intentarlo.";
    }
    function abortHandler(event){
      elementoid("status_error").innerHTML = "Carga de archivo detenida.";
    }


    function uploadFile2(){
      var file = elementoid("file2").files[0];

      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();
      
      formdata.append("iddocumento",elementoid('aspirante_documento_curp').value);
      formdata.append("numcontrol",elementoid('numcontrol').value);
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler2, false);
      ajax.addEventListener("load", completeHandler2, false);
      ajax.addEventListener("error", errorHandler2, false);
      ajax.addEventListener("abort", abortHandler2, false);
      ajax.open("POST", "/cseiio/C_subir_doc/subir_doc/");
      ajax.send(formdata);
      ajax.onload = function () {
          console.log(JSON.parse(ajax.response));
          
          var datos = JSON.parse(ajax.response);

          if(datos.status_error!==undefined){
            elementoid("status_error2").innerHTML=datos.status_error;
          }

          if(datos.status!==undefined){
            elementoid("status2").innerHTML=datos.status;
            elementoid('enlace2').innerHTML="<br>"+datos.ruta;
            elementoid('enlace2').href="/cseiio/C_subir_doc/descargar/"+datos.ruta;
          }
          


       };


    }
    function progressHandler2(event){
      //elementoid("loaded_n_total").innerHTML = "Cargando "+event.loaded+" de bytes: "+event.total;
      var percent = (event.loaded / event.total) * 100;
      elementoid("progressBar2").value = Math.round(percent);
      elementoid("status2").innerHTML = Math.round(percent)+"% Cargando...espere.";

    }
    function completeHandler2(event){
      elementoid("status2").innerHTML = event.target.responseText;
      elementoid("progressBar2").value = 0;
      
    }
    function errorHandler2(event){
      elementoid("status_error2").innerHTML = "No se subió el archivo, vuelva a intentarlo.";
    }
    function abortHandler2(event){
      elementoid("status_error2").innerHTML = "Carga de archivo detenida.";
    }



    function uploadFile3(){
      var file = elementoid("file3").files[0];

      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();
      
      formdata.append("iddocumento",elementoid('aspirante_documento_certificado_secundaria').value);
      formdata.append("numcontrol",elementoid('numcontrol').value);
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler3, false);
      ajax.addEventListener("load", completeHandler3, false);
      ajax.addEventListener("error", errorHandler3, false);
      ajax.addEventListener("abort", abortHandler3, false);
      ajax.open("POST", "/cseiio/C_subir_doc/subir_doc/");
      ajax.send(formdata);
      ajax.onload = function () {
          console.log(JSON.parse(ajax.response));
          
          var datos = JSON.parse(ajax.response);

          if(datos.status_error!==undefined){
            elementoid("status_error3").innerHTML=datos.status_error;
          }

          if(datos.status!==undefined){
            elementoid("status3").innerHTML=datos.status;
            elementoid('enlace3').innerHTML="<br>"+datos.ruta;
            elementoid('enlace3').href="/cseiio/C_subir_doc/descargar/"+datos.ruta;
          }
          


       };


    }
    function progressHandler3(event){
      //elementoid("loaded_n_total").innerHTML = "Cargando "+event.loaded+" de bytes: "+event.total;
      var percent = (event.loaded / event.total) * 100;
      elementoid("progressBar3").value = Math.round(percent);
      elementoid("status3").innerHTML = Math.round(percent)+"% Cargando...espere.";

    }
    function completeHandler3(event){
      elementoid("status3").innerHTML = event.target.responseText;
      elementoid("progressBar3").value = 0;
      
    }
    function errorHandler3(event){
      elementoid("status_error3").innerHTML = "No se subió el archivo, vuelva a intentarlo.";
    }
    function abortHandler3(event){
      elementoid("status_error3").innerHTML = "Carga de archivo detenida.";
    }


function uploadFile4(){
      var file = elementoid("file4").files[0];

      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();
      
      formdata.append("iddocumento",elementoid('aspirante_documento_fotos').value);
      formdata.append("numcontrol",elementoid('numcontrol').value);
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", progressHandler4, false);
      ajax.addEventListener("load", completeHandler4, false);
      ajax.addEventListener("error", errorHandler4, false);
      ajax.addEventListener("abort", abortHandler4, false);
      ajax.open("POST", "/cseiio/C_subir_doc/subir_doc/");
      ajax.send(formdata);
      ajax.onload = function () {
          console.log(JSON.parse(ajax.response));
          
          var datos = JSON.parse(ajax.response);

          if(datos.status_error!==undefined){
            elementoid("status_error4").innerHTML=datos.status_error;
          }

          if(datos.status!==undefined){
            elementoid("status4").innerHTML=datos.status;
            elementoid('enlace4').innerHTML="<br>"+datos.ruta;
            elementoid('enlace4').href="/cseiio/C_subir_doc/descargar/"+datos.ruta;
          }
          


       };


    }
    function progressHandler4(event){
      //elementoid("loaded_n_total").innerHTML = "Cargando "+event.loaded+" de bytes: "+event.total;
      var percent = (event.loaded / event.total) * 100;
      elementoid("progressBar4").value = Math.round(percent);
      elementoid("status4").innerHTML = Math.round(percent)+"% Cargando...espere.";

    }
    function completeHandler4(event){
      elementoid("status4").innerHTML = event.target.responseText;
      elementoid("progressBar4").value = 0;
      
    }
    function errorHandler4(event){
      elementoid("status_error4").innerHTML = "No se subió el archivo, vuelva a intentarlo.";
    }
    function abortHandler4(event){
      elementoid("status_error4").innerHTML = "Carga de archivo detenida.";
    }


    function validarArchivo(archivo,var_status,var_status_error,var_boton){
      elementoid(var_status).innerHTML ="";
      elementoid(var_status_error).innerHTML ="";
      var fileName = archivo.files[0].name;
      var fileSize = archivo.files[0].size;
      var es_valido=false;
         //alert('peso '+fileSize+' extensión '+fileName);
        if(fileSize> 2097152){
          
          elementoid(var_status_error).innerHTML = "El archivo no debe superar los 2 MB.";
          es_valido=true;
          
        }else{
          // recuperamos la extensión del archivo y validamos.
          var ext = fileName.split('.').pop();

          // console.log(ext);
          switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'pdf': break;
            default:
            es_valido=true;
            elementoid(var_status_error).innerHTML = "Archivo con extensión no permitida.";
              
          }
        }

        document.getElementById(var_boton).disabled =es_valido;
    }
    </script>



</body>

</html>