<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Realizar traslado</a>
      </li>
      <li class="breadcrumb-item active">Busque al alumno que desea trasladar al plantel</li>
    </ol>


    <div class="card">
      <div class="card-body">

        <div class="form-group">

          <div class="row">
            <div class="col-md-6">
              <div class="form-label-group ">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="aspirante_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="aspirante_curp_busqueda">CURP</label>
              </div>
            </div>

            <div class="col-md-6">
            <div class="form-label-group ">
                <input type="text" title="Faltan datos" class="form-control text-uppercase"
                  id="matricula_busqueda" placeholder="CURP" style="color: #237087">
                <label for="matricula_busqueda">Matricula</label>
              </div>
            </div>

          </div>


        </div>

        <div class="form-group">
          <div class="row">    
            <div class="col-md-12">
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
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Matricula</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Semestre en curso</th>
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
  <div class="modal fade" id="generar_traslado" tabindex="-1" role="dialog" aria-labelledby="modaleliminarTitle">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;"  role="document">
      <div class="modal-content">
        
        <div class="modal-body">
            <form id="nuevo_traslado" method="post">
            <!--datos personales------------------------------------------------------>
           <input type="hidden" name="cct_plantel_origen" id="cct_plantel_origen">
           <input type="hidden" name="id_grupo" id="id_grupo">
           <input type="hidden" name="tipo_ingreso" id="tipo_ingreso">

          <p class="text-center text-white rounded titulo-form h4">
            Datos Personales de Aspirante
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="nombre_completo" name="nombre_completo"placeholder="Nombre Completo" readonly>
                  <label for="nombre_completo">Nombre Completo</label>
                </div>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="num_control" name="num_control" placeholder="No. de Control" readonly>
                  <label for="num_control">No. de Control</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="matricula" name="matricula" placeholder="matricula" readonly>
                  <label for="matricula">Matricula</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="semestre_en_curso" name="semestre_en_curso" placeholder="semestre en curso" readonly>
                  <label for="semestre_en_curso">Semestre en curso</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="grupo" name="grupo" placeholder="grupo" readonly>
                  <label for="grupo">Grupo</label>
                </div>
              </div>

            </div>
          </div>


          


          <div class="form-group">
            <div class="row">
            <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="parcial_presentado" name="parcial_presentado" placeholder="parcial presentado" readonly>
                  <label for="parcial_presentado">Parciales presentados</label>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="plantel_actual" name="plantel_actual" placeholder="Plantel donde se encuentra inscrito" readonly>
                  <label for="plantel_actual">  Plantel donde se encuentra inscrito actualmente</label>
                </div>
              </div>
            </div>
          </div>




      <p class="text-center text-white rounded titulo-form h4">
            Datos para realizar traslado
            <hr>
          </p>

         <div class="form-group">
            <div class="row">
            <div class="col-md-12">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="plantel_para_traslado" name="plantel_para_traslado" onchange="cargargrupos()">
                  
                  <?php
                      foreach ($planteles as $plantel)
                      {
                      echo '<option value="'.$plantel->cct_plantel.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct_plantel.'</option>';
                      }
                      ?>

                </select>
                <span>Plantel a Trasladar</span>
              </label>

            </div>
            </div>
          </div>


          <div class="form-group" style="display:none" id="div_grupo">
            <div class="row">
              <div class="col-md-12">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="grupos" id="grupos" onchange="validar_num_alumnos_grupos()">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de grupos</span>
              </label>

            </div>
            </div>
          </div>


         <p class="text-center text-white rounded titulo-form h4"> Documentos solicitados
            <hr>
         </p> 


         <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="documento_presentacion_bic_bic"
              id="documento_presentacion_bic_bic" value="1" unchecked>
            Carta de presentación de BIC a BIC.
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="documento_carta_buena_conducta"
              id="documento_carta_buena_conducta" value="7" unchecked>
            Carta de buena conducta.
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="documento_historial_academico"
              id="documento_historial_academico" value="2" unchecked>
            Historial académico con fotografía.
          </label>
        </div>


        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="documento_constancia_de_no_adeudo"
              id="documento_constancia_de_no_adeudo" value="3" unchecked">
            Constancia de no adeudo firmada por el comité o la autoridad municipal.
          </label>
         </div>




          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
         <button type="submit" id="btn_enviar" class="btn btn-success" disabled="disabled">Aceptar</button>
          </div>




          </form>
        </div>
        
      
      </div>
    </div>
</div>
<!-- Modal -->

<script>

  function cargar_datos_traslado(id_estudiante){
              document.getElementById('div_grupo').style.display = "none";
              var option = document.createElement("option");
              grupos.innerHTML = "";
              option.text = "Seleccione uno";
              option.value = "";
              grupos.add(option);
              document.getElementById('grupos').removeAttribute('required');
                     document.getElementById('nuevo_traslado').reset();
                      
                      var xhr = new XMLHttpRequest();
                        var query = 'no_control=' +id_estudiante.value;
                      xhr.open('GET', '<?php echo base_url();?>c_estudiante/get_estudiante_datos_semestre_grupo_calificacion?' + query, true);
                      
                      xhr.error = function () {
                        console.log("error de conexion");
                      }
                      xhr.onload = function () {
                      let estudiante = JSON.parse(xhr.response);
                      var validacion_resultado="";

                      var semestre = estudiante[0].semestre;
                      var semestre_curso = estudiante[0].semestre_en_curso;

                      var restantes = (6 - semestre_curso) + parseInt(semestre);
                      if(restantes> 12){
                        validacion_resultado+="<p style='text-align:left;margin-left:30%'> - No puede realizar el proceso porque el alumno ha rebasado el límite de 12 semestres permitido por el Depto. de Control Escolar.</p>";
                      }

                      if(estudiante[0].matricula===null){
                            validacion_resultado+="<p style='text-align:left;margin-left:30%'> - El alumno no cuenta con matricula.</p>";
                      }

                      

                      if(estudiante[0].faltantes>0){
                            validacion_resultado+="<p style='text-align:left;margin-left:30%'> - El alumno adeuda documentación base.</p>";
                      }


                      if(validacion_resultado===""){
                        $('#generar_traslado').modal('show');
                                document.getElementById("nombre_completo").value =estudiante[0].nombre+" "+estudiante[0].primer_apellido+" "+estudiante[0].segundo_apellido;
                            document.getElementById("num_control").value =estudiante[0].no_control;
                            document.getElementById("matricula").value=estudiante[0].matricula;
                            document.getElementById("semestre_en_curso").value=estudiante[0].semestre_en_curso;
                            document.getElementById("plantel_actual").value=estudiante[0].nombre_plantel;
                            document.getElementById("cct_plantel_origen").value=estudiante[0].Plantel_cct_plantel;

                            document.getElementById("tipo_ingreso").value=estudiante[0].tipo_ingreso;

                            
                                var parciales_presentados="",p1="",p2="";

                                if(estudiante[0].num_primer_parcial>0){
                                  parciales_presentados="Hasta primer parcial";
                                    
                                }

                                if(estudiante[0].num_segundo_parcial>0){
                                  parciales_presentados="Hasta segundo parcial";
                                    
                                }


                                if(estudiante[0].num_tercer_parcial>0){
                                  parciales_presentados="Hasta tercer parcial";
                                    
                                }


                                if(estudiante[0].num_examen_final>0){
                                  parciales_presentados="Hasta examen final";
                                    
                                }


                                if(estudiante[0].num_calificacion_final>0){
                                  parciales_presentados="Hasta calificacion final";
                                    
                                }


                                if(parciales_presentados===""){
                                  parciales_presentados="Ningún parcial presentado";
                                }

                                document.getElementById("parcial_presentado").value=parciales_presentados;
                            

                             if(typeof estudiante[0].id_grupo !== 'undefined'){
                                    
                                    document.getElementById("id_grupo").value=estudiante[0].id_grupo;
                                    cargargrupos();
                                }
                                else{
                                    document.getElementById("id_grupo").value="";
                                    
                                    

                                }

                            var id_grupo = estudiante[0].nombre_grupo;
                            var componente="";

                            if(typeof id_grupo !== 'undefined' && id_grupo !== null){
                              var arreglo=id_grupo.split("-");
                                  if(arreglo.length>0){
                                    componente= arreglo[1];
                                  }

                            }

                            

                            var grupo="";
                            if(typeof estudiante[0].nombre_grupo !== 'undefined' && estudiante[0].nombre_grupo !== null){
                                    
                                    grupo=estudiante[0].nombre_grupo;
                                }
                                else{
                                    grupo="Sin grupo asignado";
                                }
                            document.getElementById("grupo").value=grupo;

                        if(estudiante[0].semestre_en_curso>=5){
                          
                            var xhr_plantel = new XMLHttpRequest();
                               var query = 'no_control=' +estudiante[0].no_control+'&semestre='+estudiante[0].semestre_en_curso+'&id_componente='+componente;
                               xhr_plantel.open('GET', '<?php echo base_url();?>index.php/C_plantel/get_lista_planteles_especialidad_traslado_html?' + query, true);
                              
                                  xhr_plantel.error = function () {
                                    console.log("error de conexion");
                                  }
                                  xhr_plantel.onload = function () {
                                  
                                  if (xhr_plantel.response === "") {
                                         document.getElementById("plantel_para_traslado").innerHTML ="<option value=''>No existen planteles disponibles con el componente seleccionado del alumno</option>";
                                        
                                      } 
                                      else {
                                        
                                        document.getElementById("plantel_para_traslado").innerHTML =xhr_plantel.responseText;
                                      }
                                  
                                          
                                };

                                xhr_plantel.send(null);

                          }

                      }

                      else{

                        Swal.fire({
                            type: 'warning',
                            title: 'Información!',
                            html: "<p>No puede realizar el proceso de traslado, debido a:</p>"+validacion_resultado
                          })
                      }

                      
                       
                              
                    };

                    xhr.send(null);

  }


	function buscar() {
		document.getElementById("matricula_busqueda").disabled = true;
	    document.getElementById("aspirante_curp_busqueda").disabled = true;
	    document.getElementById("tabla").innerHTML = "";



	    var xhr = new XMLHttpRequest();
	    var curp = document.getElementById("aspirante_curp_busqueda").value;
	    var matricula = document.getElementById("matricula_busqueda").value;
      var query = 'curp=' + curp + '&matricula=' + matricula;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiantes_porsibles_traslados?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      ////console.log(query);


      JSON.parse(xhr.response).forEach(function (valor, indice) {
        var fila = '<tr>';

        fila += '<td>';
        fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += '</td>';


        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';

        var num_matricula="";

        if(valor.matricula !== null){
        	num_matricula=valor.matricula;
        }

        fila += '<td>';
        fila += num_matricula;
        fila += '</td>';

        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';


        fila += '<td>';
        fila += valor.semestre_en_curso;
        fila += '</td>';

        fila += '<td>';
        fila += '<button class="btn btn-success" type="button" value="' + valor.no_control + '" onclick="cargar_datos_traslado(this)" class="btn btn-lg btn-block btn-info btn btn-primary">Cargar datos</button>';
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





var form_nuevo_traslado = document.getElementById("nuevo_traslado");
  form_nuevo_traslado.onsubmit = function (e) {
    e.preventDefault();
    
	    	var formdata = new FormData(form_nuevo_traslado);
		    var xhr_2 = new XMLHttpRequest();
		    xhr_2.open("POST", "<?php echo base_url();?>index.php/c_estudiante/nuevo_traslado", true);
		    xhr_2.onreadystatechange = function () {
		      if (xhr_2.responseText.trim() == "si") {
            
                //document.getElementById("tabla").innerHTML = "";
  		          Swal.fire({
  		            type: 'success',
                  scrollbarPadding:false,
  		            title: 'Traslado exitoso',
  		            showConfirmButton: false,
  		            timer: 2500
  		          })
  		          
                $('#generar_traslado').modal('toggle');
                
                
		          
		        } else {
		          Swal.fire({
		            type: 'error',
                scrollbarPadding:false,
		            title: 'Ha ocurrido un error en el proceso de traslado',
		            confirmButtonText: 'Cerrar'

		          })
		        }

                
		      
		    }
		    xhr_2.send(formdata);

        borrar_formato_tabla();
          buscar();
        
        
        

    }

    



 function cargargrupos() {
 	document.getElementById("btn_enviar").setAttribute('disabled','disabled');
   var plantel = document.getElementById("plantel_para_traslado").value;
      console.log(plantel);

      var semestre = document.getElementById("semestre_en_curso").value;
      console.log(semestre);
    
    if(plantel==document.getElementById("cct_plantel_origen").value){
            Swal.fire({
            type: 'error',
            title: 'No puede seleccionar el mismo plantel de origen.',
            confirmButtonText: 'Cerrar'

          })

            document.getElementById("plantel_para_traslado").value="";
            var option = document.createElement("option");
              grupos.innerHTML = "";
              option.text = "Seleccione uno";
              option.value = "";
              grupos.add(option);
              document.getElementById('grupos').removeAttribute('required');

    }

     else{

        if(document.getElementById('id_grupo').value!==''){
          document.getElementById('div_grupo').style.display = "inline";
          var xhr = new XMLHttpRequest();
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
            var grupo_origen='';
                  grupo_origen=document.getElementById("id_grupo").value;
            if (xhr.response === "") {

              

                  var option = document.createElement("option");
                  option.text = "Ningun grupo creado";
                  option.value = "";
                  grupos.add(option);
                  document.getElementById('grupos').removeAttribute('required');
                  document.getElementById('btn_enviar').removeAttribute('disabled');
              if(grupo_origen!=""){
                      Swal.fire({
                        type: 'error',
                        title: 'No puede realizar el traslado porque el alumno tiene un grupo asignado y en el planel de destino aun no se ha creado un grupo.',
                        confirmButtonText: 'Cerrar'

                      })
                      document.getElementById('btn_enviar').setAttribute('disabled','disabled');

                }
                  
              
            } else {
              console.log(xhr.response);
              document.getElementById('grupos').setAttribute('required','required');
              grupos.innerHTML ="<option value=''>Seleccione un grupo</option>"+xhr.responseText;
            }
          };
          xhr.send(null);
     }

        else{
                    document.getElementById('grupos').removeAttribute('required');
                    document.getElementById('btn_enviar').removeAttribute('disabled');
        }

     }
      
    }
  




 function validar_num_alumnos_grupos() {

 	var id_grupo="";
     id_grupo=document.getElementById("grupos").value;

     var xhr = new XMLHttpRequest();
     var query = 'id_grupo=' +id_grupo;
     xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_num_estudiantes_grupo?' + query, true);
    
    
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
    let alumnos = JSON.parse(xhr.response);
    var num_alumnos=0;
    if (alumnos[0].num_alumnos==null){
    	num_alumnos=0;
    }
    else{
    	num_alumnos=alumnos[0].num_alumnos;
    }

console.log("num_alumnos: "+num_alumnos);
    if(num_alumnos>=36){
    	
    	Swal.fire({
		            type: 'error',
		            title: 'Cupo de grupo lleno, favor de elegir otro grupo.',
		            confirmButtonText: 'Cerrar'

		          })

         document.getElementById("btn_enviar").setAttribute('disabled','disabled');
    }
    else{
    	document.getElementById('btn_enviar').removeAttribute('disabled');
    }
            
  };

  xhr.send(null); 


  }



function refrescar_tabla(){
  borrar_formato_tabla();
  
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }
</script>