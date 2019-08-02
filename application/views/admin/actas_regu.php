<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Actas de Regularización</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos para buscar una acta</li>
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
                <select class="form-control form-control-lg selcolor"  name="regularizaciones" onclick="cargar_materias()"
                  id="regularizaciones">
                  <option value="">Seleccione un periodo de regularización</option>

                </select>
                <span>Regularizaciones</span>
              </label>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">

          <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="materias" id="materias">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de materias </span>
              </label>
            </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block"
                style="padding: 1rem" id="crear_grupo" onclick="mostrar_acta()">Mostrar Acta</button>
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



function cargar_materias(){

  let periodo = document.getElementById("regularizaciones").value;
  let plantel = document.getElementById("plantel").value;

  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_regularizadas_periodo?periodo='+periodo+'&plantel='+plantel, true);

      xhr.onload = function () {
        document.getElementById("materias").innerHTML=xhr.response;
      };

      xhr.send(null);

}


function mostrar_acta(){
  let plantel = document.getElementById("plantel").value;
  let periodo = document.getElementById("regularizaciones").value;
  let materia = document.getElementById("materias").value;

  let mes_letra = periodo.split("-")[0];
  var mes = 0;

  switch(mes_letra){
      case "ENERO":
      mes = 1;
      break;

      case "MAYO":
      mes = 5;
      break;

      case "JULIO":
      mes = 7;
      break;

      case "OCTUBRE":
      mes = 10;
      break;
  }

  let ano = parseInt(periodo.split("-")[1]);

  console.log(plantel,mes,ano,materia);


  location.href = '<?php echo base_url();?>index.php/c_acta_regularizacion/generar_acta?plantel='+plantel+'&mes='+mes+'&ano='+ano+'&materia='+materia;
}

</script>

</html>