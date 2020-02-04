<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Panel permisos alumnos baja</a>
      </li>
      <li class="breadcrumb-item active">Seleccione que desea hacer</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="permisos_calificacion_baja()" style="padding: 1rem"
                id="agregar_usuario">Permisos calificación alumnos de baja</button>
            </div>

            <div class="col-md-4 ">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="permisos_editar_fecha()" style="padding: 1rem"
                id="modificar_usuario">Permisos editar fecha</button>
            </div>

          </div>
        </div>

        <div id="divpermisos_baja" style="display: none">

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a>Permisos de calificaciones alumnos de baja</a>
            </li>
            <li class="breadcrumb-item active">Busque la materia que desea calificar</li>
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

        <div class="card" style="overflow:scroll;" id="">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="col-md-1">Nombre completo</th>
                          <th scope="col" class="col-md-1">CURP</th>
                          <th scope="col" class="col-md-1">N° control</th>
                          <th scope="col" class="col-md-1">Plantel CCT</th>
                          <th scope="col" class="col-md-1">Semestre en curso</th>
                          <th scope="col" class="col-md-1">Grupo en curso</th>
                          <th scope="col" class="col-md-1">Asignar permiso</th>
                          
                        </tr>
                      </thead>



                        <tbody id="tabla">

                        </tbody>
        </table>
      </div>

    </div>


        </div> <!-- cerrar agregar -->

        <div id="divpermisos_editar_fecha" style="display: none">
          <div class="form-group">
            <div class="row">
              <div class="col-md-8">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" onchange="cargar_usuario()" id="lista_modificar"
                    name="lista_modificar">
                    <option value="">Seleccione un usuario </option>

                    <?php
                                        foreach ($usuarios as $usuario)
                                        {
                                          if($usuario->usuario!='depto_tecnologia'){
                                            echo '<option value="'.$usuario->id_usuario.'">'.$usuario->usuario.'</option>';

                                          }
                                          
                                        }
                                        ?>

                  </select>
                  <span>Lista de usuarios</span>
                </label>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="text" class="form-control " id="usuario_modificar"
                    placeholder="Nombre de usuario">
                  <label for="usuario_modificar">Usuario</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="text" class="form-control " id="password_modificar"
                    placeholder="Contraseña (No escribir)">
                  <label for="password_modificar">Contraseña (No escribir)</label>
                </div>
              </div>

              <div class="col-md-4">
                <button type="button" onclick="generar()" class="btn btn-primary btn-lg btn-block">Crear
                  contraseña</button>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group ">
                  <input type="mail" class="form-control " id="correo_modificar" placeholder="Contraseña">
                  <label for="correo_modificar">Correo</label>
                </div>
              </div>

              <div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" disabled id="rol_modificar" name="rol_modificar">
                    <option value="">Seleccione</option>
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    <option value="CESCOLAR">CONTROL ESCOLAR OFICINAS CENTRALES</option>
                    <option value="PLANTEL">CONTROL ESCOLAR PLANTEL</option>
                  </select>
                  <span>ROL</span>
                </label>
              </div>

              <div class="col-md-8" id="plantel_modificar_oculto" style="display: none">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="plantel_modificar" name="plantel_modificar">
                    <option value="">Seleccione el plantel </option>
                    <option value="CESCOLAR">Control Escolar oficinas centrales </option>

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
                <button type="button" class="btn btn-info btn-lg btn-block" onclick="modificar_usuario()" style="padding: 1rem">Modificar usuario</button>
              </div>
            </div>
          </div>

        </div> <!-- cerrar modificar -->

        

      </div>
    </div>

    

    

  
  
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->




<!-- Inicia modal para asignar permisos-->

<div class="modal" tabindex="-1" role="dialog" id="asignar_permisos">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignar permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="nuevo_permiso">

      <input type="hidden" id="no_control" name="no_control">
      <input type="hidden" id="id_grupo" name="id_grupo">
      <input type="hidden" id="id_plantel" name="id_plantel">

      
       <div class="modal-body">
             <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" readonly="readonly">
                  </div>
             </div>

           <table class="table table-hover" id="" style="width: 100%"  border="1">
          
                      <thead class="thead-light">
                        <tr>

                          <th scope="col" class="col-md-1">Materia</th>
                          <th scope="col" class="col-md-1">Clave</th>
                          <th scope="col" class="col-md-1">Parcial 1 <br><input type='checkbox' class='form-check-input' id='parcial1' onclick='toggle1(this)'> Seleccionar todos</th>
                          <th scope="col" class="col-md-1">Parcial 2<br><input type='checkbox' class='form-check-input' id='parcial2' onclick='toggle2(this)'> Seleccionar todos</th>
                          <th scope="col" class="col-md-1">Parcial 3<br><input type='checkbox' class='form-check-input' id='parcial3' onclick='toggle3(this)'> Seleccionar todos</th>
                          <th scope="col" class="col-md-1">Examen Final<br><input type='checkbox' class='form-check-input' id='examen_final' onclick='toggle4(this)'> Seleccionar todos</th>
                        </tr>
                      </thead>



                        <tbody id="tabla_materia">

                        </tbody>
        </table>

           <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fecha_inicio">Fecha inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" placeholder="Seleccione la fecha de inicio" required="required">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="fecha_fin">Fecha fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" placeholder="Seleccione la fecha de inicio" required="required">
                  </div>
             </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal para asignar permisos-->
<script>

  function permisos_calificacion_baja() {
    document.getElementById("divpermisos_baja").style.display = "";
    document.getElementById("divpermisos_editar_fecha").style.display = "none";
    
  }
  function permisos_editar_fecha() {
    document.getElementById("divpermisos_editar_fecha").value = "";
    document.getElementById("divpermisos_baja").style.display = "none";
  }

  
</script>

<script>

function cargar_datos_modal_asignar_permiso(e,id_grupo,nombre_completo,id_plantel) {
  

  document.getElementById("nuevo_permiso").reset();
  document.getElementById("nombre").value = nombre_completo;
  document.getElementById("no_control").value =e.value;
  document.getElementById("id_grupo").value =id_grupo;
  document.getElementById("id_plantel").value =id_plantel;

  document.getElementById("tabla_materia").innerHTML = "";
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_permisos_extemporaneo/get_datos_materia?grupo='+id_grupo, true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));
        
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var fila = '';
        fila = '<tr>';

        fila += '<td>';
        fila += valor.unidad_contenido;
        fila += '</td>';

        fila += '<td>';
        fila += valor.clave;
        fila += '</td>';

        fila += '<td>';
        fila += '<input class="form-control parcial1" type="checkbox" id="parcial1" name="examen['+valor.clave+'][parcial1]">';
        fila += '</td>';

        fila += '<td>';
        fila += '<input class="form-control parcial2" type="checkbox" id="parcial2" name="examen['+valor.clave+'][parcial2]">';
        fila += '</td>';

        fila += '<td>';
        fila += '<input class="form-control parcial3" type="checkbox" id="parcial3" name="examen['+valor.clave+'][parcial3]">';
        fila += '</td>';

        fila += '<td>';
        fila += '<input class="form-control examen_final" type="checkbox" id="examen_final" name="examen['+valor.clave+'][examen_final]">';
        fila += '</td>';


        fila += '</tr>';
        document.getElementById("tabla_materia").innerHTML += fila;

        });

        
        
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
    xhr.open('GET', '<?php echo base_url();?>index.php/C_bajas/busqueda_alumnos_grupo?' + query, true);
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
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';

        fila += '<td>';
        fila += valor.semestre_en_curso === null ? "" : valor.semestre_en_curso;
        fila += '</td>';

        fila += '<td>';
        fila += valor.nombre_grupo === null ? "" : valor.nombre_grupo;
        fila += '</td>';

        fila += '<td>';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" onclick="cargar_datos_modal_asignar_permiso(this,\''+valor.id_grupo+'\',\''+valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre+'\',\''+valor.Plantel_cct_plantel+'\')" data-toggle="modal" data-target="#asignar_permisos">Asignar permisos</button>';
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
   
  }


  var form = document.getElementById("nuevo_permiso");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/C_bajas/agregar_permiso",true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      $('#div_carga').hide();
      if(xhr.responseText==="si"){
        Swal.fire({
            type: 'success',
            scrollbarPadding:false,
            title: 'Permiso de materia asignada',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#asignar_permisos').modal('toggle');
          //borrar_formato_tabla();
          //cargar_tabla();
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

  function toggle1(source) {
    checkboxes = document.getElementsByClassName('parcial1');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }
  function toggle2(source) {
    checkboxes = document.getElementsByClassName('parcial2');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }
  function toggle3(source) {
    checkboxes = document.getElementsByClassName('parcial3');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }
  function toggle4(source) {
    checkboxes = document.getElementsByClassName('examen_final');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }

</script>