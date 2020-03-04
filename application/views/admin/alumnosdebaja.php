<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de usuarios</a>
      </li>
      <li class="breadcrumb-item active">Seleccione que desea hacer</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="asignar_calificaciones_baja()" style="padding: 1rem"
                id="agregar_usuario">Editar calificaciones baja</button>
            </div>

            <div class="col-md-4 ">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="modificar_fecha_baja()" style="padding: 1rem"
                id="modificar_usuario">Editar baja</button>
            </div>

          </div>
        </div>

<div id="div_asignar_calificaciones" style="display: none">

        <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Editar calificaciones baja</a>
      </li>
      <li class="breadcrumb-item active">Busque la materia que desea calificar</li>
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
                                          echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_corto.' DE '.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
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
                <select class="form-control form-control-lg selcolor" onchange="validarcomponente()" name="materias" id="materias">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de materias del grupo</span>
              </label>
            </div>


            <div class="col-md-4 offset-md-2" id="limpiar_oculto" style="display: none">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="recargar();" style="padding: 1rem"
                id="limpiar">Limpiar búsqueda</button>
            </div>
          </div>
        </div>



        <div class="row" id="alumnos_oculto" style="overflow: scroll; display: none">
          <div class="col-md-12" id="tabla_alumnos">
            <div class="card card-body" style="overflow: scroll;">
            <p class="h6" style="text-align: left; color: #237087; font-size: 12pt;">Criterios de calificación: <br> La calificación mínima aprobatoria es 6 <br> Toda calificación menor a 6 será 5 <br> La diagonal "/" significa que no presento </p>
            <br>
            <br>
              <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%; ">
                <caption>Lista de los alumnos del grupo</caption>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="col-md-1">Nombre completo</th>
                    <th scope="col" class="col-md-1">N° control</th>
                    <th scope="col" class="col-md-1">Parcial 1</th>
                    <th scope="col" class="col-md-1">Parcial 2</th>
                    <th scope="col" class="col-md-1">Parcial 3</th>
                    <th scope="col" class="col-md-1">Promedio Modular</th>
                    <th scope="col" class="col-md-1">Examen Final</th>
                    <th scope="col" class="col-md-1">Promedio Semestral</th>
                  </tr>
                </thead>

                <tbody id="tablagrupo">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </form>
    <br>
    <div class="col-md-12" id="agregar_oculto" style="display: none">
      <button type="button" value="nuevo" onclick="guardar()" id="boton_agregar"
        class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem"> Guardar cambios</button>
    </div>




          

</div> <!-- cerrar agregar -->

        <div id="diveditar_alumnos_baja" style="display: none">

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Editar fechas de baja</a>
          </li>
          <li class="breadcrumb-item active">Busque al alumno para asignar permisos de editar fecha de baja</li>
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
              <th scope="col" class="col-md-1">Fecha de baja</th>
              <th scope="col" class="col-md-1"></th>
              <th scope="col" class="col-md-1"></th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>


            
        </div> <!-- cerrar editar fecha de baja -->

      </div>
    </div>



  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!--Empieza Modal editar baja -->
<div class="modal fade" id="fecha_baja_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese los datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="editar_datos_baja">
      <div class="modal-body ">

      

      <input type="hidden" id="no_control_baja" name="no_control_baja" value=""/>

      

        <div class="form-group">
          <div class="row">

          <div class="col-md-8">
              <div class="form-label-group">
                <input class="form-control" placeholder="Nombre del alumno" type="text" name="nombre_alumno_baja"
                  id="nombre_alumno_baja" style="color: #237087" disabled="disabled"/>
                <label for="nombre_alumno_baja">Nombre del alumno</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input class="form-control" placeholder="Fecha de baja" type="date" name="fecha_baja"
                  id="fecha_baja" style="color: #237087" max=<?php
                echo date('Y-m-d');
                ?> required>
                <label for="fecha_baja">Fecha de baja</label>
              </div>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-md-12">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control selcolor" id="motivo_baja" name="motivo_baja" required>
                <option value="">Seleccione un motivo</option>
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
                <span>Motivo de baja</span>
              </label>
            </div>

          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-label-group">
                <input class="form-control" placeholder="observacion baja" type="input" name="observacion_baja"
                  id="observacion_baja" style="color: #237087">
                <label for="observacion_baja">Observacion</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="boton_guardar" class="btn btn-success" onclick="">Guardar</button>
        </div>
			</div>
        </form>
        
      </div>
    </div>
  </div>
<!--Termina Modal editar baja -->

<!--Empieza Modal eliminar baja -->
<div class="modal fade" id="eliminar_baja_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar baja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="eliminar_datos_baja">
      <div class="modal-body ">

      

      <input type="hidden" id="no_control_baja_eliminar" name="no_control_baja_eliminar" value=""/>

      <input type="hidden" id="fecha_baja_eliminar" name="fecha_baja_eliminar" value=""/>

        <div class="form-group">
          <div class="row">

          <div class="col-md-8">
              <div class="form-label-group">
                <input class="form-control" placeholder="Nombre del alumno" type="text" name="nombre_alumno_baja_eliminar"
                  id="nombre_alumno_baja_eliminar" style="color: #237087" disabled="disabled"/>
                <label for="nombre_alumno_baja_eliminar">Nombre del alumno</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input class="form-control" placeholder="Fecha de baja" type="date" name="fecha_baja_eliminar2"
                  id="fecha_baja_eliminar2" style="color: #237087" max=<?php
                echo date('Y-m-d');
                ?> disabled="disabled">
                <label for="fecha_baja_eliminar2">Fecha de baja</label>
              </div>
            </div>
          </div>
          </div>
			<div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control selcolor" id="motivo_baja_eliminar" name="motivo_baja_eliminar" disabled="disabled">
                <option value="">Seleccione un motivo</option>
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
                <span>Motivo de baja</span>
              </label>
            </div>
				</div>
                </div>
          
          <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <div class="form-label-group">
                <input class="form-control" placeholder="observacion baja" type="input" name="observacion_baja_eliminar"
                  id="observacion_baja_eliminar" style="color: #237087" disabled="disabled">
                <label for="observacion_baja_eliminar">Observacion</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" id="boton_guardar" class="btn btn-success" onclick="">Guardar</button>
        </div>
			</div>
        </form>
        
      </div>
    </div>
  </div>
<!--Termina Modal eliminar baja -->

<script>


var form = document.getElementById("editar_datos_baja");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/C_bajas/editar_datos_baja",true);
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
            title: 'Datos de baja modificados exitosamente.',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#fecha_baja_modal').modal('toggle');
          borrar_formato_tabla();
          buscar();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al modificar los datos.',
            showConfirmButton: false,
            timer: 2500 
          });
      }
      

    }
}
		xhr.send(formdata);
		
	}

  var form_eliminar = document.getElementById("eliminar_datos_baja");
	form_eliminar.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form_eliminar);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/C_bajas/eliminar_datos_baja",true);
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
            title: 'Datos de baja eliminados exitosamente.',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#eliminar_baja_modal').modal('toggle');
          borrar_formato_tabla();
          buscar();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al eliminar los datos.',
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

    function cargar_datos_alumno_baja(e) {
      
      document.getElementById("editar_datos_baja").reset();
      var no_control= e.value;
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_bajas/datos_alumno_baja/'+e.value, true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));
        let datos = JSON.parse(xhr.response);
        //datos personales
        document.getElementById("no_control_baja").value = datos.datos_baja.no_control;
        document.getElementById("nombre_alumno_baja").value = datos.datos_baja.primer_apellido+" "+datos.datos_baja.segundo_apellido+" "+datos.datos_baja.nombre;
        document.getElementById("fecha_baja").value =datos.datos_baja.fecha;
        document.getElementById("motivo_baja").value =datos.datos_baja.motivo;
        document.getElementById("observacion_baja").value =datos.datos_baja.observacion;

        
      }

      xhr.send(null);
    

}


function cargar_datos_eliminar_alumno_baja(e) {
      
      document.getElementById("eliminar_datos_baja").reset();
      var no_control= e.value;
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_bajas/datos_alumno_baja/'+e.value, true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));
        let datos = JSON.parse(xhr.response);
        //datos personales
        document.getElementById("no_control_baja_eliminar").value = datos.datos_baja.no_control;
        document.getElementById("nombre_alumno_baja_eliminar").value = datos.datos_baja.primer_apellido+" "+datos.datos_baja.segundo_apellido+" "+datos.datos_baja.nombre;
        document.getElementById("fecha_baja_eliminar").value =datos.datos_baja.fecha;
        document.getElementById("fecha_baja_eliminar2").value =datos.datos_baja.fecha;
        document.getElementById("motivo_baja_eliminar").value =datos.datos_baja.motivo;
        document.getElementById("observacion_baja_eliminar").value =datos.datos_baja.observacion;

        
      }

      xhr.send(null);
    

}

function buscar() {
      document.getElementById("aspirante_plantel_busqueda").disabled = true;
      document.getElementById("aspirante_curp_busqueda").disabled = true;
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      var curp = document.getElementById("aspirante_curp_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;
      var query = 'curp=' + curp + '&cct_plantel=' + plantel;
      xhr.open('GET', '<?php echo base_url();?>index.php/c_bajas/busqueda_alumnos_grupo_baja?' + query, true);
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
          fila += valor.primer_apellido + " " + valor.segundo_apellido+" "+valor.nombre;
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
          fila += valor.fecha;
          fila += '</td>';
          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-primary" type="button" onclick="cargar_datos_alumno_baja(this)" value="' + valor.no_control + '" onclick="" data-toggle="modal" data-target="#fecha_baja_modal">Editar</button>';
          fila += '</td>';
          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-danger" type="button" onclick="cargar_datos_eliminar_alumno_baja(this)" value="' + valor.no_control + '" onclick="" data-toggle="modal" data-target="#eliminar_baja_modal">Eliminar</button>';
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
</script>


<script>

  function asignar_calificaciones_baja() {
    document.getElementById("div_asignar_calificaciones").style.display = "";
    document.getElementById("diveditar_alumnos_baja").style.display = "none";
    
  }
  function modificar_fecha_baja() {
    document.getElementById("div_asignar_calificaciones").style.display = "none";
    document.getElementById("diveditar_alumnos_baja").style.display = "";
    
  }


  

</script>

<script>

function contar_vacios_input_calificaciones() {
  var validar_tabla = document.getElementById("tablagrupo");
  var contar_vacios=0;
  for (let i = 0; i < validar_tabla.childNodes.length; i++) {
      if(validar_tabla.childNodes[i].childNodes[2].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[2].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[3].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[3].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[4].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[4].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[6].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[6].childNodes[0].value===""){
        contar_vacios++;
      }

      

    }
    console.log('vacios: '+contar_vacios);
    return contar_vacios;


}



  //document.getElementById("boton_agregar").disabled=true;

  function guardar() {

var inputs_vacios=0;
inputs_vacios=contar_vacios_input_calificaciones();
console.log("Es el contador: "+inputs_vacios);
if(inputs_vacios>0){
Swal.fire({
    type: 'info',
    text: 'Faltan por rellenar algunos campos con calificaciones, verifique por favor.'
  });
  
  
}
else{
    var tabla = document.getElementById("tablagrupo");
    var datos = new Array();

    for (let i = 0; i < tabla.childNodes.length; i++) {
      var dato = {
        id_grupo: document.getElementById("grupos").value,
        materia: document.getElementById("materias").value,
        no_control: tabla.childNodes[i].childNodes[1].innerText,
        primer_parcial: tabla.childNodes[i].childNodes[2].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[2].childNodes[0].value,
        segundo_parcial: tabla.childNodes[i].childNodes[3].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[3].childNodes[0].value,
        tercer_parcial: tabla.childNodes[i].childNodes[4].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[4].childNodes[0].value,
        examen_final: tabla.childNodes[i].childNodes[6].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[6].childNodes[0].value
      }

      datos.push(dato);
    }

    //console.log(datos);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/C_bajas/actualizar_calificaciones_materia_grupo', true);

    swalWithBootstrapButtons.fire({
      type: 'info',
      text: 'Al aceptar no podrá realizar cambio alguno ¿Esta seguro?',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false,
      showCancelButton: 'true',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
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
          console.log(xhr.response);
          swalWithBootstrapButtons.fire({
            type: 'success',
            text: 'Calificaciones guardadas correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              //location.reload(); 
              document.getElementById("alumnos_oculto").style.display = "none";
              document.getElementById("agregar_oculto").style.display = "none";
              
            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Calificaciones no guardadas'
          });
        }
      }
    }
    xhr.send(JSON.stringify(datos));
    console.log(datos);
    
    }
    });


}




}

  function recargar() {
    location.reload();

  }


  function cargargrupos() {
    if (document.getElementById("plantel").value == "" || document.getElementById("semestre_grupo").value == "") {
      
      Swal.fire({
        type: 'info',
        text: 'Falta seleccionar un campo.'
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

  function validarcomponente() {

    if (document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("materias").value != '') {
      cargar_materia();
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
    document.getElementById('limpiar_oculto').style.display = "";
  }





  function cargar_materia() {
    document.getElementById("alumnos_oculto").style.display = "";
    document.getElementById("agregar_oculto").style.display = "";
    


      //cargar inputs
      document.getElementById("tablagrupo").innerHTML = "";
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_bajas/get_estudiantes_por_calificar?grupo=' + document.getElementById("grupos").value + '&materia=' + document.getElementById("materias").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }

      xhr.onload = function () {
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));


        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var promedio =0;


          var p1=0,p2=0,p3=0;

           p1=(valor.primer_parcial === null || valor.primer_parcial ==="") ? 0 : valor.primer_parcial;
          p2=(valor.segundo_parcial === null || valor.segundo_parcial ==="")? 0 : valor.segundo_parcial;
          p3=(valor.tercer_parcial === null || valor.tercer_parcial =="")? 0 : valor.tercer_parcial;
          ef=(valor.examen_final === null || valor.examen_final =="")? 0 : valor.examen_final;

          
          promedio=redondeo((parseInt(p1)+parseInt(p2)+parseInt(p3))/3);
          

          var registro = "<tr>";
          registro += '<td>' + valor.primer_apellido + ' ' + valor.segundo_apellido + ' ' + valor.nombre + '</td>';
          registro += '<td>' + valor.no_control + '</td>';
          var primer_parcial = valor.primer_parcial !== null ? valor.primer_parcial : "";

          if (valor.p1 === "1") {
            registro += '<td><input type="text" class="form-control" name="primer_parcial" value="' + (primer_parcial === "0" ? "/" : primer_parcial) + '" id="primer_parcial" onchange="calificaciones(this,\''+valor.tipo+'\',2,'+indice+','+valor.final+');"></td>';
          }
          else {
            registro += '<td><input type="text" class="form-control" name="primer_parcial" value="' + (primer_parcial === "0" ? "/" : primer_parcial) + '" id="primer_parcial" disabled></td>';
          }

          var segundo_parcial = valor.segundo_parcial !== null ? valor.segundo_parcial : "";
          if (valor.p2 === "1") {
            registro += '<td><input type="text" class="form-control" name="segundo_parcial" value="' + (segundo_parcial === "0" ? "/" : segundo_parcial) + '" id="segundo_parcial"  onchange="calificaciones(this,\''+valor.tipo+'\',3,'+indice+','+valor.final+');"></td>';
          }

          else {
            registro += '<td><input type="text" class="form-control" name="segundo_parcial" value="' + (segundo_parcial === "0" ? "/" : segundo_parcial) + '" id="segundo_parcial" disabled></td>';

          }

          var tercer_parcial = valor.tercer_parcial !== null ? valor.tercer_parcial : "";
          if (valor.p3 === "1") {
            registro += '<td><input type="text" class="form-control" name="tercer_parcial" value="' + (tercer_parcial === "0" ? "/" : tercer_parcial) + '" id="tercer_parcial" onchange="calificaciones(this,\''+valor.tipo+'\',4,'+indice+','+valor.final+');"></td>';
          }
          else {
            registro += '<td><input type="text" class="form-control" name="tercer_parcial" value="' + (tercer_parcial === "0" ? "/" : tercer_parcial) + '" id="tercer_parcial" disabled></td>';
          }

          if (promedio >= 6) {
            registro += '<td><input type="text" class="form-control" name="promedio_modular" value="' + promedio+'" id="promedio_modular" disabled style="background-color:#1F934C;color: white;font-weight:bold"></td>';
          } else {
            registro += '<td><input type="text" class="form-control" name="promedio_modular" value="' + promedio + '" id="promedio_modular" disabled style="background-color:#C4131B;color: white; font-weight:bold"></td>';
          }

          

          var examen_final = valor.examen_final !== null ? valor.examen_final : "";
          if (valor.final === "1" && promedio >= 6) {
            registro += '<td><input type="text" class="form-control" name="examen_final" value="' + (examen_final === "0" ? "/" : examen_final) + '" id="examen_final" onchange="calificaciones(this,\''+valor.tipo+'\',6,'+indice+','+valor.final+');"></td>';
          } else if (valor.final === "1" && promedio < 6) {
            registro += '<td><input type="text" class="form-control" name="examen_final" value="/" id="examen_final" onchange="calificaciones(this,\''+valor.tipo+'\',6,'+indice+','+valor.final+');" disabled></td>';
          } else {
            registro += '<td><input type="text" class="form-control" name="examen_final" value="' + (examen_final === "0" ? "/" : examen_final) + '" onchange="calificaciones(this,\''+valor.tipo+'\',6,'+indice+','+valor.final+');" id="examen_final" disabled></td>';
          }
          
          var promedio_total= redondeo((promedio+parseInt(ef))/2);


          if (promedio_total >= 6) {
          	registro += '<td> <input type="text" class="form-control" name="promediot" value="' + ((promedio_total === "0" || promedio_total==='') ? "/" : promedio_total) + '" id="promediot" disabled style="background-color:#1F934C;color: white;font-weight:bold"> </td>';
          }
          else{
          		registro += '<td> <input type="text" class="form-control" name="promediot" value="' + ((promedio_total === "0" || promedio_total==='') ? "/" : promedio_total) + '" id="promediot" disabled style="background-color:#C4131B;color: white; font-weight:bold"> </td>';
          }
          

          
          registro += '</tr>';

          document.getElementById("tablagrupo").innerHTML += registro;
        });
      }

      xhr.send(null);
      cambiarbusqueda();
     

  }



  function cargar_materias() {
    if (document.getElementById("grupos").value != "") {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_bajas/get_materias_por_calificar?grupo=' + document.getElementById("grupos").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        console.log(xhr.response.trim());
        if(xhr.response.trim() === "[]"){
          let opciones = "";
          opciones += '<option value="">No existen materias con permisos para calificar</option>';
          document.getElementById("materias").innerHTML = opciones;
          
        }else{
          let opciones = "";
          opciones += '<option value="">Seleccione una materia</option>';
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          opciones += '<option value="' + valor.clave + '">' + valor.unidad_contenido + '</option>';
        });

        document.getElementById("materias").innerHTML = opciones;
        }
        
      };

      xhr.send(null);
    } else {
      document.getElementById("materias").innerHTML = '';
    }

  }


  function calificaciones(e,tipo,columna_activa,fila,activo_examen_final) {
    var string = e.value.toString();
    var tipo_materia=tipo;

    for (var i = 0, output = '', validos = "0123456789./"; i < string.length; i++) {
      if (validos.indexOf(string.charAt(i)) != -1)
        output += string.charAt(i)
    }
    console.log(output);
    if (output != "") {


      
      if(tipo_materia==='EXTRAESCOLAR'){
          if (output >= 6 && output <= 10) {
              var valor = parseFloat(output);
              valor = Math.round(valor);
              console.log(valor)
              e.value = valor;
              e.style.color = "black";
            }
            else if(output==="/"){
                e.value ="/";
            }

            else{
                e.value =6;
            }
      }

      else{
                if (output >= 6 && output <= 10) {
              var valor = parseFloat(output);
              valor = Math.round(valor);
              console.log(valor)
              e.value = valor;
              e.style.color = "black";
            } else if (output === "/") {
              e.style.color = "black";
            } else if (output >= 0 && output < 6) {
              e.value = 5;
              e.style.color = "red";
            } else {
              console.log("valor no valido")
              e.value = "";
            }

      }

      


    } else {
      e.value = "";
    }
    //e.value=output;
    //-----------comienza validación de filas activas
    //validar_vacios_input();
    //validacion para calcular promedio del semestre por alumno
    promedio_semestral(fila,activo_examen_final)

  }


function validar_vacios_input() {
  var validar_tabla = document.getElementById("tablagrupo");
  var contar_vacios=0;
  for (let i = 0; i < validar_tabla.childNodes.length; i++) {
      if(validar_tabla.childNodes[i].childNodes[2].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[2].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[3].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[3].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[4].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[4].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[6].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[6].childNodes[0].value===""){
        contar_vacios++;
      }

      

    }
    console.log('vacios: '+contar_vacios);
    if(contar_vacios>0){
        document.getElementById("boton_agregar").disabled=true;
    }
    else{
        document.getElementById("boton_agregar").disabled=false;
    }


}


  function redondeo(e) {
    if (e >= 6 && e <= 10) {
      var valor = parseFloat(e);
      valor = Math.round(valor);
      return valor;
    } else if (e === 0) {
      return "/";
    } else if (e > 0 && e < 6) {
      return 5;
    } else {
      return "";
    }
  }



  function promedio_semestral(fila,activo_examen_final) {
    var tabla = document.getElementById("tablagrupo");
    var promedio=0;
    primer_parcial=(tabla.childNodes[fila].childNodes[2].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[2].childNodes[0].value==='/') ? 0 : tabla.childNodes[fila].childNodes[2].childNodes[0].value;
    segundo_parcial=(tabla.childNodes[fila].childNodes[3].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[3].childNodes[0].value === "/") ? 0 : tabla.childNodes[fila].childNodes[3].childNodes[0].value;
    tercer_parcial=(tabla.childNodes[fila].childNodes[4].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[4].childNodes[0].value === "/") ? 0 : tabla.childNodes[fila].childNodes[4].childNodes[0].value;
    examen_final=(tabla.childNodes[fila].childNodes[6].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[6].childNodes[0].value === "/") ? 0 : tabla.childNodes[fila].childNodes[6].childNodes[0].value;

    
promedio_modular=redondeo((parseInt(primer_parcial)+parseInt(segundo_parcial)+parseInt(tercer_parcial))/3);
	

	
if(promedio_modular>=6){
		tabla.childNodes[fila].childNodes[5].innerHTML='<input type="text" class="form-control" name="promedio_modular" value="' +promedio_modular+'" id="promedio_modular" disabled style="background-color:#1F934C;color: white;font-weight:bold">';
   
		 if(activo_examen_final===1){
		 	tabla.childNodes[fila].childNodes[6].childNodes[0].disabled=false;

		 	
		 }
	}

	else{
		tabla.childNodes[fila].childNodes[5].innerHTML='<input type="text" class="form-control" name="promedio_modular" value="' +promedio_modular+'" id="promedio_modular" disabled style="background-color:#C4131B;color: white;font-weight:bold">';
		if(activo_examen_final===1){
      
		 	tabla.childNodes[fila].childNodes[6].childNodes[0].disabled=true;
		 	tabla.childNodes[fila].childNodes[6].childNodes[0].value="/";
		 	examen_final=0;
		 }
	}



	

    promedio=redondeo((parseInt(promedio_modular)+parseInt(examen_final))/2);
    /*console.log('p1:'+primer_parcial+', p2:'+segundo_parcial+', p3:'+tercer_parcial+', ef:'+examen_final);
    console.log('este es el promedio Modular: '+promedio_modular);
    console.log('este es el promedio: '+promedio);
    console.log('este es la fila: '+fila);*/



	if(promedio>=6){
		tabla.childNodes[fila].childNodes[7].innerHTML='<input type="text" class="form-control" name="promediot" value="' + ((promedio === "0" || promedio==='') ? "/" : promedio) + '" id="promediot" disabled="disabled" style="background-color:#1F934C;color: white;font-weight:bold">';
	}
	else{
		tabla.childNodes[fila].childNodes[7].innerHTML='<input type="text" class="form-control" name="promediot" value="' + ((promedio === "0" || promedio==='') ? "/" : promedio) + '" id="promediot" disabled="disabled" style="background-color:#C4131B;color: white; font-weight:bold">';
	}

     

  }
  var bPreguntar = true;
window.onbeforeunload = preguntarAntesDeSalir;
function preguntarAntesDeSalir()
{
  if (bPreguntar)
    return "¿Seguro que quieres salir?";
}


$("body").on("keydown", "input, select, textarea", function(e) {
  var self = $(this),
    form = self.parents("form:eq(0)"),
    focusable,
    next;
  
  // si presiono el enter
  if (e.keyCode == 13) {
    // busco el siguiente elemento
    focusable = form.find("input").filter(":enabled");
    next = focusable.eq(focusable.index(this) + 1);
    // si existe siguiente elemento, hago foco
    if (next.length) {
      next.focus();
    }
    return false;
  }
});

</script>