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


</script>