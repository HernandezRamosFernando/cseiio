<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Generar FRIAE</a>
      </li>
      <li class="breadcrumb-item active">seleccione los datos solicitados</li>
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
                                          echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                                        }
                                        ?>

                </select>
                <span>Plantel</span>
              </label>
            </div>

          </div>

        </div>

        <div class="form-group" id="boton_oculto" style="display: ">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12" id="agregar_oculto" style="display: ">
                <button type="button" onclick="generar_friae()" value="nuevo" id="boton_cerrar"
                  class="btn btn-success btn-lg btn-block btn-cerrar" style="padding: 1rem"> Cerrar</button>
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


  function generar_friae() {
    if (document.getElementById("plantel").value != "") {
      var cerrar = new XMLHttpRequest();
          cerrar.open('GET', '<?php echo base_url();?>index.php/c_friae/cerrar_friae?plantel='+document.getElementById("plantel").value, true);
          cerrar.onloadstart = function () {
        $('#div_carga').show();
      }
      cerrar.error = function () {
        console.log("error de conexion");
      }
      cerrar.onload = function () {
        $('#div_carga').hide();
            console.log(cerrar.response.trim());
//respuesta de si puede cerrar
      if(cerrar.response.trim()==="si"){
        console.log(cerrar.response);
        swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'FRIAE generado correctamente.',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el acepta
              $(document).scrollTop(0);
              location.reload();

            }
            //aqui va si cancela
          });
    }

    else{// si no puede cerrar
      Swal.fire({
        type: 'warning',
        text: 'Error al cerrar FRIAE.'
      });
    }

    };

      cerrar.send(null);
//-------------------------------------------------------------------------------------
    } 
    else {
      Swal.fire({
        type: 'warning',
        text: 'Seleccione un plantel'
      });
    }
  }


</script>