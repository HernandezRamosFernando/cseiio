<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Nulidad del Semestre</a>
      </li>
      <li class="breadcrumb-item active">Busque al alumno que desea aplicar el proceso de nulidad</li>
    </ol>


    <div class="card">
      <div class="card-body">

        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="curp_busqueda">CURP</label>
              </div>
            </div>

          </div>


        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-8">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" required="required" id="plantel_busqueda"
                name="plantel_busqueda">
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
        <table class="table table-hover" id="tabla_completa">
          <caption>Lista de alumnos con derecho a traslado</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Semestre en curso</th>
              <th scope="col" class="col-md-1">Grupo</th>
              <th scope="col" class="col-md-1">Situación del alumno</th>
              <th scope="col" class="col-md-1"></th>
                   

            </tr>
          </thead>
          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>






</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->




<!-- Modal generar traslado--------------------------------------------------->
  <div class="modal fade" id="solicitar_nulidad_semestre" tabindex="-1" role="dialog" aria-labelledby="modaleliminarTitle">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;"  role="document">
      <div class="modal-content">
        
        <div class="modal-body">
            <form id="solicitar_nulidad" method="post">
            <!--datos personales------------------------------------------------------>
           
           <input type="hidden" name="id_plantel" id="id_plantel">
           

          <p class="text-center text-white rounded titulo-form h4">
            Datos Personales de Aspirante
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="no_control_estudiante" name="no_control_estudiante" placeholder="Nombre Completo" readonly>
                  <label for="no_control_estudiante">No. de Control</label>
                </div>
              </div>
              <div class="col-md-9">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="nombre_completo" name="nombre_completo"placeholder="Nombre Completo" readonly>
                  <label for="nombre_completo">Nombre Completo</label>
                </div>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="semestre" name="semestre" placeholder="Semestre en curso" readonly>
                  <label for="semestre">Semestre</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="grupo" name="grupo" placeholder="grupo" readonly>
                  <label for="grupo">Grupo</label>
                </div>
              </div>

            </div>
          </div>


	<p class="text-center text-white rounded titulo-form h4">
            Datos para nulidad del semestre
            <hr>
    </p>

		<div class="form-group">
            <div class="row">

              <div class="col-md-6">
                <label class="form-group has-float-label">
                <select class="form-control form-control-lg" required="required" id="semestre_nulidad"
                  name="semestre_nulidad">
                  <option value="">Seleccione el semestre</option>
                  
                </select>
                <span>Semestre a aplicar</span>
              </label>
              </div>


              <div class="col-md-6">
                <label class="form-group has-float-label">
                <select class="form-control form-control-lg" required="required" id="motivo_nulidad"
                  name="motivo_nulidad">
		                  <option value="">Seleccione el motivo</option>
		                  <option value="Salud">Salud</option>
		                  <option value="Personal">Personal</option>
		                  <option value="Economico">Económico</option>
		                  <option value="Cambios de residencia">Cambios de residencia</option>
                </select>
                <span>Motivo nulidad semestre</span>
              </label>
              </div>


            </div>
          </div>


          <p class="text-center text-white rounded titulo-form h4"> Documentos solicitados
            <hr>
         </p> 


         <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="documento_solicitud_nulidad"
              id="documento_solicitud_nulidad" value="1" unchecked required="required">
            Solicitud de nulidad del semestre.
          </label>
        </div>


          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
         <button type="submit" id="btn_enviar" class="btn btn-success">Aceptar</button>
          </div>


          </form>
        </div>
        
      
      </div>
    </div>
</div>
<!-- Modal -->

<script>

 

function cargar_datos_solicitud_nulidad(no_control){
  
              var option = document.createElement("option");
              semestre_nulidad.innerHTML = "";
              option.text = "Seleccione el semestre";
              option.value = "";
              semestre_nulidad.add(option);

              document.getElementById("solicitar_nulidad").reset();

	var no_control=no_control.value;
	var xhr = new XMLHttpRequest();
	      var query = 'no_control=' +no_control;
	    xhr.open('GET', '<?php echo base_url();?>index.php/C_estudiante/get_estudiante_datos_semestre_grupo_calificacion?' + query, true);
	    xhr.onloadstart = function () {
	      $('#div_carga').show();
	    }
	    xhr.error = function () {
	      console.log("error de conexion");
	    }
		    xhr.onload = function () {
		      $('#div_carga').hide();
		    let estudiante = JSON.parse(xhr.response);

		    var validacion_resultado="";

                      if(estudiante[0].tipo_ingreso==='BAJA' && estudiante[0].tipo_ingreso==='REPROBADO' && estudiante[0].tipo_ingreso==='NUEVO INGRESO' && estudiante[0].tipo_ingreso==='PORTABILIDAD'){
                            validacion_resultado+="<p style='text-align:left;margin-left:20%'> - El estatus del alumno es "+estudiante[0].tipo_ingreso+".</p>";
                      }


                       if(estudiante[0].faltantes>0){
                            validacion_resultado+="<p style='text-align:left;margin-left:20%'> - El alumno adeuda documentación.</p>";
                      }



                      if( typeof estudiante[0].matricula == 'undefined' ){
                            validacion_resultado+="<p style='text-align:left;margin-left:20%'> - El alumno no cuenta con matricula.</p>";
                      }



               if(validacion_resultado===""){


			              semestre_nulidad.innerHTML = "";

			              var option = document.createElement("option");
			              option.text = "Seleccione el semestre";
			              option.value = "";
			              for(x=1;x<=estudiante[0].semestre_en_curso;x++){
			              		var option = document.createElement("option");
					            option.text =x;
					            option.value = x;
					            semestre_nulidad.add(option);
			              }
			              
			              

               			$('#solicitar_nulidad_semestre').modal('show');
               			var grupo="";
							   document.getElementById("id_plantel").value=estudiante[0].Plantel_cct_plantel;
					        document.getElementById("nombre_completo").value=estudiante[0].nombre+" "+estudiante[0].primer_apellido+" "+estudiante[0].segundo_apellido;

					        document.getElementById("semestre").value=estudiante[0].semestre_en_curso;

					        document.getElementById("no_control_estudiante").value=estudiante[0].no_control;

					        
					        if(typeof estudiante[0].nombre_grupo == 'undefined'){
					            grupo="Sin grupo asignado";
					        }
					        else{
					          grupo=estudiante[0].nombre_grupo;
					        }
					        document.getElementById("grupo").value=grupo;

			               }

			       else{
			       			Swal.fire({
                            type: 'warning',
                            scrollbarPadding:false,
                            title: 'Información!',
                            html: "<p>No puede realizar el proceso de nulidad del semestre, debido a:</p>"+validacion_resultado
                          })

			        }


		  };

		  xhr.send(null);

}


function enviar_solicitud(form_solicitar_nulidad){

var formdata = new FormData(form_solicitar_nulidad);
            var xhr_2 = new XMLHttpRequest();
            xhr_2.open("POST", "<?php echo base_url();?>index.php/C_nulidad_semestre/solicitar_nulidad", true);
            xhr_2.onreadystatechange = function () {
              if (xhr_2.responseText === "si") {
                  Swal.fire({
                    type: 'success',
                    scrollbarPadding:false,
                    title: 'Solicitud registrada exitosamente',
                    showConfirmButton: false,
                    timer: 2500
                  })
                  $('#solicitar_nulidad_semestre').modal('hide');
                  
                } else {
                  Swal.fire({
                    type: 'error',
                    scrollbarPadding:false,
                    title: 'Ha ocurrido un error en solicitud de nulidad',
                    confirmButtonText: 'Cerrar'

                  })
                }
              
            }
            xhr_2.send(formdata);

            refrescar_tabla();

}








var form_solicitar_nulidad = document.getElementById("solicitar_nulidad");
  form_solicitar_nulidad.onsubmit = function (e) {
    e.preventDefault();

				id_semestre_nulidad=document.getElementById('semestre_nulidad').value;

                 if(id_semestre_nulidad==1){
                        swalWithBootstrapButtons.fire({
                        type: 'warning',
                        text: '¿Esta seguro de que desea solicitar el proceso de nulidad hasta primer semestre?, En caso de ser aprobado ocacionaría que los semestres cursados por el alumno sean invalidos y tendrá que registrar al alumno como de nuevo ingreso.',
                        confirmButtonText: 'Aceptar',
                        scrollbarPadding:false,
                        showCancelButton: 'true',
                        cancelButtonText: 'Cancelar'
                      }).then((result) => {
                        if (result.value) {
                             enviar_solicitud(form_solicitar_nulidad);
                             
                        } 

                      });

                 }
                 else{
                      enviar_solicitud(form_solicitar_nulidad);
                 }
                  
   


    }



  function buscar() {
    document.getElementById("plantel_busqueda").disabled = true;
      document.getElementById("curp_busqueda").disabled = true;
      document.getElementById("tabla").innerHTML = "";



      var xhr = new XMLHttpRequest();
      var curp_busqueda = document.getElementById("curp_busqueda").value;
      var plantel_busqueda = document.getElementById("plantel_busqueda").value;

      var query = 'curp=' + curp_busqueda + '&plantel=' + plantel_busqueda;
    xhr.open('GET', '<?php echo base_url();?>index.php/C_nulidad_semestre/get_alumnos?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      console.log(JSON.parse(xhr.response));
      ////console.log(query);


      JSON.parse(xhr.response).forEach(function (valor, indice) {
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
        fila += valor.semestre_en_curso;
        fila += '</td>';

		var grupo="";
        if(valor.Grupo_id_grupo===null){
            grupo="Sin grupo asignado";
        }
        else{
            grupo=valor.nombre_grupo;
        }

        fila += '<td>';
        fila += grupo;
        fila += '</td>';
        
        fila += '<td>';
        fila += valor.tipo_ingreso;
        fila += '</td>';

        var agregar_html='',agregar_html_2='Solicitar nulidad semestre',clase_boton='btn btn-success btn-block';
        if(valor.por_autorizar==0){
        		agregar_html='disabled="disabled"';
        		agregar_html_2='Por autorizar solicitud';
        		clase_boton='btn btn-warning btn-block';
        }


        fila += '<td>';
        fila += '<button class="'+clase_boton+'" type="button" value="' +valor.no_control+'" onclick="cargar_datos_solicitud_nulidad(this)" '+agregar_html+'>'+agregar_html_2+'</button>';
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
    document.getElementById('btn_buscar').classList.add('btn-dark');
    document.getElementById('busqueda_oculto').style.display="";

}


function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }



</script>