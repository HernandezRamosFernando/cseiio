<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Buscar FRIAE</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos para buscar un FRIAE</li>
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
                <select class="form-control form-control-lg selcolor" onchange="mostrar_grupos()" name="ciclo_escolar"
                  id="ciclo_escolar">
                  <option value="">Seleccione un ciclo escolar</option>

                  <?php
                                        foreach ($ciclo_escolar as $ciclo)
                                        {
                                          echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->nombre_ciclo_escolar.' --: '.$ciclo->periodo.'</option>';
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
                <select class="form-control form-control-lg selcolor" name="grupos" id="grupos">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de grupos</span>
              </label>
            </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="imprimir_friae()"
                style="padding: 1rem" id="crear_grupo">Mostrar FRIAE</button>
            </div>
          </div>
        </div>

      </div>
                                      </form>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>


function mostrar_grupos(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_grupos_ciclo_escolar_plantel_friae?plantel='+document.getElementById("plantel").value+'&ciclo='+document.getElementById("ciclo_escolar").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        console.log(xhr.response);
        document.getElementById("grupos").innerHTML=xhr.response;
      };

      xhr.send(null);
}



function imprimir_friae(){

window.open('<?php echo base_url();?>index.php/c_friae/generar_friae_grupo?grupo='+document.getElementById("grupos").value, '_blank');

}

</script>

</html>