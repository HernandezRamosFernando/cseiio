<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Autorización de Nulidad de Semestre</a>
      </li>
      <li class="breadcrumb-item active">Busque al alumno que desea autorizar el proceso de nulidad</li>
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
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Semestre en curso</th>
              <th scope="col" class="col-md-1">Grupo</th>
              <th scope="col" class="col-md-1">Semestre aplicar nulidad</th>
              <th scope="col" class="col-md-1">Situación del alumno</th>
              <th scope="col" class="col-md-1">Fecha de solicitud</th>
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




<!-- Modal autorizar traslado--------------------------------------------------->
  <div class="modal fade" id="autorizar_nulidad_semestre" tabindex="-1" role="dialog" aria-labelledby="modaleliminarTitle">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;"  role="document">
      <div class="modal-content">
        
        <div class="modal-body">
            <form id="autorizar_nulidad" method="post">
            <!--datos personales------------------------------------------------------>
           
           <input type="hidden" name="id_plantel" id="id_plantel">
           <input type="hidden" name="id_nulidad" id="id_nulidad">
           

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
                <select class="form-control form-control-lg" required="required" id="ciclo_escolar"
                  name="ciclo_escolar" onchange="cambiar_semestre(this.value)">
                  <option value="">Seleccione el ciclo</option>
                  <?php
                    foreach ($ciclo_escolar as $ciclo)
                    {
                      echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->nombre_ciclo_escolar.'----'.$ciclo->periodo.'</option>';
                    }
                    ?>
                  
                </select>
                <span>Ciclo Escolar</span>
              </label>
              </div>


              <div class="col-md-6">
                <label class="form-group has-float-label">
                <select class="form-control form-control-lg" required="required" id="semestre_nulidad"
                  name="semestre_nulidad" onchange="validar_semestre(this)">
                  <option value="">Seleccione el semestre</option>
                  
                </select>
                <span>Semestre a aplicar</span>
              </label>
              </div>


            </div>
          </div>



          <div class="form-group">
            <div class="row">


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
         <button type="submit" id="btn_enviar" class="btn btn-success">Autorizar</button>
          </div>


          </form>
        </div>
        
      
      </div>
    </div>
</div>
<!-- Modal -->

<script>
function autorizar_solicitud(form_autorizar_nulidad){


var formdata = new FormData(form_autorizar_nulidad);
            var xhr_2 = new XMLHttpRequest();
            xhr_2.open("POST", "<?php echo base_url();?>index.php/C_nulidad_semestre/autorizar_nulidad", true);
            xhr_2.onreadystatechange = function () {
              if (xhr_2.responseText === "si") {
                  Swal.fire({
                    type: 'success',
                    scrollbarPadding:false,
                    title: 'Autorización realizada exitosamente',
                    showConfirmButton: false,
                    timer: 2500
                  })
                  $('#autorizar_nulidad_semestre').modal('hide');
                  
                } else {
                  Swal.fire({
                    type: 'error',
                    scrollbarPadding:false,
                    title: 'Ha ocurrido un error en autorización de nulidad',
                    confirmButtonText: 'Cerrar'

                  })
                }
              
            }
            xhr_2.send(formdata);

            refrescar_tabla();

}

var form_autorizar_nulidad = document.getElementById("autorizar_nulidad");
  form_autorizar_nulidad.onsubmit = function (e) {
    e.preventDefault();

    var id_ciclo_escolar=document.getElementById("ciclo_escolar").value;
    var no_control_estudiante=document.getElementById("no_control_estudiante").value;
    var id_semestre_nulidad=document.getElementById("semestre_nulidad").value;

    var xhr_validacion = new XMLHttpRequest();
          xhr_validacion.open('GET', '<?php echo base_url();?>index.php/C_grupo_estudiante/existe_grupo_ciclo_escolar_estudiante?id_ciclo_escolar=' + id_ciclo_escolar+'&no_control='+no_control_estudiante+'&semestre_nulidad='+id_semestre_nulidad, true);
          
          xhr_validacion.error = function () {
            console.log("error de conexion");
          }
          xhr_validacion.onload = function () {

            let validacion = JSON.parse(xhr_validacion.response);

            if(validacion[0].resultado>0){
                 if(id_semestre_nulidad==1){
                        swalWithBootstrapButtons.fire({
                        type: 'warning',
                        title:'¿Esta seguro de que desea autorizar el proceso de nulidad hasta primer semestre?',
                        text: 'En caso de ser aprobado ocacionaría que los semestres cursados por el alumno sean invalidos y que tenga un nuevo número de control',
                        confirmButtonText: 'Aceptar',
                        scrollbarPadding:false,
                        showCancelButton: 'true',
                        cancelButtonText: 'Cancelar'
                      }).then((result) => {
                        if (result.value) {
                             autorizar_solicitud(form_autorizar_nulidad);
                             
                        } 

                      });

                 }

                 else{
                      autorizar_solicitud(form_autorizar_nulidad);
                 }
                  

            }

            else{
                Swal.fire({
                    type: 'error',
                    scrollbarPadding:false,
                    title: 'El semestre y ciclo escolar seleccionados para nulidad del semestre no existe registro en la base de datos del alumno, seleccione semestre y ciclo escolar validos.',
                    confirmButtonText: 'Cerrar'

                  })

            }

        

              

         };
          xhr_validacion.send(null);   


    }



function validar_semestre(valor){
  var semestre_nulidad=parseInt(valor.value);
  var semestre_en_curso=parseInt(document.getElementById("semestre").value);
    if(semestre_nulidad!=='' && (semestre_nulidad>semestre_en_curso)){
    	document.getElementById("semestre_nulidad").value="";
      Swal.fire({
                type: 'error',
                title: 'El semestre a aplicar nulidad no puede ser mayor al semestre en curso.',
                confirmButtonText: 'Cerrar'

              })
         
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
    xhr.open('GET', '<?php echo base_url();?>index.php/C_nulidad_semestre/get_solicitantes_nulidad?' + query, true);
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
        fila += valor.no_control;
        fila += '</td>';

        fila += '<td>';
        fila += valor.semestre_en_curso;
        fila += '</td>';

        fila += '<td>';
        fila += valor.grupo_en_curso;
        fila += '</td>';
        
        fila += '<td>';
        fila += valor.semestre_nulidad;
        fila += '</td>';

        fila += '<td>';
        fila += valor.tipo_ingreso;
        fila += '</td>';


        fila += '<td>';
        fila += valor.fecha_solicitud;
        fila += '</td>';


        var agregar_html='',agregar_html_2='Autorizar nulidad semestre',clase_boton='btn btn-success btn-block';
        if(valor.autorizado==1){
            agregar_html='disabled="disabled"';
            agregar_html_2='Solicitud autorizada';
            clase_boton='btn btn-warning btn-block';
        }



        
          fila += '<td>';
        fila += '<button class="'+clase_boton+'" type="button" value="' +valor.no_control+'" data-toggle="modal" data-target="#autorizar_nulidad_semestre" onclick="cargar_datos_solicitud_nulidad(this)">'+agregar_html_2+'</button>';
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


function cargar_datos_solicitud_nulidad(no_control){
  document.getElementById("autorizar_nulidad").reset();

  var no_control=no_control.value;
  var xhr = new XMLHttpRequest();
        var query = 'no_control=' +no_control;
      xhr.open('GET', '<?php echo base_url();?>index.php/C_estudiante/get_estudiante_datos_semestre_grupo?' + query, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
        xhr.onload = function () {
          $('#div_carga').hide();
        let estudiante = JSON.parse(xhr.response);
        var grupo="";
       document.getElementById("id_plantel").value=estudiante[0].Plantel_cct_plantel;
        document.getElementById("nombre_completo").value=estudiante[0].nombre+" "+estudiante[0].primer_apellido+" "+estudiante[0].segundo_apellido;

        document.getElementById("semestre").value=estudiante[0].semestre_en_curso;

        document.getElementById("no_control_estudiante").value=estudiante[0].no_control;

        
        if(estudiante[0].nombre_grupo===null){
            grupo="Sin grupo asignado";
        }
        else{
          grupo=estudiante[0].nombre_grupo;
        }
        document.getElementById("grupo").value=grupo;

              var xhr_nulidad = new XMLHttpRequest();
              var query_2 = 'no_control=' +no_control;
            xhr_nulidad.open('GET', '<?php echo base_url();?>index.php/C_nulidad_semestre/get_alumno_datos_nulidad?' + query_2, true);
            xhr_nulidad.onloadstart = function () {
              
            }
            xhr_nulidad.error = function () {
              console.log("error de conexion");
            }
              xhr_nulidad.onload = function () {
                let nulidad = JSON.parse(xhr_nulidad.response);
                document.getElementById("id_nulidad").value=nulidad.datos_nulidad[0].idnulidad_semestre;

                document.getElementById("ciclo_escolar").value=nulidad.datos_nulidad[0].id_ciclo_escolar;
                document.getElementById("motivo_nulidad").value=nulidad.datos_nulidad[0].motivo;
                var periodo=nulidad.ciclo_escolar[0].periodo;
                var s_nulidad=nulidad.datos_nulidad[0].semestre_nulidad;

                var opcion_semestre='<option value="">Seleccione el semestre</option>';
                if(periodo=='FEBRERO-JULIO' && periodo!=null){
			      for(x=2;x<=6;x=x+2){
			      	  
			      	  if (x==s_nulidad){
			      	  		opcion_semestre+='<option value="'+x+'" selected="selected">'+x+'</option>';
			      	  }
			      	  else{
			      	  		opcion_semestre+='<option value="'+x+'">'+x+'</option>';
			      	  }
			      	  
			      }

		    }

		    if(periodo=='AGOSTO-ENERO' && periodo!=null){
		    		for(x=1;x<=5;x=x+2){
			      	  
			      	  if (x==s_nulidad){
			      	  		opcion_semestre+='<option value="'+x+'" selected="selected">'+x+'</option>';
			      	  }
			      	  else{
			      	  		opcion_semestre+='<option value="'+x+'">'+x+'</option>';
			      	  }
			      	  
			      }
		    	
		    }

		    	document.getElementById('semestre_nulidad').innerHTML=opcion_semestre;
                document.getElementById('documento_solicitud_nulidad').checked=nulidad.documento[0].entregado;



            };

            xhr_nulidad.send(null);

            



      };

      xhr.send(null);



}



function cambiar_semestre(periodo) {

		
		if(periodo!==""){
		
		var xhr = new XMLHttpRequest();

	      var query = 'ciclo=' + periodo;
	    xhr.open('GET', '<?php echo base_url();?>index.php/C_ciclo_escolar/get_ciclo_escolar_seleccionado?' + query, true);
	    xhr.onloadstart = function () {
	      $('#div_carga').show();
	    }
	    xhr.error = function () {
	      console.log("error de conexion");
	    }
		
		xhr.onload = function () {
		    $('#div_carga').hide();
		    var option = document.createElement("option");
              semestre_nulidad.innerHTML = "";
              option.text = "Seleccione el semestre";
              option.value = "";
              semestre_nulidad.add(option);
		    let ciclo_escolar = JSON.parse(xhr.response);


		    if(ciclo_escolar[0].periodo=='FEBRERO-JULIO' && ciclo_escolar[0].periodo!=null){
		      var option2 = document.createElement("option");
		      option2.text = "2";
              option2.value = "2";

              semestre_nulidad.add(option2);

              var option4 = document.createElement("option");
              option4.text = "4";
              option4.value = "4";
              semestre_nulidad.add(option4);

              var option6 = document.createElement("option");
              option6.text = "6";
              option6.value = "6";
              semestre_nulidad.add(option6);

              

		    }

		    if(ciclo_escolar[0].periodo=='AGOSTO-ENERO' && ciclo_escolar[0].periodo!=null){
		    	var option1 = document.createElement("option");
		    	option1.text = "1";
              option1.value = "1";
              semestre_nulidad.add(option1);

				var option3 = document.createElement("option");
              option3.text = "3";
              option3.value = "3";
              semestre_nulidad.add(option3);

              var option5 = document.createElement("option");
              option5.text = "5";
              option5.value = "5";
              semestre_nulidad.add(option5);
		    }
		    

		};

		  xhr.send(null);

		  }
		  else{
		  	var option = document.createElement("option");
              semestre_nulidad.innerHTML = "";
              option.text = "Seleccione el semestre";
              option.value = "";
              semestre_nulidad.add(option);

		  }


	}


  function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }
 
</script>