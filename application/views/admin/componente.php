  <div id="content-wrapper">

      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Lista de componentes</a>
          </li>
          <li class="breadcrumb-item active">Ingrese los datos requeridos</li>
        </ol>


        <div class="card">
          <div class="card-body">

        <div class="row">
    		<div class="col">
		        
		        <div class="float-right">
		        	<button type='button' class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#modal_nuevo_componente" id="btn_buscar"
                    onclick='reset_modal_ingresar()'>Agregar componente</button>
		        </div>
    		</div>
		</div>

		  </div>
        </div>

 


      


		
      <!--Empieza lista de las componentees-->
		<div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_completa" style="width: 100%">
              <caption>Lista de todas las componentes</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre</th>
                  <th scope="col" class="col-md-1">Nombre corto</th>
                  <th scope="col" class="col-md-1">Editar</th>
                  <th scope="col" class="col-md-1">Borrar</th>
                </tr>
              </thead>
              <tbody id="tabla">
              	

              </tbody>
            </table>
          </div>
        </div>



       <!--TErmina lista de las componentees-->


      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->







  <!--Inicia modal de agregar componente -->

      <div class="modal fade" id="modal_nuevo_componente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar componente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              
      <form id="nuevocomponente">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-label-group">
                    <input type="text" required="required"
                      class="form-control text-uppercase" id="componente"
                      name="componente" placeholder="Nombre de componente">
                    <label for="componente">componente</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-2">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="nombre_corto" name="nombre_corto"
                      placeholder="Nombre corto" required="required">
                    <label for="nombre_corto">Nombre Corto</label>
                  </div>
                  <br>
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


      <!--Termina modal de agregar componente-->



      <!--Inicia modal de modificar componente -->

      <div class="modal fade" id="modal_modificar_componente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modificar componente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              
      <form id="modificarcomponente">

        <input type="hidden" name="midcomponente" id="midcomponente">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-label-group">
                    <input type="text" required="required"
                      class="form-control text-uppercase" id="mcomponente"
                      name="mcomponente" placeholder="Nombre de componente">
                    <label for="mcomponente">componente</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-2">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase"
                      id="mnombre_corto" name="mnombre_corto"
                      placeholder="Nombre corto" required="required">
                    <label for="mnombre_corto">Nombre Corto</label>
                  </div>
                  <br>
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
<!--Termina modal de modificar componente-->

 <!-- Empieza modal de eliminar componente -->
      <div class="modal fade" id="modal_eliminar_componente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmación de eliminación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="eliminarcomponente">

              <input type="hidden" name="eidcomponente" id="eidcomponente">
            <div class="modal-body">
              <div class="container-fluid">
                ¿Esta seguro que desea eliminar a esta materia? 
                <br>
                <br><span style="font-weight: bold; text-align: center;" id="enombre_componente"></span>
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
<!-- termina modal de eliminar componente -->

<script>

function borrar_formato_tabla(){
  $("#tabla_completa").dataTable().fnDestroy();
  
}

function reset_modal_ingresar(){
  document.getElementById("nuevocomponente").reset();
}


function eliminar_componente(e,nombrecomponente) {
      document.getElementById("eidcomponente").value = e.value;
      document.getElementById("enombre_componente").innerHTML =nombrecomponente;
    }


function cargar_datos_componente(e) {
      
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_componente/get_componente/'+e.value, true);
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
        document.getElementById("midcomponente").value = datos.componente.id_componente;
        document.getElementById("mnombre_corto").value = datos.componente.nombre_corto;
        document.getElementById("mcomponente").value = datos.componente.nombre;
      }

      xhr.send(null);
    

}




function cargar_tabla() {
    document.getElementById("tabla").innerHTML="";
    var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_componente/get_lista/', true);
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
          fila += valor.nombre;
          fila += '</td>';

          fila += '<td>';
          fila += valor.nombre_corto;
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="'+valor.id_componente+'" onclick="cargar_datos_componente(this)" class="btn btn-primary" data-toggle="modal" data-target="#modal_modificar_componente">Editar</button>';
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="'+valor.id_componente+'" onclick="eliminar_componente(this,\''+valor.nombre+'\')" class="btn btn-primary" data-toggle="modal" data-target="#modal_eliminar_componente">Eliminar</button>';
          fila += '</td>';



          fila += '</tr>';

          document.getElementById("tabla").innerHTML += fila;
        });

        formato_tabla();
      }

      xhr.send(null);
      
    }


    

var form = document.getElementById("nuevocomponente");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/C_componente/agregar_componente",true);
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
            title: 'Nuevo componente agregado',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modal_nuevo_componente').modal('toggle');
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



  var form_modificar = document.getElementById("modificarcomponente");
  form_modificar.onsubmit = function(e){
    e.preventDefault();
    var formdata_modificar = new FormData(form_modificar);
    var xhr =  new XMLHttpRequest();
    xhr.open("POST","<?php echo base_url();?>index.php/C_componente/modificar_componente",true);
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
            title: 'componente actualizado',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modal_modificar_componente').modal('toggle');
          borrar_formato_tabla();
          cargar_tabla();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al actualizar los datos de componente',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
    xhr.send(formdata_modificar);
    
  }


 var form_eliminar = document.getElementById("eliminarcomponente");
  form_eliminar.onsubmit = function(e){
    e.preventDefault();
    var formdata_eliminar = new FormData(form_eliminar);
    var xhr =  new XMLHttpRequest();
    xhr.open("POST","<?php echo base_url();?>index.php/C_componente/eliminar_componente",true);
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
            title: 'Componente eliminado exitosamente',
            showConfirmButton: false,
            timer: 2500 
          });

          $('#modal_eliminar_componente').modal('toggle');
          borrar_formato_tabla();
          cargar_tabla();
      }

      else{
        Swal.fire({
            type: 'error',
            scrollbarPadding:false,
            title: 'Ocurrió un error al eliminar los datos de componente',
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

