<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Buscar grupos</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos requeridos para crear un grupo</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"="" id="plantel"   name="plantel">
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
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" onchange="cargargrupos()" name="semestre_grupo"
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
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"  name="grupos" id="grupos">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de grupos</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="buscar_estudiantes_grupo()" style="padding: 1rem" id="crear_grupo">Mostrar grupo</button>
            </div>
          </div>
        </div>

        <div class="row" id="botones" style="display:none">
          <div class="col-md-6">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="btnagregar_alumnos();" style="padding: 1rem" id="agregar_alumnos">Agregar alumnos al grupo</button>
          </div>
          <div class="col-md-6">
            <button type="button" class="btn btn-warning btn-lg btn-block" onclick="btnquitar_alumnos();" style="padding: 1rem" id="quitar_alumnos">Quitar alumnos al grupo</button>
          </div>
        </div>


      <div class="row" id="alumnos_oculto" style="display:none">
      

      <div class="col-md-6" id="tabla_alumnos">
        <div class="card card-body">
          <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%">
            <caption>Lista del Grupo creado</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Opción</th>
              </tr>
            </thead>

            <tbody id="tablagrupo">

            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-6" style="display:none" id="tabla_completa_alumnos">
        <div class="card card-body" >
          <table class="table table-hover" id="tabla_completa" style="width: 100%">
            <caption>Lista de todos los alumnos de este semestre sin grupo</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Opción</th>
              </tr>
            </thead>
            <tbody id="tabla">
            </tbody>
          </table>
        </div>
      </div>

     </div>
   </form>
    <br>
    <button type="button" value="nuevo" onclick="enviar_formulario()" id="boton_agregar" class="btn btn-success btn-lg btn-block" style="display: none"> Guardar Alumnos</button>
    </div>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>

var lista_alumnos=new Array();
function cargargrupos() 
{
  if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        title: 'Debe seleccionar un plantel',
        showConfirmButton: false,
        timer: 2500
      });
    }else{
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);
  
      var semestre = document.getElementById("semestre_grupo").value;
      console.log(semestre);
      grupos.innerHTML="";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_grupos_plantel_html?plantel=' + plantel + '&semestre='+ semestre , true);
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

function btnagregar_alumnos() {
  //document.getElementById('agregar_alumnos').value = 
  document.getElementById('agregar_alumnos').classList.remove('btn-success');
  document.getElementById('agregar_alumnos').classList.add('btn-dark');
  document.getElementById('agregar_alumnos').disabled = true;
  document.getElementById('quitar_alumnos').style.display = "none";
  document.getElementById('tabla_completa_alumnos').style.display = "";
  document.getElementById('tabla_alumnos').classList.remove('col-md-12');
  document.getElementById('tabla_alumnos').classList.add('col-md-6');
  document.getElementById('boton_agregar').style.display = "";
  buscar();
  
}
function btnquitar_alumnos() {
  document.getElementById('boton_agregar').value = "eliminar";
  document.getElementById('quitar_alumnos').classList.remove('btn-success');
  document.getElementById('quitar_alumnos').classList.add('btn-dark');
  document.getElementById('quitar_alumnos').disabled = true;
  document.getElementById('agregar_alumnos').style.display = "none";
  document.getElementById('boton_agregar').style.display = "";
  buscar_quitar_estudiantes();

  
}



function validarcomponente(){
if (document.getElementById("grupos").value === "5" || document.getElementById("grupos").value === "6") {
  if(document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != "" && document.getElementById("seleccione_componente").value != "" && document.getElementById("grupo_componente").value != ""){
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("grupo_ciclo_escolar").disabled = true;
    document.getElementById("seleccione_componente").disabled = true;
    document.getElementById("grupo_componente").disabled = true;
    alerta_grupo();

  }else{
    Swal.fire({
            type: 'warning',
            title: 'Agregue los datos faltantes'
          });
    }

  }else{
    if(document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != ""){
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("grupo_ciclo_escolar").disabled = true;
    alerta_grupo();
    }else{
    Swal.fire({
            type: 'warning',
            title: 'Agregue los datos faltantes'
          });
      }
  }
}

  function buscar() { 
    var xhr = new XMLHttpRequest();
    var semestre = document.getElementById("semestre_grupo").value;
    var plantel = document.getElementById("plantel").value;
    var query = 'semestre=' + semestre + '&plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/get_estudiantes_plantel_semestre?' + query, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="cambiardetabla(this);">Agregar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tabla").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('boton_agregar').style.display = "";
    document.getElementById('alumnos_oculto').style.display = "";
    limpiarbusqueda();
  }

  function buscar_estudiantes_grupo() {
    idgrupo=document.getElementById("grupos").value;
    console.log(idgrupo);
    document.getElementById("tablagrupo").innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo?id_grupo=' + idgrupo, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-dark" type="button" value="' + valor.no_control + '" id="botoncambio" disabled="true">Deshabilitado</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('alumnos_oculto').style.display = "";
    document.getElementById('botones').style.display = "";
    document.getElementById('tabla_alumnos').classList.remove('col-md-6');
    document.getElementById('tabla_alumnos').classList.add('col-md-12');
    limpiarbusqueda();

  }

  function limpiarbusqueda(){
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
    document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
    document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
  }

  function buscar_quitar_estudiantes() {
  idgrupo=document.getElementById("grupos").value;
    console.log(idgrupo);
    document.getElementById("tablagrupo").innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo?id_grupo=' + idgrupo, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="eliminar(this)" >Eliminar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
      });
      //formato_tabla();


      var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
      lista_alumnos = new Array();
    for(let i=0;i<alumnos.length;i++){
      lista_alumnos.push(alumnos[i].children[1].innerText);
    }

    console.log(lista_alumnos);
    };
    xhr.send(null);
    document.getElementById('alumnos_oculto').style.display = "";
    document.getElementById('botones').style.display = "";
    document.getElementById('tabla_alumnos').classList.remove('col-md-6');
    document.getElementById('tabla_alumnos').classList.add('col-md-12');
    limpiarbusqueda();
  }
  function enviar_formulario(){

    if(document.getElementById("boton_agregar").value==="eliminar"){

      var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for(let i=0;i<alumnos.length;i++){
      alumnos_json.push(alumnos[i].children[1].innerText);
    }
    
    if(alumnos_json.length===0){
    alert("si el grupo esta vacio, este se eliminara");
    }

    else{
      //lista_alumnos
    var faltantes = new Array();
    lista_alumnos.forEach(function(valor,indice){
      if(alumnos_json.indexOf(valor)<0){
            faltantes.push(valor);
        }
    });

    var datos={
      id_grupo:document.getElementById("grupos").value,
      eliminados:faltantes
    }

    var xhr = new XMLHttpRequest();
      xhr.open("POST", '/cseiio/c_grupo/delete_estudiantes_grupo', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              console.log(xhr.response);
          }
      }
      xhr.send(JSON.stringify(datos));
    }

    }

    else{

      var tabla = document.getElementById("tabla_completa_grupo");
      var filas = tabla.children[2].children;
      var estudiantes = new Array();
      
      for(let i=0;i<filas.length;i++){
          //console.log(filas[i].children[2].children.botoncambio.disabled);
          if(filas[i].children[2].children.botoncambio.disabled===false){
            estudiantes.push(filas[i].children[2].children.botoncambio.value);
          }
      }

      var datos = {
        estudiantes:estudiantes,
        id_grupo:document.getElementById("grupos").value,
        semestre:document.getElementById("semestre_grupo").value
      }

      var xhr = new XMLHttpRequest();
      xhr.open("POST", '/cseiio/c_acreditacion/agregar_estudiantes_grupo_editado', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
             console.log(xhr.response);
          }
      }
      xhr.send(JSON.stringify(datos));

      //console.log(estudiantes);

    }

    

    //console.log(faltantes);
  }


  function eliminar(e){
    var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for(let i=0;i<alumnos.length;i++){
      alumnos_json.push(alumnos[i].children[1].innerText);
    }
    $(e).parents('tr').detach();

    console.log(alumnos_json);
  }


</script>
</html>