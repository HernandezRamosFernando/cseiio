<div id="content-wrapper">

<div class="container-fluid ">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Finalización de periodo de ciclo escolar</a>
    </li>
    <li class="breadcrumb-item active">Agregue los datos solicitados</li>
  </ol>

  <div class="card">
      <div class="card-body">

      <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="" class="form-control"
                  id="nombre_ciclo" placeholder="Nombre ciclo escolar ">
                <label for="nombre_ciclo">Nombre de ciclo escolar</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="" class="form-control"
                  id="fecha_matricula" placeholder="Fecha de la matrícula">
                <label for="fecha_matricula">Fecha de la matrícula</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="" class="form-control"
                  id="periodo" placeholder="Periodo">
                <label for="periodo">Periodo</label>
              </div>
            </div>

        
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="" class="form-control"
                  id="fecha_inicio_periodo" placeholder="Fecha de inicio del periodo">
                <label for="fecha_inicio_periodo">Fecha de inicio del periodo</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="" class="form-control"
                  id="fecha_fin_periodo" placeholder="Fecha de finalización del periodo">
                <label for="fecha_fin_periodo">Fecha de finalización del periodo</label>
              </div>
            </div>

        
          </div>
        </div>


      </div>
|   </div>



 


</div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

window.onload = function() {
  //funciones a ejecutar
  swalWithBootstrapButtons.fire({
                    type: 'warning',
                    text: 'Esta seguro que desea finalizar el periodo escolar',
                    confirmButtonText: 'Aceptar',
                    showCancelButton: 'true',
                    cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.value) {
                    //aqui va el aceptar
                      }
                    //aqui va si cancela
                    });
};
 

</script>

