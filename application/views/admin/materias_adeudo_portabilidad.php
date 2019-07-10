<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Agregar materias de adeudo de portabilidad</a>
      </li>
      <li class="breadcrumb-item active">Seleccione un alumno para agregar sus materias</li>
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
<div class="modal fade" id="modalmaterias" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog"  style="max-width: 80% !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Materias de adeudo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            <form id="agregar_materias">
          <!--datos personales------------------------------------------------------>
          <input type="hidden" id="num_control_estudiante" name="num_control_estudiante" />
          <input type="hidden" id="tiempo_de_inscripcion" name="tiempo_de_inscripcion" />


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
            Materias de adeudo
            <hr>
          </p>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="materia_1"
                    name="materia_1" >
                    <option value="">Seleccione una materia</option>
                    
                  </select>
                  <span>Materia 1</span>
                </label>
              </div>
              <div class="col-md-3" id="calificacionoculta1" style="display: none">
                <div class="form-label-group">
                  <input type="number" class="form-control text-uppercase" id="calificacion_materia_1" name="calificacion_materia_1"
                    placeholder="Agregue calificacion" onchange="calificaciones(this)">
                  <label for="calificacion_materia_1">Agregue calificación</label>
                </div>
              </div>

                </div>
                <div class="row">
              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="materia_2"
                    name="materia_2" >
                    <option value="">Seleccione una materia</option>
                    
                  </select>
                  <span>Materia 2</span>
                </label>
              </div>
              <div class="col-md-3" id="calificacionoculta2" style="display: none">
                <div class="form-label-group">
                  <input type="number" class="form-control text-uppercase" id="calificacion_materia_2" name="calificacion_materia_2"
                    placeholder="Agregue calificacion" onchange="calificaciones(this)">
                  <label for="calificacion_materia_2">Agregue calificación</label>
                </div>
              </div>
                </div>

                <div class="row">
              <div class="col-md-4" >
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="materia_3"
                    name="materia_3" >
                    <option value="">Seleccione una materia</option>
                    
                  </select>
                  <span>Materia 3</span>
                </label>
              </div>
              <div class="col-md-3" id="calificacionoculta3" style="display: none">
                <div class="form-label-group">
                  <input type="number" class="form-control text-uppercase" id="calificacion_materia_3" name="calificacion_materia_3"
                    placeholder="Agregue calificacion" onchange="calificaciones(this)">
                  <label for="calificacion_materia_3">Agregue calificación</label>
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


<script>
  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_portabilidad/estudiantes_de_portabilidad?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      console.log(JSON.parse(xhr.response));

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
        fila += '<td>';
        fila += '<button class="btn btn-warning" type="button" class="btn btn-primary" value="' + valor.no_control + '" onclick="saber_tiempo(this)" >Añadir Materias de adeudo</button>';
        fila += '</td>';
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

  function saber_tiempo(e){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_portabilidad/fecha_valida_agregar_materias?no_control=' + e.value, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      console.log(xhr.response);
      if(xhr.response==="si"){
        $('#modalmaterias').modal('show');

      }else if (xhr.response==="no"){
        document.getElementById('calificacionoculta1').style.display = "";
        document.getElementById('calificacionoculta2').style.display = "";
        document.getElementById('calificacionoculta3').style.display = "";
        $('#modalmaterias').modal('show');

      }else{

      }
    };
    xhr.send(null); 
  }

  function calificaciones(e) {
    var string = e.value.toString();

    for (var i = 0, output = '', validos = "0123456789./"; i < string.length; i++) {
      if (validos.indexOf(string.charAt(i)) != -1)
        output += string.charAt(i)
    }
    console.log(output);
    if (output != "") {

            if (output >= 6 && output <= 10) {
              var valor = parseFloat(output);
              valor = Math.round(valor);
              console.log(valor)
              e.value = valor;
              e.style.color = "black";
            
            } else {
              console.log("valor no valido")
              e.value = "";
            }
  } else {
      e.value = "";
  }
  }

</script>