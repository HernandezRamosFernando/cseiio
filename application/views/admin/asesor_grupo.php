<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Asignar Asesor a Grupos</a>
      </li>
      <li class="breadcrumb-item active">Seleccione e ingrese los datos solicitados</li>
    </ol>

    <div class="form-group">

      <div class="row">
        <div class="col-md-8">
          <label class="form-group has-float-label">
            <select class="form-control form-control-lg" required="required" id="aspirante_plantel"
              name="aspirante_plantel">
              <option value="">Seleccione el plantel donde esta el grupo</option>

              <?php
                                  foreach ($planteles as $plantel)
                                  {
                                    echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct.'</option>';
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
            </select>
            <span>Seleccione el grupo</span>
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

      </div>
    </div>


    <div class="card" style="overflow:scroll">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de las materias del grupo</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Materia</th>
              <th scope="col" class="col-md-1">Clave</th>
              <th scope="col" class="col-md-1">Nombre de Asesor</th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-4 offset-md-3">
          <button class="btn btn-success btn-lg btn-block" style="padding: 1rem">Guardar</button>
        </div>
      </div>
    </div>





  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>
  function formato_tabla() {
    $('#tabla_completa').DataTable({
      //"order": [[ 0, 'desc' ]],
      "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
        "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
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
</script>

</html>