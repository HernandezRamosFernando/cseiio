<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Generacion de Matrícula</a>
      </li>
      <li class="breadcrumb-item active">Ingrese el Aspirante que desee:</li>
    </ol>

    <div class="card">
      <div class="card-body">


        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                  id="aspirante_curp_busqueda" placeholder="CURP">
                <label for="aspirante_curp_busqueda">CURP</label>
              </div>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-8">
              <label class="form-group has-float-label">
                <select class="form-control form-control-lg" required="required" id="aspirante_plantel_busqueda"
                  name="aspirante_plantel">
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



    <div class="card" style="overflow:scroll">
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
              <th scope="col" class="col-md-1">Matrícula</th>

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

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" ¿Seguro que deseas salir?</h5> <button class="close"
          type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a>
      </div>
    </div>
  </div>
</div>


<script>




  function formato_tabla() {
    $('#tabla_completa').DataTable({
      //"order": [[ 0, 'desc' ]],
      "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible",
        "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
        "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar específico:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "oAria": {
          "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      }
    });
  }

  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&plantel=' + plantel;
    xhr.open('GET', '/cseiio/index.php/c_estudiante/estudiantes_sin_matricula?' + query, true);

    xhr.onload = function () {
      //console.log(JSON.parse(xhr.response));
      ////console.log(query);


      JSON.parse(xhr.response).forEach(function (valor, indice) {
        var fila = '<tr>';

        fila += '<td>';
        fila += valor.nombre + " " + valor.apellido_paterno + " " + valor.apellido_materno;
        fila += '</td>';

        fila += '<td>';
        fila += valor.curp;
        fila += '</td>';

        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';

        fila += '<td>';
        fila += valor.semestre;
        fila += '</td>';

        fila += '<td>';
        fila += valor.Plantel_cct;
        fila += '</td>';

        fila += '<td>';
        fila += '<button class="btn btn-info" type="button" value="' + valor.no_control + '" onclick="asignar_matricula(this)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Generar Matrícula</button>';
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

  }
  function limpiar() {
    $('#aspirante_curp_busqueda').val('');
    location.reload();

  }


  function asignar_matricula(e) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/cseiio/index.php/c_estudiante/insertar_estudiante?no_control=' + e.value, true);

    xhr.onload = function () {
      console.log(xhr.responseText);

      if (xhr.responseText.trim() !== "no") {
        Swal.fire({
          type: 'success',
          title: 'Matrícula generada correctamente: ' + xhr.responseText
        })
        $(e).parents('tr').detach();
      } else {
        Swal.fire({
          type: 'error',
          title: 'Matrícula no generada',
          confirmButtonText: 'Cerrar'
        })
      }
    };

    xhr.send(null);

  }
</script>