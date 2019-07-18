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
      <div class="card-body">
        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel" name="plantel">

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
                <select class="form-control form-control-lg selcolor" id="grupo_ciclo_escolar"
                  name="grupo_ciclo_escolar">
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
                                          if($ciclo->periodo == "AGOSTO-ENERO"){
                                            echo '<option value="B">'.$ciclo->periodo.'</option>';
                                          }else{
                                            echo '<option value="A">'.$ciclo->periodo.'</option>';
                                          }
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
            <div class="card card-body" style="width: 100%; overflow: scroll">
            <p class="h5" id="">Alumnos registrados en este plantel</p>
              <p class="h5" id="contador_alumnos_restantes">Restantes para agregar: 0</p>
              <table class="table table-hover" id="tabla_completa" style="width: 100%; overflow: scroll">
                <caption>Lista de todos los alumnos de este semestre sin grupo</caption>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="col-md-1">Nombre completo</th>
                    <th scope="col" class="col-md-1">N° control</th>
                    <th scope="col" class="col-md-1">Sexo</th>
                    <th scope="col" class="col-md-1">Agregar</th>
                  </tr>
                </thead>
                <tbody id="tabla">
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-body" style="width: 100%; overflow: scroll">
            <p class="h5" id="">Alumnos en el grupo</p>
              <p class="h5" id="contador_alumnos_agregados">Agregados: 0</p>
              <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%; overflow: scroll">
                <caption>Lista del Grupo creado</caption>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="col-md-1">Nombre completo</th>
                    <th scope="col" class="col-md-1">N° control</th>
                    <th scope="col" class="col-md-1">Sexo</th>
                    <th scope="col" class="col-md-1">Eliminar</th>
                  </tr>
                </thead>

                <tbody id="tablagrupo">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </form>
    <br>


    <div class="card" style=" display: none " id="tabla_oculto_asesor">
      <div class="card card-body" style="width: 100%; overflow: scroll">
        <table class="table table-hover" id="tabla_completa_asesor" style="width: 100%; overflow: scroll">
          <caption>Lista de las materias del grupo</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col">Materia</th>
              <th scope="col">Clave</th>
              <th scope="col">Nombre de Asesor</th>
            </tr>
          </thead>



          <tbody id="tabla_asesor">

          </tbody>
        </table>
      </div>
    </div>
    <br>
    <div class="form-group" id="boton_oculto_asesor" style="display: ">
      <div class="row">
        <div class="col-md-12">
          <div class="col-md-12" id="agregar_oculto" style="display: none">
            <button type="button" onclick="enviar_formulario()" value="nuevo" id="boton_agregar"
              class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem"> Guardar</button>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

var opcionselect=0;
var cantidad_materias=0;

function validarselect(e){
  if(e.value != ""){
    console.log(e.value);
    optionselect = 1;
  }else if(e.value === "" ){
    console.log(e.value);
    optionselect = 0;
  }
}

  function limpiarbusqueda() {
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-info');
    document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
    document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
  }

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

  }

  function validarcomponente() {
    if (document.getElementById("semestre_grupo").value === "5" || document.getElementById("semestre_grupo").value === "6") {
      if (document.getElementById("plantel").value != '' && document.getElementById("grupo_periodo").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != "" && document.getElementById("seleccione_componente").value != "") {
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
        fila += '<td>';
        fila += valor.sexo;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="cambiardetabla(this);">Agregar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tabla").innerHTML += fila;
      });
      //formato_tabla();
      contador_tablas();
    };
    xhr.send(null);
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
    document.getElementById('crear_grupo').disabled = true;
    document.getElementById('agregar_oculto').style.display = "";
    document.getElementById('alumnos_oculto').style.display = "";
    
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
        fila += '<td>';
        fila += valor.sexo;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="' + valor.no_control + '" id="botoncambio" disabled="true">Eliminar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
      });
      //formato_tabla();
      contador_tablas();
    };
    xhr.send(null);
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
    document.getElementById('crear_grupo').disabled = true;
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
        document.getElementById("grupo_nombre").innerHTML = "";
        console.log(xhr.response);
        var cAlumnos = JSON.parse(xhr.response)[0].total_estudiante;
        if (cAlumnos <= 35) {
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear 1 grupo";
          var select = document.getElementById("grupo_nombre");
          var option = document.createElement("option");
          option.text = "A";
          option.value = "A"
          select.add(option);
        } else {
          var cGrupos = parseInt(cAlumnos / 35);
          cGrupos = cGrupos + 1;
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear " + cGrupos + " grupos";
          if (cGrupos = 2) {
            var select = document.getElementById("grupo_nombre");
            var option = document.createElement("option");
            option.text = "Seleccione uno";
            option.value = "";
            select.add(option);
            var option = document.createElement("option");
            option.text = "A";
            option.value = "A";
            select.add(option);
            var option = document.createElement("option");
            option.text = "B";
            option.value = "B";
            select.add(option);
          } else if (cGrupos = 3) {
            var select = document.getElementById("grupo_nombre");
            var option = document.createElement("option");
            option.text = "Seleccione uno";
            option.value = "";
            select.add(option);
            var option = document.createElement("option");
            option.text = "A";
            option.value = "A";
            select.add(option);
            var option = document.createElement("option");
            option.text = "B";
            option.value = "B";
            select.add(option);
            var option = document.createElement("option");
            option.text = "C";
            option.value = "C";
            select.add(option);
          } else if (cGrupos = 4) {
            var select = document.getElementById("grupo_nombre");
            var option = document.createElement("option");
            option.text = "Seleccione uno";
            option.value = "";
            select.add(option);
            var option = document.createElement("option");
            option.text = "A";
            option.value = "A";
            select.add(option);
            var option = document.createElement("option");
            option.text = "B";
            option.value = "B";
            select.add(option);
            var option = document.createElement("option");
            option.text = "C";
            option.value = "C";
            select.add(option);
            var option = document.createElement("option");
            option.text = "D";
            option.value = "D";
            select.add(option);

          } else {
            var select = document.getElementById("grupo_nombre");
            var option = document.createElement("option");
            option.text = "Seleccione uno";
            option.value = "";
            select.add(option);
            var option = document.createElement("option");
            option.text = "A";
            option.value = "A";
            select.add(option);
            var option = document.createElement("option");
            option.text = "B";
            option.value = "B";
            select.add(option);
            var option = document.createElement("option");
            option.text = "C";
            option.value = "C";
            select.add(option);
            var option = document.createElement("option");
            option.text = "D";
            option.value = "D";
            select.add(option);
            var option = document.createElement("option");
            option.text = "E";
            option.value = "E";
            select.add(option);
            var option = document.createElement("option");
            option.text = "F";
            option.value = "F";
            select.add(option);
          }



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
      ///////////////////////////////////////////////////////////////
      console.log(JSON.parse(xhr.response));
      console.log(JSON.parse(xhr.response).length);
      console.log(id_grupo);


      if (JSON.parse(xhr.response).length === 0) {
        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Agregue estudiantes al grupo creado',
          confirmButtonText: 'Agregar'
        });
        buscar();

        ///////////////////////////// cargar asesores

        //cargar select de asesores de ese plantel
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

          //cargar las materias en la tabla-----------------------------------------------
          var semestre = parseInt(document.getElementById("semestre_grupo").value);
          if (semestre < 5) {
            //api que regrese esas materias
            var materias = new XMLHttpRequest();
            materias.open('GET', '<?php echo base_url();?>index.php/c_materias/materias_semestre?semestre=' + semestre, true);
            materias.onloadstart = function () {
      $('#div_carga').show();
    }
    materias.error = function () {
      console.log("error de conexion");
    }

    materias.onload = function () {
      $('#div_carga').hide();
              document.getElementById("tabla_asesor").innerHTML = "";
              var tabla = document.getElementById("tabla_asesor");
              cantidad_materias=JSON.parse(materias.response).length;

              JSON.parse(materias.response).forEach(function (valor, indice) {
                var fila = "<tr>";
                fila += "<td>" + valor.unidad_contenido.toUpperCase() + "</td>";
                fila += "<td>" + valor.clave + "</td>";
                fila += "<td><select class='form-control form-control-lg selcolor' onclick='validarselect(this)'>" + asesores.response + "</select><td>";
                fila += "</tr>";
                tabla.innerHTML += fila;
              });
            };

            materias.send(null);
            document.getElementById("tabla_oculto_asesor").style.display = "";
          }

          else {
            //api que regresa las materias de especialidad
            var materias = new XMLHttpRequest();
            materias.open('GET', '<?php echo base_url();?>index.php/c_materias/get_materias_semestre_componente?semestre=' + semestre + "&componente=" + document.getElementById("seleccione_componente").value.split("-")[0], true);

            materias.onloadstart = function () {
      $('#div_carga').show();
    }
    materias.error = function () {
      console.log("error de conexion");
    }

    materias.onload = function () {
      $('#div_carga').hide();
              document.getElementById("tabla_asesor").innerHTML = "";
              var tabla = document.getElementById("tabla_asesor");
              console.log("materias" + materias.response.length);

              JSON.parse(materias.response).forEach(function (valor, indice) {
                var fila = "<tr>";
                fila += "<td>" + valor.unidad_contenido.toUpperCase() + "</td>";
                fila += "<td>" + valor.clave + "</td>";
                fila += "<td><select class='form-control form-control-lg selcolor' required>" + asesores.response + "</select><td>";
                fila += "</tr>";
                tabla.innerHTML += fila;
              });
            };

            materias.send(null);
            document.getElementById("tabla_oculto_asesor").style.display = "";
          }

          //----------------------------------------------------------------------------------------
        };

        asesores.send(null);

        ///////////////////////////
      }
      else if (35 - JSON.parse(xhr.response)[0].total_alumnos > 0) {
        swalWithBootstrapButtons.fire({
          type: 'warning',
          text: 'El grupo ya existe y tiene ' + (35 - JSON.parse(xhr.response)[0].total_alumnos) + " lugares disponibles",
          confirmButtonText: 'Agregar estudiantes al grupo',
          showCancelButton: true,
          allowOutsideClick: false,
          cancelButtonText: 'Cerrar'
        }).then(function (result) {
          if (result.value) {
            buscar();
            buscar_estudiantes_grupo(id_grupo);
            document.getElementById("boton_agregar").value = "existente";
            //oculta la tabla de asesores porque el grupo ya existe
            document.getElementById("tabla_oculto_asesor").style.display = "none";
          } else {
            document.getElementById('crear_grupo').classList.remove('btn-success');
            document.getElementById('crear_grupo').classList.add('btn-info');
            document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
            document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
          }
        });
      }
      else {
        Swal.fire({
          type: 'warning',
          text: 'El grupo ya existe y se encuentra lleno'
        });
        //oculta la tabla de asesores porque el grupo ya existe
        document.getElementById("tabla_oculto_asesor").style.display = "none";
      }
    };
    xhr.send(null);
  }

  function select_formulario(){
    if(opcionselect === cantidad_materias){
      console.log("igual");

    }
    else{
      console.log("diferente");
    }
  }

  function enviar_formulario() {
    bPreguntar = false;
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
    } else {
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

        //---------------------------sacar los asesores de cada materia
        var tabla_asesores = document.getElementById("tabla_asesor");
        console.log(tabla_asesores);
        var asesores = new Array();
        for (let i = 0; i < tabla_asesores.childNodes.length; i++) {
          var materia_asesor = {
            materia: tabla_asesores.childNodes[i].childNodes[1].innerText,
            asesor: tabla_asesores.childNodes[i].childNodes[2].childNodes[0].value
          };
          asesores.push(materia_asesor);
        }
        //---------------------------
        var datos = {
          grupo: datos_grupo,
          alumnos: alumnos_json,
          asesores_materia: asesores
        };
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr.error = function () {
          console.log("error de conexion");
        }
        xhr.onreadystatechange = function () {
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {//agrego el grupo
            if (xhr.responseText.trim() === "si") {
              var friae = new XMLHttpRequest();
              friae.open("POST", '<?php echo base_url();?>index.php/c_friae/crear_friae', true);
              friae.setRequestHeader("Content-Type", "application/json");
              friae.onloadstart = function () {
                $('#div_carga').show();
              }
              friae.error = function () {
                console.log("error de conexion");
              }
              friae.onreadystatechange = function () { // Call a function when the state changes.
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                  console.log(friae.response);
                  $('#div_carga').hide();
                  if (friae.responseText.trim() === "si") {
                    console.log(friae.response);
                    swalWithBootstrapButtons.fire({
                      type: 'success',
                      text: 'Datos agregados correctamente',
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
                      text: 'Datos no agregados'
                    });
                  }
                }
              }
              friae.send(JSON.stringify(datos));
            }
          }

        }
        xhr.send(JSON.stringify(datos));

      } else {
        var tabla = document.getElementById("tabla_completa_grupo");
        var filas = tabla.children[2].children;
        var estudiantes = new Array();

        for (let i = 0; i < filas.length; i++) {
          //console.log(filas[i].children[2].children.botoncambio.disabled);
          if (filas[i].children[3].children.botoncambio.disabled === false) {
            estudiantes.push(filas[i].children[3].children.botoncambio.value);
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

        console.log(datos);

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
              var friae = new XMLHttpRequest();
              friae.open("POST", '<?php echo base_url();?>index.php/c_friae/agregar_estudiantes_friae', true);

              //Send the proper header information along with the request
              friae.setRequestHeader("Content-Type", "application/json");
              friae.onloadstart = function () {
                $('#div_carga').show();
              }
              friae.error = function () {
                console.log("error de conexion");
              }
              friae.onreadystatechange = function () { // Call a function when the state changes.
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                  console.log(friae.response);
                  $('#div_carga').hide();
                  if (friae.responseText.trim() === "si") {
                    console.log(friae.response);
                    swalWithBootstrapButtons.fire({
                      type: 'success',
                      text: 'Datos agregados correctamente',
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
                      text: 'Datos no agregados'
                    });
                  }
                }
              }
              friae.send(JSON.stringify(datos));
            }
          }
        }
        xhr.send(JSON.stringify(datos));
      }
    }
  }
  function semestres() {
    if (document.getElementById("grupo_periodo").innerText === "AGOSTO-ENERO") {
      document.getElementById("semestre_grupo").innerHTML = '<option value=" ">Seleccione uno</option>';
      document.getElementById("semestre_grupo").innerHTML += '<option value="1">1</option>';
      document.getElementById("semestre_grupo").innerHTML += '<option value="3">3</option>';
      document.getElementById("semestre_grupo").innerHTML += '<option value="5">5</option>';
    }
    else {
      document.getElementById("semestre_grupo").innerHTML = '<option value=" ">Seleccione uno</option>';
      document.getElementById("semestre_grupo").innerHTML += '<option value="2">2</option>';
      document.getElementById("semestre_grupo").innerHTML += '<option value="4">4</option>';
      document.getElementById("semestre_grupo").innerHTML += '<option value="6">6</option>';
    }
  }
  semestres();

  var bPreguntar = true;
  window.onbeforeunload = preguntarAntesDeSalir;
  function preguntarAntesDeSalir() {
    if (bPreguntar)
      return "¿Seguro que quieres salir?";
  }
</script>

</html>