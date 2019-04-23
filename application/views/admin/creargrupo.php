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
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"="" id="plantel" name="plantel">
                <option value="">Seleccione el plantel donde creara el grupo</option>

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
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" onchange="numero_alumnos(this)" name="semestre_grupo"
                id="semestre_grupo">
                <option value="0">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              <span>Seleccione el semestre del grupo a crear</span>
            </label>
          </div>


          <div class="col-md-4" style="display: none" id="grupo_especialidad_oculto">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" name="grupo_especialidad" id="grupo_especialidad">
                <option value="SI">SI</option>
              </select>
              <span>¿Es de especialidad?</span>
            </label>
          </div>

          <div class="col-md-4" style="display: none" id="seleccione_especialidad_oculto">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" name="seleccione_especialidad" id="seleccione_especialidad">
                <option value="">Seleccione una especialidad</option>
              </select>
              <span>Especialidad</span>
            </label>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-4">
          <label class="form-group has-float-label">
            <select class="form-control form-control-lg"="" id="grupo_ciclo_escolar" name="grupo_ciclo_escolar">
              <option>Seleccione el ciclo del grupo </option>

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

      <div class="form-group">
        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">
              <input type="text" required="required" pattern="[A-Za-z]+[ ]*[A-Za-z ]*" title="Introduzca solo letras"
                class="form-control text-uppercase" id="grupo_nombre" onchange="valida(this);" name="grupo_nombre"
                placeholder="Nombre de grupo">
              <label for="grupo_nombre">Ingrese el nombre del grupo</label>
            </div>
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
            <div class="form-label-group">
              <input type="text"="" pattern="[A-Za-z]+[-]*[A-Za-z ]*" title="Introduzca solo letras"
                class="form-control text-uppercase" id="grupo_periodo" name="grupo_periodo"
                placeholder="Periodo del grupo(s)">
              <label for="grupo_periodo">Perido del grupo</label>
            </div>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="alerta_grupo()" style="padding: 1rem" id="crear_grupo">Crear
                grupo</button>
            </div>
          </div>
        </div>
      </div>


    


    <input type="text" style="display:none" id="id_grupo">
    <a name="" id="" class="btn btn-primary" onclick="buscar();" role="button">Cargar datos</a>


    <div class="row">
      <div class=" col-md-6">
        <div class="card card-body">
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
      </form>
    </div>
    <br>
    <button type="button" onclick="enviar_formulario()" class="btn btn-primary btn-lg btn-block"> Guardar Alumnos</button>
                                      </div>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>

  function cambiardetabla(e) {
    var tr = $(e).parents("tr").appendTo("#tabla_completa_grupo tbody");
    e.className = "";
    e.className = "btn btn-lg btn-block btn-danger";
    e.innerText = "";
    e.innerText = "Eliminar";
    e.setAttribute("onClick", "regresartabla(this);");
  }

  function regresartabla(e) {
    var tr = $(e).parents("tr").appendTo("#tabla_completa tbody");
    e.className = "";
    e.className = "btn btn-lg btn-block btn-success";
    e.innerText = "";
    e.innerText = "Agregar";
    e.setAttribute("onClick", "cambiardetabla(this);");
  }



  function buscar() {
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("grupo_ciclo_escolar").disabled = true;
    
    var xhr = new XMLHttpRequest();
    var semestre = document.getElementById("semestre_grupo").value;
    var plantel = document.getElementById("plantel").value;
    var query = 'semestre=' + semestre + '&plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/get_estudiantes_plantel_semestre?' + query, true);
    xhr.onload = function () {
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
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
    document.getElementById('crear_grupo').disabled = true;
  }

  function especialidad(e) {
    if (document.getElementById("semestre_grupo").value === "5" || document.getElementById("semestre_grupo").value === "6") {
      document.getElementById("grupo_especialidad_oculto").style.display = "";
      document.getElementById("seleccione_especialidad_oculto").style.display = "";

    } else {
      document.getElementById("grupo_especialidad_oculto").style.display = "none";
      document.getElementById("seleccione_especialidad_oculto").style.display = "none";
    }
  }

  function numero_alumnos(e) {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        title: 'Debe seleccionar un plantel',
        showConfirmButton: false,
        timer: 2500
      });
    }

    else {
      especialidad(e);
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/numero_estudiantes_semestre_plantel?semestre=' + e.value + '&cct=' + document.getElementById("plantel").value, true);

      xhr.onload = function () {
        document.getElementById("cantidad_alumnos_oculto").style.display = "";
        console.log(xhr.response);
        var cAlumnos = JSON.parse(xhr.response)[0].total_estudiante;
        if (cAlumnos <= 35) {
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear 1 grupo";
        } else {
          var cGrupos = parseInt(cAlumnos / 35);
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear " + cGrupos + " grupos";
          console.log(cGrupos);

        }
      };

      xhr.send(null);
    }


  }


  function alerta_grupo(){
    Swal.fire({
            type: 'info',
            title: 'Agregue estudiantes al grupo creado'
          });

          buscar();

  }

  function enviar_formulario(){
    var datos_grupo = {
      plantel:document.getElementById("plantel").value,
      semestre:parseInt(document.getElementById("semestre_grupo").value),
      nombre_grupo:document.getElementById("grupo_nombre").value,
      ciclo_escolar:document.getElementById("grupo_ciclo_escolar").value
    };

    var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for(let i=0;i<alumnos.length;i++){
      alumnos_json.push(alumnos[i].children[1].innerText);
    }

    var datos = {
      grupo:datos_grupo,
      alumnos:alumnos_json
    }

    //console.log(datos);



    var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {

            //aqui esta la respuesta de crear el grupo
              console.log(xhr.response);
          }
      }
      xhr.send(JSON.stringify(datos));



  }
/*
  var form = document.getElementById("formulario");
  form.onsubmit = function (e) {
    e.preventDefault();
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo", true);
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        console.log(xhr.responseText);
        if (xhr.responseText.trim() !== "no") {
          Swal.fire({
            type: 'success',
            title: 'Grupo creado Exitosamente',
            showConfirmButton: false,
            timer: 2500
          });

          //document.getElementById("formulario").reset();

          document.getElementById("grupo_nombre").disabled = true;
          document.getElementById("grupo_periodo").disabled = true;
          document.getElementById("semestre_grupo").disabled = true;
          document.getElementById("plantel").disabled = true;
          document.getElementById("grupo_ciclo_escolar").disabled = true;
          document.getElementById("id_grupo").value = xhr.responseText;
        }

        else {
          Swal.fire({
            type: 'error',
            title: 'No se puede crear el grupo',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }

    }
    xhr.send(formdata);


		
	}
*/
</script>






</html>