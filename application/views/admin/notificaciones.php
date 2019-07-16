<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Notificaciones</a>
      </li>
      <li class="breadcrumb-item active">Agregue la notificación que desea enviar</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">

            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel_notificacion"
                  name="plantel_notificacion">
                  <option value="">Seleccione uno</option>
                  <option value="todos">TODOS LOS PLANTELES DEL SISTEMA</option>

                  <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                                        }
                                        ?>

                </select>
                <span>Plantel al que desea enviar la notificación</span>
              </label>
            </div>

            <div class="col-md-2">
             <button type="button" name="btn_añadir" id="btn-añadir" class="btn btn-primary btn-lg btn-block" onclick="agregar_plantel(this);">Añadir +</button>
            </div>
            <div class="col-md-2">
             <button type="button" name="btn_eliminar" id="btn-eliminar" class="btn btn-danger btn-lg btn-block" onclick="eliminar_plantel(this);">Eliminar -</button>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row" id="nuevosplanteles">

          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" class="form-control text-uppercase" id="titulo_notificacion"
                  placeholder="Título de la notificación">
                <label for="titulo_notificacion">Título de la notificación</label>
              </div>
            </div>


          </div>
        </div>

        <br>

        <div class="form-group">
          <div class="row">
            <div class="col-md-8">
              <div class="form-group has-float-label seltitulo ">
                <textarea type="text" class="form-control text-uppercase" id="mensaje_notificacion" rows="6"></textarea>
                <label for="mensaje_notificacion">Mensaje de la notificación</label>
              </div>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <button type="button" onclick="validarcomponente();" class="btn btn-warning btn-lg btn-block"
                style="padding: 1rem" id="eliminar_usuario">Enviar notificación </button>
            </div>
          </div>
        </div>


      </div>
    </div>



  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Modal -->
<div class="modal fade" id="fechanotificacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 60% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese hasta que fecha se mostrará la notificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <div class="col-md-12">
          <div class="form-label-group">
            <input type="date" class="form-control" id="fecha_fin" placeholder="Fecha de finalización " min=<?php
                echo date('Y-m-d');
                ?>>
            <label for="fecha_fin">Fecha de finalización de notificación </label>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="validarcomponentefecha()" class="btn btn-success">Guardar fecha</button>
      </div>
    </div>
  </div>
</div>


<script>
  function validarcomponente() {
    if (document.getElementById("plantel_notificacion").value != '' && document.getElementById("titulo_notificacion").value != '' && document.getElementById("mensaje_notificacion").value != '') {
      $('#fechanotificacion').modal().show();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Agregue datos a todos los campos'
      });
    }
  }
  function validarcomponentefecha() {
    validafecha(document.getElementById("fecha_fin"));

    if (document.getElementById("fecha_fin").value != '') {
      mandar_notificacion();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'La fecha ingresada es incorrecta'
      });
    }
  }


  function mandar_notificacion() {

    if(document.getElementById("plantel_notificacion").value=="todos"){
      var dato = {
      plantel: document.getElementById("plantel_notificacion").value,
      titulo: document.getElementById("titulo_notificacion").value,
      mensaje: document.getElementById("mensaje_notificacion").value,
      autor: "<?php echo $this->session->userdata('user')['usuario'] ?>",
      fecha_fin: document.getElementById("fecha_fin").value
    }
    }

    else{

      //console.log(document.getElementById("nuevosplanteles").childNodes);
      var planteles = new Array();
      for(let i=1;i<document.getElementById("nuevosplanteles").childNodes.length;i++){
        planteles.push(document.getElementById("nuevosplanteles").childNodes[i].id);
      }

      //console.log(planteles);

      var dato = {
      plantel: planteles,
      titulo: document.getElementById("titulo_notificacion").value,
      mensaje: document.getElementById("mensaje_notificacion").value,
      autor: "<?php echo $this->session->userdata('user')['usuario'] ?>",
      fecha_fin: document.getElementById("fecha_fin").value
    }

    }

    console.log(dato);

    


    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_notificacion/agregar_notificacion', true);

    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        console.log(xhr.response);
        if (xhr.responseText.trim() === "si") {
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Notificación enviada correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              location.reload();
            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Notificación no enviada'
          });
        }
      }
    }
    xhr.send(JSON.stringify(dato));

    //console.log(dato);
    

  }
function agregar_plantel(plantel) {
  var contador_plantel = 0;
  if (document.getElementById("plantel_notificacion").value === "" || document.getElementById("plantel_notificacion").value === "todos") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
    } else {
      var contenedor =  document.getElementById("nuevosplanteles");
      var plantel = document.getElementById("plantel_notificacion").value;
      lbl = document.createElement('label');
      lbl.innerHTML = document.getElementById("plantel_notificacion").value;
      lbl.className += "btn btn-outline-success";
      lbl.setAttribute("id", document.getElementById("plantel_notificacion").value );
      contenedor.appendChild(lbl);
  }
}

function eliminar_plantel(plantel) {
  var contador_plantel = 0;
  if (document.getElementById("plantel_notificacion").value === "" || document.getElementById("plantel_notificacion").value === "todos") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
    } else {
      var plantel = document.getElementById("plantel_notificacion").value;
      $("#"+plantel+"").remove();
  }
}

</script>