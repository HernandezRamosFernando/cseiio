<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Asignar permisos de para calificaciones</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos requeridos para crear un grupo</li>
    </ol>

    <div class="row">
      <div class="col-md-6 ">
        <button type="button" class="btn btn-info btn-lg btn-block" onclick="todoslosplanteles();" style="padding: 1rem"
          id="todos_planteles">Todos los planteles</button>
      </div>

      <div class="col-md-6 ">
        <button type="button" class="btn btn-info btn-lg btn-block" onclick="unplantel();" style="padding: 1rem"
          id="un_plantel">Un plantel</button>
      </div>
    </div>

    <br>
    <form class="card" id="formulariounplantel" name="formulariounplantel" style="display: none">

    <div class="form-group">
    <div class="row">
    <div class="col-md-12 ">
    <label class="form-group has-float-label seltitulo">
                    <select class="form-control form-control-lg selcolor" required="required"
                      id="aspirante_plantel_busqueda" name="aspirante_plantel" onChange="grupos_cct(this)">
                      <option value="">Seleccione un plantel</option>

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

    <div class="col-md-6 ">
    <label class="form-group has-float-label seltitulo">
                    <select class="form-control form-control-lg selcolor" required="required"
                      id="aspirante_grupo_busqueda" name="aspirante_grupo" onChange="materias_grupo(this)">
                      <option value="">Todos las grupos</option>
                    </select>
                    <span>Grupo</span>
                  </label>
        </div>


    <div class="col-md-6 ">
    <label class="form-group has-float-label seltitulo">
                    <select class="form-control form-control-lg selcolor" required="required"
                      id="aspirante_materia_busqueda" name="aspirante_materia">
                      <option value="">Todas las materias</option>
                    </select>
                    <span>Materia</span>
                  </label>
        </div>

    </div>
      </div>
      

      <div class="form-group">
        <div class="col-md-12" id="tabla_plantel">
          <div class="card card-body">
            <table class="table table-hover" id="tabla_completa_plantel" style="width: 100%">
              <caption>Lista de parciales y examen final</caption>
              <thead class="thead-light">
                <tr>
                  
                  <th scope="col" class="col-md-1">Parcial 1</th>
                  <th scope="col" class="col-md-1">Parcial 2</th>
                  <th scope="col" class="col-md-1">Parcial 3</th>
                  <th scope="col" class="col-md-1">Examen Final</th>
                </tr>
              </thead>

              <tbody id="tablaunplantel">
              <tr>
                
                <td>
                  <input type='checkbox' class='form-check-input' id='parcial1' name='parcial1'>
                </td>
                <td>
                  <input type='checkbox' class='form-check-input' id='parcial2' name='parcial2'>
                </td>
                <td>
                  <input type='checkbox' class='form-check-input' id='parcial3' name='parcial3'>
                </td>
                <td class="">
                  <input type='checkbox' class='form-check-input' id='examenfinal' name='examenfinal'>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </form>


    <form class="card" id="formulario" name="formulario" style="display: none">
      <div class="form-group">

        <div class="col-md-12" id="tabla_planteles">
          <div class="card card-body">
            <table class="table table-hover" id="tabla_completa_planteles" style="width: 100%">
              <caption>Lista de los planteles</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Plantel</th>
                  <th scope="col" class="col-md-1">CCT</th>
                  <th scope="col" class="col-md-1">Nombre Corto</th>
                  <th scope="col" name="parcial1" class="col-md-1">Parcial 1</th>
                  <th scope="col" class="col-md-1">Parcial 2</th>
                  <th scope="col" class="col-md-1">Parcial 3</th>
                  <th scope="col" class="col-md-1">Examen Final</th>
                </tr>
              </thead>

              <tbody id="tablaplantel">

              </tbody>
            </table>
          </div>
        </div>


      </div>
    </form>
    <br>
    <div class="col-md-12" id="agregar_oculto" style="display: none">
      <button type="button" id="boton_agregar"
        class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem" onclick="validar_form()"> Guardar cambios</button>
    </div>

  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Modal -->
<div class="modal fade" id="fechapermiso" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignar fecha de permiso de asignación de calificaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-6">
            <div class="form-label-group">
              <input type="date" class="form-control" id="fecha_inicio" placeholder="Fecha de inicio" min=<?php
                echo date('Y-m-d');
                ?>>
              <label for="fecha_inicio">Fecha de inicio de permiso </label>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-label-group">
              <input type="date" class="form-control" id="fecha_fin" placeholder="Fecha de finalización " min=<?php
                echo date('Y-m-d');
                ?>>
              <label for="fecha_fin">Fecha de finalización de permiso </label>
            </div>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="validarcomponente()" class="btn btn-success">Guardar fecha</button>
      </div>
    </div>
  </div>
</div>


<script>

function validar_form(){
  if(document.getElementById('formulariounplantel').style.display==""){
     if(document.getElementById("aspirante_plantel_busqueda").value == '' || document.getElementById("aspirante_grupo_busqueda").value == '' || document.getElementById("aspirante_materia_busqueda").value == ''){
     
     
            Swal.fire({
              type: 'warning',
              text: 'Faltan algunos campos por rellenar.'
            });
           
     }
     else{
      $('#fechapermiso').modal('show');
     }

  }
  else{
    if(document.getElementById('formulario').style.display==""){
      $('#fechapermiso').modal('show');
    }

  }
  
}

  function validarcomponente() {
    validafecha(document.getElementById("fecha_inicio"));
    validafecha(document.getElementById("fecha_fin"));

    if (document.getElementById("fecha_fin").value != '' && document.getElementById("fecha_inicio").value != '') {
      guardar()
    } else {
      Swal.fire({
        type: 'warning',
        text: 'La fecha ingresada es incorrecta'
      });
    }
  }

  function fecha_sql(fecha) {
    let fecha_separada = fecha.split("/").reverse();
    return fecha_separada.join("-");
  }

  function guardar() {
    document.getElementById("fecha_inicio");
    document.getElementById("fecha_fin");

    var datos = new Array();
    if (document.getElementById("boton_agregar").value === "todos") {
      var tabla = document.getElementById("tablaplantel");
      for (let i = 2; i < tabla.childNodes.length; i++) {
        var dato = {
          tipo_operacion:"PLANTELES_SELECCIONADOS",
          cct_plantel: tabla.childNodes[i].childNodes[1].innerText,
          primer_parcial: tabla.childNodes[i].childNodes[3].childNodes[0].checked,
          segundo_parcial: tabla.childNodes[i].childNodes[4].childNodes[0].checked,
          tercer_parcial: tabla.childNodes[i].childNodes[5].childNodes[0].checked,
          examen_final: tabla.childNodes[i].childNodes[6].childNodes[0].checked,
          fecha_inicio: fecha_sql(document.getElementById("fecha_inicio").value),
          fecha_fin: fecha_sql(document.getElementById("fecha_fin").value),
          usuario: "<?= $this->session->userdata('user')['usuario'] ?>"
        };

        datos.push(dato);
      }

      console.log(datos);
    }

    else {
      
      var tabla = document.getElementById("tablaunplantel");

      //console.log("hola: "+tabla.childNodes[1].childNodes[5].childNodes[1].name);
      var dato = {
        tipo_operacion:"UN_PLANTEL",
        cct_plantel: document.getElementById("aspirante_plantel_busqueda").value,
        grupo: document.getElementById("aspirante_grupo_busqueda").value,
        materia: document.getElementById("aspirante_materia_busqueda").value,
        primer_parcial: tabla.childNodes[1].childNodes[1].childNodes[1].checked,
        segundo_parcial: tabla.childNodes[1].childNodes[3].childNodes[1].checked,
        tercer_parcial: tabla.childNodes[1].childNodes[5].childNodes[1].checked,
        examen_final: tabla.childNodes[1].childNodes[7].childNodes[1].checked,
        fecha_inicio: fecha_sql(document.getElementById("fecha_inicio").value),
        fecha_fin: fecha_sql(document.getElementById("fecha_fin").value),
        usuario: "<?= $this->session->userdata('user')['usuario'] ?>"
      };
      datos.push(dato);
    }



    //mandar json a controlador permisos
    var xhr = new XMLHttpRequest();
    $('#fechapermiso').modal().hide();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_permisos/agregar_permisos', true);

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
        } else {
          Swal.fire({
            type: 'error',
            text: 'Datos no guardados'
          });
          $('#fechapermiso').modal().show();
        }
      }
    }
    xhr.send(JSON.stringify(datos));
    //fin peticion
  }

  function unplantel() {
    document.getElementById("boton_agregar").value = "uno";
    document.getElementById("todos_planteles").style.display = "none";
    document.getElementById("formulariounplantel").style.display = "";
    document.getElementById("un_plantel").disabled = true;
    document.getElementById("agregar_oculto").style.display = "";

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_planteles', true);
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
        fila += valor.nombre_plantel;
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='parcial1' name='parcial1'>"
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='parcial2' name='parcial2'>"
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='parcial3' name='parcial3'>"
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='examenfinal' name='examenfinal'>"
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablaplantel").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);

  }

  function todoslosplanteles() {
    document.getElementById("boton_agregar").value = "todos";

    document.getElementById("un_plantel").style.display = "none";
    document.getElementById("formulario").style.display = "";
    document.getElementById("todos_planteles").disabled = true;
    document.getElementById("agregar_oculto").style.display = "";
    

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_planteles', true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      var fila = '<tr>';
      fila += '<td>';
      fila += 'Todos los planteles';
      fila += '</td>';
      fila += '<td>';
      fila += '';
      fila += '</td>';
      fila += '<td class="">';
      fila += '';
      fila += '</td>';
      fila += '<td class="">';
      fila += "<input type='checkbox' class='form-check-input' id='parcial1' onclick='toggle(this)'> Seleccionar todos"
      fila += '</td>';
      fila += '<td class="">';
      fila += "<input type='checkbox' class='form-check-input' id='parcial2' onclick='toggle2(this)'> Seleccionar todos"
      fila += '</td>';
      fila += '<td class="">';
      fila += "<input type='checkbox' class='form-check-input' id='parcial3' onclick='toggle3(this)'> Seleccionar todos"
      fila += '</td>';
      fila += '<td class="">';
      fila += "<input type='checkbox' class='form-check-input' id='examenfinal' onclick='toggle4(this)'> Seleccionar todos"
      fila += '</td>';
      fila += '</tr>';
      document.getElementById("tablaplantel").innerHTML += fila;

      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.nombre_plantel;
        fila += '</td>';
        fila += '<td>';
        fila += valor.cct_plantel;
        fila += '</td>';
        fila += '<td class="">';
        fila += valor.nombre_corto;
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='parcial1' name='parcial1'>"
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='parcial2' name='parcial2'>"
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='parcial3' name='parcial3'>"
        fila += '</td>';
        fila += '<td class="">';
        fila += "<input type='checkbox' class='form-check-input' id='examenfinal' name='examenfinal'>"
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablaplantel").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);

  }


  function toggle(source) {
    checkboxes = document.getElementsByName('parcial1');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }
  function toggle2(source) {
    checkboxes = document.getElementsByName('parcial2');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }
  function toggle3(source) {
    checkboxes = document.getElementsByName('parcial3');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }
  function toggle4(source) {
    checkboxes = document.getElementsByName('examenfinal');

    for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
    }

  }



function grupos_cct(parametro_cct){
  var cct=parametro_cct.value;
    var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_grupos_activos?plantel='+cct, true);
        xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
          console.log(xhr.response);

          
          document.getElementById("aspirante_grupo_busqueda").innerHTML="";
          let opciones="";
          let cont=0;
         
                  
                JSON.parse(xhr.response).forEach(function (valor, indice) {
                  if(cont==0){
                    opciones += '<option value="">Seleccione un grupo</option>';
                  opciones += '<option value="TODOS_LOS_GRUPOS">Todos los grupos</option>';
                }
                  opciones += '<option value="' + valor.id_grupo + '">' +valor.semestre+'-'+valor.nombre_grupo+'</option>';
                  cont=cont+1;
                });

                if(cont==0){
                  opciones += '<option value="">Sin grupos activos</option>';
                  
                }
              
              document.getElementById("aspirante_grupo_busqueda").innerHTML += opciones;
              document.getElementById("aspirante_materia_busqueda").innerHTML ="";
              var select = document.getElementById("aspirante_materia_busqueda");
              var option = document.createElement("option");
              option.text = "Seleccione una materia";
              option.value = ""
              select.add(option);
          
        };

        xhr.send(null);

}


function materias_grupo(parametro_grupo){
  
  var grupo=parametro_grupo.value;
  if(grupo==""){
    document.getElementById("aspirante_materia_busqueda").innerHTML="";
              var select = document.getElementById("aspirante_materia_busqueda");
              var option = document.createElement("option");
              option.text = "Seleccione una materia";
              option.value = ""
              select.add(option);
  }
  else{
    if (grupo=="TODOS_LOS_GRUPOS"){
      document.getElementById("aspirante_materia_busqueda").innerHTML="";
      var select = document.getElementById("aspirante_materia_busqueda");
              var option = document.createElement("option");
              option.text = "Todas las materias";
              option.value = "TODAS_LAS_MATERIAS"
              select.add(option);

    }
    else{
      var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_materias_grupo?grupo='+grupo, true);
        xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
          console.log(xhr.response);
          document.getElementById("aspirante_materia_busqueda").innerHTML="";
          let opciones="";
          opciones += '<option value="TODAS_LAS_MATERIAS">Todas las materias</option>';
                  
                JSON.parse(xhr.response).forEach(function (valor, indice) {
                  opciones += '<option value="' + valor.clave + '">' +valor.clave+'-'+valor.unidad_contenido+'</option>';
                });
              
              document.getElementById("aspirante_materia_busqueda").innerHTML += opciones;


              
          
        };

        xhr.send(null);

    }
    

  }
    
  }







</script>