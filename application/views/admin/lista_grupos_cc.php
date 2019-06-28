<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Lista de materias con calificaciones</a>
      </li>
      <li class="breadcrumb-item active">Busque el grupo que desea imprimir</li>
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

        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="cargargrupos()" name="semestre_grupo"
                  id="semestre_grupo">
                  <option value="">Seleccione uno</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
                <span>Semestre del grupo a buscar</span>
              </label>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="cargar_materias()" name="grupos"
                  id="grupos">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de grupos</span>
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
                <span>Lista de materias del grupo</span>
              </label>
            </div>

            <div class="col-md-3 offset-md-2">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente()"
                style="padding: 1rem" id="crear_grupo">Imprimir materia</button>
            </div>
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

if (document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("materias").value != '') {
  window.open('<?php echo base_url();?>index.php/c_lista_calificaciones/lista_calificaciones_grupo_materia_llena?grupo='+document.getElementById("grupos").value+'&materia='+document.getElementById("materias").value, '_blanck');
} else {
  Swal.fire({
    type: 'warning',
    text: 'Agregue los datos faltantes'
  });
}
}
 
function cambiarbusqueda() {
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-info');
    document.getElementById('crear_grupo').innerHTML = 'Buscar de nuevo';
    document.getElementById('limpiar_oculto').style.display = "";
  }


  function cargargrupos() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#semestre_grupo").val('');
    } else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);

      var semestre = document.getElementById("semestre_grupo").value;
      console.log(semestre);
      grupos.innerHTML = "";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_grupos_plantel_htmloption?plantel=' + plantel + '&semestre=' + semestre, true);
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
          option.text = "Ningun grupo creado";
          option.value = "";
          grupos.add(option);
        } else {
          console.log(xhr.response);
          grupos.innerHTML = xhr.responseText;
        }
      };
      xhr.send(null);
    }
  }



  function cargar_materias() {
    if (document.getElementById("grupos").value != "") {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_materias_grupo?grupo=' + document.getElementById("grupos").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        let opciones = "";
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          opciones += '<option value="' + valor.clave + '">' + valor.unidad_contenido + '</option>';
        });

        document.getElementById("materias").innerHTML = opciones;
      };

      xhr.send(null);
    } else {
      document.getElementById("materias").innerHTML = '';
    }

  }



</script>