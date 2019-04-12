
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
                      <option value="">Buscar en todos los planteles</option>

                      <?php
              foreach ($planteles as $plantel)
           {
            echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
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
                <th scope="col" class="col-md-1">Plantel CCT</th>
                <th scope="col" class="col-md-1">Estatus de documentación</th>
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
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="refrescar_tabla()">
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

          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="refrescar_tabla()">Cerrar y guardar</button>
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


        var xhr2 = new XMLHttpRequest();
        xhr2.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_docxaspirante/' + e.value, true);

        xhr2.onload = function () {
          console.log(JSON.parse(xhr2.response));

          var estudiante = JSON.parse(xhr2.response);
          //datos personales
          document.getElementById("numcontrol").value = estudiante.numcontrol;
          document.getElementById("nombrecompleto").innerHTML = e2 + " " + e3 + " " + e4;
          //documentos 1.
          var cont2 = 0;

            estudiante.documentacion_aspirante.forEach(function (valor, indice2) {
              cont2++;
               var fila = '<tr>';
               estatusdoc='';
               estatusCheck='';
               if (valor.entregado == true) {
                  estatusCheck='checked';
                  
                }

                else{
                    estatusCheck='unchecked';
                    estatusdoc='disabled';
                }

          fila += '<td>';
          fila += '<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="documento' + cont2 + '" id="documento' + cont2 + '" value="' + valor.id_documento + '"  onclick="activarFile(this,\'file' + cont2 + '\')" '+estatusCheck+'>' + valor.nombre_documento;
          fila += '</label></div></td>';

          fila += '<td>';
          fila += '<input type="file" name="file' + cont2 + '" id="file' + cont2 + '" onchange="validarArchivo(this,\'status' + cont2 + '\',\'status_error' + cont2 + '\',\'boton' + cont2 + '\')" '+estatusdoc+' required/><br><span class="badge badge-danger">* El archivo debe estar en formato PDF, JPG y PNG.</span><progress id="progressBar' + cont2 + '" value="0" max="100"></progress><span id="status' + cont2 + '" class="status_upload"></span><span id="status_error' + cont2 + '" class="status_upload_error"></span> <input  id="boton' + cont2 + '" class="btn btn-success" type="button" value="Cargar archivo" onclick="uploadFile(\'file' + cont2 + '\',\'documento' + cont2 + '\',\'progressBar' + cont2 + '\',\'status' + cont2 + '\',\'status_error' + cont2 + '\',\'enlace' + cont2 + '\',\'enlaceview' + cont2 + '\',\'view' + cont2 + '\')" disabled>';
          fila += '</td>';

          if (valor.ruta !== null && valor.ruta.length!==0) {
              fila += '<td>';
              fila += '<center><a class="btn btn-info" id="enlace'+cont2 +'" href="<?php echo base_url();?>index.php/C_subir_doc/descargar/'+ valor.Estudiante_no_control +'/'+valor.Documento_id_documento+'" >Descargar <i class="fa fa-download" aria-hidden="true"></i></a> </center>';
              fila += '</td>';

              fila += '<td>';
               fila += '<center><div id="view'+ cont2+'"><a class="btn btn-info enlace1" id="enlaceview' + cont2 + '" onClick="ventanaSecundaria(\'<?php echo base_url();?>index.php/C_subir_doc/visualizar/' + valor.Estudiante_no_control + '/' +valor.Documento_id_documento + '\');">Visualizar <i class="fa fa-search" aria-hidden="true"></i></a></div> </center>';
              fila += '</td>';
          }

          else{
            fila += '<td>';
            fila += '<center><a id="enlace' + cont2 + '" href="" ></a> </center>';
          fila += '</td>';

          fila += '<td>';
          fila += '<center><div id="view' + cont2 + '"></div> </center>';
          fila += '</td>';
          }
         


         fila += '</tr>';
         document.getElementById("tablaajax").innerHTML += fila;
              
            });

          



        };

        xhr2.send(null);



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
          console.log('enlace: '+enlace);
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

      xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/buscar_aspirantesxplantel?' + query, true);



      xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));
        ////console.log(query);


        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var contador=0;
          var fila = '<tr>';

          fila += '<td>';
          fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
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

          fila += '<td>';
          fila += valor.Plantel_cct_plantel;
          fila += '</td>';

          fila += '<td>';
          if(valor.no_entregado==0){
            fila+='<span class="badge badge-success">Documentación por entregar completa</span><br>';
          }
          else{
            fila+='<span class="badge badge-warning">Num. de Documentación por entregar: '+valor.no_entregado+'</span><br>';
          }
          if(valor.no_subida==0){
            
            fila+='<span class="badge badge-success">Documentación por subir completa</span>';
          }
          else{
            fila+='<span class="badge badge-warning">Num. de Documentación por subir: '+valor.no_subida+'</span>';
          }
          fila += '';
          fila += '</td>';

          fila += '<td class="text-center"><button type="button" value="' + valor.no_control + '" onclick="cargar_doc_aspirante(this,\'' + valor.nombre + '\',\'' + valor.primer_apellido + '\',\'' + valor.segundo_apellido + '\',\'' + valor.tipo_ingreso + '\')" class="btn btn-success" data-toggle="modal" data-target="#modalsubirdocumentos" data-backdrop="static" data-keyboard="false">Subir documentos</button>';
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


function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }

  </script>



