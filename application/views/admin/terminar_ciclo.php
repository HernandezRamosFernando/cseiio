<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Finalización de periodo de ciclo escolar</a>
      </li>
      <li class="breadcrumb-item active">Agregue los datos solicitados</li>
    </ol>

    <div class="card" id="periodo_oculto" style="display: none">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text"  disabled class="form-control" id="nombre_ciclo"
                  placeholder="Nombre ciclo escolar ">
                <label for="nombre_ciclo">Nombre de ciclo escolar</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" disabled class="form-control" id="fecha_matricula"
                  placeholder="Fecha de la matrícula">
                <label for="fecha_matricula">Fecha de la matrícula</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" disabled  class="form-control" id="periodo"
                  placeholder="Periodo">
                <label for="periodo">Periodo</label>
              </div>
            </div>


          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text"  class="form-control" id="fecha_inicio_periodo" onkeyup="mascara(this,'/',patron,true)" 
                  placeholder="Fecha de inicio del periodo">
                <label for="fecha_inicio_periodo">Fecha de inicio del periodo (dd/mm/aaaa)</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text"  class="form-control" id="fecha_fin_periodo" onkeyup="mascara(this,'/',patron,true)"
                  placeholder="Fecha de finalización del periodo">
                <label for="fecha_fin_periodo">Fecha de finalización del periodo (dd/mm/aaaa)</label>
              </div>
            </div>


          </div>
        </div>


      </div>
    </div>






  </div>

  <br>
  <div class="col-md-12" id="boton_oculto" style="display: none">
    <button type="button" onclick="agregar_ciclo()" id="boton_agregar" class="btn btn-success btn-lg btn-block" style="padding: 1rem">
      Guardar Nuevo periodo de ciclo escolar</button>
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
      text: 'Esta seguro que desea finalizar el periodo escolar',
      confirmButtonText: 'Aceptar',
      showCancelButton: 'true',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Agregue los datos del nuevo periodo escolar',
          confirmButtonText: 'Aceptar'
        }).then((result) => {
          if (result.value) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?php echo base_url();?>index.php/c_ciclo_escolar/get_datos_siguiente_ciclo', true);

            xhr.onload = function () {
              //console.log(JSON.parse(xhr.response));
              //console.log(JSON.parse(xhr.response)[0].id_ciclo_escolar);
              

              if (JSON.parse(xhr.response)[0].respuesta === undefined) {
                document.getElementById("nombre_ciclo").value = JSON.parse(xhr.response)[0].nombre_ciclo_escolar;
                document.getElementById("fecha_matricula").value = JSON.parse(xhr.response)[0].fecha_matricula;
                document.getElementById("periodo").value = "ENERO-JULIO";

              }

              else{
                let separador_nombre = JSON.parse(xhr.response)[1].nombre_ciclo_escolar.split("-");
                var a = parseInt(separador_nombre[0])+1;
                var b = parseInt(separador_nombre[1])+1;
                var nombre_ciclo = a+"-"+b;
                var fecha_matricula = parseInt(JSON.parse(xhr.response)[1].fecha_matricula)+1;
                document.getElementById("nombre_ciclo").value = nombre_ciclo;
                document.getElementById("fecha_matricula").value = fecha_matricula;
                document.getElementById("periodo").value = "AGOSTO-DICIEMBRE";
              }

              
            };

            xhr.send(null);
            document.getElementById("periodo_oculto").style.display = "";
            document.getElementById("boton_oculto").style.display = "";
          }
        });
      } else {
        window.location.replace("<?php echo base_url();?>index.php/c_vistas/acreditacion"); 
      }     //aqui va si cancela




    });
  }


  function fecha_sql(fecha){
    let fecha_separada = fecha.split("/").reverse();
    return fecha_separada.join("-");
  }


  function agregar_ciclo(){
    let datos = {
      nombre_ciclo:document.getElementById("nombre_ciclo").value,
      fecha_matricula:document.getElementById("fecha_matricula").value,
      periodo:document.getElementById("periodo").value,
      fecha_inicio:fecha_sql(document.getElementById("fecha_inicio_periodo").value),
      fecha_terminacion:fecha_sql(document.getElementById("fecha_fin_periodo").value)
    };
 


    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_ciclo_escolar/agregar_ciclo_escolar', true);

    //Send the proper header information along with the request
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
        xhr.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              $('#div_carga').hide();
            console.log(xhr.response);
            if (xhr.responseText.trim() === "si") {
                console.log(xhr.response);
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

               }else{
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