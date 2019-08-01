<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Regularización</a>
      </li>
      <li class="breadcrumb-item active">Busque la materia a regularizar</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="plantel" name="plantel" onchange="cargar_semestre()"
                >
                <option value="">Seleccione el plantel donde buscar la materia</option>

                <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
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
                  <select class="form-control form-control-lg selcolor" required="required" id="semestre_reg" onchange="cargarmaterias()"
                    name="semestre_reg" >
                    <option value="">Seleccione un semestre</option>
                    
                  </select>
                  <span>Semestres</span>
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
              <span>Lista de materias</span>
            </label>
          </div>

          <div class="col-md-4 offset-md-3">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente();"
              style="padding: 1rem" id="mostrar_materias">Mostrar Materia</button>
          </div>
        </div>
      </div>


      <div class="row" id="alumnos_oculto" style="display:none">
        <div class=" col-md-12">
          <div class="card card-body" style="width: 100%; overflow: scroll">
            <table class="table table-hover" id="tabla_completa" style="width: 100%; overflow: scroll">
              <caption>Lista de los alumnos que deben regularizar</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre completo</th>
                  <th scope="col" class="col-md-1">N° control</th>
                  <th scope="col" class="col-md-1">Semestre actual</th>
                  <th scope="col" class="col-md-1">Semestre de adeudo</th>
                  <th scope="col" class="col-md-1">Solicitud de regularización</th>
                  <th scope="col" class="col-md-1">Calificacion</th>
                </tr>
              </thead>
              <tbody id="tabla">
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </form>
    <br>
    <div class="col-md-12" id="agregar_oculto" style="display: none">
      <button type="button" data-toggle="modal" data-target="#fechacalificacion" value="nuevo" id="boton_agregar" onclick="cargar_asesor();"
        class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem"> Guardar cambios</button>
    </div>


  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<div class="modal fade" id="fechacalificacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 50% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar fecha de calificación de regularización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body card">
        <div class="form-group form-label-group row">
          <input type="date" class="form-control" id="fecha_inicio" placeholder="Fecha de calificación" min=<?php
                $fecha_actual = date("d-m-Y");
                date("d-m-Y",strtotime($fecha_actual."- 60 days")); 
                ?>>
          <label for="fecha_inicio">Fecha de calificación </label>

          </div>

          <div class="form-group form-label-group row">
          <input type="time" class="form-control" id="hora_inicio" placeholder="Hora de aplicación" >
          <label for="hora_inicio">Hora de aplicación </label>
        </div>

        <div class="form-group row">
        <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="asesor"  name="asesor">
              </select>
              <span>Seleccione Asesor</span>
            </label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" value="nuevo" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="validarcomponentefecha()" class="btn btn-success">Guardar fecha</button>
      </div>
    </div>
  </div>
</div>

<script>
  function validarcomponentefecha() {

    if (document.getElementById("fecha_inicio").value != '') {
      enviar_formulario();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
    }
  }

  function validarcomponente() {

    if (document.getElementById("plantel").value != '' && document.getElementById("materias").value != '') {
      buscar();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
    }
  }


  function cargarmaterias() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#materias").val('');
    } else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      var semestre = document.getElementById("semestre_reg").value;
      console.log(plantel);

      materias.innerHTML = "";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_con_reprobados_html?plantel=' + plantel+'&semestre='+semestre, true);
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
          option.text = "Ningun alumno con adeudo en este plantel";
          option.value = "";
          materias.add(option);
        } else {
          console.log(xhr.response);
          materias.innerHTML = xhr.responseText;
        }
      };
      xhr.send(null);
    }
  }


  function cargar_semestre(){
    var plantel = document.getElementById("plantel").value;
    var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/semetres_con_reprobados_html?plantel=' + plantel, true);

        xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
          if(xhr.response.trim() != ""){
            document.getElementById("semestre_reg").innerHTML=xhr.response;
          }
          else{
            console.log("no hay regularizaciones");
          }
        };

        xhr.send(null);
  }

  function buscar() {
    var permiso = new XMLHttpRequest();
    var plantel = document.getElementById("plantel").value;
    var materia = document.getElementById("materias").value;
    permiso.open('GET', '<?php echo base_url();?>index.php/c_permiso_regularizacion/obtener_permiso_plantel_materia?plantel=' + plantel + '&materia=' + materia, true);
    permiso.onloadstart = function () {
      $('#div_carga').show();
    }
    permiso.error = function () {
      console.log("error de conexion");
    }
    permiso.onload = function () {
      $('#div_carga').hide();
      var permiso_regularizacion = JSON.parse(permiso.response);
      if (permiso_regularizacion.length > 0 && permiso_regularizacion[0].estatus === "1") {
        console.log(permiso_regularizacion);
        document.getElementById("boton_agregar").style.display = "";

        //rellena la tabla con los estudiantes que deben esa materia de ese plantel
        var xhr = new XMLHttpRequest();
        var plantel = document.getElementById("plantel").value;
        var materia = document.getElementById("materias").value;
        document.getElementById("tabla").innerHTML = "";
        xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/estudiantes_materia?plantel=' + plantel + '&materia=' + materia, true);
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
            var fila = '<tr>';
            fila += '<td>';
            fila += valor.nombre + ' ' + valor.primer_apellido + ' ' + valor.segundo_apellido;
            fila += '</td>';
            fila += '<td>';
            fila += valor.no_control;
            fila += '</td>';
            fila += '<td>';
            fila += valor.semestre_en_curso;
            fila += '</td>';
            fila += '<td>';
            fila += valor.semestre_materia;
            fila += '</td>';
            fila += '<td>';
            fila += "<input type='checkbox' class='form-check-input' id='solicitud' name='solicitud' onclick='checkregularizacion(this)'>"
            fila += '</td>';
            fila += '<td class="">';
            fila += '<input type="text" class="form-control" id="calificacion" onchange="calificaciones(this);" disabled ></input>';
            fila += '</td>';
            fila += '</tr>';
            document.getElementById("tabla").innerHTML += fila;
          });
          console.log(JSON.parse(xhr.response));
        };
        xhr.send(null);
        document.getElementById('agregar_oculto').style.display = "";
        document.getElementById('alumnos_oculto').style.display = "";
        //limpiarbusqueda();
      }//fin if si hay permiso


      else if (permiso_regularizacion.length > 0 && permiso_regularizacion[0].estatus === "0") {
        console.log(permiso_regularizacion);
        document.getElementById("boton_agregar").style.display = "none";
        //rellena la tabla con los estudiantes que deben esa materia de ese plantel
        var xhr = new XMLHttpRequest();
        var plantel = document.getElementById("plantel").value;
        var materia = document.getElementById("materias").value;
        document.getElementById("tabla").innerHTML = "";
        xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/estudiantes_materia_registrada_activa?plantel=' + plantel + '&materia=' + materia, true);
        xhr.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr.error = function () {
          console.log("error de conexion");
        }
        xhr.onload = function () {
          $('#div_carga').hide();
          JSON.parse(xhr.response).forEach(function (valor, indice) {




            var fila = '<tr>';
            fila += '<td>';
            fila += valor.nombre + ' ' + valor.primer_apellido + ' ' + valor.segundo_apellido;
            fila += '</td>';
            fila += '<td>';
            fila += valor.Estudiante_no_control;
            fila += '</td>';
            fila += '<td>';
            fila += valor.semestre_en_curso;
            fila += '</td>';
            fila += '<td>';
            fila += valor.semestre_materia;
            fila += '</td>';
            fila += '<td>';
            fila += "<input type='checkbox' class='form-check-input' id='solicitud' name='solicitud' disabled>"
            fila += '</td>';
            fila += '<td class="">';
            fila += '<input type="text" class="form-control" id="calificacion" onchange="calificaciones(this);" value="' + valor.calificacion + '" disabled></input>';
            fila += '</td>';
            fila += '</tr>';
            document.getElementById("tabla").innerHTML += fila;



            ///qui termina un estudiante
          });
          console.log(JSON.parse(xhr.response));
        };
        xhr.send(null);
        document.getElementById('agregar_oculto').style.display = "";
        document.getElementById('alumnos_oculto').style.display = "";

      }

      else {
        ///alerta de que no hay permiso

        Swal.fire({
          type: 'error',
          html: '<p>No tiene permisos para calificar regularizacion.</p> <p>Contacte al jefe de Control Escolar</p>'
        });
        /////////////////////////////////
      }
    };//fin peticion permiso
    permiso.send(null);
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
      } else if (output === "/") {
        e.style.color = "black";
      } else if (output >= 0 && output < 6) {
        e.value = 5;
        e.style.color = "red";
      } else {
        console.log("valor no valido")
        e.value = "";
      }
    } else {
      e.value = "";
    }
    //e.value=output;
  }
  function enviar_formulario() {
    var tabla = document.getElementById("tabla");
    var datos = new Array();
    for (let i = 0; i < tabla.childNodes.length; i++) {
      //console.log(tabla.childNodes[i].childNodes[1].innerText);
      var calificacion = tabla.childNodes[i].childNodes[5].childNodes[0].value;
      if(calificacion !== ""){
        
      if (calificaciones === "/") {
        calificacion = "0";
      }

      var dato = {
        no_control: tabla.childNodes[i].childNodes[1].innerText,
        id_materia: document.getElementById("materias").value,
        calificacion: calificacion,
        fecha_calificacion: document.getElementById("fecha_inicio").value,
        cct_plantel: document.getElementById("plantel").value,
        hora:document.getElementById("hora_inicio").value.trim(),
        asesor:document.getElementById("asesor").value
      };
      datos.push(dato);
      }
      
    }

    console.log(datos);

    var xhr = new XMLHttpRequest();
    $('#fechacalificacion').modal().hide();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_regularizacion/agregar_regularizacion', true);

    swalWithBootstrapButtons.fire({
      type: 'info',
      text: 'Al aceptar no podrá realizar cambio alguno ¿Esta seguro?',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false,
      showCancelButton: 'true',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {

        var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_regularizacion/agregar_regularizacion', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr.error = function () {
          console.log("error de conexion");
        }
        xhr.onreadystatechange = function () { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            $('#div_carga').hide();
            console.log(xhr.response);
            if (xhr.responseText.trim() === "si") {
              console.log(xhr.response);
              swalWithBootstrapButtons.fire({
                type: 'success',
                text: 'Datos guardados correctamente',
                allowOutsideClick: false,
                confirmButtonText: 'Aceptar'
              }).then((result) => {
                if (result.value) {
                  //aqui va el aceptar
                  $(document).scrollTop(0);
                  location.reload();
                }
                //aqui va si cancela
              });
            } else {
              Swal.fire({
                type: 'error',
                text: 'Datos no guardados'
              });
              $('#fechacalificacion').modal().show();
            }
          }
        }
        xhr.send(JSON.stringify(datos));
      }
      //aqui va si cancela
    });
  }

  function checkregularizacion(e) {
    //$(e).parent().next().children().prop( "disabled", true );
    //console.log($(e).parent().next().children());
    
  if (e.checked) {
    $(e).parent().next().children().prop( "disabled", false );
  } else {
    $(e).parent().next().children().prop( "disabled", true );
    $(e).parent().next().children().val("")
  }
}

function cargar_asesor(){
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
            };
            asesores.send(null);
}


</script>

</html>