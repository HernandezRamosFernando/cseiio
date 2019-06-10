<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Cerrar calificaciones</a>
      </li>
      <li class="breadcrumb-item active">Agregue los datos solicitados</li>
    </ol>
    <form class="card" id="formulario">
      <div class="card-body">
        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel" name="plantel">
                  <option value="">Seleccione un plantel </option>

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

        <div class="form-group" id="boton_oculto" style="display: ">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-12" id="agregar_oculto" style="display: ">
                <button type="button" onclick="cerrar_calificaciones()" value="nuevo" id="boton_cerrar"
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


  function cerrar_calificaciones() {
    if (document.getElementById("plantel").value != "") {
      var cerrar = new XMLHttpRequest();
          cerrar.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/cerrar_calificaciones_plantel?plantel='+document.getElementById("plantel").value, true);
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
      if(cerrar.response.trim()==="si"){//si si puede cerrar
      let plantel = document.getElementById("plantel").value;

      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_reinscripcion/cerrar_calificaciones_plantel?plantel=' + plantel, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        console.log(xhr.response);

        if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'info',
            text: 'Calificaciones cerradas correctamente, estatus de los alumnos actualizados',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              $(document).scrollTop(0);
              location.reload();
            } else {
              Swal.fire({
                type: 'error',
                text: 'Datos no guardados'
              });
            }
          });

        }
      };
      xhr.send(null);
    }

    else{// si no puede cerrar
      Swal.fire({
        type: 'error',
        text: 'No se puede cerrar calificaciones sin antes capturar las calificaciones del examen final de todos los grupos.'
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