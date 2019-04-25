<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Crear grupos</a>
      </li>
      <li class="breadcrumb-item active">Ingrese los datos requeridos para crear un grupo</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"="" id="plantel"   name="plantel">
                <option value="">Seleccione el plantel donde creara el grupo</option>

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
              <select class="form-control form-control-lg" onchange="numero_alumnos(this)" name="semestre_grupo"
                id="semestre_grupo">
                <option value="">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              <span>Seleccione el semestre del grupo a crear</span>
            </label>
          </div>


          <div class="col-md-4" style="display: none" id="grupo_componente_oculto">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" name="grupo_componente" id="grupo_componente">
                <option value="SI">SI</option>
              </select>
              <span>¿Es de componente?</span>
            </label>
          </div>

          <div class="col-md-4" style="display: none" id="seleccione_componente_oculto">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" name="seleccione_componente" id="seleccione_componente">
                <option value="">Seleccione un componente</option>
              </select>
              <span>Componente</span>
            </label>
          </div>

        </div>
      </div>

      <div class="form-group">
      <div class="row">
        <div class="col-md-4">
          <label class="form-group has-float-label">
            <select class="form-control form-control-lg" id="grupo_ciclo_escolar" name="grupo_ciclo_escolar">
              <option>Seleccione el ciclo del grupo </option>

              <?php
                                        foreach ($ciclo_escolar as $ciclo)
                                        {
                                          echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->nombre_ciclo_escolar.'</option>';
                                        }
                                        ?>

            </select>
            <span>Ciclo escolar</span>
          </label>
        </div>
      </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"  name="grupo_nombre"
                id="grupo_nombre">
                <option value="">Seleccione uno</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
              </select>
              <span>Seleccione nombre del grupo</span>
            </label>
          </div>

          <div class="col-md-3">
          </div>

          <div class="col-md-4" style="display: none" id="cantidad_alumnos_oculto">
            <label id="cantidad_alumnos">Cantidad de alumnos:</label>

          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
        
          <div class="col-md-4">
          <label class="form-group has-float-label">
              <select class="form-control form-control-lg"  name="grupo_periodo"
                id="grupo_periodo">
                <option value="">Seleccione uno</option>
                <option value="A">Agosto-Diciembre</option>
                <option value="B">Enero-Julio</option>
              </select>
              <span>Periodo del grupo</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente()" style="padding: 1rem" id="crear_grupo">Crear grupo</button>
            </div>
          </div>
        </div>


      <div class="row" id="alumnos_oculto" style="display:none">
      <div class=" col-md-6">
        <div class="card card-body">
          <table class="table table-hover" id="tabla_completa" style="width: 100%">
            <caption>Lista de todos los alumnos de este semestre sin grupo</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Agregar</th>
              </tr>
            </thead>
            <tbody id="tabla">
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card card-body">
          <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%">
            <caption>Lista del Grupo creado</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Eliminar</th>
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
    <button type="button" value="nuevo" onclick="enviar_formulario()" id="boton_agregar" class="btn btn-success btn-lg btn-block" style="display: none"> Guardar Alumnos</button>
    </div>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>

function llenar_especialidad(){
  seleccione_componente.innerHTML = "Cargando datos";
  document.getElementById("plantel").setAttribute("onchange", "llenar_especialidad();");
  var xhr = new XMLHttpRequest();
  var plantel = document.getElementById("plantel").value;
  xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_plantel_especialidad_html?plantel=' + plantel , true);
  xhr.onload = function(){
    console.log(xhr.response);
    seleccione_componente.innerHTML = xhr.responseText;
    
  };
  xhr.send(null);
}

function validarcomponente(){
if (document.getElementById("semestre_grupo").value === "5" || document.getElementById("semestre_grupo").value === "6") {
  if(document.getElementById("plantel").value != '' && document.getElementById("grupo_periodo").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != "" && document.getElementById("seleccione_componente").value != "" && document.getElementById("grupo_componente").value != ""){
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
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
    if(document.getElementById("plantel").value != '' && document.getElementById("grupo_periodo").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("grupo_ciclo_escolar").value != '' && document.getElementById("grupo_nombre").value != ""){
    document.getElementById("tabla").innerHTML = "";
    document.getElementById("grupo_nombre").disabled = true;
    document.getElementById("grupo_periodo").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
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
    xhr.onload = function () {
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
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
    document.getElementById('crear_grupo').disabled = true;
    document.getElementById('boton_agregar').style.display = "";
    document.getElementById('alumnos_oculto').style.display = "";
  }

  function buscar_estudiantes_grupo(idgrupo) {
    document.getElementById("tablagrupo").innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo?id_grupo=' + idgrupo, true);
    xhr.onload = function () {
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
        fila += '<button class="btn btn-lg btn-block btn-danger" type="button" value="' + valor.no_control + '" id="botoncambio" disabled="true">Eliminar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tablagrupo").innerHTML += fila;
      });
      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-dark');
    document.getElementById('crear_grupo').disabled = true;
  }



  function numero_alumnos(e) {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        title: 'Debe seleccionar un plantel',
        showConfirmButton: false,
        timer: 2500
      });
    }

    else {
      componente_grupo(e);
     
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_acreditacion/numero_estudiantes_semestre_plantel?semestre=' + e.value + '&cct=' + document.getElementById("plantel").value, true);

      xhr.onload = function () {
        document.getElementById("cantidad_alumnos_oculto").style.display = "";
        //console.log(xhr.response);
        var cAlumnos = JSON.parse(xhr.response)[0].total_estudiante;
        if (cAlumnos <= 35) {
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear 1 grupo";
        } else {
          var cGrupos = parseInt(cAlumnos / 35);
          document.getElementById("cantidad_alumnos").innerHTML = "La cantidad de Alumnos registrados en este semestre es: " + cAlumnos + " se recomienda crear " + cGrupos + " grupos";
          console.log(cGrupos);

        }
      };

      xhr.send(null);
    }


  }


  function alerta_grupo(){

    if(parseInt(document.getElementById("semestre_grupo"))<5){
      var id_grupo = document.getElementById("plantel").value+document.getElementById("semestre_grupo").value+document.getElementById("grupo_ciclo_escolar").value+document.getElementById("grupo_periodo").value+document.getElementById("grupo_nombre").value.toUpperCase();
    }

    else{
      var valor_componente = document.getElementById("seleccione_componente").value;
      var nombre_corto_componente = valor_componente.split("-")[1];
      var id_grupo = document.getElementById("plantel").value+document.getElementById("semestre_grupo").value+document.getElementById("grupo_ciclo_escolar").value+document.getElementById("grupo_periodo").value+document.getElementById("grupo_nombre").value.toUpperCase()+"-"+nombre_corto_componente;
    }
    
    var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_existe_grupo?id_grupo='+id_grupo, true);
      xhr.onload = function () {
        console.log(JSON.parse(xhr.response)[0]);
        if(JSON.parse(xhr.response).length===0){
          swalWithBootstrapButtons.fire({
            type: 'info',
            title: 'Agregue estudiantes al grupo creado',
            confirmButtonText:'Agregar'
          });
          buscar();
         
        }
        else if(35-JSON.parse(xhr.response)[0].total_alumnos>0){
          swalWithBootstrapButtons.fire({
            type: 'warning',
            title: 'El grupo ya existe y tiene '+(35-JSON.parse(xhr.response)[0].total_alumnos)+" lugares libres",
            confirmButtonText:'Agregar estudiantes al grupo',
            showCancelButton: true,
            cancelButtonText: 'Cerrar'
          }).then(function(result){
              if(result.value){
                  buscar();
                  buscar_estudiantes_grupo(id_grupo);
                  document.getElementById("boton_agregar").value="existente";
              }
          });
        }
        else{
          Swal.fire({
            type: 'warning',
            title: 'El grupo ya existe y se encuentra lleno'
          });
        }
      };
      xhr.send(null);
}

  function enviar_formulario(){
    if(document.getElementById("boton_agregar").value==="nuevo"){
    
    var datos_grupo = {
      plantel:document.getElementById("plantel").value,
      semestre:parseInt(document.getElementById("semestre_grupo").value),
      nombre_grupo:document.getElementById("grupo_nombre").value,
      ciclo_escolar:document.getElementById("grupo_ciclo_escolar").value,
      componente:document.getElementById("seleccione_componente").value,
      periodo:document.getElementById("grupo_periodo").value
    };

    var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for(let i=0;i<alumnos.length;i++){
      alumnos_json.push(alumnos[i].children[1].innerText);
    }

    var datos = {
      grupo:datos_grupo,
      alumnos:alumnos_json
    }

    var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo', true);
      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(xhr.response);
            if (xhr.responseText.trim() === "si") {      
                Swal.fire({
                  type: 'success',
                  title: 'Datos agregados correctamente'
                 });
                 setTimeout(location.reload.bind(location), 2500); 
                 document.getElementById("tabla").innerHTML = "";
                 document.getElementById("tablagrupo").innerHTML = "";
               }else{
                Swal.fire({
                  type: 'error',
                  title: 'Datos no agregados'
                 });
               }
          }
      }
      xhr.send(JSON.stringify(datos));
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
        id_grupo:document.getElementById("plantel").value+document.getElementById("semestre_grupo").value+document.getElementById("grupo_ciclo_escolar").value+document.getElementById("grupo_nombre").value.toUpperCase(),
        estudiantes:estudiantes,
        semestre:document.getElementById("semestre_grupo").value,
        ciclo_escolar:document.getElementById("grupo_ciclo_escolar").value,
        componente:document.getElementById("seleccione_componente").value.split("-")[1],
        id_componente:document.getElementById("seleccione_componente").value.split("-")[0]
      };





      var xhr = new XMLHttpRequest();
        xhr.open("POST", '<?php echo base_url();?>index.php/c_acreditacion/agregar_estudiantes_grupo', true);
        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              if (xhr.responseText.trim() === "si") {
                console.log(xhr.response);
                Swal.fire({
                  type: 'success',
                  title: 'Datos agregados correctamente',
                  showConfirmButton: false,
                 });

                 setTimeout(location.reload.bind(location), 2500); 
                 

               }else{
                Swal.fire({
                  type: 'error',
                  title: 'Datos no agregados'
                 });
               }
            }
        }
        xhr.send(JSON.stringify(datos));

    }

  }
/*
  var form = document.getElementById("formulario");
  form.onsubmit = function (e) {
    e.preventDefault();
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo", true);
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        console.log(xhr.responseText);
        if (xhr.responseText.trim() !== "no") {
          Swal.fire({
            type: 'success',
            title: 'Grupo creado Exitosamente',
            showConfirmButton: false,
            timer: 2500
          });

          //document.getElementById("formulario").reset();

          document.getElementById("grupo_nombre").disabled = true;
          document.getElementById("grupo_periodo").disabled = true;
          document.getElementById("semestre_grupo").disabled = true;
          document.getElementById("plantel").disabled = true;
          document.getElementById("grupo_ciclo_escolar").disabled = true;
          document.getElementById("id_grupo").value = xhr.responseText;
        }

        else {
          Swal.fire({
            type: 'error',
            title: 'No se puede crear el grupo',
            showConfirmButton: false,
            timer: 2500
          });
        }
      }

    }
    xhr.send(formdata);


		
	}
*/
</script>






</html>