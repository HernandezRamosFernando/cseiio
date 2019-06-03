<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Cerrar calificaciones</a>
      </li>
      <li class="breadcrumb-item active">Agregue los datos solicitados</li>
    </ol>

      
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
        cerrar_calificaciones();
      } else {
        window.location.replace("<?php echo base_url();?>index.php/c_vistas/acreditacion");
      }     //aqui va si cancela




    });
  }


  function cerrar_calificaciones() {
    if (document.getElementById("plantel").value != "") {
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
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
                window.location.replace("<?php echo base_url();?>index.php/c_vistas/acreditacion");
            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
        }
      };

      xhr.send(null);

    } else {
      Swal.fire({
        type: 'warning',
        text: 'Seleccione un plantel'
      });
    }
  }


</script>