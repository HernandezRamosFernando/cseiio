<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Actas de Regularización</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos para buscar una acta</li>
    </ol>


    <form class="card" id="formulario">
      <div class="card-body">
        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="cargarregularizacion()" id="plantel" name="plantel">
                  <option value="">Seleccione el plantel donde buscar el grupo</option>

                  <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
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
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="regularizaciones" onclick="cargar_materias()"
                  id="regularizaciones">
                  <option value="">Seleccione un periodo de regularización</option>

                </select>
                <span>Regularizaciones</span>
              </label>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">

          <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="materias" id="materias">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de materias </span>
              </label>
            </div>

            <div class="col-md-4">
              <button type="button" class="btn btn-primary btn-lg btn-block"
                style="padding: 1rem" id="id_mostrar_acta" onclick="mostrar_acta()">Mostrar Acta</button>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-success btn-lg btn-block"
                style="padding: 1rem" id="id_mostrar_registros" onclick="buscar_registros()">Mostrar Registros</button>
            </div>

          </div>
        </div>


      </div>
    </form>
<!-- inicio tabla-->
<div class="card" style="overflow:scroll; display:none" id="busqueda_oculto">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
          <thead class="thead-light">
            <tr>
            <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">Calificación</th>
              <th scope="col" class="col-md-1">Fecha de evluación</th>
              <th scope="col" class="col-md-1">Hora de evaluación</th>
              
              <th scope="col" class="col-md-1">Fecha de captura</th>
              <th scope="col" class="col-md-1">Asesor</th>
              
              <th scope="col" class="col-md-1"></th>
              
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>


    <!-- Fin tabla-->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- inicio modal-->
<div class="modal fade" id="modificar_regularizacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 50% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar datos de regularización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="modificar_datos_regu">
      <input id="no_control" name="no_control" type="hidden" value="">
      <input id="id_materia" name="id_materia" type="hidden" value="">
      <input id="fecha" name="fecha" type="hidden" value="">
      <input id="cct_plantel" name="cct_plantel" type="hidden" value="">
      <input id="calificacion_inicial" name="calificacion_inicial" type="hidden" value="">
      <div class="modal-body card">
      <div class="form-group form-label-group row">
          <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Nombre completo" readonly>
          <label for="nombre_completo">Nombre completo </label>

          </div>

          <div class="form-group form-label-group row">
          <input type="text" class="form-control" id="calificacion" name="calificacion" placeholder="Calificacion" required>
          <label for="calificacion">Calificación </label>

          </div>
        <div class="form-group form-label-group row">
          <input type="date" class="form-control" id="fecha_calificacion" name="fecha_calificacion" placeholder="Fecha de calificación" min=<?php
                $fecha_actual = date("d-m-Y");
                date("d-m-Y",strtotime($fecha_actual."- 60 days")); 
                ?> required>
          <label for="fecha_calificacion">Fecha de calificación </label>

          </div>

          <div class="form-group form-label-group row">
          <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" placeholder="Hora de aplicación" required>
          <label for="hora_inicio">Hora de aplicación </label>
        </div>

        <div class="form-group row">
        <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="asesor"  name="asesor" required>
              </select>
              <span>Seleccione Asesor</span>
            </label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" value="nuevo" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit"  class="btn btn-success">Modificar</button>
      </div>
      </form>
    </div>
  </div>
</div>



    <!-- Fin modal-->


<script>
var form_modificar = document.getElementById("modificar_datos_regu");
  form_modificar.onsubmit = function(e){
    e.preventDefault();
    var formdata_modificar = new FormData(form_modificar);
    var xhr =  new XMLHttpRequest();
    xhr.open("POST","<?php echo base_url();?>index.php/C_regularizacion/modificar_datos_regularizacion",true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if(xhr.responseText.trim()==="si"){
        Swal.fire({
            type: 'success',
            scrollbarPadding:false,
            title: 'Datos de regularización actualizada',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modificar_regularizacion').modal('toggle');
          
          buscar_registros();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al actualizar los datos de regularización',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
    xhr.send(formdata_modificar);
    
  }


 function borrar_formato_tabla(){
  $("#tabla_completa").dataTable().fnDestroy();
  
}



function buscar_registros() {
  borrar_formato_tabla();
      document.getElementById("plantel").disabled = true;
      document.getElementById("regularizaciones").disabled = true;
      document.getElementById("materias").disabled = true;



      let periodo = document.getElementById("regularizaciones").value;
      let plantel = document.getElementById("plantel").value;
      let materia = document.getElementById("materias").value;
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      /*var curp = document.getElementById("aspirante_curp_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;*/
      var query = 'materia='+materia+'&periodo='+periodo+'&plantel='+plantel;
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/estudiantes_regularizadas_periodo_mostrar?' + query, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          //console.log(valor);

          
          alumno_nombre_completo=valor.primer_apellido_alumno+' '+valor.segundo_apellido_alumno+' '+valor.nombre_alumno;

          fila += valor.fecha;
          parametros_regu = "{'nombre_completo':'"+alumno_nombre_completo+"','calificacion':"+valor.calificacion+",'fecha_calificacion':'"+valor.fecha_calificacion+"','hora':'"+valor.hora+"','fecha':'"+valor.fecha+"','id_asesor':"+valor.id_asesor+",'id_materia':'"+valor.id_materia+"','no_control':'"+valor.no_control+"'}";
          
          var fila = '<tr>';
          fila += '<td>';
          fila += alumno_nombre_completo;
          fila += '</td>';
          fila += '<td>';
          fila += valor.calificacion;
          fila += '</td>';
          fila += '<td>';
          fila += valor.fecha_calificacion;
          fila += '</td>';
          fila += '<td>';
          fila += valor.hora;
          fila += '</td>';
          fila += '<td>';
          fila += valor.fecha;
          fila += '</td>';
          fila += '<td>';
          fila += valor.primer_apellido_asesor+' '+( typeof(valor.segundo_apellido_asesor) == "undefined" ? "" : valor.segundo_apellido_asesor)+' '+valor.nombre_asesor;
          fila += '</td>';

          
          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-danger" type="button" onclick="pasar_no_control('+parametros_regu+')" value="' + valor.id_materia + '" onclick="" data-toggle="modal" data-target="#modificar_regularizacion">Editar</button>';
          fila += '</td>';
          
          fila += '</tr>';
          document.getElementById("tabla").innerHTML += fila;
        });
        formato_tabla();
      };
      xhr.send(null);


      document.getElementById('id_mostrar_registros').setAttribute("onClick", "limpiar();");
      document.getElementById('id_mostrar_registros').innerHTML = 'Limpiar Búsqueda';
      document.getElementById('id_mostrar_registros').classList.remove('btn-success');
      document.getElementById('id_mostrar_registros').classList.add('btn-info');
      document.getElementById('busqueda_oculto').style.display = "";
    }

    function pasar_no_control(valor){
      document.getElementById("modificar_datos_regu").reset();
      document.getElementById("nombre_completo").value=valor.nombre_completo;
      document.getElementById("fecha_calificacion").value=valor.fecha_calificacion;
      document.getElementById("hora_inicio").value=valor.hora;
      document.getElementById("calificacion").value=valor.calificacion;

      document.getElementById("no_control").value=valor.no_control;
      document.getElementById("id_materia").value=document.getElementById("materias").value;
      document.getElementById("fecha").value=valor.fecha;
      document.getElementById("cct_plantel").value=document.getElementById("plantel").value;
      document.getElementById("calificacion_inicial").value=valor.calificacion;


      var asesores = new XMLHttpRequest();
        asesores.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_asesores_plantel?plantel=' + document.getElementById("plantel").value, true);
        asesores.onloadstart = function () {
          $('#div_carga').show();
        }
        asesores.error = function () {
          console.log("error de conexion");
        }

        asesores.onload = function () {
          $('#div_carga').hide();
          document.getElementById("asesor").innerHTML = asesores.response;
          document.getElementById("asesor").value=valor.id_asesor;
            };
            asesores.send(null);
      
    }

  var lista_alumnos = new Array();

  
  function cargarregularizacion() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
    } 
    
    
    else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;

      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/periodos_regularizacion_plantel?plantel=' + plantel, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        if (xhr.response === "") {
          var option = document.createElement("option");
          option.text = "Ninguna regularizacion en este plantel";
          option.value = "";
          document.getElementById("regularizaciones").add(option);
        } 
        else {
          console.log(xhr.response);
          document.getElementById("regularizaciones").innerHTML=xhr.response;
        }
      };
      xhr.send(null);
    }
  }



function cargar_materias(){

  let periodo = document.getElementById("regularizaciones").value;
  let plantel = document.getElementById("plantel").value;

  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_regularizadas_periodo?periodo='+periodo+'&plantel='+plantel, true);

      xhr.onload = function () {
        document.getElementById("materias").innerHTML=xhr.response;
      };

      xhr.send(null);

}


function mostrar_acta(){
  let plantel = document.getElementById("plantel").value;
  let periodo = document.getElementById("regularizaciones").value;
  let materia = document.getElementById("materias").value;

  let mes_letra = periodo.split("-")[0];
  var mes = 0;

  switch(mes_letra){
      case "ENERO":
      mes = 1;
      break;

      case "MAYO":
      mes = 5;
      break;

      case "JULIO":
      mes = 7;
      break;

      case "OCTUBRE":
      mes = 10;
      break;
  }

  let ano = parseInt(periodo.split("-")[1]);

  console.log(plantel,mes,ano,materia);


  location.href = '<?php echo base_url();?>index.php/c_acta_regularizacion/generar_acta?plantel='+plantel+'&mes='+mes+'&ano='+ano+'&materia='+materia;
}

</script>

</html>