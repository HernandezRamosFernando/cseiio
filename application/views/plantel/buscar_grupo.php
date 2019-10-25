<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Buscar grupos</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos requeridos para crear un grupo</li>
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
                <select class="form-control form-control-lg selcolor" name="grupos" id="grupos">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de grupos</span>
              </label>
            </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente()"
                style="padding: 1rem" id="crear_grupo">Mostrar grupo</button>
            </div>
          </div>
        </div>

        <div class="row" id="botones" style="display:none">
          <div class="col-md-6">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="btnagregar_alumnos();"
              style="padding: 1rem" id="agregar_alumnos">Agregar alumnos al grupo</button>
          </div>
          <div class="col-md-6">
            <button type="button" class="btn btn-warning btn-lg btn-block" onclick="btnquitar_alumnos();"
              style="padding: 1rem" id="quitar_alumnos">Quitar alumnos al grupo</button>
          </div>
        </div>


        <div class="row" id="alumnos_oculto" style="display: none">
          <div class="col-md-6" style="display: none" id="tabla_completa_alumnos"
            style="width: 100%;  overflow: scroll">
            <div class="card card-body" style="width: 100%; overflow: scroll">
            <p class="h5" id="">Alumnos registrados en este plantel</p>
              <p class="h5" id="contador_alumnos_restantes">Restantes para agregar: 0</p>
              <table class="table table-hover" id="tabla_completa" style="width: 100%; overflow: scroll">
                <caption>Lista de todos los alumnos de este semestre sin grupo</caption>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="col-md-1">Nombre completo</th>
                    <th scope="col" class="col-md-1">N° control</th>
                    <th scope="col" class="col-md-1">Sexo</th>
                    <th scope="col" class="col-md-1">Opción</th>
                  </tr>
                </thead>
                <tbody id="tabla">
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-6" id="tabla_alumnos">
            <div class="card card-body" style="width: 100%; overflow: scroll">
            <p class="h5" id="">Alumnos en el grupo</p>
              <p class="h5" id="contador_alumnos_agregados">Agregados: 0</p>
              <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%; overflow: scroll">
                <caption>Lista del Grupo creado</caption>
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="col-md-1">Nombre completo</th>
                    <th scope="col" class="col-md-1">N° control</th>
                    <th scope="col" class="col-md-1">Sexo</th>
                    <th scope="col" class="col-md-1">Opción</th>
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
      <button type="button" value="nuevo" onclick="enviar_formulario()" id="boton_agregar"
        class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem"> Guardar cambios</button>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<!--Empieza modal-->

<div class="modal" tabindex="-1" role="dialog" id="modal_cambiar_grupo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mensaje de advertencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="cambiar_grupo">
      <div class="modal-body">
        <p>No puede eliminar al estudiante del grupo actual debido a que tiene calificaciones asignadas hasta <span id="estatus_calificacion_parcial" style="font-weight: bold;"></span></p>
        <p>¿Desea cambialo de grupo? </p>
        
        <input type="hidden" id="no_control_alumno" name="no_control_alumno">
        <input type="hidden" id="id_grupo_a_modificar" name="id_grupo_a_modificar">
        <input type="hidden" id="id_fila_seleccionada" name="id_fila_seleccionada">
        
        
        <div class="form-group">
            <div class="row">
            <div class="col-md-12">
          <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="id_grupo_destino" id="id_grupo_destino" required="required" onclick='validar_grupo_alumnos(this)'>
                    <option value="">Seleccione el grupo</option>
                  </select>
                  <span>Lista de grupos</span>
                </label>
              </div>
              </div>
              </div>


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="opcion_eliminar" value="cambiar_grupo" onclick="">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal-->

<script>

  function validarcomponente() {

    if (document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != '') {
      buscar_estudiantes_grupo();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
    }
  }

  var lista_alumnos = new Array();
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
      xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_grupos_plantel_html?plantel=' + plantel + '&semestre=' + semestre, true);
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

  function btnagregar_alumnos() {
    //document.getElementById('agregar_alumnos').value = 
    document.getElementById('agregar_alumnos').classList.remove('btn-success');
    document.getElementById('agregar_alumnos').classList.add('btn-dark');
    document.getElementById('agregar_alumnos').disabled = true;
    document.getElementById('quitar_alumnos').style.display = "none";
    document.getElementById('tabla_completa_alumnos').style.display = "";
    document.getElementById('tabla_alumnos').classList.remove('col-md-12');
    document.getElementById('tabla_alumnos').classList.add('col-md-6');
    document.getElementById('agregar_oculto').style.display = "";
    buscar();

  }
  function btnquitar_alumnos() {
    document.getElementById('boton_agregar').value = "eliminar";
    document.getElementById('quitar_alumnos').classList.remove('btn-success');
    document.getElementById('quitar_alumnos').classList.add('btn-dark');
    document.getElementById('quitar_alumnos').disabled = true;
    document.getElementById('agregar_alumnos').style.display = "none";
    //document.getElementById('agregar_oculto').style.display = "";
    buscar_quitar_estudiantes();


  }




  function buscar() {
    var xhr = new XMLHttpRequest();
    var semestre = document.getElementById("semestre_grupo").value;
    var plantel = document.getElementById("plantel").value;
    var query = 'semestre=' + semestre + '&plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/get_estudiantes_plantel_semestre?' + query, true);
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
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.sexo;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="cambiardetabla(this);">Agregar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tabla").innerHTML += fila;
      });
      //console.log(JSON.parse(xhr.response));
      document.getElementById("contador_alumnos_restantes").innerText = "Alumnos restantes: " + JSON.parse(xhr.response).length;
      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('boton_agregar').style.display = "";
    document.getElementById('alumnos_oculto').style.display = "";
    limpiarbusqueda();
  }

  function buscar_estudiantes_grupo() {



    idgrupo = document.getElementById("grupos").value;
    console.log(idgrupo);
    document.getElementById("tablagrupo").innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo?id_grupo=' + idgrupo, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();

      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(xhr.response);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.primer_apellido + " " + valor.segundo_apellido + " " + valor.nombre;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.sexo;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-dark" type="button" value="' + valor.no_control + '" id="botoncambio" disabled="true">Deshabilitado</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
      });
      document.getElementById("contador_alumnos_agregados").innerText = "Alumnos agregados: " + JSON.parse(xhr.response).length;
      //console.log(JSON.parse(xhr.response).length);
      //tabla_restantes = document.getElementById("tabla");

      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('alumnos_oculto').style.display = "";
    document.getElementById('botones').style.display = "";
    document.getElementById('tabla_alumnos').classList.remove('col-md-6');
    document.getElementById('tabla_alumnos').classList.add('col-md-12');
    limpiarbusqueda();

  }

  function limpiarbusqueda() {
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-info');
    document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
    document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
  }

  function buscar_quitar_estudiantes() {
    idgrupo = document.getElementById("grupos").value;
    console.log(idgrupo);
    document.getElementById("tablagrupo").innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo?id_grupo=' + idgrupo, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      var cont=1;
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        
        var fila = '<tr id="fila'+cont+'">';
        fila += '<td>';
        fila += valor.primer_apellido + " " + valor.segundo_apellido + " " + valor.nombre;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.sexo;
        fila += '</td>';
        fila += '<td class="" >';
        fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="eliminar(\'fila'+cont+'\',this)" >Eliminar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
        cont=cont+1;
      });
      //formato_tabla();


      var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
      lista_alumnos = new Array();
      for (let i = 0; i < alumnos.length; i++) {
        lista_alumnos.push(alumnos[i].children[1].innerText);
      }

      console.log(lista_alumnos);
    };
    xhr.send(null);
    document.getElementById('alumnos_oculto').style.display = "";
    document.getElementById('botones').style.display = "";
    document.getElementById('tabla_alumnos').classList.remove('col-md-6');
    document.getElementById('tabla_alumnos').classList.add('col-md-12');
    limpiarbusqueda();
  }
  function enviar_formulario() {
    if (document.getElementById("boton_agregar").value != "eliminar") {


      var tabla = document.getElementById("tabla_completa_grupo");
      var filas = tabla.children[2].children;
      var estudiantes = new Array();

      for (let i = 0; i < filas.length; i++) {
        //console.log(filas[i].children[2].children.botoncambio.disabled);
        if (filas[i].children[3].children.botoncambio.disabled === false) {
          estudiantes.push(filas[i].children[3].children.botoncambio.value);
        }
      }

      var datos = {
        estudiantes: estudiantes,
        id_grupo: document.getElementById("grupos").value,
        semestre: document.getElementById("semestre_grupo").value
      }

      var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_estudiantes_grupo_editado', true);
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

            var friae = new XMLHttpRequest();
            friae.open("POST", '<?php echo base_url();?>index.php/c_friae/agregar_estudiantes_friae', true);

            //Send the proper header information along with the request
            friae.setRequestHeader("Content-Type", "application/json");
            friae.onloadstart = function () {
              $('#div_carga').show();
            }
            friae.error = function () {
              console.log("error de conexion");
            }
            friae.onreadystatechange = function () { // Call a function when the state changes.
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                $('#div_carga').hide();
                if (friae.responseText.trim() === "si") {
                  console.log(friae.response);
                  swalWithBootstrapButtons.fire({
                    type: 'success',
                    text: 'Datos guardados correctamente',
                    allowOutsideClick: false,
                    confirmButtonText: 'Aceptar'
                  }).then((result) => {
                    if (result.value) {
                      //aqui va el aceptar
                      $(document).scrollTop(0);
                      location.reload();
                    }
                    //aqui va si cancela
                  });
                }
              }
            }
            friae.send(JSON.stringify(datos));


          } else {
            Swal.fire({
              type: 'error',
              text: 'Alumnos no guardados'
            });
          }
        }
      }
      xhr.send(JSON.stringify(datos));
    }
  }


  function eliminar_de_grupo(e) {
    swalWithBootstrapButtons.fire({
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    text: 'Si elimina al alumno se perderán sus datos de grupo actual',
                  }).then((result) => {
                    if (result.value) {
                      //aqui va el aceptar
                      $(document).scrollTop(0);
                      location.reload();
                    }
                    //aqui va si cancela
                  });
   
}

function cambiar_grupo(e) {
   
  }


  function eliminar(fila_seleccionada,e) {
    console.log("Este es el valor de seleccionado");
    console.log(e);
   // $('#modal_opcion_eliminar').modal('show');
    
   var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_estudiante/obtener_datos_parciales/'+e.value, true);
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
        var parciales_presentados='Ninguno';
        var num_parcial=0;
        if(datos.p1>0 && datos.p2==0 && datos.p3==0 && datos.ef==0){
          parciales_presentados='Primer parcial';
          num_parcial=1;
        }
        if(datos.p2>0 && datos.p2>0 && datos.p3==0 && datos.ef==0){
          parciales_presentados='Segundo parcial';
          num_parcial=2;
        }
        if(datos.p3>0 && datos.p2>0 && datos.p3>0 && datos.ef==0){
          parciales_presentados='Tercer parcial';
          num_parcial=3;
        }
        if(datos.p3>0 && datos.p2>0 && datos.p3>0 && datos.ef>0){
          parciales_presentados='Examen final';
          num_parcial=4;
        }

        if(num_parcial==0){ // Si el alumno no ha realizado ninguna evaluacion entra aqui
		
		
		var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
          var alumnos_json = new Array();
          for (let i = 0; i < alumnos.length; i++) {
            alumnos_json.push(alumnos[i].children[1].innerText);
          }
            console.log("EStos son los restantes: "+alumnos_json.length);
          if (alumnos_json.length === 1) {
            swalWithBootstrapButtons.fire({
              type: 'warning',
              text: 'Al quitar todos los alumnos se borrará el grupo ¿Está seguro?',
              showCancelButton: true,
              confirmButtonText: 'Aceptar',
              cancelButtonText: 'Cancelar',
            }).then((result) => {
              if (result.value) {
                var xhr_eliminar = new XMLHttpRequest();
                xhr_eliminar.open("POST", '<?php echo base_url();?>index.php/c_grupo/delete_grupo', true);

                //Send the proper header information along with the request
                xhr_eliminar.setRequestHeader("Content-Type", "application/json");
                xhr_eliminar.onloadstart = function () {
              $('#div_carga').show();
            }
            xhr_eliminar.error = function () {
              console.log("error de conexion");
            }
            xhr_eliminar.onreadystatechange = function () { // Call a function when the state changes.
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                $('#div_carga').hide();
                    console.log(xhr_eliminar.response);
                    swalWithBootstrapButtons.fire({
                      type: 'success',
                      text: 'Datos guardados correctamente',
                      allowOutsideClick: false,
                      confirmButtonText: 'Aceptar'
                    }).then((result) => {
                      if (result.value) {
                        //aqui va el aceptar
                        $(document).scrollTop(0);
                        location.reload();
                      }
                      //aqui va si cancela
                    });
                  }
                }
                xhr_eliminar.send(JSON.stringify({ id_grupo: document.getElementById("grupos").value }));

              }
              //aqui va si cancela
            });
          }

          else {
		
		
		

          swalWithBootstrapButtons.fire({
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    text: 'Desea eliminar al alumno del grupo?',
                  }).then((result) => {
                    if (result.value) {
                      //aqui va el aceptar
                     /* $(document).scrollTop(0);
                      location.reload();*/
									  var estudiante = new Array();
									  estudiante.push(e.value);
				
							var datos_eliminar = {
							  id_grupo: document.getElementById("grupos").value,
							  eliminados: estudiante
							}

								var eliminar_estudiante = new XMLHttpRequest();
								eliminar_estudiante.open("POST", '<?php echo base_url();?>index.php/c_grupo/delete_estudiantes_grupo', true);
								eliminar_estudiante.onloadstart = function () {
								  $('#div_carga').show();
								}
								eliminar_estudiante.error = function () {
								  console.log("error de conexion");
								}
								eliminar_estudiante.onreadystatechange = function () { // Call a function when the state changes.
								  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
									$('#div_carga').hide();
									if (eliminar_estudiante.responseText.trim() === "si") {
					
									  var friae = new XMLHttpRequest();
									  friae.open("POST", '<?php echo base_url();?>index.php/c_friae/quitar_estudiante', true);
					
									  //Send the proper header information along with the request
									  friae.setRequestHeader("Content-Type", "application/json");
									  friae.onloadstart = function () {
								  $('#div_carga').show();
								}
								friae.error = function () {
								  console.log("error de conexion");
								}
								friae.onreadystatechange = function () { // Call a function when the state changes.
								  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
									$('#div_carga').hide();
										  if (friae.responseText.trim() === "si") {
											swalWithBootstrapButtons.fire({
											  type: 'success',
											  text: 'Datos guardados correctamente',
											  confirmButtonText: 'Aceptar'
											}).then((result) => {
											  if (result.value) {
												//aqui va el aceptar
											//	$(document).scrollTop(0);
												//location.reload();
                        
											  }
                        $('#'+fila_seleccionada).remove();
                        contador_tablas();
											  //aqui va si cancela
											});
										  }
										}
									  }
									  friae.send(JSON.stringify(datos_eliminar));
									  /*
					  
										  
										  */
					
									} else {
									  Swal.fire({
										type: 'error',
										text: 'Datos no guardados'
									  });
									}
								  }
								}
								eliminar_estudiante.send(JSON.stringify(datos_eliminar));
                      
                    }
                    //aqui va si cancela
                  });
		  		}
				
				
				
				
        
			}//TErmina condicion si i el alumno no ha realizado ninguna evaluacion entra aqui
          else if(num_parcial>0 && num_parcial<=3){//Empieza validacion si num_parcial es menor o igual a 3
           
            var lista_grupo = new XMLHttpRequest();
            lista_grupo.open('GET', '<?php echo base_url();?>index.php/C_grupo/get_lista_grupos_estudiante?plantel='+document.getElementById("plantel").value+'&grupo='+document.getElementById("grupos").value+'&semestre='+document.getElementById("semestre_grupo").value, true);
            lista_grupo.onloadstart = function(){
                    $('#div_carga').show();
                  }
                  lista_grupo.error = function (){
                    console.log("error de conexion");
                  }
                  lista_grupo.onload = function(){
                    $('#div_carga').hide();
                    document.getElementById("id_grupo_destino").innerHTML = lista_grupo.responseText;
                    
                  }

                  lista_grupo.send(null);
            document.getElementById('id_fila_seleccionada').value=fila_seleccionada;
            document.getElementById('id_grupo_a_modificar').value=document.getElementById('grupos').value;
            document.getElementById('estatus_calificacion_parcial').innerHTML =parciales_presentados;
            document.getElementById('no_control_alumno').value=e.value;
            $('#modal_cambiar_grupo').modal('show');
          }//Termina si es menor a tercer parcial
          else{ // Si ek numero de parciales es examen final
                  Swal.fire({
                  type: 'error',
                  scrollbarPadding:false,
                  title: "No puede realizar la modificación del grupo, consulte al Depto. de Control Escolar.",
                  showConfirmButton: false,
                  timer: 2500 
                });
          }
      }

      xhr.send(null);
         
    /*var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for (let i = 0; i < alumnos.length; i++) {
      alumnos_json.push(alumnos[i].children[1].innerText);
    }
    console.log(alumnos_json);
    */
    
    contador_tablas();

    
  }


  var form = document.getElementById("cambiar_grupo");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/C_grupo/modificar_grupo",true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      $('#div_carga').hide();
      let datos = JSON.parse(xhr.response);
      if (typeof datos.exito !== 'undefined'){
      
        Swal.fire({
            type: 'success',
            scrollbarPadding:false,
            title: datos.exito,
            showConfirmButton: false,
            timer: 2500 
          });
         
          $('#'+document.getElementById('id_fila_seleccionada').value).remove();
          $('#modal_cambiar_grupo').modal('toggle');
          contador_tablas();
      }

      if (typeof datos.error !== 'undefined'){
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: datos.error,
            showConfirmButton: false,
            timer: 2500 
          });
      }
      

    }
}
		xhr.send(formdata);
		contador_tablas();
	}


  function validar_grupo_alumnos(e){
    var id_grupo="";
    var id_grupo_actual="";
    id_grupo_actual=document.getElementById("grupos").value;
    id_grupo=e.value;

    if(id_grupo==id_grupo_actual){
      Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'No puede seleccionar el grupo actual donde se encuentra el estudiante',
            showConfirmButton: false,
            timer: 2500 
          });

          document.getElementById('id_grupo_destino').value="";
    }
    


  }

</script>

</html>