<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de alumnos</a>
      </li>
      <li class="breadcrumb-item active">Ingrese la búsqueda que desea realizar</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
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
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Matrícula</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Fecha Ingreso</th>
              <th scope="col" class="col-md-1">Imprimir</th>
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

<script>
  cargar_anio();

  function cargar_datos_aspirante(e) {
    document.getElementById("selector_municipio_aspirante").innerHTML = "";
    document.getElementById("selector_localidad_aspirante").innerHTML = "";
    document.getElementById("aspirante_no_control").value = e.value;
    document.getElementById("aspirante_alergia").value = "";
    document.getElementById("aspirante_discapacidad").value = "";
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiante?no_control=' + e.value, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      $('#modalaspirante').modal().show();
      let datos = JSON.parse(xhr.response);
      console.log(datos);
      document.getElementById("aspirante_no_control").value = datos.estudiante[0].no_control;
      document.getElementById("id_tutor").value = datos.tutor[0].id_tutor;
      //datos personales
      document.getElementById("aspirante_nombre").value = datos.estudiante[0].nombre;
      document.getElementById("aspirante_apellido_paterno").value = datos.estudiante[0].primer_apellido;
      document.getElementById("aspirante_apellido_materno").value = datos.estudiante[0].segundo_apellido;
      document.getElementById("aspirante_curp").value = datos.estudiante[0].curp;

      var anio = datos.estudiante[0].fecha_nacimiento.split("-")[0];
      var mes = datos.estudiante[0].fecha_nacimiento.split("-")[1];
      var dia = parseInt(datos.estudiante[0].fecha_nacimiento.split("-")[2]);
      dia = dia.toString();
      //console.log(anio,mes,dia.toString());
      //$('#aspirante_anio_nacimiento option[value="'+anio+'"]')
      document.getElementById("aspirante_anio_nacimiento").value = anio;
      document.getElementById("aspirante_mes_nacimiento").value = mes;
      document.getElementById("aspirante_dia_nacimiento").value = dia;
      //document.getElementById("aspirante_fecha_nacimiento").value = datos.estudiante[0].fecha_nacimiento;
      //-----------------------------------------
      document.getElementById("aspirante_telefono").value = datos.estudiante[0].telefono;
      document.getElementById("aspirante_correo").value = datos.estudiante[0].correo;
      document.getElementById("aspirante_sexo").value = datos.estudiante[0].sexo;
      document.getElementById("aspirante_lugar_nacimiento").value = datos.estudiante[0].lugar_nacimiento;
      document.getElementById("aspirante_nacionalidad").value = datos.estudiante[0].nacionalidad;
      //console.log(datos.expediente_medico);
      document.getElementById("tipo_sangre").value = datos.expediente_medico[2].valor;
      if (datos.expediente_medico[0].valor === "") {
        document.getElementById("aspirante_alergia_combo").value = "2";
        document.getElementById("a").style.display = "none";
      }
      //datos.datos_medicos_aspirante[0].alergia_medicamento === null
      else {
        document.getElementById("aspirante_alergia_combo").value = "1";
        document.getElementById("aspirante_alergia").value = datos.expediente_medico[0].valor;
        document.getElementById("a").style.display = "";
      }
      if (datos.expediente_medico[1].valor === "") {
        document.getElementById("aspirante_discapacidad_combo").value = "2";
        document.getElementById("b").style.display = "none";
      }
      else {
        document.getElementById("aspirante_discapacidad_combo").value = "1";
        document.getElementById("aspirante_discapacidad").value = datos.expediente_medico[1].valor;
        document.getElementById("b").style.display = "";
      }
      document.getElementById("aspirante_plantel").value = datos.estudiante[0].Plantel_cct_plantel;
      document.getElementById("aspirante_semestre").value = datos.estudiante[0].semestre_en_curso;
      //fin datos personales
      //direccion aspirante
      //llamada al api que regresa los ids de la direccion del estudiante
      var respuesta;
      let direccion = new XMLHttpRequest();
      direccion.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_estado_municipio_localidad_id_localidad?id_localidad=' + datos.estudiante[0].id_localidad, true);

      direccion.onloadstart = function () {
        $('#div_carga').show();
      }
      direccion.error = function () {
        console.log("error de conexion");
      }
      direccion.onload = function () {
        $('#div_carga').hide();
        var respuesta = JSON.parse(direccion.response);
        //cargar municipios
        let municipios = new XMLHttpRequest();
        municipios.open('GET', '<?php echo base_url();?>index.php/c_municipio/get_municipios_estado_html?id_estado=' + respuesta[0].id_estado, true);
        municipios.onload = function () {
          document.getElementById("selector_municipio_aspirante").innerHTML = municipios.responseText;
        };
        municipios.send(null);
        //fin cargar municipios
        //cargar localidades

        let localidades = new XMLHttpRequest();
        localidades.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_localidades_municipio_html?id_municipio=' + respuesta[0].id_municipio, true);
        localidades.onload = function () {
          document.getElementById("selector_localidad_aspirante").innerHTML = localidades.responseText;
          //seleccionar las opciones de la direccion del estudiante que habia registrado
          document.getElementById("selector_estado_aspirante").value = respuesta[0].id_estado;
          document.getElementById("selector_municipio_aspirante").value = respuesta[0].id_municipio;
          document.getElementById("selector_localidad_aspirante").value = respuesta[0].id_localidad;
        };
        localidades.send(null);

        //fin cargar localidades
      };
      direccion.send(null);

      document.getElementById("aspirante_direccion_calle").value = datos.estudiante[0].calle;
      document.getElementById("aspirante_direccion_colonia").value = datos.estudiante[0].colonia;
      document.getElementById("aspirante_direccion_cp").value = datos.estudiante[0].cp;
      //fin direccion aspirante
      //datos tutor
      document.getElementById("aspirante_tutor_nombre").value = datos.tutor[0].nombre_tutor;
      document.getElementById("aspirante_tutor_apellido").value = datos.tutor[0].primer_apellido_tutor;
      document.getElementById("aspirante_tutor_apellidodos").value = datos.tutor[0].segundo_apellido_tutor;
      document.getElementById("aspirante_tutor_ocupacion").value = datos.tutor[0].ocupacion;
      //document.getElementById("aspirante_tutor_telefono").value = datos.tutor[0].telefono_tutor;
      document.getElementById("aspirante_tutor_telefono_comunidad").value = datos.tutor[0].telefono_comunidad;
      document.getElementById("aspirante_tutor_prospera").value = datos.tutor[0].folio_programa_social_tutor;
      $parentesco = datos.tutor[0].parentesco;
      if ($parentesco !== "PADRE" && $parentesco !== "MADRE" && $parentesco !== "HERMANO/A" && $parentesco !== "TIO" && $parentesco !== "TIA" && $parentesco !== "ABUELO" && $parentesco !== "ABUELA") {
        document.getElementById("aspirante_tutor_parentesco").value = "otro";
        document.getElementById("aspirante_tutor_otro").value = $parentesco;
        document.getElementById("parentescootro").style.display = "";
      }
      else {
        document.getElementById("aspirante_tutor_parentesco").value = $parentesco;
        document.getElementById("aspirante_tutor_otro").value = "";
        document.getElementById("parentescootro").style.display = "none";
      }
      //fin datos tutor
      //datos lengua materna
      if (datos.lengua_materna[0].id_lengua === "0") {
        document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna[0].id_lengua;
        document.getElementById("aspirante_lengua_lee").value = 0;
        document.getElementById("aspirante_lengua_habla").value = 0;
        document.getElementById("aspirante_lengua_escribe").value = 0;
        document.getElementById("aspirante_lengua_entiende").value = 0;
        document.getElementById("aspirante_lengua_traduce").value = 0;
      }
      else {
        document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna[0].id_lengua;
        document.getElementById("aspirante_lengua_lee").disabled = false;
        document.getElementById("aspirante_lengua_lee").value = datos.lengua_materna[0].porcentaje;
        document.getElementById("aspirante_lengua_habla").disabled = false;
        document.getElementById("aspirante_lengua_habla").value = datos.lengua_materna[1].porcentaje;
        document.getElementById("aspirante_lengua_escribe").disabled = false;
        document.getElementById("aspirante_lengua_escribe").value = datos.lengua_materna[2].porcentaje;
        document.getElementById("aspirante_lengua_entiende").disabled = false;
        document.getElementById("aspirante_lengua_entiende").value = datos.lengua_materna[3].porcentaje;
        document.getElementById("aspirante_lengua_traduce").disabled = false;
        document.getElementById("aspirante_lengua_traduce").value = datos.lengua_materna[4].porcentaje;
      }
      //fin datos lengua materna
      //secundaria
      if (datos.estudiante[0].tipo_ingreso === "PORTABILIDAD") {
        document.getElementById("aspirante_secundaria_cct").value = datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;
        document.getElementById("bachillerato_oculto").style.display = "";
        document.getElementById("aspirante_bachillerato_cct").value = datos.escuela_procedencia[1].Escuela_procedencia_cct_escuela_procedencia;

      } else {
        document.getElementById("aspirante_secundaria_cct").value = datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;
        document.getElementById("bachillerato_oculto").style.display = "none";
      }

      /*
      document.getElementById("aspirante_secundaria_nombre").value = datos.secundaria_aspirante[0].nombre_secundaria;
      document.getElementById("aspirante_secundaria_nombre").disabled = true;
      document.getElementById("nombre_secundaria_oculto").style.display = "";
 
      document.getElementById("aspirante_secundaria_tipo_subsistema").value = datos.secundaria_aspirante[0].tipo_subsistema;
      document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
      document.getElementById("tipo_subsistema_oculto").style.display = "";
      */
    }
    xhr.send(null);
  }

  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiantes_curp_plantel?' + query, true);
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
        fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += '</td>';
        fila += '<td>';
        fila += valor.curp;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.matricula === null ? "" : valor.matricula;
        fila += '</td>';
        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';
        fila += '<td>';
        fila += valor.fecha_registro;
        fila += '</td>';
        fila += '<td>';
        fila += '<a href="<?php echo base_url();?>index.php/C_estudiante/generar_formato_inscripcion?no_control=' + valor.no_control + '" class="btn btn-lg btn-block btn-info btn btn-primary" target="_blank">Imprimir</a>';
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
    document.getElementById('btn_buscar').classList.add('btn-info');
    document.getElementById('busqueda_oculto').style.display = "";
  }

  function obtener_secundaria(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);
      if (secundaria.length == 1) {
        document.getElementById("nombre_secundaria_oculto").style.display = "";
        document.getElementById("aspirante_secundaria_nombre").value = secundaria[0].nombre_escuela_procedencia;
        document.getElementById("aspirante_secundaria_nombre").disabled = true;
        //tipo_subsistema_oculto
        document.getElementById("tipo_subsistema_oculto").style.display = "";
        //aspirante_secundaria_tipo_subsistema
        document.getElementById("aspirante_secundaria_tipo_subsistema").value = secundaria[0].tipo_subsistema;
        document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
      }
      else {
        document.getElementById("nombre_secundaria_oculto").style.display = "none";
        document.getElementById("tipo_subsistema_oculto").style.display = "none";

        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Esta secundaria no existe',
          showCancelButton: true,
          showConfirmButton: false,
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {
            $('#nuevasecundaria').modal().show();
            cct();

          }
        })
      }
    };

    xhr.send(null);
  }

  function obtener_bachillerato(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);
      if (secundaria.length == 1) {
        document.getElementById("nombre_bachillerato_oculto").style.display = "";
        document.getElementById("aspirante_bachillerato_nombre").value = secundaria[0].nombre_escuela_procedencia;
        document.getElementById("aspirante_bachillerato_nombre").disabled = true;
        //tipo_subsistema_oculto
        document.getElementById("tipo_subsistema_bachillerato_oculto").style.display = "";
        //aspirante_secundaria_tipo_subsistema
        document.getElementById("aspirante_bachillerato_tipo_subsistema").value = secundaria[0].tipo_subsistema;
        document.getElementById("aspirante_bachillerato_tipo_subsistema").disabled = true;
      }
      else {
        document.getElementById("nombre_bachillerato_oculto").style.display = "none";
        document.getElementById("tipo_subsistema_bachillerato_oculto").style.display = "none";

        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Esta secundaria no existe',
          showCancelButton: true,
          showConfirmButton: false,
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {
            $('#nuevasecundaria').modal().show();
            cct();

          }
        })
      }
    };

    xhr.send(null);
  }
  function insertar_secundaria() {
    let secundaria = "";
    secundaria = {
      "cct_secundaria": document.getElementById("aspirante_nuevasecundaria_cct").value,
      "nombre_secundaria": document.getElementById("aspirante_nuevasecundaria_nombre").value,
      "subsistema": document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value,
      "localidad": parseInt(document.getElementById("selector_localidad_secundaria").value)
    };
    document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevasecundaria_cct").value + '">'
    console.log(secundaria);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_secundaria/insert_secundaria', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText === "si") {
          Swal.fire({
            type: 'success',
            title: 'Secundaria agregada correctamente',
            showConfirmButton: false,
            timer: 2500
          })
        } else {
          Swal.fire({
            type: 'error',
            title: 'Secundaria no agregada',
            confirmButtonText: 'Cerrar'

          })//alert(xhr.responseText);
        }
      }
      xhr.send(JSON.stringify(secundaria));
    }
  }

  var form = document.getElementById("formulario");
  form.onsubmit = function (e) {
    if (document.getElementById("aspirante_secundaria_cct").value === '') {
      console.log("vacio");
      swalWithBootstrapButtons.fire({
        type: 'warning',
        text: 'Esta tratando de actualizar un alumno sin Secundaria',
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.value) {
          console.log("Entro a if")
          e.preventDefault();
          envioform(form);

        }
      })
      return false;
    } else {
      e.preventDefault();
      envioform(form);
    }


  }



  function envioform(form) {
    $('#modalaspirante').modal('toggle');
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_estudiante/update_estudiante", true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText === "si") {
          Swal.fire({
            type: 'success',
            title: 'Actualizacion exitosa'
          });

        }
        else {
          Swal.fire({
            type: 'error',
            text: 'Ocurrio un error al actualizar los datos'
          });
          $('#modalaspirante').modal().show();
        }
      }
    }
    xhr.send(formdata);

  }
</script>