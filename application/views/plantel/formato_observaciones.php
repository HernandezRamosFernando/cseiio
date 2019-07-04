<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Generar Formato de Observaciones en Expedientes</a>
          </li>
          <li class="breadcrumb-item active">Seleccione Plantel y ciclo escolar</li>
        </ol>


    <div class="card">
      <div class="card-body">

<form id="formato_observacion" action="<?php echo base_url();?>index.php/c_estudiante/generar_formato_observaciones_expedientes" method="post">

            <div class="form-group">
              <div class="row">
                <div class="col-md-8">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" id="plantel_busqueda"
                      name="plantel_busqueda">

                      <?php
                        foreach ($planteles as $plantel)
                        {
                                echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.'-----'.$plantel->cct_plantel.'</option>';
                        }
                      ?>

                    </select>
                    <span>Plantel</span>
                  </label>

                </div>


                <div class="col-md-4">
                  <button type='submit' class="btn btn-success btn-lg btn-block" id="btn_buscar">Generar formato de observaciones</button>
                </div>

              </div>
            </div>

            
      </form>


      </div>
    </div>




</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<script>
var form = document.getElementById("formato_observacion");
  form.onsubmit = function (e) {
    e.preventDefault();
    var formdata = new FormData(form);   
          var observacion = new XMLHttpRequest();
          observacion.open('POST', '<?php echo base_url();?>index.php/c_estudiante/generar_formato_observaciones_expedientes', true);
          observacion.responseType = "arraybuffer";
          observacion.onloadstart = function () {
            $('#div_carga').show();
          }
          observacion.error = function () {
            console.log("error de conexion");
          }

          observacion.onload = function () {
            $('#div_carga').hide();
            //console.log(carta_compromiso.responseText);
            if (this.status === 200) {
              var blob = new Blob([observacion.response], { type: "application/pdf" });
              var objectUrl = URL.createObjectURL(blob);
              window.open(objectUrl, "_blank");

            }

          };

          observacion.send(formdata);

        }
 
 
</script>