<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Resolución de Equivalencia</a>
      </li>
      <li class="breadcrumb-item active">Seleccione un alumno de portabilidad para generar el formato:</li>
    </ol>

    <div class="card">
      <div class="card-body">


        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="aspirante_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="aspirante_curp_busqueda">CURP</label>
              </div>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="aspirante_plantel_busqueda" name="aspirante_plantel">
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
              <button type='button' class="btn btn-success btn-lg btn-block" id="btn_buscar"
                onclick='buscar()'>Buscar</button>
            </div>

          </div>
        </div>



      </div>
    </div>



    <div class="card" style="overflow:scroll; display:none" id="busqueda_oculto">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa">
          <caption>Lista de Alumnos sin matrícula asignada</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Semestre</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1"></th>
              <th scope="col" class="col-md-1"></th>
              <th scope="col" class="col-md-1"></th>

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
<div class="modal fade" id="generar_resolucion_equivalencia" tabindex="-1" role="dialog"
  aria-labelledby="modaleliminarTitle">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <form id="generar_equivalencia">
          <!--datos personales------------------------------------------------------>
          <input type="hidden" id="num_control_estudiante" name="num_control_estudiante" />
          <input type="hidden" id="plantel_inscrito" name="plantel_inscrito" />


          <p class="text-center text-white rounded titulo-form h4">
            Datos Personales de Aspirante
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="nombre_completo" name="nombre_completo"
                    placeholder="Nombre Completo" readonly>
                  <label for="nombre_completo">Nombre Completo</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-9">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="escuela_procedencia"
                    name="escuela_procedencia" placeholder="Escuela de Procedencia" readonly>
                  <label for="escuela_procedencia">Escuela de Educacion Media Superior de Procedencia</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="cct_procedencia" name="cct_procedencia"
                    placeholder="CCT" readonly>
                  <label for="cct_procedencia">CCT de Escuela de Procedencia</label>
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="plantel_inscripcion"
                    name="nombre_plantel_inscripcion" placeholder="nombre plantel inscripcion" readonly>
                  <label for="nombre_plantel_inscripcion"> Plantel donde se encuentra inscrito</label>
                </div>
              </div>
            </div>
          </div>


          <p class="text-center text-white rounded titulo-form h4">
            Datos Para Resolución de Equivalencia
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="num_folio" name="num_folio"
                    placeholder="Número de folio" required="required"
                    pattern="([B|b]{1})([I|i]{1})([C|c]{1})([-]{1})([E|e]{1})([ ]{1})([0-9]{4})">
                  <label for="num_folio">Num. Folio</label>
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="semestre_acreditado"
                    name="semestre_acreditado" onchange="semestre_ciclo(this,'ciclo_escolar','')">
                    <option value="">Seleccione el semestre</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    
                  </select>
                  <span>Ultimo Semestre Acreditado</span>
                </label>
              </div>

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input class="form-control" placeholder="" type="date" id="fecha_expedicion" name="fecha_expedicion"
                    required="required" value="<?php echo date('Y-m-d'); ?>">
                  <label for="fecha_expedicion">Fecha de Expedición: dd/mm/aaaa</label>
                </div>
              </div>

            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="ciclo_escolar"
                    name="ciclo_escolar">
                    <option value="">Seleccione el ciclo</option>
                    

                  </select>
                  <span>Ciclo Escolar</span>
                </label>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="promedio_acreditado"
                    name="promedio_acreditado" placeholder="promedio acreditado" min="6" max="10"
                    pattern="^([6-9]{1})([.][0-9]{0,1})?$" title="Introduzca una calificación valida, Ejemplo: 8.1"
                    required="required" />
                  <label for="promedio_acreditado">Promedio Acreditado</label>
                </div>
              </div>

            </div>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="btn_enviar" class="btn btn-success">Aceptar</button>
          </div>




        </form>
      </div>


    </div>
  </div>
</div>
<!-- Modal -->



<!-- Modal -->
<div class="modal fade" id="editar_resolucion_equivalencia" tabindex="-1" role="dialog"
  aria-labelledby="modaleliminarTitle">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <form id="editar_equivalencia">
          <!--datos personales------------------------------------------------------>
          <input type="hidden" id="mnum_control_estudiante" name="mnum_control_estudiante" />
          <input type="hidden" id="mplantel_inscrito" name="mplantel_inscrito" />


          <p class="text-center text-white rounded titulo-form h4">
            Datos Personales de Aspirante
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="mnombre_completo" name="mnombre_completo"
                    placeholder="Nombre Completo" readonly>
                  <label for="mnombre_completo">Nombre Completo</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-9">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="mescuela_procedencia"
                    name="mescuela_procedencia" placeholder="Escuela de Procedencia" readonly>
                  <label for="mescuela_procedencia">Escuela de Procedencia</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="mcct_procedencia" name="mcct_procedencia"
                    placeholder="CCT" readonly>
                  <label for="mcct_procedencia">CCT de Escuela de Procedencia</label>
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="mplantel_inscripcion"
                    name="mplantel_inscripcion" placeholder="nombre plantel inscripcion" readonly>
                  <label for="mplantel_inscripcion"> Plantel donde se encuentra inscrito</label>
                </div>
              </div>
            </div>
          </div>


          <p class="text-center text-white rounded titulo-form h4">
            Datos Para Resolución de Equivalencia
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="mnum_folio" name="mnum_folio"
                    placeholder="Número de folio" required="required"
                    pattern="([B|b]{1})([I|i]{1})([C|c]{1})([-]{1})([E|e]{1})([ ]{1})([0-9]{4})">
                  <label for="mnum_folio">Num. Folio</label>
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="msemestre_acreditado"
                    name="msemestre_acreditado" onchange="semestre_ciclo(this,'mciclo_escolar','')">
                    <option value="">Seleccione el semestre</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    
                  </select>
                  <span>Ultimo Semestre Acreditado</span>
                </label>
              </div>

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input class="form-control" placeholder="" type="date" id="mfecha_expedicion" name="mfecha_expedicion"
                    required="required" value="<?php echo date('Y-m-d'); ?>">
                  <label for="mfecha_expedicion">Fecha de Expedición: dd/mm/aaaa</label>
                </div>
              </div>

            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="mciclo_escolar"
                    name="mciclo_escolar">
                    <option value="">Seleccione el ciclo</option>

                  </select>
                  <span>Ciclo Escolar</span>
                </label>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="mpromedio_acreditado"
                    name="mpromedio_acreditado" placeholder="promedio acreditado" min="6" max="10"
                    pattern="^([6-9]{1})([.][0-9]{0,1})?$" title="Introduzca una calificación valida, Ejemplo: 8.1"
                    required="required" />
                  <label for="mpromedio_acreditado">Promedio Acreditado</label>
                </div>
              </div>

            </div>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" id="mbtn_enviar" class="btn btn-success">Aceptar</button>
          </div>




        </form>
      </div>


    </div>
  </div>
</div>
<!-- Modal -->






<!-- Modal para ingresar el número de inicio consecutivo de los números de resolución de equivalencia-->
<div class="modal fade" id="modal_ingresar_numero" tabindex="-1" role="dialog" aria-labelledby="modalnumeroTitle"
  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar número de equivalencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_numero_equivalencia">
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <input type="number" name="numero_ingresar" id="numero_ingresar" class="form-control"
                  title="ingrese un número" placeholder="Ingrese un número entero para inicializar" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cerrar_modal()">Cerrar</button>
          <button type="input" class="btn btn-primary" id="btn_num_equivalencia" disabled="disabled">Aceptar</button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>

function semestre_ciclo(id_semestre,id_ciclo,valor_id_ciclo) {
  semestre=id_semestre.value;
  periodo='';

  if(semestre % 2 == 0) {
    periodo='FEBRERO-JULIO';
  }
  else {
     periodo='AGOSTO-ENERO';
  }

  var xhr_escuela = new XMLHttpRequest();
        xhr_escuela.open('GET', '<?php echo base_url();?>index.php/C_ciclo_escolar/ciclo_escolar_x_periodo?periodo='+periodo, true);
        xhr_escuela.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr_escuela.error = function () {
          console.log("error de conexion");
        }

        xhr_escuela.onload = function () {
          $('#div_carga').hide();

          let periodos_ciclo = JSON.parse(xhr_escuela.response);
          document.getElementById(id_ciclo).innerHTML = "";
          var option = document.createElement("option");
          option.text = "Seleccione el ciclo escolar";
          option.value = "";
          document.getElementById(id_ciclo).add(option);

            if (typeof periodos_ciclo !== 'undefined') {
              
                  periodos_ciclo.forEach(function (valor, indice) {
                        var option = document.createElement("option");
                        option.text = valor.nombre_ciclo_escolar+'-----'+valor.periodo;
                        option.value = valor.id_ciclo_escolar;
                        if(valor_id_ciclo===valor.id_ciclo_escolar){
                          option.selected=true;
                        }
                        document.getElementById(id_ciclo).add(option);
                    
                  });
      

            }


        };

        xhr_escuela.send(null);

  }


  function buscar() {

    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/estudiantes_portabilidad?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      console.log(JSON.parse(xhr.response));
      ////console.log(query);


      JSON.parse(xhr.response).forEach(function (valor, indice) {
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
        fila += valor.semestre_en_curso;
        fila += '</td>';

        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';



        if (valor.entregado > 0) {
          fila += '<td>';
          fila += '<a class="btn btn-success" href="<?php echo base_url();?>index.php/c_estudiante/descargar_resolucion_equivalencia?no_control=' + valor.no_control + '" role="button" target="_blank">Descargar PDF</a>';
          fila += '</td>';

          fila += '<td>';
          fila += '<button class="btn btn-info" type="button" class="btn btn-primary" value="' + valor.no_control + '" onclick="editar_datos_resolucion(this)"  data-toggle="modal" data-target="#editar_resolucion_equivalencia">Editar</button>';
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-warning" type="button" class="btn btn-primary" data-toggle="modal"  disabled="true">Resolución de Equivalencia</button>';
          fila += '</td>';

        }



        if (valor.entregado == 0) {

          fila += '<td>';
          fila += '<a class="btn btn-success" role="button" disabled style="color: currentColor;cursor: not-allowed;opacity: 0.5;text-decoration: none;">Descargar PDF</a>';
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal"  disabled="true">Editar</button>';
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-warning" type="button" value="' + valor.no_control + '" onclick="cargar_datos_resolucion(this)" class="btn btn-primary" data-toggle="modal" data-target="#generar_resolucion_equivalencia">Resolución de Equivalencia</button>';
          fila += '</td>';
        }


        fila += '</tr>';

        document.getElementById("tabla").innerHTML += fila;
      });

      formato_tabla();

    };

    xhr.send(null);
    document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
    document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
    document.getElementById('btn_buscar').classList.remove('btn-success');
    document.getElementById('btn_buscar').classList.add('btn-dark');
    document.getElementById('busqueda_oculto').style.display = "";

  }


  function editar_datos_resolucion(no_control) {
    document.getElementById('editar_equivalencia').reset();

    console.log(no_control);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_plantel_estudiante?no_control=' + no_control.value, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onload = function () {
      $('#div_carga').hide();
      let mestudiante = JSON.parse(xhr.response);
      console.log(mestudiante);

      document.getElementById("mnum_control_estudiante").value = mestudiante[0].no_control;
      document.getElementById("mnombre_completo").value = mestudiante[0].nombre + " " + mestudiante[0].primer_apellido + " " + mestudiante[0].segundo_apellido;

      document.getElementById("mplantel_inscrito").value = mestudiante[0].Plantel_cct_plantel;
      document.getElementById("mplantel_inscripcion").value = mestudiante[0].nombre_plantel;



      var xhr_resolucion = new XMLHttpRequest();
      xhr_resolucion.open('GET', '<?php echo base_url();?>index.php/C_estudiante/get_resolucion_equivalencia?no_control=' + no_control.value, true);
      xhr_resolucion.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr_resolucion.error = function () {
        console.log("error de conexion");
      }

      xhr_resolucion.onload = function () {
        $('#div_carga').hide();

        let mresolucion = JSON.parse(xhr_resolucion.response);
        document.getElementById("mnum_folio").value = mresolucion[0].folio;
        document.getElementById("msemestre_acreditado").value = mresolucion[0].ultimo_semestre_acreditado;
        semestre_ciclo(document.getElementById("msemestre_acreditado"),"mciclo_escolar",mresolucion[0].id_ciclo_escolar);
        document.getElementById("mfecha_expedicion").value = mresolucion[0].fecha_expedicion;
        //document.getElementById("mciclo_escolar").value = mresolucion[0].id_ciclo_escolar;
        document.getElementById("mpromedio_acreditado").value = mresolucion[0].promedio_acreditado;

      };

      xhr_resolucion.send(null);




      //if (mestudiante[0].cct_escuela_procedencia !== "") {

        document.getElementById('mbtn_enviar').disabled = false;
        
        var xhr_escuela = new XMLHttpRequest();
        xhr_escuela.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela_procedencia_repetidor?no_control=' + mestudiante[0].no_control, true);
        xhr_escuela.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr_escuela.error = function () {
          console.log("error de conexion");
        }

        xhr_escuela.onload = function () {
          $('#div_carga').hide();

          let mprocedencia = JSON.parse(xhr_escuela.response);

          if (typeof mprocedencia[0] !== 'undefined') {

              document.getElementById("mcct_procedencia").value = mprocedencia[0].cct_escuela_procedencia;
              document.getElementById("mescuela_procedencia").value = mprocedencia[0].nombre_escuela_procedencia;
              document.getElementById("btn_num_equivalencia").disabled = false; 

          }

              else {
            Swal.fire({
              type: 'error',
              title: 'Para realizar este procedimiento es necesario que ingrese la escuela de procedencia.',
              showConfirmButton: true,
              
            });
            document.getElementById('mbtn_enviar').disabled = true;
            document.getElementById("btn_num_equivalencia").disabled = true;
          }

        };

        xhr_escuela.send(null);

    

    };

    xhr.send(null);

  }




  function cargar_datos_resolucion(no_control) {
    document.getElementById('generar_equivalencia').reset();

    var xhr_num_resolucion = new XMLHttpRequest();
    xhr_num_resolucion.open('GET', '<?php echo base_url();?>index.php/C_estudiante/get_num_resolucion', true);
    xhr_num_resolucion.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr_num_resolucion.error = function () {
      console.log("error de conexion");
    }

    xhr_num_resolucion.onload = function () {
      $('#div_carga').hide();

      if (xhr_num_resolucion.responseText.trim() !== '') {

        document.getElementById('num_folio').value = xhr_num_resolucion.responseText;
      }
      else {

        $('#modal_ingresar_numero').modal('show');
        document.getElementById('form_numero_equivalencia').reset();

      }

    };

    xhr_num_resolucion.send(null);


    console.log(no_control);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_plantel_estudiante?no_control=' + no_control.value, true);

    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onload = function () {
      $('#div_carga').hide();
      let estudiante = JSON.parse(xhr.response);
      console.log(estudiante);

      document.getElementById("num_control_estudiante").value = estudiante[0].no_control;
      document.getElementById("nombre_completo").value = estudiante[0].nombre + " " + estudiante[0].primer_apellido + " " + estudiante[0].segundo_apellido;

      document.getElementById("plantel_inscrito").value = estudiante[0].Plantel_cct_plantel;
      document.getElementById("plantel_inscripcion").value = estudiante[0].nombre_plantel;

      

        document.getElementById('btn_enviar').disabled = false;
        
        var xhr_escuela = new XMLHttpRequest();
        xhr_escuela.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela_procedencia_repetidor?no_control=' + estudiante[0].no_control, true);
        xhr_escuela.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr_escuela.error = function () {
          console.log("error de conexion");
        }

        xhr_escuela.onload = function () {
          $('#div_carga').hide();
          let procedencia = JSON.parse(xhr_escuela.response);
          if (typeof procedencia[0] !== 'undefined') {
              document.getElementById("escuela_procedencia").value = procedencia[0].nombre_escuela_procedencia;
              document.getElementById("cct_procedencia").value = procedencia[0].cct_escuela_procedencia;
              document.getElementById("btn_num_equivalencia").disabled = false; 

          }

          else {
            Swal.fire({
              type: 'error',
              title: 'Para realizar este procedimiento es necesario que ingrese la escuela de procedencia.',
              showConfirmButton: true
              
            });
            document.getElementById("btn_num_equivalencia").disabled = true;
            document.getElementById('btn_enviar').disabled = true;
        }


        };

        xhr_escuela.send(null);


    };

    xhr.send(null);

  }




  var form = document.getElementById("generar_equivalencia");
  form.onsubmit = function (e) {
    e.preventDefault();
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_estudiante/generar_resolucion_equivalencia", true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        //console.log();
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          Swal.fire({
            type: 'success',
            title: 'Resolución de equivalencia ingresada exitosamente',
            showConfirmButton: false,
            timer: 2500
          });
          $('#generar_resolucion_equivalencia').modal('toggle');


          var resolucion_eq = new XMLHttpRequest();
          resolucion_eq.open('GET', '<?php echo base_url();?>index.php/c_estudiante/descargar_resolucion_equivalencia?no_control=' + document.getElementById("num_control_estudiante").value, true);
          resolucion_eq.responseType = "arraybuffer";
          resolucion_eq.onloadstart = function () {
            $('#div_carga').show();
          }
          resolucion_eq.error = function () {
            console.log("error de conexion");
          }

          resolucion_eq.onload = function () {
            $('#div_carga').hide();
            //console.log(carta_compromiso.responseText);
            if (this.status === 200) {
              var blob = new Blob([resolucion_eq.response], { type: "application/pdf" });
              var objectUrl = URL.createObjectURL(blob);
              window.open(objectUrl, "_blank");

            }

          };
          borrar_formato_tabla();
          document.getElementById("tabla").innerHTML = "";
          buscar();


          resolucion_eq.send(null);
        }
        else {
          Swal.fire({
            type: 'error',
            title: 'Ocurrio un error al ingresar datos, verifique el número de folio.',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }
    }
    xhr.send(formdata);
  }


  var form_2 = document.getElementById("editar_equivalencia");
  form_2.onsubmit = function (e) {
    e.preventDefault();
    var formdata = new FormData(form_2);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/C_estudiante/editar_resolucion_equivalencia", true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        //console.log();
        $('#div_carga').show();
        if (xhr.responseText.trim() === "si") {
          Swal.fire({
            type: 'success',
            title: 'Resolución de equivalencia modificada exitosamente',
            showConfirmButton: false,
            timer: 2500
          });
          $('#editar_resolucion_equivalencia').modal('toggle');


          var resolucion_eq = new XMLHttpRequest();
          resolucion_eq.open('GET', '<?php echo base_url();?>index.php/c_estudiante/descargar_resolucion_equivalencia?no_control=' + document.getElementById("mnum_control_estudiante").value, true);
          resolucion_eq.responseType = "arraybuffer";
          resolucion_eq.onloadstart = function () {
            $('#div_carga').show();
          }
          resolucion_eq.error = function () {
            console.log("error de conexion");
          }

          resolucion_eq.onload = function () {
            $('#div_carga').hide();
            //console.log(carta_compromiso.responseText);
            if (this.status === 200) {
              var blob = new Blob([resolucion_eq.response], { type: "application/pdf" });
              var objectUrl = URL.createObjectURL(blob);
              window.open(objectUrl, "_blank");

            }

          };
          borrar_formato_tabla();
          document.getElementById("tabla").innerHTML = "";
          buscar();


          resolucion_eq.send(null);
        }
        else {
          Swal.fire({
            type: 'error',
            title: 'Ocurrio un error al ingresar datos, verifique el número de folio.',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }
    }
    xhr.send(formdata);
  }



  function str_pad(str, pad_length, pad_string, pad_type) {
    var len = pad_length - str.length;
    if (len < 0) return str;
    var pad = new Array(len + 1).join(pad_string);
    if (pad_type == "STR_PAD_LEFT") return pad + str;
    return str + pad;
  }


  var form_3 = document.getElementById("form_numero_equivalencia");
  form_3.onsubmit = function (e) {
    e.preventDefault();

    numero = document.getElementById("numero_ingresar").value;
    formato = 'BIC-E ' + str_pad(numero, 4, "0", "STR_PAD_LEFT");
    document.getElementById("num_folio").value = formato;
    $("#modal_ingresar_numero").modal('hide');

  }



  function borrar_formato_tabla() {
    $("#tabla_completa").dataTable().fnDestroy();

  }


  function cerrar_modal() {
    $("#generar_resolucion_equivalencia").modal('hide');

  }

</script>