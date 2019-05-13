<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Crear grupos</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos requeridos para crear un grupo</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="plantel" name="plantel">
                <option value="">Seleccione el plantel donde creará el grupo</option>

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
              <select class="form-control form-control-lg selcolor" onchange="numero_alumnos(this)"
                name="semestre_grupo" id="semestre_grupo">
                <option value="">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              <span>Semestre del grupo a crear</span>
            </label>
          </div>


          <div class="col-md-4" style="display: none" id="grupo_componente_oculto">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="grupo_componente" id="grupo_componente">
                <option value="SI">SI</option>
              </select>
              <span>¿Es de componente?</span>
            </label>
          </div>

          <div class="col-md-4" style="display: none" id="seleccione_componente_oculto">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="seleccione_componente"
                id="seleccione_componente">
                <option value="">Seleccione un componente</option>
              </select>
              <span>Componente</span>
            </label>
          </div>

        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="grupo_ciclo_escolar" name="grupo_ciclo_escolar">
                <?php
                                        foreach ($ciclo_escolar as $ciclo)
                                        {
                                          echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->nombre_ciclo_escolar.'</option>';
                                        }
                                        ?>

              </select>
              <span>Ciclo escolar</span>
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="grupo_nombre" id="grupo_nombre">
                <option value="">Elegir</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
              </select>
              <span>Nombre del grupo</span>
            </label>
          </div>

          <div class="col-md-3">
          </div>

          <div class="col-md-4" style="display: none" id="cantidad_alumnos_oculto">
            <label id="cantidad_alumnos">Cantidad de alumnos:</label>

          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="grupo_periodo" id="grupo_periodo">
                <?php
                                        foreach ($ciclo_escolar as $ciclo)
                                        {
                                          echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->periodo.'</option>';
                                        }
                                        ?>
              </select>
              <span>Periodo del grupo</span>
            </label>
          </div>

          <div class="col-md-4 offset-md-3">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente()"
              style="padding: 1rem" id="crear_grupo">Crear grupo</button>
          </div>
        </div>
      </div>


      <div class="row" id="alumnos_oculto" style="display:none">
        <div class=" col-md-6">
          <div class="card card-body">
            <p class="h5" id="contador_alumnos_restantes">Alumnos restantes: 0</p>
            <table class="table table-hover" id="tabla_completa" style="width: 100%">
              <caption>Lista de todos los alumnos de este semestre sin grupo</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre completo</th>
                  <th scope="col" class="col-md-1">N° control</th>
                  <th scope="col" class="col-md-1">Agregar</th>
                </tr>
              </thead>
              <tbody id="tabla">
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-body">
            <p class="h5" id="contador_alumnos_agregados">Alumnos restantes: 0</p>
            <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%">
              <caption>Lista del Grupo creado</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre completo</th>
                  <th scope="col" class="col-md-1">N° control</th>
                  <th scope="col" class="col-md-1">Eliminar</th>
                </tr>
              </thead>

              <tbody id="tablagrupo">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>
    <br>
    <div class="col-md-12" id="agregar_oculto" style="display: none">
      <button type="button" value="nuevo" onclick="enviar_formulario()" id="boton_agregar"
        class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem"> Guardar Alumnos</button>
    </div>

    <div class="card" style="overflow:scroll; display: none" id="tabla_oculto" >
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de las materias del grupo</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col">Materia</th>
              <th scope="col" >Clave</th>
              <th scope="col" style="width:35%">Nombre de Asesor</th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
      </div>
      <br>
    <div class="form-group" id="boton_oculto_asesor" style="display: none">
      <div class="row">
        <div class="col-md-12">
          <button class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem" onclick="guardar()">Guardar</button>
        </div>
      </div>
    </div>




  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

  function llenar_especialidad() {
    seleccione_componente.innerHTML = "Cargando datos";
    document.getElementById("plantel").setAttribute("onchange", "llenar_especialidad();");
    var xhr = new XMLHttpRequest();
    var plantel = document.getElementById("plantel").value;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_plantel_especialidad_html?plantel=' + plantel, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      console.log(xhr.response);
      seleccione_componente.innerHTML = xhr.responseText;

    };
    xhr.send(null);
  }

  function bloquearcomponente() {
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("grupo_ciclo_escolar").disabled = true;
    document.getElementById("seleccione_componente").disabled = true;
    document.getElementById("grupo_componente").disabled = true;
  }

  function bloquearnormal() {
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("grupo_ciclo_escolar").disabled = true;
  }

  function nobloquear() {
    document.getElementById("grupo_nombre").disabled = false;
    document.getElementById("grupo_periodo").disabled = false;
    document.getElementById("semestre_grupo").disabled = false;
    document.getElementById("plantel").disabled = false;
    document.getElementById("grupo_ciclo_escolar").disabled = false;
    document.getElementById("seleccione_componente").disabled = false;
    document.getElementById("grupo_componente").disabled = false;
  }

  function validarcomponente() {
    if (document.getElementById("semestre_grupo").value === "5" || document.getElementById("semestre_grupo").value === "6") {
      if (document.getElementById("plantel").value != '' && document.getElementById("grupo_periodo").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != "" && document.getElementById("seleccione_componente").value != "" && document.getElementById("grupo_componente").value != "") {
        bloquearcomponente();
        alerta_grupo();

      } else {
        Swal.fire({
          type: 'warning',
          text: 'Agregue los datos faltantes'
        });
      }

    } else {
      if (document.getElementById("plantel").value != '' && document.getElementById("grupo_periodo").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != "") {
        bloquearnormal();
        alerta_grupo();
      } else {
        Swal.fire({
          type: 'warning',
          text: 'Agregue los datos faltantes'
        });
      }
    }
  }

  function buscar() {
    var xhr = new XMLHttpRequest();
    var semestre = document.getElementById("semestre_grupo").value;
    var plantel = document.getElementById("plantel").value;
    var query = 'semestre=' + semestre + '&plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/get_estudiantes_plantel_semestre?' + query, true);
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
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="cambiardetabla(this);">Agregar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tabla").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('agregar_oculto').style.display = "";
    document.getElementById('alumnos_oculto').style.display = "";
    contador_tablas();
    limpiarbusqueda();
    
  }

  function buscar_estudiantes_grupo(idgrupo) {
    document.getElementById("tablagrupo").innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo?id_grupo=' + idgrupo, true);
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
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="' + valor.no_control + '" id="botoncambio" disabled="true">Eliminar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);
    contador_tablas();
  }



  function numero_alumnos(e) {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#semestre_grupo").val('');
    }

    else {
      componente_grupo(e);

      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/numero_estudiantes_semestre_plantel?semestre=' + e.value + '&cct=' + document.getElementById("plantel").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        document.getElementById("cantidad_alumnos_oculto").style.display = "";
        console.log(xhr.response);
        var cAlumnos = JSON.parse(xhr.response)[0].total_estudiante;
        if (cAlumnos <= 35) {
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear 1 grupo";
        } else {
          var cGrupos = parseInt(cAlumnos / 35);
          cGrupos = cGrupos + 1;
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear " + cGrupos + " grupos";

        }
      };

      xhr.send(null);
    }


  }


  function alerta_grupo() {
    if (parseInt(document.getElementById("semestre_grupo").value) < 5) {
      var id_grupo = document.getElementById("plantel").value + document.getElementById("semestre_grupo").value + document.getElementById("grupo_ciclo_escolar").value + document.getElementById("grupo_periodo").value + document.getElementById("grupo_nombre").value.toUpperCase();
    }
    else {
      var valor_componente = document.getElementById("seleccione_componente").value;
      var nombre_corto_componente = valor_componente.split("-")[1];
      var id_grupo = document.getElementById("plantel").value + document.getElementById("semestre_grupo").value + document.getElementById("grupo_ciclo_escolar").value + document.getElementById("grupo_periodo").value + document.getElementById("grupo_nombre").value.toUpperCase() + "-" + nombre_corto_componente;
    }
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_existe_grupo?id_grupo=' + id_grupo, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      if (JSON.parse(xhr.response).length === 0) {
        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Agregue estudiantes al grupo creado',
          confirmButtonText: 'Agregar'
        });
        buscar();
      }
      else if (35 - JSON.parse(xhr.response)[0].total_alumnos > 0) {
        swalWithBootstrapButtons.fire({
          type: 'warning',
          text: 'El grupo ya existe y tiene ' + (35 - JSON.parse(xhr.response)[0].total_alumnos) + " lugares disponibles",
          confirmButtonText: 'Agregar estudiantes al grupo',
          showCancelButton: true,
          cancelButtonText: 'Cerrar'
        }).then(function (result) {
          if (result.value) {
            buscar();
            buscar_estudiantes_grupo(id_grupo);
            document.getElementById("boton_agregar").value = "existente";
          }
        });
      }
      else {
        swalWithBootstrapButtons.fire({
          type: 'warning',
          text: 'El grupo se encuentra lleno',
          confirmButtonText: 'Aceptar'
        });
      }
    };
    xhr.send(null);
    limpiarbusqueda();
  }

  function enviar_formulario() {
    var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for (let i = 0; i < alumnos.length; i++) {
      alumnos_json.push(alumnos[i].children[1].innerText);
    }

    console.log(alumnos_json);
    if (alumnos_json.length === 0) {
      Swal.fire({
        type: 'error',
        text: 'No se pueden guardar grupos vacios'
      });
    }
    else {
      if (document.getElementById("boton_agregar").value === "nuevo") {

        var datos_grupo = {
          plantel: document.getElementById("plantel").value,
          semestre: parseInt(document.getElementById("semestre_grupo").value),
          nombre_grupo: document.getElementById("grupo_nombre").value,
          ciclo_escolar: document.getElementById("grupo_ciclo_escolar").value,
          componente: document.getElementById("seleccione_componente").value,
          periodo: document.getElementById("grupo_periodo").value
        };

        var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
        var alumnos_json = new Array();
        for (let i = 0; i < alumnos.length; i++) {
          alumnos_json.push(alumnos[i].children[1].innerText);
        }

        var datos = {
          grupo: datos_grupo,
          alumnos: alumnos_json
        }
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo', true);
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
            console.log(xhr.response);
            $('#div_carga').hide();
            if (xhr.responseText.trim() === "si") {
              console.log(xhr.response);
              swalWithBootstrapButtons.fire({
                type: 'success',
                text: 'Datos agregados correctamente',
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
                text: 'Datos no agregados'
              });
            }
          }
        }
        xhr.send(JSON.stringify(datos));
      }
      else {
        var tabla = document.getElementById("tabla_completa_grupo");
        var filas = tabla.children[2].children;
        var estudiantes = new Array();

        for (let i = 0; i < filas.length; i++) {
          //console.log(filas[i].children[2].children.botoncambio.disabled);
          if (filas[i].children[2].children.botoncambio.disabled === false) {
            estudiantes.push(filas[i].children[2].children.botoncambio.value);
          }
        }
        var datos = {
          id_grupo: document.getElementById("plantel").value + document.getElementById("semestre_grupo").value + document.getElementById("grupo_ciclo_escolar").value + document.getElementById("grupo_periodo").value + document.getElementById("grupo_nombre").value.toUpperCase(),
          estudiantes: estudiantes,
          semestre: document.getElementById("semestre_grupo").value,
          ciclo_escolar: document.getElementById("grupo_ciclo_escolar").value,
          componente: document.getElementById("seleccione_componente").value.split("-")[1],
          id_componente: document.getElementById("seleccione_componente").value.split("-")[0]
        };
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_estudiantes_grupo', true);
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
            if (xhr.responseText.trim() === "si") {
              console.log(xhr.response);
              swalWithBootstrapButtons.fire({
                type: 'success',
                text: 'Datos agregados correctamente',
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
                text: 'Datos no agregados'
              });
            }
          }
        }
        xhr.send(JSON.stringify(datos));

      }
    }
  }

  function limpiarbusqueda() {
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-info');
    document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
    document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
  }


  function semestres(){
    if(document.getElementById("grupo_periodo").innerText==="AGOSTO-ENERO"){
      document.getElementById("semestre_grupo").innerHTML='<option value="1">1</option>';
      document.getElementById("semestre_grupo").innerHTML+='<option value="3">3</option>';
      document.getElementById("semestre_grupo").innerHTML+='<option value="5">5</option>';
    }
    else{
      document.getElementById("semestre_grupo").innerHTML='<option value="2">2</option>';
      document.getElementById("semestre_grupo").innerHTML+='<option value="4">4</option>';
      document.getElementById("semestre_grupo").innerHTML+='<option value="6">6</option>';
    }
  }

  semestres();
</script>

</html>