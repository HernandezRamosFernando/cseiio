<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Bajas</a>
      </li>
      <li class="breadcrumb-item active">Búsqueda de alumnos que desertaron</li>
    </ol>

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
                      echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
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
    <div class="card" style="overflow:scroll; display:none" id="busqueda_oculto">
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
              <th scope="col" class="col-md-1">Fecha Ingreso</th>
              <th scope="col" class="col-md-1"></th>
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


<!-- Modal -->
<div class="modal fade" id="desercion_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese el motivo de deserción</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body ">

      <form id="marcar_desertor">
      <input type="hidden" name="semestre_en_curso" id="semestre_en_curso">
      <input type="hidden" name="no_control" id="no_control">
        <div class="form-group">
          <div class="row">
            <div class="col-md-8">
              <div class="form-label-group">
                <input class="form-control" required="required" placeholder="Fecha de deserción" type="date" name="fecha_desercion"
                  id="fecha_inicio" style="color: #237087" min=<?php
                echo date('Y-m-d');
                ?>>
                <label for="fecha_desercion" class="seltitulo">Fecha de deserción</label>
              </div>
            </div>
          </div>
        </div>
          
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control selcolor" id="motivo_desercion" name="motivo_desercion" required="required">
                  <option value="">SELECCIONE EL MOTIVO DE DESERCIÓN</option>
                  <option value="SE CAMBIO A OTRO PLANTEL">SE CAMBIO A OTRO PLANTEL</option>
                  <option value="FALTA DINERO EN HOGAR PARA UTILES, PASAJES O INSCRIPCIÓN">FALTA DINERO EN HOGAR PARA
                    UTILES, PASAJES O INSCRIPCIÓN</option>
                  <option value="LE DISGUSTABA ESTUDIAR">LE DISGUSTABA ESTUDIAR</option>
                  <option value="CONSIDERA TRABAJAR ES MAS IMPORTANTE QUE ESTUDIAR">CONSIDERA TRABAJAR ES MAS IMPORTANTE
                    QUE ESTUDIAR</option>
                  <option value="PROBLEMAS PARA ENTENDER A LOS MAESTROS">PROBLEMAS PARA ENTENDER A LOS MAESTROS</option>
                  <option value="POR REPROBACIÓN DE MATERIAS">POR REPROBACIÓN DE MATERIAS</option>
                  <option value="SE EMBARAZÓ, EMBARAZÓ A ALGUIEN O TUVO UN HIJO">SE EMBARAZÓ, EMBARAZÓ A ALGUIEN O TUVO
                    UN HIJO</option>
                  <option value="SE CASÓ/JUNTÓ">SE CASÓ/JUNTÓ</option>
                  <option value="LA ESCUELA QUEDA LEJOS DE SU LOCALIDAD">LA ESCUELA QUEDA LEJOS DE SU LOCALIDAD</option>
                  <option value="HABÍA REGLAS DE DISCIPLINA CON LAS QUE NO ESTABA DE ACUERDO">HABÍA REGLAS DE DISCIPLINA
                    CON LAS QUE NO ESTABA DE ACUERDO</option>
                  <option value="TENÍA PROBLEMAS PERSONALES CON MAMÁ, PAPÁ O PAREJA DE UNO DE ELLOS">TENÍA PROBLEMAS
                    PERSONALES CON MAMÁ, PAPÁ O PAREJA DE UNO DE ELLOS</option>
                  <option value="HABÍA COMPAÑEROS QUE LO MOLESTABAN">HABÍA COMPAÑEROS QUE LO MOLESTABAN</option>
                  <option value="FALLECIÓ UN FAMILIAR O ALGUIEN DE LA FAMILIA SE ENFERMÓ GRAVEMENTE">FALLECIÓ UN
                    FAMILIAR O ALGUIEN DE LA FAMILIA SE ENFERMÓ GRAVEMENTE</option>
                  <option value="EXPULSADO POR INDISCIPLINA">EXPULSADO POR INDISCIPLINA</option>
                  <option value="SE CAMBIÓ DE DOMICILIO">SE CAMBIÓ DE DOMICILIO</option>
                  <option value="TENÍA BAJA AUTOESTIMA">TENÍA BAJA AUTOESTIMA</option>
                  <option value="SE SENTÍA INSEGURO EN LA ESCUELA O EN EL CAMINO PARA LLEGAR A ESTA">SE SENTÍA INSEGURO
                    EN LA ESCUELA O EN EL CAMINO PARA LLEGAR A ESTA</option>
                  <option value="LE DISGUSTABAN LAS INSTALACIONES DE LA ESCUELA">LE DISGUSTABAN LAS INSTALACIONES DE LA
                    ESCUELA</option>
                  <option value="SE SENTIA DISCRIMINADO POR SU FORMA DE PENSAR O DE VESTIR">SE SENTIA DISCRIMINADO POR
                    SU FORMA DE PENSAR O DE VESTIR</option>
                  <option value="CONSIDERABA QUE ESTUDIAR ERA DE POCA UTILIDAD">CONSIDERABA QUE ESTUDIAR ERA DE POCA
                    UTILIDAD</option>
                  <option value="LA FAMILIA PREFERIA QUE ESTUDIARAN OTROS HERMANOS ">LA FAMILIA PREFERIA QUE ESTUDIARAN
                    OTROS HERMANOS </option>
                  <option value="OTRO">OTRO MOTIVO</option>
                </select>
                <span>Motivo de deserción</span>
              </label>
            </div>

          </div>
        </div>


        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="boton_guardar" class="btn btn-success"> Guardar</button>
        </div>
        </form>

      </div>
    </div>
  </div>


  <script>


    function buscar() {
      document.getElementById("aspirante_plantel_busqueda").disabled = true;
      document.getElementById("aspirante_curp_busqueda").disabled = true;
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      var curp = document.getElementById("aspirante_curp_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;
      var query = 'curp=' + curp + '&cct_plantel=' + plantel;
      xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiantes_probables_desertores?' + query, true);
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
          fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
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
          fila += valor.fecha_registro;
          fila += '</td>';
          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-danger" type="button" onclick="pasar_no_control(this,'+valor.semestre_en_curso+')" value="' + valor.no_control + '" data-toggle="modal" data-target="#desercion_modal">Marcar como desertor</button>';
          fila += '</td>';
          fila += '</tr>';
          document.getElementById("tabla").innerHTML += fila;
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


    function pasar_no_control(e,semestre) {
      document.getElementById("marcar_desertor").reset();
      document.getElementById("no_control").value="";
      document.getElementById("semestre_en_curso").value="";
      document.getElementById("no_control").value = e.value;
      document.getElementById("semestre_en_curso").value = semestre;
    }

    var form = document.getElementById("marcar_desertor");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>/C_estudiante/set_desertor",true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      $('#div_carga').hide();
      if(xhr.responseText.trim()==="si"){
        Swal.fire({
            type: 'success',
            scrollbarPadding:false,
            title: 'El alumno ha sido marcado como desertor exitosamente',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#desercion_modal').modal('toggle');
          borrar_formato_tabla();
          buscar();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrio un error al agregar los datos',
            showConfirmButton: false,
            timer: 2500 
          });
      }
      

    }
}
		xhr.send(formdata);
		
	}


  function borrar_formato_tabla(){
  $("#tabla_completa").dataTable().fnDestroy();
  
}
  </script>