<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Generar Lista de Asistencias</a>
      </li>
      <li class="breadcrumb-item active">Busque la materia que desea generar lista de asistencia</li>
    </ol>


    <form class="card" id="formulario" action="<?php echo base_url();?>index.php/C_grupo_estudiante/generar_lista_asistencia" target="_blank" method='post'>
      <div class="card-body">


        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel" name="plantel" required="required">
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

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="cargargrupos()" name="semestre_grupo"
                  id="semestre_grupo" required="required">
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
                  id="grupos" required="required">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de grupos</span>
              </label>
            </div>

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="materias" id="materias" required="required">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de materias del grupo</span>
              </label>
            </div>


            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="mes"
                  id="mes" required="required">
                  <option value="">Seleccione el mes</option>
                  <option value="1">ENERO</option>
                  <option value="2">FEBRERO</option>
                  <option value="3">MARZO</option>
                  <option value="4">ABRIL</option>
                  <option value="5">MAYO</option>
                  <option value="6">JUNIO</option>
                  <option value="7">JULIO</option>
                  <option value="8">AGOSTO</option>
                  <option value="9">SEPTIEMBRE</option>
                  <option value="10">OCTUBRE</option>
                  <option value="11">NOVIEMBRE</option>
                  <option value="12">DICIEMBRE</option>
                </select>
                <span>Mes</span>
              </label>
            </div>

          </div>
        </div>


        <div class="form-group">
          <div class="row">
          <div class="col-md-6">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="tipo_formato"
                  id="tipo_formato" required="required">
                  <option value="">Seleccione el formato que desea para imprimir</option>
                  <option value="OFICIO">OFICIO</option>
                  <option value="CARTA">CARTA</option>
                </select>
                <span>Tamaño de hoja para imprimir</span>
              </label>
            </div>
        
          </div>
        </div>


        <div class="form-group">
          <div class="row">
<div class="col-md-12">

<button type="submit" class="btn btn-success btn-lg btn-block" style="padding: 1rem"
                id="limpiar">Generar lista de asistencia</button>
            
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

 var form_reset = document.getElementById("plantel");
  form_reset.onchange = function(e){

  	if(document.getElementById("semestre_grupo").value!=="" || document.getElementById("semestre_grupo").value!=="" || document.getElementById("grupos").value!=="" || document.getElementById("materias").value!=="" || document.getElementById("mes").value!==""){
  		
  		
  		cargargrupos();
  		cargar_materias();
  	}
    
    
  }


  function recargar() {
    location.reload();

  }




  function cargargrupos() {

    if (document.getElementById("plantel").value === "") {
      var option = document.createElement("option");
          option.text = "Ningun grupo creado";
          option.value = "";
          grupos.add(option);
      
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
        console.log(xhr.response.trim());
        
          let opciones = "";
          opciones += '<option value="">Seleccione una materia</option>';
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