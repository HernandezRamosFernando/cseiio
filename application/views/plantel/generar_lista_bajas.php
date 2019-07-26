<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Generar Lista de Bajas</a>
      </li>
      <li class="breadcrumb-item active">Seleccione los campos correspondientes para generar lista de bajas</li>
    </ol>


    <form class="card" id="formulario" action="<?php echo base_url();?>/C_formato_bajas/generar_formato" target="_blank" method='post'>
      <div class="card-body">


        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel" name="plantel" required="required">

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

          <div class="col-md-6">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="" name="ciclo_escolar"
                  id="ciclo_escolar" required="required">
                  <option value="">Seleccione el ciclo escolar correspondiente</option>
                  <?php
                        foreach ($ciclo_escolar as $c)
                            {
                                echo '<option value="'.$c->id_ciclo_escolar.'">'.$c->nombre_ciclo_escolar.' -----'.$c->periodo.'</option>';
                            }
                    ?>

                  
                </select>
                <span>Ciclo escolar</span>
              </label>
            </div>

            <div class="col-md-6 ">
                  <div class="text-right">
                <button type="submit" class="btn btn-success btn-lg btn-block" style=""
                                id="crear_grupo">Generar reporte de bajas</button>
                            
                </div>
                </div>
          </div>
        </div>



      </div>
    </form>
 

  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

</script>