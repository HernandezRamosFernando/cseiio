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
                  <option value="">Seleccione el plantel donde buscar el grupo</option>

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
            <button type="button" onclick="" value="nuevo" id="boton_cerrar"
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
      window.onload = function () {
        //funciones a ejecutar
        swalWithBootstrapButtons.fire({
          type: 'warning',
          text: 'Esta seguro que desea cerrar la captura de calificaciones?',
          confirmButtonText: 'Aceptar',
          showCancelButton: 'true',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {
            swalWithBootstrapButtons.fire({
              type: 'info',
              text: 'Calificaciones cerradas correctamente, estatus de los alumnos actualizados',
              confirmButtonText: 'Aceptar'
            }).then((result) => {
              if (result.value) {
                //window.location.replace("<?php echo base_url();?>index.php/c_vistas/acreditacion");
              }
            });
          } else {
            window.location.replace("<?php echo base_url();?>index.php/c_vistas/acreditacion");
          }     //aqui va si cancela




        });
      }


      function fecha_sql(fecha) {
        let fecha_separada = fecha.split("/").reverse();
        return fecha_separada.join("-");
      }

      function validarcomponente() {
        validafecha(document.getElementById("fecha_inicio"));
        validafecha(document.getElementById("fecha_fin"));

        if (document.getElementById("fecha_fin").value != '' && document.getElementById("fecha_inicio").value != '') {
          agregar_ciclo()
        } else {
          Swal.fire({
            type: 'warning',
            text: 'La fecha ingresada es incorrecta'
          });
        }
      }


      function agregar_ciclo() {

        let datos = {
          nombre_ciclo: document.getElementById("nombre_ciclo").value,
          fecha_matricula: document.getElementById("fecha_matricula").value,
          periodo: document.getElementById("periodo").value,
          fecha_inicio: fecha_sql(document.getElementById("fecha_inicio").value),
          fecha_terminacion: fecha_sql(document.getElementById("fecha_fin").value)
        };
        console.log(datos);


        var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_ciclo_escolar/agregar_ciclo_escolar', true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr.error = function () {
          console.log("error de conexion");
        }
        xhr.onreadystatechange = function () { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            $('#div_carga').hide();
            if (xhr.responseText.trim() === "si") {
              swalWithBootstrapButtons.fire({
                type: 'success',
                text: 'Datos agregados correctamente',
                confirmButtonText: 'Aceptar'
              }).then((result) => {
                if (result.value) {
                  //aqui va el aceptar
                  $(document).scrollTop(0);
                  window.location.replace("<?php echo base_url();?>index.php/c_vistas/acreditacion");
                }
                //aqui va si cancela
              });

            } else {
              Swal.fire({
                type: 'error',
                text: 'Datos no agregados'
              });
            }
          }
        }
        xhr.send(JSON.stringify(datos));



        //console.log(datos);
      }


    </script>