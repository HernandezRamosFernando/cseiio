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
                <input type="text" disabled class="form-control" id="nombre_ciclo" placeholder="Nombre ciclo escolar ">
                <label for="nombre_ciclo">Nombre de ciclo escolar</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" disabled class="form-control" id="fecha_matricula"
                  placeholder="Fecha de la matrícula">
                <label for="fecha_matricula">Serie de la matrícula</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" disabled class="form-control" id="periodo" placeholder="Periodo">
                <label for="periodo">Periodo</label>
              </div>
            </div>


          </div>
        </div>

        <div class="form-group">
          <div class="row">

          <div class="col-md-4">
              <div class="form-label-group">
              <input class="form-control" placeholder="Fecha de inicio de periodo" type="date" name="fecha_inicio_oficial" 
                id="fecha_inicio_oficial"  style="color: #237087" onchange="fecha_minima(this)" min=
                <?php
                echo date('Y-m-d');
                ?>
                >
              <label for="fecha_inicio_oficial">Fecha de inicio de periodo</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
              <input class="form-control" placeholder="Fecha de finalización de periodo" type="date" name="fecha_fin"
                id="fecha_fin"  style="color: #237087"min=
                <?php
                echo date('Y-m-d');
                ?>
                >
              <label for="fecha_fin">Fecha de finalización de periodo</label>
              </div>
            </div>
  </div>
</div>
<div class="form-group">
          <div class="row">

          <div class="col-md-4">
              <div class="form-label-group">
              <input class="form-control" placeholder="Fecha de inicio de periodo de inscripción" type="date" name="fecha_inicio" 
                id="fecha_inicio"  style="color: #237087"
                >
              <label for="fecha_inicio">Fecha de inicio de periodo de inscripción</label>
              </div>
            </div>
  </div>
</div>

<br>
<div class="col-md-12" id="boton_oculto" style="display: none">
  <button type="button" onclick="validarcomponente()" id="boton_agregar"
    class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem">
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
      allowOutsideClick: false,
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Agregue los datos del nuevo periodo escolar',
          allowOutsideClick: false,
          confirmButtonText: 'Aceptar'
        }).then((result) => {
          if (result.value) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '<?php echo base_url();?>index.php/c_ciclo_escolar/get_datos_siguiente_ciclo', true);
            xhr.onloadstart = function () {
              $('#div_carga').show();
            }
            xhr.error = function () {
              console.log("error de conexion");
            }
            xhr.onload = function () {
              $('#div_carga').hide();
              if (JSON.parse(xhr.response)[0].respuesta === undefined) {
                document.getElementById("nombre_ciclo").value = JSON.parse(xhr.response)[0].nombre_ciclo_escolar;
                document.getElementById("fecha_matricula").value = JSON.parse(xhr.response)[0].fecha_matricula;
                document.getElementById("periodo").value = "FEBRERO-JULIO";

              }

              else {
                let separador_nombre = JSON.parse(xhr.response)[1].nombre_ciclo_escolar.split("-");
                var a = parseInt(separador_nombre[0]) + 1;
                var b = parseInt(separador_nombre[1]) + 1;
                var nombre_ciclo = a + "-" + b;
                var fecha_matricula = parseInt(JSON.parse(xhr.response)[1].fecha_matricula) + 1;
                document.getElementById("nombre_ciclo").value = nombre_ciclo;
                document.getElementById("fecha_matricula").value = fecha_matricula;
                document.getElementById("periodo").value = "AGOSTO-ENERO";
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


  function fecha_sql(fecha) {
    let fecha_separada = fecha.split("/").reverse();
    return fecha_separada.join("-");
  }

  function validarcomponente() {

    var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_planteles_sin_cerrar_calificaciones', true);
        xhr.onloadstart = function () {
        $('#div_carga').show();
        }
       xhr.error = function () {
       console.log("error de conexion");
        }
        xhr.onload = function () {
          $('#div_carga').hide();
          if(JSON.parse(xhr.response).length>0){
            var lista = "<ul>";
            JSON.parse(xhr.response).forEach(function(valor){
                lista+="<li>"+valor.nombre_plantel+"</li>"
            });
            lista += "</ul>";

            console.log(lista);
            
            Swal.fire({
                    type: 'warning',
                    html: '<p>hay planteles pendientes por cerrar calificaciones<p>'+lista
                  });
          }

          else{
            validafecha(document.getElementById("fecha_inicio"));
                validafecha(document.getElementById("fecha_fin"));

                if (document.getElementById("fecha_fin").value != '' && document.getElementById("fecha_inicio").value != ''  && document.getElementById("fecha_inicio_oficial").value != '') {
                  agregar_ciclo()
                } else {
                  Swal.fire({
                    type: 'warning',
                    text: 'La fecha ingresada es incorrecta'
                  });
                }
          }
        };

        xhr.send(null);
    
  }


  function agregar_ciclo() {

    let datos = {
      nombre_ciclo: document.getElementById("nombre_ciclo").value,
      fecha_matricula: document.getElementById("fecha_matricula").value,
      periodo: document.getElementById("periodo").value,
      fecha_inicio: fecha_sql(document.getElementById("fecha_inicio_oficial").value),
      fecha_inicio_inscripcion: fecha_sql(document.getElementById("fecha_inicio").value),
      fecha_terminacion: fecha_sql(document.getElementById("fecha_fin").value)
    };
console.log(datos);


    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_reinscripcion/cerrar_periodo', true);

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
            allowOutsideClick: false,
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

  function fecha_minima(e) {+
    $("#fecha_inicio").val(e.value);
    $("#fecha_inicio").attr({ "max" : e.value });
  }


</script>