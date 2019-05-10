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
              <span>Semestre del grupo a  buscar</span>
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
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente()" style="padding: 1rem" id="crear_grupo">Mostrar materia</button>
            </div>
          </div>
      </div>



      <div class="row" id="alumnos_oculto" style="display: none">
      <div class="col-md-12" id="tabla_alumnos" >
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
                <th scope="col" class="col-md-1">Promedio Modular</th>
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
        <div class="col-md-12" id="agregar_oculto" style="display: none">
        <button type="button" value="nuevo" onclick="guardar()" id="boton_agregar" class="btn btn-success btn-lg btn-block btn-guardar"  style="padding: 1rem"> Guardar cambios</button> 
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
        examen_final:tabla.childNodes[i].childNodes[6].childNodes[0].value===""?null:tabla.childNodes[i].childNodes[6].childNodes[0].value
      }

      datos.push(dato);
  }

  //console.log(datos);

  var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?php echo base_url();?>index.php/c_grupo_estudiante/agregar_calificaciones_materia_grupo', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onloadstart = function(){
    $('#div_carga').show();
  }
  xhr.error = function (){
    console.log("error de conexion");
  }
      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            $('#div_carga').hide();
              if (xhr.responseText.trim() === "si") {
                console.log(xhr.response);
                    swalWithBootstrapButtons.fire({
                    type: 'success',
                    text: 'Datos guardados correctamente',
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                    if (result.value) {
                    //aqui va el aceptar
                    $(document).scrollTop(0);
                    location.reload(); 
                      }
                    //aqui va si cancela
                    });
               }else{
                Swal.fire({
                  type: 'error',
                  text: 'Datos no guardados'
                 });
               }
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

function validarcomponente(){

if(document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != ''  && document.getElementById("materias").value != ''){
  cargar_materia();
}else{
  Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
  }
}
function limpiarbusqueda(){
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById("materias").disabled = true;
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-info');
    document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
    document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
  }



function cargar_materia(){
  document.getElementById("alumnos_oculto").style.display = "";
  document.getElementById("agregar_oculto").style.display = "";
  var permisos = new XMLHttpRequest();
      permisos.open('GET', '<?php echo base_url();?>index.php/c_permisos/get_permiso_plantel?plantel='+document.getElementById("plantel").value, true);
      permisos.onloadstart = function(){
    $('#div_carga').show();
  }
  permisos.error = function (){
    console.log("error de conexion");
  }
  
  permisos.onload = function(){
    $('#div_carga').hide();
        //console.log(JSON.parse(xhr.response)[0];
        var permisos_plantel = JSON.parse(permisos.response)[0];
        if(permisos_plantel===undefined){
          var permisos_plantel = {
            primer_parcial:"0",
            segundo_parcial:"0",
            tercer_parcial:"0",
            examen_final:"0"
          }
        }


        //cargar inputs
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
        var promedio="";
        if(valor.primer_parcial != null && valor.segundo_parcial != null && valor.tercer_parcial != null)
        {
          promedio = (parseInt(valor.primer_parcial) + parseInt(valor.segundo_parcial) + parseInt(valor.tercer_parcial))/3;
          console.log(promedio);
          promedio = redondeo(promedio);
        }
        var registro = "<tr>";
        registro+='<td>'+valor.nombre+' '+valor.primer_apellido+' '+valor.segundo_apellido+'</td>';
        registro+='<td>'+valor.no_control+'</td>';
        var primer_parcial = valor.primer_parcial!==null?valor.primer_parcial:"";

        if(permisos_plantel.primer_parcial==="1"){
          registro+='<td><input type="text" class="form-control" name="primer_parcial" value="'+(primer_parcial==="0"?"/":primer_parcial)+'" id="primer_parcial" placeholder="Primer Parcial" onchange="calificaciones(this);"></td>';
        }
        else{
          registro+='<td><input type="text" class="form-control" name="primer_parcial" value="'+(primer_parcial==="0"?"/":primer_parcial)+'" id="primer_parcial" placeholder="Primer Parcial" disabled></td>';
        }

        var segundo_parcial = valor.segundo_parcial!==null?valor.segundo_parcial:"";
        if(permisos_plantel.segundo_parcial==="1"){
          registro+='<td><input type="text" class="form-control" name="segundo_parcial" value="'+(segundo_parcial==="0"?"/":segundo_parcial)+'" id="segundo_parcial" placeholder="Segundo Parcial" onchange="calificaciones(this);"></td>';
        }

        else{
          registro+='<td><input type="text" class="form-control" name="segundo_parcial" value="'+(segundo_parcial==="0"?"/":segundo_parcial)+'" id="segundo_parcial" placeholder="Segundo Parcial" disabled></td>';

        }

        var tercer_parcial = valor.tercer_parcial!==null?valor.tercer_parcial:"";
        if(permisos_plantel.tercer_parcial==="1"){
          registro+='<td><input type="text" class="form-control" name="tercer_parcial" value="'+(tercer_parcial==="0"?"/":tercer_parcial)+'" id="tercer_parcial" placeholder="Tercer Parcial" onchange="calificaciones(this);"></td>';
        }
        else{
          registro+='<td><input type="text" class="form-control" name="tercer_parcial" value="'+(tercer_parcial==="0"?"/":tercer_parcial)+'" id="tercer_parcial" placeholder="Tercer Parcial" disabled></td>';
        }

        if(promedio>=6){
          registro+='<td><input type="text" class="form-control" name="promedio_modular" value="'+promedio+'" id="promedio_modular" placeholder="Promedio Modular" onchange="calificaciones(this);" disabled></td>';
        }else{
          registro+='<td><input type="text" class="form-control" name="promedio_modular" value="'+promedio+'" id="promedio_modular" placeholder="Promedio Modular" onchange="calificaciones(this);" disabled style="color: red"></td>';
        }
        
        var examen_final = valor.examen_final!==null?valor.examen_final:"";
        if(permisos_plantel.examen_final==="1" && promedio >= 6 ){
          registro+='<td><input type="text" class="form-control" name="examen_final" value="'+(examen_final==="0"?"/":examen_final)+'" id="examen_final" placeholder="Examen Final" onchange="calificaciones(this);"></td>';
          }else if (permisos_plantel.examen_final==="1" && promedio < 6){
              registro+='<td><input type="text" class="form-control" name="examen_final" value="'+(examen_final==="0"?"/":examen_final)+'" id="examen_final" placeholder="Examen Final" onchange="calificaciones(this);" disabled></td>';
            }else{
              registro+='<td><input type="text" class="form-control" name="examen_final" value="'+(examen_final==="0"?"/":examen_final)+'" id="examen_final" placeholder="Examen Final" disabled></td>';
            }
        registro+='</tr>';
        document.getElementById("tablagrupo").innerHTML+=registro;
      });
    }

    xhr.send(null);
    limpiarbusqueda();
        //fin cargar inputs
      };

      permisos.send(null);
/*
    */
  
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


function calificaciones(e) {
  var string= e.value.toString();

  for (var i=0, output='', validos="0123456789./"; i<string.length; i++){
       if (validos.indexOf(string.charAt(i)) != -1)
          output += string.charAt(i)
  }
  console.log(output);
  if(output != ""){
   if(output >= 6 && output <= 10 ){
    var valor=parseFloat(output);
    valor = Math.round(valor); 
    console.log(valor)
    e.value= valor;
    e.style.color = "black";
    }else if (output === "/"){
      e.style.color = "black";
    }else if (output >= 0 && output < 6 ){
      e.value= 5;
      e.style.color = "red";
    }else{
    console.log("valor no valido")
    e.value = "";
    }
   }else{
     e.value="";
   }
   //e.value=output;
  }

  function redondeo(e) {
    if(e >= 6 && e <= 10 ){
    var valor=parseFloat(e);
    valor = Math.round(valor); 
    return valor;
    }else if (e === 0){
      return "/";
    }else if (e > 0 && e < 6 ){
      return 5;
    }else{
     return "";
    }
  }
    </script>