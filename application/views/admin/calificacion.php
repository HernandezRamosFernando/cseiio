<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Asignar calificaciones</a>
      </li>
      <li class="breadcrumb-item active">Busque la materia que desea calificar</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="plantel"   name="plantel">
                <option value="">Seleccione el plantel donde buscar el grupo</option>

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
              <span>Seleccione el semestre del grupo a  buscar</span>
            </label>
          </div>

        </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" onchange="cargar_materias()" name="grupos" id="grupos">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de grupos</span>
            </label>
          </div>
                                    </div>
                                    </div>

      <div class="form-group">
        <div class="row">


          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="materias" id="materias">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de materias del grupo</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="cargar_materia()" style="padding: 1rem" id="crear_grupo">Mostrar materia</button>
            </div>
          </div>
      </div>



      <div class="row" id="alumnos_oculto" style="display:">
      

      <div class="col-md-12" id="tabla_alumnos">
        <div class="card card-body">
          <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%">
            <caption>Lista de los alumnos del grupo</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Parcial 1</th>
                <th scope="col" class="col-md-1">Parcial 2</th>
                <th scope="col" class="col-md-1">Parcial 3</th>
                <th scope="col" class="col-md-1">Examen Final</th>
              </tr>
            </thead>

            <tbody id="tablagrupo">

            </tbody>
          </table>
        </div>
      </div>

     </div>
   </form>
    <br>
        <div class="col-md-12" id="agregar_oculto">
        <button type="button" value="nuevo" onclick="guardar()" id="boton_agregar" class="btn btn-success btn-lg btn-block"  style="padding: 1rem"> Guardar cambios</button> 
        </div>

    </div>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

function guardar(){
  var tabla = document.getElementById("tablagrupo");
  var datos = new Array();

  for(let i=0;i<tabla.childNodes.length;i++){
      var dato = {
        id_grupo:document.getElementById("grupos").value,
        materia:document.getElementById("materias").value,
        no_control:tabla.childNodes[i].childNodes[1].innerText,
        primer_parcial:tabla.childNodes[i].childNodes[2].childNodes[0].value===""?null:tabla.childNodes[i].childNodes[2].childNodes[0].value,
        segundo_parcial:tabla.childNodes[i].childNodes[3].childNodes[0].value===""?null:tabla.childNodes[i].childNodes[3].childNodes[0].value,
        tercer_parcial:tabla.childNodes[i].childNodes[4].childNodes[0].value===""?null:tabla.childNodes[i].childNodes[4].childNodes[0].value,
        examen_final:tabla.childNodes[i].childNodes[5].childNodes[0].value===""?null:tabla.childNodes[i].childNodes[5].childNodes[0].value
      }

      datos.push(dato);
  }

  var xhr = new XMLHttpRequest();
      xhr.open("POST", '/cseiio/c_grupo_estudiante/agregar_calificaciones_materia_grupo', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              console.log(xhr.response);
          }
      }
      xhr.send(JSON.stringify(datos));

  console.log(datos);
}


    function validarcomponente(){

if(document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != '' ){
  //
}else{
  Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
  }
}

function cargargrupos() {
if (document.getElementById("plantel").value === "") {
  Swal.fire({
    type: 'info',
    text: 'Debe seleccionar un plantel'
  });
  $("#semestre_grupo").val('');
}else{
  var xhr = new XMLHttpRequest();
  var plantel = document.getElementById("plantel").value;
  console.log(plantel);

  var semestre = document.getElementById("semestre_grupo").value;
  console.log(semestre);
  grupos.innerHTML="";
  xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_grupos_plantel_htmloption?plantel=' + plantel + '&semestre='+ semestre , true);
  xhr.onloadstart = function(){
    $('#div_carga').show();
  }
  xhr.error = function (){
    console.log("error de conexion");
  }
  xhr.onload = function(){
    $('#div_carga').hide();
   if(xhr.response === ""){
   var option = document.createElement("option");
   option.text = "Ningun grupo creado";
   option.value = "";
   grupos.add(option); 
   }else{
    console.log(xhr.response);
     grupos.innerHTML = xhr.responseText;
    }
    };  
   xhr.send(null);
}
}



function cargar_materia(){
  document.getElementById("tablagrupo").innerHTML="";
  var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo_materia?grupo='+document.getElementById("grupos").value+'&materia='+document.getElementById("materias").value, true);
    xhr.onloadstart = function(){
    $('#div_carga').show();
  }
  xhr.error = function (){
    console.log("error de conexion");
  }
  xhr.onload = function(){
    $('#div_carga').hide();
      console.log(JSON.parse(xhr.response));
      JSON.parse(xhr.response).forEach(function(valor,indice){
        var registro = "<tr>";
        registro+='<td>'+valor.nombre+' '+valor.primer_apellido+' '+valor.segundo_apellido+'</td>';
        registro+='<td>'+valor.no_control+'</td>';
        var primer_parcial = valor.primer_parcial!==null?valor.primer_parcial:"";
        registro+='<td><input type="text" class="form-control" name="primer_parcial" value="'+primer_parcial+'" id="primer_parcial" placeholder="Primer Parcial"></td>';
        var segundo_parcial = valor.segundo_parcial!==null?valor.segundo_parcial:"";
        registro+='<td><input type="text" class="form-control" name="segundo_parcial" value="'+segundo_parcial+'" id="segundo_parcial" placeholder="Segundo Parcial"></td>';
        var tercer_parcial = valor.tercer_parcial!==null?valor.tercer_parcial:"";
        registro+='<td><input type="text" class="form-control" name="tercer_parcial" value="'+tercer_parcial+'" id="tercer_parcial" placeholder="Tercer Parcial"></td>';
        var examen_final = valor.examen_final!==null?valor.examen_final:"";
        registro+='<td><input type="text" class="form-control" name="examen_final" value="'+examen_final+'" id="examen_final" placeholder="Examen Final"></td>';
        registro+='</tr>';
        document.getElementById("tablagrupo").innerHTML+=registro;
      });
    }

    xhr.send(null);
  
}


function cargar_materias(){
  if(document.getElementById("grupos").value != ""){
  var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_materias_grupo?grupo='+document.getElementById("grupos").value, true);
    xhr.onloadstart = function(){
    $('#div_carga').show();
  }
  xhr.error = function (){
    console.log("error de conexion");
  }
  xhr.onload = function(){
    $('#div_carga').hide();
      let opciones = "";
      JSON.parse(xhr.response).forEach(function(valor,indice){
        opciones+= '<option value="'+valor.clave+'">'+valor.unidad_contenido+'</option>';
      });

      document.getElementById("materias").innerHTML=opciones;
    };

    xhr.send(null);
    }else{
      document.getElementById("materias").innerHTML = '';
  }
}
    </script>