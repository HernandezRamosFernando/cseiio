<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Buscar FRER</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos para buscar un FRER</li>
    </ol>


    <form class="card" id="formulario">
      <div class="card-body">
        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="cargarregularizacion()" id="plantel" name="plantel">
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

        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="regularizaciones"
                  id="regularizaciones">
                  <option value="">Seleccione un periodo de regularización</option>

                </select>
                <span>Regularizaciones</span>
              </label>
            </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="imprimir_frer()"
                style="padding: 1rem" id="crear_grupo">Mostrar FRER</button>
            </div>

          </div>
        </div>


      </div>
                                      </form>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>

  var lista_alumnos = new Array();

  
  function cargarregularizacion() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
    } 
    
    
    else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;

      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/periodos_regularizacion_plantel?plantel=' + plantel, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        if (xhr.response === "") {
          var option = document.createElement("option");
          option.text = "Ninguna regularizacion en este plantel";
          option.value = "";
          document.getElementById("regularizaciones").add(option);
        } 
        else {
          console.log(xhr.response);
          document.getElementById("regularizaciones").innerHTML=xhr.response;
        }
      };
      xhr.send(null);
    }
  }

function imprimir_frer(){

  var plantel = document.getElementById("plantel").value;

  let periodo_junto = document.getElementById("regularizaciones").value;

  let periodo = periodo_junto.split("-");

  switch(periodo[0]){
    case "ENERO":
    var mes = "1";
    break;

    case "MAYO":
    var mes = "5";
    break;

    case "JULIO":
    var mes = "7";
    break;

    case "OCTUBRE":
    var mes = "10";
    break;
  }

  let fecha = mes+"-"+periodo[1];





  //console.log(fecha);



window.open('<?php echo base_url();?>index.php/c_frer/generar_frer_plantel_periodo?plantel='+plantel+'&periodo='+fecha, '_blank');

}

</script>

</html>