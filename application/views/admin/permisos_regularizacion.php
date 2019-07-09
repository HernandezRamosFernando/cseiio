<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Asignar permisos de para regularización</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos requeridos para crear un grupo</li>
    </ol>

    <div class="row">
      <div class="col-md-6 ">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="todoslosplanteles();" style="padding: 1rem" id="todos_planteles">Todos los planteles</button>
            </div>

      <div class="col-md-6 ">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="unplantel();" style="padding: 1rem" id="un_plantel">Un plantel</button>
            </div>
      </div>

      <br>
    <form class="card" id="formulariounplantel" name="formulariounplantel" style="display: none">
      <div class="form-group card-body">
          <div class="row">

      <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel" name="plantel" onchange="cargarmaterias();">
                  <option value="">Seleccione el plantel</option>

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

        <div class="row">
         <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="materias" id="materias">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de materias</span>
            </label>
          </div>
        </div>
     </div>

     <br>
        <div class="col-md-12" id="agregar_oculto" style="display: ">
        <button type="button" data-toggle="modal" data-target="#fechapermiso1" id="boton_agregar" class="btn btn-success btn-lg btn-block btn-guardar"  style="padding: 1rem"> Guardar permiso</button> 
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
                <th scope="col" n class="col-md-1">Regularización</th>
              </tr>
            </thead>

            <tbody id="tablaplantel">

            </tbody>
          </table>
        </div>
      </div>


     </div>
     <br>
        <div class="col-md-12" id="agregar_oculto" style="display: ">
        <button type="button" data-toggle="modal" data-target="#fechapermiso" id="boton_agregar" class="btn btn-success btn-lg btn-block btn-guardar"  style="padding: 1rem"> Guardar permisos</button> 
        </div>
                                 
   </form>
   

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
        <h5 class="modal-title">Asignar fecha de permiso de asignación de calificación de regularización</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          
        <div class="row">
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="date"  class="form-control" id="fecha_inicio"  
                  placeholder="Fecha de inicio" min= <?php echo date('Y-m-d');?> >
                <label for="fecha_inicio">Fecha de inicio de permiso </label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-label-group">
                <input type="date"  class="form-control" id="fecha_fin"  
                  placeholder="Fecha de finalización " min=
                <?php
                echo date('Y-m-d');
                ?>
                >
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

<!-- Modal -->
<div class="modal fade" id="fechapermiso1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Asignar fecha de permiso de asignación de calificación de regularización</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          
        <div class="row">
            <div class="col-md-6">
              <div class="form-label-group">
                <input type="date"  class="form-control" id="fecha_inicio_un_plantel"  
                  placeholder="Fecha de inicio" min=
                <?php
                echo date('Y-m-d');
                ?>
                >
                <label for="fecha_inicio">Fecha de inicio de permiso </label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-label-group">
                <input type="date"  class="form-control" id="fecha_fin_un_plantel"  
                  placeholder="Fecha de finalización "min=
                <?php
                echo date('Y-m-d');
                ?>
                >
                <label for="fecha_fin">Fecha de finalización de permiso </label>
              </div>
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="validarcomponenteunplantel()" class="btn btn-success">Guardar fecha</button>
      </div>
    </div>
  </div>
</div>


<script>

function validarcomponente() {
    validafecha(document.getElementById("fecha_inicio"));
     validafecha(document.getElementById("fecha_fin"));

    if (document.getElementById("fecha_fin").value != '' && document.getElementById("fecha_inicio").value != '') {
      guardar();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'La fecha ingresada es incorrecta'
      });
    }
  }

  function validarcomponenteunplantel() {
    validafecha(document.getElementById("fecha_inicio_un_plantel"));
     validafecha(document.getElementById("fecha_fin_un_plantel"));

    if (document.getElementById("fecha_inicio_un_plantel").value != '' && document.getElementById("fecha_fin_un_plantel").value != '') {
      guardarunplantel();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'La fecha ingresada es incorrecta'
      });
    }
  }

function fecha_sql(fecha){
let fecha_separada = fecha.split("/").reverse();
return fecha_separada.join("-");
}

function cargarmaterias() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#materias").val('');
    } else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);

      materias.innerHTML = "";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_con_reprobados_html_regularizacion?plantel=' + plantel, true);
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
          option.text = "Ningun alumno con adeudo en este plantel";
          option.value = "";
          materias.add(option);
        } else {
          console.log(xhr.response);
          materias.innerHTML = xhr.responseText;
        }
      };
      xhr.send(null);
    }
  }



 function todoslosplanteles() {
  document.getElementById("boton_agregar").value = "todos";

   document.getElementById("un_plantel").style.display = "none";
   document.getElementById("formulario").style.display = "";
   document.getElementById("todos_planteles").disabled=true;

  var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_planteles',  true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
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
        fila += "<input type='checkbox' class='form-check-input' id='regularizacion' onclick='toggle(this)'> Seleccionar todos"
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
        fila += "<input type='checkbox' class='form-check-input' id='regularizacion' name='regularizacion'>"
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablaplantel").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);

}

function unplantel(){
    document.getElementById("boton_agregar").value = "uno";
    document.getElementById("todos_planteles").style.display = "none";
   document.getElementById("formulariounplantel").style.display = "";
   document.getElementById("un_plantel").disabled=true;

  }


function toggle(source) {
  checkboxes = document.getElementsByName('regularizacion');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}

function guardar(){

  let tabla = document.getElementById("tablaplantel");
  let renglones = tabla.childNodes;
  var datos = new Array();

  for(let i=2;i<renglones.length;i++){
    //console.log(renglones[i].childNodes[1].innerText);//cct
    //console.log(renglones[i].childNodes[3].childNodes[0].checked);//si se le otorgaron permisos
    if(renglones[i].childNodes[3].childNodes[0].checked){
    let dato = {
      usuario:"<?php echo $this->session->userdata('user')['usuario'] ?>",
      plantel:renglones[i].childNodes[1].innerText,
      fecha_inicio:document.getElementById("fecha_inicio").value,
      fecha_fin:document.getElementById("fecha_fin").value,
    }

    datos.push(dato);
    }
  }

  console.log(datos);

  //enviar datos
  var xhr = new XMLHttpRequest();
  
      xhr.open("POST", '<?php echo base_url();?>index.php/c_permiso_regularizacion/agregar_permiso_todos_planteles', true);
      $('#fechapermiso').modal().hide();
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
              console.log(xhr.response);
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
  ////////////////////////////////////////////

}

function guardarunplantel(){

  let dato = {
    usuario:"<?php echo $this->session->userdata('user')['usuario'] ?>",
    id_materia:document.getElementById("materias").value,
    plantel:document.getElementById("plantel").value,
    fecha_inicio:document.getElementById("fecha_inicio_un_plantel").value,
    fecha_fin:document.getElementById("fecha_fin_un_plantel").value
  }


  var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?php echo base_url();?>index.php/c_permiso_regularizacion/agregar_permiso_plantel_materia', true);
      $('#fechapermiso1').modal().hide();
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
              console.log(xhr.response);

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
      xhr.send(JSON.stringify(dato));

  console.log(dato);
    
}





  </script>
