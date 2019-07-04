<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Repetidores</a>
      </li>
      <li class="breadcrumb-item active">Búsqueda de alumnos que pueden repetir semestre</li>
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
              <th scope="col" class="col-md-1">Contador de Semestre</th>
              <th scope="col" class="col-md-1">Semestre anterior cursado</th>
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
<!-- /.content-wrapper -->



<script>



  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiantes_reprobados?' + query, true);
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
        fila += valor.semestre;
        fila += '</td>';
        fila += '<td>';
        fila += valor.semestre_en_curso;
        fila += '</td>';
        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';
        fila += '<td>';
        fila += '<button class="btn btn-lg btn-block btn-warning" type="button" value="' + valor.no_control + "," + valor.semestre + "," + valor.semestre_en_curso + '" onclick="reinscribir_reprobado(this)" data-toggle="modal" data-target="#">Reinscribir</button>';
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

  function reinscribir_reprobado(e){
    var separar = e.value.split(",")
    var noControl = separar[0];
    var semestre = separar[1];
    var semestre_curso = separar[2];

    var restantes = (6 - semestre_curso) + parseInt(semestre);
    if(restantes <= 12){
      var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_estudiante/reinscribir_reprobado', true);
        xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Estudiante repetidor inscrito correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta

            }
            //aqui va si cancela
          });
          $(e).parents('tr').detach();
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
        }
      }
    }
        xhr.send(JSON.stringify({no_control:noControl})); 
    }else{
      swalWithBootstrapButtons.fire({
            type: 'error',
            text: 'Los semestres restantes del alumno no son suficientes para terminar sus estudios de bachillerato en el tiempo establecido',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta
            }
            //aqui va si cancela
          });
    }



    console.log(restantes);
    console.log(semestre);
    console.log(semestre_curso);
/*
    var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_estudiante/reinscribir_reprobado', true);
        xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () { // Call a function when the state changes.
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Estudiante repetidor inscrito correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta

            }
            //aqui va si cancela
          });
          $(e).parents('tr').detach();
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
        }
      }
    }
        xhr.send(JSON.stringify({no_control:e.value})); */
  }

</script>