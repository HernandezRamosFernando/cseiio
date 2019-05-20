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
              <select class="form-control form-control-lg selcolor" id="plantel"   name="plantel">
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
              <select class="form-control form-control-lg selcolor"  name="materias" id="materias">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de materias</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="" style="padding: 1rem" id="mostrar_materias">Mostrar Materia</button>
            </div>
          </div>
      </div>


      <div class="row" id="alumnos_oculto" style="display:none">
      <div class=" col-md-6">
        <div class="card card-body" style="width: 100%; overflow: scroll">
          <table class="table table-hover" id="tabla_completa" style="width: 100%; overflow: scroll">
            <caption>Lista de los alumnos que deben regularizar</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
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


    </div>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

</script>
</html>