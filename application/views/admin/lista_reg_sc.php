<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Lista de alumnos de regularización</a>
      </li>
      <li class="breadcrumb-item active">Busque la materia a imprimir</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="plantel" name="plantel"
                onchange="cargarmaterias();">
                <option value="">Seleccione el plantel donde buscar la materia</option>

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
              <select class="form-control form-control-lg selcolor" name="materias" id="materias">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de materias</span>
            </label>
          </div>

          <div class="col-md-4 offset-md-3">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente();"
              style="padding: 1rem" id="mostrar_materias">Imprimir lista de materia</button>
          </div>
        </div>
      </div>


     
    </form>

  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>

  function validarcomponente() {

    if (document.getElementById("plantel").value != '' && document.getElementById("materias").value != '') {
      buscar();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
    }
  }


  function cargarmaterias() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#materias").val('');
    } else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);

      materias.innerHTML = "";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_con_reprobados_html?plantel=' + plantel, true);
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
          option.text = "Ningun alumno con adeudo en este plantel";
          option.value = "";
          materias.add(option);
        } else {
          console.log(xhr.response);
          materias.innerHTML = xhr.responseText;
        }
      };
      xhr.send(null);
    }
  }



</script>

</html>