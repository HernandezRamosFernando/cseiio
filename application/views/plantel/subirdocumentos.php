
    <div id="content-wrapper">
      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Carga de Documentos</a>
          </li>
          <li class="breadcrumb-item active">Busque al alumno que desea cargar documentos</li>
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

                      <?php
              foreach ($planteles as $plantel)
           {
            echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct.'</option>';
          }
          ?>

                    </select>
                  </label>

                </div>

                <div class="col-md-4">
                  <button type='button' class="btn btn-success btn-lg btn-block" id="btn_buscar"
                    onclick='buscar()'>Buscar</button>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_completa" style="width: 100%; overflow:scroll">
              <caption>Lista de todos los alumnos</caption>
              <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">Curp</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Tipo de ingreso</th>
                <th scope="col" class="col-md-1">Control de documentación</th>
              </tr>
              </thead>



              <tbody id="tabla">

              </tbody>
            </table>
          </div>
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

  <div class="modal" tabindex="-1" role="dialog" id="modalsubirdocumentos">
    <div class="modal-dialog modal-xl" style="max-width: 90% !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">SUBIR DOCUMENTACIÓN</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <p style="font-weight: bold;">Nombre: <span id="nombrecompleto"></span>
          </p>
          <input type="hidden" id="numcontrol" name="numcontrol" value="">

          <div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_completa" style="width: 100%">

              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-4">Documentación</th>
                  <th scope="col" class="col-md-4">Cargar Documentación</th>
                  <th scope="col" class="col-md-2">
                    <center>Descargar</center>
                  </th>
                  <th scope="col" class="col-md-2">
                    <center>Visualizar</center>
                  </th>

                </tr>
              </thead>
              <tbody id="tablaajax">

              </tbody>
            </table>
            </div>
          </div>
          <p id="muestra"> </p>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar y guardar</button>
        </div>
      </div>
    </div>
  </div>



  <!-- Termina modal de carga de documentos por aspirante-->

 

  <script>

    function activarFile(campo, campoArchivo) {
      var checkBox = document.getElementById(campo.name);
      var archivo = document.getElementById(campoArchivo);
      if (checkBox.checked == true) {
        archivo.disabled = false;
      }
      else {
        archivo.disabled = true;
      }

    }
    function formato_tabla() {
      $('#tabla_completa').DataTable({
        //"order": [[ 0, 'desc' ]],
        "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
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



    function cargar_doc_aspirante(e, e2, e3, e4, e5) {
      document.getElementById("tablaajax").innerHTML = "";
      //Asignar datos de documentación del aspirante.

      var query2 = 'tipoingreso=' + e5;


      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_documentacion/lista_documentacion?' + query2, true);

      xhr.onload = function () {
        console.log(JSON.parse(xhr.response));

        var datos = JSON.parse(xhr.response);
        var cont = 0;
        datos.listadoc.forEach(function (valor, indice) {
          var fila = '<tr>';

          cont++;


          fila += '<td>';
          fila += '<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="documento' + cont + '" id="documento' + cont + '" value="' + valor.id_documento + '"  onclick="activarFile(this,\'file' + cont + '\')" unchecked>' + valor.nombre_documento;
          fila += '</label></div></td>';

          fila += '<td>';
          fila += '<input type="file" name="file' + cont + '" id="file' + cont + '" onchange="validarArchivo(this,\'status' + cont + '\',\'status_error' + cont + '\',\'boton' + cont + '\')" disabled required/><br><span class="badge badge-danger">* El archivo debe estar en formato PDF, JPG y PNG.</span><progress id="progressBar' + cont + '" value="0" max="100"></progress><span id="status' + cont + '" class="status_upload"></span><span id="status_error' + cont + '" class="status_upload_error"></span> <input  id="boton' + cont + '" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile(\'file' + cont + '\',\'documento' + cont + '\',\'progressBar' + cont + '\',\'status' + cont + '\',\'status_error' + cont + '\',\'enlace' + cont + '\',\'enlaceview' + cont + '\',\'view' + cont + '\')" disabled>';
          fila += '</td>';

          fila += '<td>';
          fila += '<center><a id="enlace' + cont + '" href="" ></a> </center>';
          fila += '</td>';

          fila += '<td>';
          fila += '<center><div id="view' + cont + '"></div> </center>';
          fila += '</td>';

          fila += '</tr>';

          document.getElementById("tablaajax").innerHTML += fila;



        });


        var xhr2 = new XMLHttpRequest();
        xhr2.open('GET', '<?php echo base_url();?>index.php/c_aspirante/get_docxaspirante/' + e.value, true);

        xhr2.onload = function () {
          console.log(JSON.parse(xhr2.response));

          var aspirante = JSON.parse(xhr2.response);
          //datos personales
          document.getElementById("numcontrol").value = aspirante.numcontrol;
          document.getElementById("nombrecompleto").innerHTML = e2 + " " + e3 + " " + e4;
          //documentos 1.
          var cont2 = 0;
          datos.listadoc.forEach(function (valor, indice) {
            cont2++;

            aspirante.documentacion_aspirante.forEach(function (seleccionado, indice2) {
              if (seleccionado.Documento_id_documento == valor.id_documento) {




                if (seleccionado.entregado == true) {
                  document.getElementById("documento" + cont2).checked = true;
                  document.getElementById("file" + cont2).disabled = false;
                }

                if (seleccionado.ruta != null) {



                  var d = document.getElementById("enlace" + cont2);
                  d.className = "btn btn-info";
                  document.getElementById("enlace" + cont2).innerHTML = 'Descargar <i class="fa fa-download" aria-hidden="true"></i>';
                  document.getElementById("enlace" + cont2).href = "<?php echo base_url();?>index.php/C_subir_doc/descargar/" + seleccionado.Aspirante_no_control + "/" + seleccionado.Documento_id_documento;

                  document.getElementById("view" + cont2).innerHTML = '<a class="btn btn-info enlace1" id="enlaceview' + cont2 + '" onClick="ventanaSecundaria(\'<?php echo base_url();?>index.php/C_subir_doc/visualizar/' + seleccionado.Aspirante_no_control + '/' + seleccionado.Documento_id_documento + '\');">Visualizar <i class="fa fa-search" aria-hidden="true"></i></a>';




                }



              }
            });

          });



        };

        xhr2.send(null);


      };

      xhr.send(null);














    }



    function borrar_formato_tabla() {
      $("#tlistaaspirantes").dataTable().fnDestroy();
    }



    function elementoid(el) {
      return document.getElementById(el);
    }



    function uploadFile(doc, iddoc, cargando, estado, estado_error, enlace, enlaceview, view) {
      var file = elementoid(doc).files[0];

      console.log("archivo: " + doc);

      // alert(file.name+" | "+file.size+" | "+file.type);
      var formdata = new FormData();

      formdata.append("iddocumento", elementoid(iddoc).value);
      formdata.append("numcontrol", elementoid('numcontrol').value);
      formdata.append("file1", file);
      var ajax = new XMLHttpRequest();
      ajax.upload.addEventListener("progress", function progressHandler(event) {
        //elementoid("loaded_n_total").innerHTML = "Cargando "+event.loaded+" de bytes: "+event.total;
        var percent = (event.loaded / event.total) * 100;
        elementoid(cargando).value = Math.round(percent);
        elementoid(estado).innerHTML = Math.round(percent) + "% Cargando...espere.";

      }, false);
      ajax.addEventListener("load", function completeHandler(event) {
        elementoid(estado).innerHTML = event.target.responseText;
        elementoid(cargando).value = 0;

      }, false);
      ajax.addEventListener("error", function errorHandler(event) {
        elementoid(estado_error).innerHTML = "No se subió el archivo, vuelva a intentarlo.";
      }, false);
      ajax.addEventListener("abort", function abortHandler(event) {
        elementoid(estado_error).innerHTML = "Carga de archivo detenida.";
      }, false);
      ajax.open("POST", "<?php echo base_url();?>index.php/C_subir_doc/subir_doc/");
      ajax.send(formdata);
      ajax.onload = function () {
        console.log(JSON.parse(ajax.response));

        var datos = JSON.parse(ajax.response);

        if (datos.status_error !== undefined) {
          elementoid(estado_error).innerHTML = datos.status_error;
        }

        if (datos.status !== undefined) {
          var dx = document.getElementById(enlace);
          dx.className = "btn btn-primary";
          elementoid(estado).innerHTML = datos.status;
          elementoid(enlace).innerHTML = 'Descargar <i class="fa fa-download" aria-hidden="true"></i>';
          elementoid(enlace).href = "<?php echo base_url();?>index.php/C_subir_doc/descargar/" + datos.no_control + "/" + datos.iddocumento;

          elementoid(view).innerHTML = '<a class="btn btn-primary enlace1" id="' + enlaceview + '" onClick="ventanaSecundaria(\'<?php echo base_url();?>index.php/C_subir_doc/visualizar/'
            + datos.no_control + '/' + datos.iddocumento + '\');">Visualizar <i class="fa fa-search" aria-hidden="true"></i></a>';

        }



      };


    }


    function validarArchivo(archivo, var_status, var_status_error, var_boton) {
      elementoid(var_status).innerHTML = "";
      elementoid(var_status_error).innerHTML = "";
      var fileName = archivo.files[0].name;
      var fileSize = archivo.files[0].size;
      var es_valido = false;
      //alert('peso '+fileSize+' extensión '+fileName);
      if (fileSize > 2097152) {

        elementoid(var_status_error).innerHTML = "El archivo no debe superar los 2 MB.";
        es_valido = true;

      } else {
        // recuperamos la extensión del archivo y validamos.
        var ext = fileName.split('.').pop();

        // console.log(ext);
        switch (ext) {
          case 'jpg':
          case 'jpeg':
          case 'png':
          case 'pdf': break;
          default:
            es_valido = true;
            elementoid(var_status_error).innerHTML = "Archivo con extensión no permitida.";

        }
      }

      document.getElementById(var_boton).disabled = es_valido;
    }



    function ventanaSecundaria(URL) {
      window.open(URL, "Visor de Documentos", "width=700,height=700,scrollbars=yes")
    }



    function buscar() {
      document.getElementById("aspirante_plantel_busqueda").disabled = true;
      document.getElementById("aspirante_curp_busqueda").disabled = true;
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      var curp = document.getElementById("aspirante_curp_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;
      var query = 'curp=' + curp + '&plantel=' + plantel;

      xhr.open('GET', '<?php echo base_url();?>index.php/c_aspirante/buscar_aspirantesxplantel?' + query, true);



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
          fila += valor.tipo_ingreso;
          fila += '</td>';

          fila += '<td class="text-center"><button type="button" value="' + valor.no_control + '" onclick="cargar_doc_aspirante(this,\'' + valor.nombre + '\',\'' + valor.apellido_paterno + '\',\'' + valor.apellido_materno + '\',\'' + valor.tipo_ingreso + '\')" class="btn btn-success" data-toggle="modal" data-target="#modalsubirdocumentos">Subir documentos</button>';
          fila += '';
          fila += '</td>';

          fila += '</tr>';

          document.getElementById("tabla").innerHTML += fila;
        });


        formato_tabla();

      };

      xhr.send(null); document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
      document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
      document.getElementById('btn_buscar').classList.remove('btn-success');
      document.getElementById('btn_buscar').classList.add('btn-dark');
    }





    function limpiar() {
      location.reload();

    }


  </script>



