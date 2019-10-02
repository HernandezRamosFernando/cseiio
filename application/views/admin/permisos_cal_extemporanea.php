<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Permisos de calificaciones extemporaneas</a>
      </li>
      <li class="breadcrumb-item active">Ingrese la búsqueda que desea realizar</li>
    </ol>

    <div class="card">
          <div class="card-body">

        <div class="row">
    		<div class="col">
		        
		        <div class="float-right">
		        	<button type='button' class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modalnuevopermiso" id="btn_buscar"
                    onclick=''>Asignar permiso</button>
		        </div>
    		</div>
		</div>

		  </div>
        </div>

    
    <div class="card" style="overflow:scroll;" id="">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Matrícula</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Semestre en curso</th>
              <th scope="col" class="col-md-1">Editar</th>
              <th scope="col" class="col-md-1">Imprimir</th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
      
    </div>
  </div>


</div>
<!-- /.content-wrapper -->



<!--Inicia modal de agregar materia -->

<div class="modal fade" id="modalnuevopermiso" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 90% !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asignar permiso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              
            <div class="card">
      <div class="card-body">

        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="aspirante_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="aspirante_curp_busqueda">CURP</label>
              </div>
            </div>

          </div>


        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="aspirante_plantel_busqueda" name="aspirante_plantel">
                  <option value="">Buscar en todos los planteles</option>

                  <?php
                      foreach ($planteles as $plantel)
                      {
                        echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                      }
                      ?>

                </select>
                <span>Plantel</span>
              </label>

            </div>

            <div class="col-md-4">
              <button type='button' class="btn btn-success btn-lg btn-block" id="btn_buscar"
                onclick='buscar()'>Buscar</button>
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="card" style="overflow:scroll;" id="">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa_buscar" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="col-md-1">Nombre completo</th>
                          <th scope="col" class="col-md-1">CURP</th>
                          <th scope="col" class="col-md-1">N° control</th>
                          <th scope="col" class="col-md-1">Matrícula</th>
                          <th scope="col" class="col-md-1">Plantel CCT</th>
                          <th scope="col" class="col-md-1">Semestre en curso</th>
                          <th scope="col" class="col-md-1">Parcial 1</th>
                          <th scope="col" class="col-md-1">Parcial 2</th>
                          <th scope="col" class="col-md-1">Parcial 3</th>
                          <th scope="col" class="col-md-1">Examen Final</th>
                          
                        </tr>
                      </thead>



                        <tbody id="tabla_buscar">

                        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
      
         
              </div><!-- Fin de contanier-fluid  -->

            </div><!-- Fin de modal-body  -->

            

          </div>
          
        </div>
      </div>
    </div>


      <!--Termina modal de agregar materia-->


<script>

function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla_buscar").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/C_grupo_estudiante/busqueda_alumnos_grupo?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.primer_apellido + " " + valor.segundo_apellido + " " + valor.nombre;
        fila += '</td>';
        fila += '<td>';
        fila += valor.curp;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.matricula === null ? "" : valor.matricula;
        fila += '</td>';
        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';

        fila += '<td>';
        fila += '</td>';

        fila += '<td>';
        fila += '</td>';

        fila += '<td>';
        fila += '</td>';

        fila += '<td>';
        fila += '</td>';

        fila += '<td>';
        fila += '</td>';

        fila += '</tr>';
        document.getElementById("tabla_buscar").innerHTML += fila;
      });
      formato_tabla();
    };
    xhr.send(null);
    document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
    document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
    document.getElementById('btn_buscar').classList.remove('btn-success');
    document.getElementById('btn_buscar').classList.add('btn-info');
    document.getElementById('busqueda_oculto').style.display = "";
  }

</script>


