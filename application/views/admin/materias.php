  <div id="content-wrapper">

      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Lista de Materias</a>
          </li>
          <li class="breadcrumb-item active">Ingrese los datos requeridos</li>
        </ol>


        <div class="card">
          <div class="card-body">

        <div class="row">
    		<div class="col">
		        
		        <div class="float-right">
		        	<button type='button' class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modalnuevamateria" id="btn_buscar"
                    onclick='reset_modal_ingresar()'>Agregar Materia</button>
		        </div>
    		</div>
		</div>

		  </div>
        </div>

 


      


		
      <!--Empieza lista de las materias-->
		<div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_completa" style="width: 100%">
              <caption>Lista de todos los alumnos</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Clave</th>
                  <th scope="col" class="col-md-1">Unidad de Contenido</th>
                  <th scope="col" class="col-md-1">Semestre</th>
                  <th scope="col" class="col-md-1">Componente</th>
                  <th scope="col" class="col-md-1">Horas</th>
                  <th scope="col" class="col-md-1">Creditos</th>
                  <!-- <th scope="col" class="col-md-1">Academia que pertenece</th> -->
                  <th scope="col" class="col-md-1">Editar</th>
                 <!-- <th scope="col" class="col-md-1">Borrar</th> -->
                </tr>
              </thead>
              <tbody id="tabla">
              	

              </tbody>
            </table>
          </div>
        </div>



       <!--TErmina lista de las materias-->


      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->







  <!--Inicia modal de agregar materia -->

      <div class="modal fade" id="modalnuevamateria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar materia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              
      <form id="nuevamateria">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" required="required"
                      class="form-control text-uppercase" id="clave"
                      name="clave" placeholder="Clave de materia">
                    <label for="clave">Clave</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-8">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="unidad_contenido" name="unidad_contenido"
                      placeholder="Nombre de unidad de contenido">
                    <label for="unidad_contenido">Unidad de Contenido</label>
                  </div>
                  <br>
                </div>

              </div>


              <div class="row">
                <div class="col-md-3">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="semestre" id="semestre">
                      <option value="">Seleccione</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>

                    </select>
                    <span>Semestre</span>
                  </label>
                </div>

                <div class="col-md-9">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="componente" id="componente">
                      <option value="">Seleccione un componente</option>
                <?php
                foreach ($componente as $c) {
                  echo "<option value='".$c->id_componente."'>".$c->nombre."</option>";
                }
                ?>

                    </select>
                    <span>Componente</span>
                  </label>
                </div>

              </div>


              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="horas" name="horas"
                      placeholder="Horas" pattern="[0-9]{1,3}" title="Solo se permiten números enteros">
                    <label for="horas">Horas</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="creditos" name="creditos"
                      placeholder="creditos" pattern="[0-9]{1,3}" title="Solo se permiten números enteros">
                    <label for="creditos">Creditos</label>
                  </div>
                  <br>
                </div>

              </div>


              <div class="row">
                 <div class="col-md-12">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="academia" id="academia">
                      <option value="0" selected="selected">Seleccione una academia</option>
                    <?php

                                    /*foreach ($academia as $a) {
                                      echo "<option value='".$a->id_academia."'>".$a->nombre."</option>";
                                    }*/
                                    ?>
            
                    </select>
                    <span>Academia a la que pertenece</span>
                  </label>
                </div>
              </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"
              onclick="">Cancelar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
    
    </form>

            </div>
          </div>
          
        </div>
      </div>
    </div>


      <!--Termina modal de agregar materia-->



      <!--Inicia modal de modificar materia -->

      <div class="modal fade" id="modal_modificar_materia" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modificar materia</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              
      <form id="modificarmateria">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" required="required"
                      class="form-control text-uppercase" id="mclave"
                      name="mclave" placeholder="Clave de materia" readonly="">
                    <label for="mclave">Clave</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-8">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="munidad_contenido" name="munidad_contenido"
                      placeholder="Nombre de unidad de contenido">
                    <label for="munidad_contenido">Unidad de Contenido</label>
                  </div>
                  <br>
                </div>

              </div>


              <div class="row">
                <div class="col-md-3">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="msemestre" id="msemestre">
                      <option value="">Seleccione</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>

                    </select>
                    <span>Semestre</span>
                  </label>
                </div>

                <div class="col-md-9">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="mcomponente" id="mcomponente">
                      <option value="">Seleccione un componente</option>
                      <?php
                      foreach ($componente as $c) {
                        echo "<option value='".$c->id_componente."'>".$c->nombre."</option>";
                      }
                      ?>

                    </select>
                    <span>Componente</span>
                  </label>
                </div>

              </div>


              <div class="row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="mhoras" name="mhoras"
                      placeholder="Horas" pattern="[0-9]{1,3}" title="Solo se permiten números enteros">
                    <label for="mhoras">Horas</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="mcreditos" name="mcreditos"
                      placeholder="creditos" pattern="[0-9]{1,3}" title="Solo se permiten números enteros">
                    <label for="mcreditos">Creditos</label>
                  </div>
                  <br>
                </div>

              </div>


              <div class="row">
                 <div class="col-md-12">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="macademia" id="macademia">
                      <option value="0">Seleccione una academia</option>
                               <?php
                                    /*foreach ($academia as $ma) {
                                      echo "<option value='".$ma->id_academia."'>".$ma->nombre."</option>";
                                    }*/
                                    ?>
            
                    </select>
                    <span>Academia a la que pertenece</span>
                  </label>
                </div>
              </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"
              onclick="">Cancelar</button>
            <button type="submit" class="btn btn-success">Guardar</button>
          </div>
    
    </form>

            </div>
          </div>
          
        </div>
      </div>
    </div>
<!--Termina modal de modificar materia-->

 <!-- Empieza modal de eliminar materia -->
      <div class="modal fade" id="modal_eliminar_materia" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmación de eliminación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="eliminarmateria">

              <input type="hidden" name="clave_eliminar" id="clave_eliminar">
            <div class="modal-body">
              <div class="container-fluid">
                ¿Esta seguro que desea eliminar a esta materia? 
                <br>
                <br><span style="font-weight: bold; text-align: center;" id="nombre_materia"></span>
                  <br>
                  
                Una vez eliminado, el registro se perderá definitivamente del sistema.
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" id="btn-confirmacion" class="btn btn-danger">Eliminar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
<!-- termina modal de eliminar materia -->

<script>

function borrar_formato_tabla(){
  $("#tabla_completa").dataTable().fnDestroy();
  
}
function reset_modal_ingresar(){
  document.getElementById("nuevamateria").reset();
}
  function cargar_tabla() {
    document.getElementById("tabla").innerHTML="";
    var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_materias/lista_materias/', true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
        //console.log(JSON.parse(xhr.response));
        let datos = JSON.parse(xhr.response);
        //datos de materia
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          console.log(valor);
          var fila = '<tr>';

          fila += '<td>';
          fila += valor.clave;
          fila += '</td>';

          fila += '<td>';
          fila += valor.unidad_contenido;
          fila += '</td>';

          fila += '<td>';
          fila += valor.semestre;
          fila += '</td>';

          fila += '<td>';
          fila += valor.nombre === null ? "" : valor.nombre;
          fila += '</td>';

          fila += '<td>';
          fila += valor.horas;
          fila += '</td>';


          fila += '<td>';
          fila += valor.creditos;
          fila += '</td>';


          /*fila += '<td>';
          fila += valor.nombreacademia === null ? "" : valor.nombreacademia;
          fila += '</td>';*/

          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="'+valor.clave+'" onclick="cargar_datos_materias(this)" class="btn btn-primary" data-toggle="modal" data-target="#modal_modificar_materia">Editar</button>';
          fila += '</td>';


         /* fila += '<td>';
          fila += '<button class="btn btn-lg btn-danger" type="button" value="'+valor.clave+'" onclick="eliminar_materia(this,\''+valor.unidad_contenido+'\')" class="btn btn-primary" data-toggle="modal" data-target="#modal_eliminar_materia">Eliminar</button>';
          fila += '</td>';*/



          fila += '</tr>';

          document.getElementById("tabla").innerHTML += fila;
        });

        formato_tabla();
      }

      xhr.send(null);
      
    }



  function eliminar_materia(e,nombremateria) {
      document.getElementById("clave_eliminar").value = e.value;
      document.getElementById("nombre_materia").innerHTML =nombremateria;
    }

function limpiar_formulario_actualizar(){
	      document.getElementById("mclave").value ="";
        document.getElementById("munidad_contenido").value = "";
        document.getElementById("mhoras").value = "";
        document.getElementById("mcreditos").value = "";
        document.getElementById("msemestre").value = "";
        document.getElementById("mcomponente").value = "";
        document.getElementById("macademia").value ="";
}

function cargar_datos_materias(e) {
      limpiar_formulario_actualizar();
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_materias/get_datos_materia/'+e.value, true);
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
        document.getElementById("mclave").value = datos.materia.clave;
        document.getElementById("munidad_contenido").value = datos.materia.unidad_contenido;
        document.getElementById("mhoras").value = datos.materia.horas;
        document.getElementById("mcreditos").value = datos.materia.creditos;
        document.getElementById("msemestre").value = datos.materia.semestre;
        document.getElementById("mcomponente").value = datos.materia.componente;
        document.getElementById("macademia").value = datos.materia.Academia_id_academia;
        
      }

      xhr.send(null);
    

}


var form = document.getElementById("nuevamateria");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/C_materias/agregarMateria",true);
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
            title: 'Materia agregada',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modalnuevamateria').modal('toggle');
          borrar_formato_tabla();
          cargar_tabla();
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



  var form_modificar = document.getElementById("modificarmateria");
  form_modificar.onsubmit = function(e){
    e.preventDefault();
    var formdata_modificar = new FormData(form_modificar);
    var xhr =  new XMLHttpRequest();
    xhr.open("POST","<?php echo base_url();?>index.php/C_materias/modificarMateria",true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if(xhr.responseText==="si"){
        Swal.fire({
            type: 'success',
            scrollbarPadding:false,
            title: 'Materia actualizada',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modal_modificar_materia').modal('toggle');
          borrar_formato_tabla();
          cargar_tabla();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al actualizar los datos de materia',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
    xhr.send(formdata_modificar);
    
  }


 var form_eliminar = document.getElementById("eliminarmateria");
  form_eliminar.onsubmit = function(e){
    e.preventDefault();
    var formdata_eliminar = new FormData(form_eliminar);
    var xhr =  new XMLHttpRequest();
    xhr.open("POST","<?php echo base_url();?>index.php/C_materias/eliminarMateria",true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if(xhr.responseText==="si"){
        Swal.fire({
            type: 'success',
            scrollbarPadding:false,
            title: 'Materia eliminada exitosamente',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modal_eliminar_materia').modal('toggle');
          borrar_formato_tabla();
          cargar_tabla();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al eliminar los datos de materia',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
    xhr.send(formdata_eliminar);
    
  }



cargar_tabla();
</script>

