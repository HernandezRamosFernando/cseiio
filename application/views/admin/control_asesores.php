<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de asesores</a>
      </li>
      <li class="breadcrumb-item active">Seleccione que desea hacer</li>
    </ol>    



    <div class="card">
      <div class="card-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="asesor_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="asesor_curp_busqueda">CURP</label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="asesor_plantel_busqueda" name="asesor_plantel_busqueda">
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

        


    <div class="card">
      <div class="card-body">

        
      <div class="row justify-content-end">
        <div class="col-2"><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#agregar"
                    id="agregar_usuario">Agregar Asesor</button>
         </div>
  		</div>
<br>

      <table class="table table-hover" id="tabla_completa" style="width: 100%">
          
          <thead class="thead-light">
            <tr>

              <th scope="col" class="col-md-1">Nombre Completo</th>
              <th scope="col" class="col-md-1">CCT procedencia</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">Puesto de trabajo</th>
              
              <th scope="col" class="col-md-1">Editar</th>
              <th scope="col" class="col-md-1">Eliminar</th>
            </tr>
          </thead>



            <tbody id="tabla_asesor">
                      
                      
            </tbody>
      </table>



      </div>
    </div>


  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<!-- Inicia modal para agregar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="modal_modificar_asesor">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modificar Asesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="agregar_asesor">
      
       <div class="modal-body">
           <table class="table table-hover" id="" style="width: 100%"  border="1">
          
                      <thead class="thead-light">
                        <tr>

                          <th scope="col" class="col-md-1">Materia</th>
                          <th scope="col" class="col-md-1">Clave</th>
                          <th scope="col" class="col-md-1">Parcial 1</th>
                          <th scope="col" class="col-md-1">Parcial 2</th>
                          <th scope="col" class="col-md-1">Parcial 3</th>
                          <th scope="col" class="col-md-1">Examen Final</th>
                        </tr>
                      </thead>



                        <tbody id="tabla_completa">
                                  
                        </tbody>
        </table>

           
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal para agregar asesor-->

<!-- Inicia modal para agregar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="agregar">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Asesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="agregar_asesor">
      
       <div class="modal-body">
       
       
           <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras validas"
                    class="form-control text-uppercase" id="asesor_nombre" name="asesor_nombre"
                    onchange="valida(this)" placeholder="Nombre(s)" style="color: #237087">
                  <label for="asesor_nombre">Nombre(s)</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras"
                    class="form-control text-uppercase" id="asesor_apellido_paterno" onchange="valida(this)"
                    name="asesor_apellido_paterno" placeholder="Apellido Paterno" style="color: #237087" >
                  <label for="asesor_apellido_paterno">Primer Apellido</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="asesor_apellido_materno" onchange="valida(this)"
                    name="asesor_apellido_materno" placeholder="Apellido Materno" style="color: #237087" >
                  <label for="asesor_apellido_materno">Segundo Apellido</label>
                </div>
              </div>
            </div>
            </div>
            
            <div class="form-group">
            <div class="row">
            
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                    id="asesor_curp" name="asesor_curp" placeholder="CURP" style="color: #237087">
                  <label for="asesor_curp">CURP</label>
                </div>
              </div>

              
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{13}" title="Faltan datos" class="form-control text-uppercase"
                    id="asesor_rfc" name="asesor_rfc" placeholder="RFC" style="color: #237087">
                  <label for="asesor_rfc">RFC</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos"
                    class="form-control text-uppercase" id="asesor_nss" name="asesor_nss"
                    placeholder="Numero de Seguro Social" style="color: #237087 ">
                  <label for="asesor_nss">NSS (IMSS)</label>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="form-group">
            <div class="row">
            	<div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_puesto"
                    onChange=""
                    id="asesor_puesto">
                    <option></option>
                  </select>
                  <span>Puesto</span>
                </label>
              </div>
              
              <div class="col-md-6">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_categoria"
                    onChange=""
                    id="asesor_categoria">
                    <option></option>
                  </select>
                  <span>Categoría</span>
                </label>
              </div>
          
          </div>
          </div>
          
          <div class="form-group">
            <div class="row">
            	<div class="col-md-3">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_modalidad"
                    onChange=""
                    id="asesor_modalidad">
                    <option></option>
                  </select>
                  <span>Modalidad</span>
                </label>
              </div>
              
              <div class="col-md-9">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="asesor_plantel"
                    onChange=""
                    id="asesor_plantel">
                    <option></option>
                  </select>
                  <span>Plantel CCT</span>
                </label>
              </div>
          
          </div>
          </div>
          
          
          
          
          
          
          
          <div class="form-group">
            <div class="row">
            <div class="col-md-4">
                <div class="form-label-group">
                  <input type="date" title="Faltan datos" class="form-control text-uppercase"
                    id="asesor_fecha_nacimiento" name="asesor_fecha_nacimiento" placeholder="Fecha " style="color: #237087">
                  <label for="asesor_fecha_nacimiento">Fechade nacimiento</label>
                </div>
              </div>
          
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

<!--Termina modal para agregar asesor-->


<!-- Inicia modal para modificar asesor-->

<div class="modal" tabindex="-1" role="dialog" id="modifcar">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Asesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="agregar_asesor">
      
       <div class="modal-body">
           <table class="table table-hover" id="" style="width: 100%"  border="1">
          
                      <thead class="thead-light">
                        <tr>

                          <th scope="col" class="col-md-1">Materia</th>
                          <th scope="col" class="col-md-1">Clave</th>
                          <th scope="col" class="col-md-1">Parcial 1</th>
                          <th scope="col" class="col-md-1">Parcial 2</th>
                          <th scope="col" class="col-md-1">Parcial 3</th>
                          <th scope="col" class="col-md-1">Examen Final</th>
                        </tr>
                      </thead>



                        <tbody id="tabla_asesor">
                                  
                        </tbody>
        </table>

           
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!--Termina modal para modificar asesor-->




<script>

function buscar() {
    document.getElementById("asesor_plantel_busqueda").disabled = true;
    document.getElementById("asesor_curp_busqueda").disabled = true;
    document.getElementById("tabla_asesor").innerHTML = "";
    var curp = document.getElementById("asesor_curp_busqueda").value;
    var plantel = document.getElementById("asesor_plantel_busqueda").value;

    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/C_asesor/buscar_asesores_plantel?'+query, true);
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
          fila += valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre;
          fila += '</td>';

          fila += '<td>';
          fila += valor.Plantel_cct_plantel;
          fila += '</td>';

          fila += '<td>';
          fila += valor.curp;
          fila += '</td>';

          fila += '<td>';
          fila += valor.puesto;
          fila += '</td>';

          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="" onclick="cargar_datos_materias(this)" class="btn btn-primary" data-toggle="modal" data-target="#modal_modificar_asesor">Editar</button>';
          fila += '</td>';


          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="" onclick="cargar_datos_materias(this)" class="btn btn-primary" data-toggle="modal" data-target="#modal_eliminar_asesor">Eliminar</button>';
          fila += '</td>';




          fila += '</tr>';

          document.getElementById("tabla_asesor").innerHTML += fila;
        });

        formato_tabla();
      }

      xhr.send(null);
	  
	  limpiarbusqueda();
      
    }
	
	
	function limpiarbusqueda(){
    document.getElementById("asesor_curp_busqueda").disabled = true;
    document.getElementById("asesor_plantel_busqueda").disabled = true;
    document.getElementById('btn_buscar').classList.remove('btn-success');
    document.getElementById('btn_buscar').classList.add('btn-info');
    document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
    document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
  }

</script>