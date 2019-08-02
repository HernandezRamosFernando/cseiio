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
      <div class="card-body">
        <div class="form-group">

          <div class="row">
            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" id="plantel" name="plantel">
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
                <span>Semestre del grupo a buscar</span>
              </label>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" onchange="cargar_materias()" name="grupos"
                  id="grupos">
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
                <select class="form-control form-control-lg selcolor" onchange="validarcomponente()" name="materias" id="materias">
                  <option value="">Seleccione uno</option>
                </select>
                <span>Lista de materias del grupo</span>
              </label>
            </div>


            <div class="col-md-4 offset-md-2" id="limpiar_oculto" style="display: none">
              <button type="button" class="btn btn-info btn-lg btn-block" onclick="recargar();" style="padding: 1rem"
                id="limpiar">Limpiar búsqueda</button>
            </div>
          </div>
        </div>



        <div class="row" id="alumnos_oculto" style="overflow: scroll; display: none">
          <div class="col-md-12" id="tabla_alumnos">
            <div class="card card-body" style="overflow: scroll;">
            <p class="h6" style="text-align: left; color: #237087; font-size: 12pt;">Criterios de calificación: <br> La calificación mínima aprobatoria es 6 <br> Toda calificación menor a 6 será 5 <br> La diagonal "/" significa que no presento </p>
            <br>
            <br>
              <table class="table table-hover" id="tabla_completa_grupo" style="width: 100%; ">
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
                    <th scope="col" class="col-md-1">Promedio Semestral</th>
                  </tr>
                </thead>

                <tbody id="tablagrupo">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </form>
    <br>
    <div class="col-md-12" id="agregar_oculto" style="display: none">
      <button type="button" value="nuevo" onclick="guardar()" id="boton_agregar"
        class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem"> Guardar cambios</button>
    </div>

  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

  document.getElementById("boton_agregar").disabled=true;

  function guardar() {

    var tabla = document.getElementById("tablagrupo");
    var datos = new Array();

    for (let i = 0; i < tabla.childNodes.length; i++) {
      var dato = {
        id_grupo: document.getElementById("grupos").value,
        materia: document.getElementById("materias").value,
        no_control: tabla.childNodes[i].childNodes[1].innerText,
        primer_parcial: tabla.childNodes[i].childNodes[2].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[2].childNodes[0].value,
        segundo_parcial: tabla.childNodes[i].childNodes[3].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[3].childNodes[0].value,
        tercer_parcial: tabla.childNodes[i].childNodes[4].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[4].childNodes[0].value,
        examen_final: tabla.childNodes[i].childNodes[6].childNodes[0].value === "" ? null : tabla.childNodes[i].childNodes[6].childNodes[0].value
      }

      datos.push(dato);
    }

    //console.log(datos);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_grupo_estudiante/agregar_calificaciones_materia_grupo', true);

    swalWithBootstrapButtons.fire({
      type: 'info',
      text: 'Al aceptar no podrá realizar cambio alguno ¿Esta seguro?',
      confirmButtonText: 'Aceptar',
      allowOutsideClick: false,
      showCancelButton: 'true',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
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
            text: 'Calificaciones guardadas correctamente',
            allowOutsideClick: false,
            confirmButtonText: 'Aceptar'
          }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              //location.reload(); 
              document.getElementById("alumnos_oculto").style.display = "none";
              document.getElementById("agregar_oculto").style.display = "none";
              
            }
            //aqui va si cancela
          });
        } else {
          Swal.fire({
            type: 'error',
            text: 'Calificaciones no guardadas'
          });
        }
      }
    }
    xhr.send(JSON.stringify(datos));
    console.log(datos);
    document.getElementById("boton_agregar").disabled=true;
    }
    });

    

  }

  function recargar() {
    location.reload();

  }


  function cargargrupos() {
    if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#semestre_grupo").val('');
    } else {
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);

      var semestre = document.getElementById("semestre_grupo").value;
      console.log(semestre);
      grupos.innerHTML = "";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_grupos_plantel_htmloption?plantel=' + plantel + '&semestre=' + semestre, true);
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
          option.text = "Ningun grupo creado";
          option.value = "";
          grupos.add(option);
        } else {
          console.log(xhr.response);
          grupos.innerHTML = xhr.responseText;
        }
      };
      xhr.send(null);
    }
  }

  function validarcomponente() {

    if (document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != '' && document.getElementById("materias").value != '') {
      cargar_materia();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
    }
  }
  function cambiarbusqueda() {
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;    
    document.getElementById('limpiar_oculto').style.display = "";
  }





  function cargar_materia() {
    document.getElementById("alumnos_oculto").style.display = "";
    document.getElementById("agregar_oculto").style.display = "";
    var permisos = new XMLHttpRequest();
    permisos.open('GET', '<?php echo base_url();?>index.php/c_permisos/get_permisos_plantel_grupo_materia?plantel=' + document.getElementById("plantel").value+'&grupo='+document.getElementById("grupos").value+'&materia='+document.getElementById("materias").value, true);
    permisos.onloadstart = function () {
      $('#div_carga').show();
    }
    permisos.error = function () {
      console.log("error de conexion");
    }

    permisos.onload = function () {
      $('#div_carga').hide();
      console.log(JSON.parse(permisos.response)[0]);
      var permisos_plantel = JSON.parse(permisos.response)[0];
      if (permisos_plantel === undefined) {
        var permisos_plantel = {
          primer_parcial: "0",
          segundo_parcial: "0",
          tercer_parcial: "0",
          examen_final: "0",
          promedio_total: "0"
        }
      }


      //cargar inputs
      document.getElementById("tablagrupo").innerHTML = "";
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_estudiantes_grupo_materia?grupo=' + document.getElementById("grupos").value + '&materia=' + document.getElementById("materias").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }

      xhr.onload = function () {
        $('#div_carga').hide();
        console.log(JSON.parse(xhr.response));


        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var promedio =0;

          /*if (valor.primer_parcial != null && valor.segundo_parcial != null && valor.tercer_parcial != null) {
            promedio = (parseInt(valor.primer_parcial) + parseInt(valor.segundo_parcial) + parseInt(valor.tercer_parcial)) / 3;
            console.log(promedio);
            promedio = redondeo(promedio);
          }*/

          var p1=0,p2=0,p3=0;

           p1=(valor.primer_parcial === null || valor.primer_parcial ==="") ? 0 : valor.primer_parcial;
          p2=(valor.segundo_parcial === null || valor.segundo_parcial ==="")? 0 : valor.segundo_parcial;
          p3=(valor.tercer_parcial === null || valor.tercer_parcial =="")? 0 : valor.tercer_parcial;
          ef=(valor.examen_final === null || valor.examen_final =="")? 0 : valor.examen_final;

          
          promedio=redondeo((parseInt(p1)+parseInt(p2)+parseInt(p3))/3);
          

          var registro = "<tr>";
          registro += '<td>' + valor.nombre + ' ' + valor.primer_apellido + ' ' + valor.segundo_apellido + '</td>';
          registro += '<td>' + valor.no_control + '</td>';
          var primer_parcial = valor.primer_parcial !== null ? valor.primer_parcial : "";

          if (permisos_plantel.primer_parcial === "1") {
            registro += '<td><input type="text" class="form-control" name="primer_parcial" value="' + (primer_parcial === "0" ? "/" : primer_parcial) + '" id="primer_parcial" onchange="calificaciones(this,\''+valor.tipo+'\',2,'+indice+','+permisos_plantel.examen_final+');"></td>';
          }
          else {
            registro += '<td><input type="text" class="form-control" name="primer_parcial" value="' + (primer_parcial === "0" ? "/" : primer_parcial) + '" id="primer_parcial" disabled></td>';
          }

          var segundo_parcial = valor.segundo_parcial !== null ? valor.segundo_parcial : "";
          if (permisos_plantel.segundo_parcial === "1") {
            registro += '<td><input type="text" class="form-control" name="segundo_parcial" value="' + (segundo_parcial === "0" ? "/" : segundo_parcial) + '" id="segundo_parcial"  onchange="calificaciones(this,\''+valor.tipo+'\',3,'+indice+','+permisos_plantel.examen_final+');"></td>';
          }

          else {
            registro += '<td><input type="text" class="form-control" name="segundo_parcial" value="' + (segundo_parcial === "0" ? "/" : segundo_parcial) + '" id="segundo_parcial" disabled></td>';

          }

          var tercer_parcial = valor.tercer_parcial !== null ? valor.tercer_parcial : "";
          if (permisos_plantel.tercer_parcial === "1") {
            registro += '<td><input type="text" class="form-control" name="tercer_parcial" value="' + (tercer_parcial === "0" ? "/" : tercer_parcial) + '" id="tercer_parcial" onchange="calificaciones(this,\''+valor.tipo+'\',4,'+indice+','+permisos_plantel.examen_final+');"></td>';
          }
          else {
            registro += '<td><input type="text" class="form-control" name="tercer_parcial" value="' + (tercer_parcial === "0" ? "/" : tercer_parcial) + '" id="tercer_parcial" disabled></td>';
          }

          if (promedio >= 6) {
            registro += '<td><input type="text" class="form-control" name="promedio_modular" value="' + promedio+'" id="promedio_modular" disabled style="background-color:#1F934C;color: white;font-weight:bold"></td>';
          } else {
            registro += '<td><input type="text" class="form-control" name="promedio_modular" value="' + promedio + '" id="promedio_modular" disabled style="background-color:#C4131B;color: white; font-weight:bold"></td>';
          }

          

          var examen_final = valor.examen_final !== null ? valor.examen_final : "";
          if (permisos_plantel.examen_final === "1" && promedio >= 6) {
            registro += '<td><input type="text" class="form-control" name="examen_final" value="' + (examen_final === "0" ? "/" : examen_final) + '" id="examen_final" onchange="calificaciones(this,\''+valor.tipo+'\',6,'+indice+','+permisos_plantel.examen_final+');"></td>';
          } else if (permisos_plantel.examen_final === "1" && promedio < 6) {
            registro += '<td><input type="text" class="form-control" name="examen_final" value="/" id="examen_final" onchange="calificaciones(this,\''+valor.tipo+'\',6,'+indice+','+permisos_plantel.examen_final+');" disabled></td>';
          } else {
            registro += '<td><input type="text" class="form-control" name="examen_final" value="' + (examen_final === "0" ? "/" : examen_final) + '" onchange="calificaciones(this,\''+valor.tipo+'\',6,'+indice+','+permisos_plantel.examen_final+');" id="examen_final" disabled></td>';
          }
          
          var promedio_total= redondeo((promedio+parseInt(ef))/2);


          if (promedio_total >= 6) {
          	registro += '<td> <input type="text" class="form-control" name="promediot" value="' + ((promedio_total === "0" || promedio_total==='') ? "/" : promedio_total) + '" id="promediot" disabled style="background-color:#1F934C;color: white;font-weight:bold"> </td>';
          }
          else{
          		registro += '<td> <input type="text" class="form-control" name="promediot" value="' + ((promedio_total === "0" || promedio_total==='') ? "/" : promedio_total) + '" id="promediot" disabled style="background-color:#C4131B;color: white; font-weight:bold"> </td>';
          }
          

          
          registro += '</tr>';

          document.getElementById("tablagrupo").innerHTML += registro;
        });
      }

      xhr.send(null);
      cambiarbusqueda();
      //fin cargar inputs
    };

    permisos.send(null);
    /*
        */

  }


  function cargar_materias() {
    if (document.getElementById("grupos").value != "") {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_materias_grupo_por_calificar?grupo=' + document.getElementById("grupos").value, true);
      xhr.onloadstart = function () {
        $('#div_carga').show();
      }
      xhr.error = function () {
        console.log("error de conexion");
      }
      xhr.onload = function () {
        $('#div_carga').hide();
        console.log(xhr.response.trim());
        if(xhr.response.trim() === "[]"){
          let opciones = "";
          opciones += '<option value="">No existen materias con permisos para calificar</option>';
          document.getElementById("materias").innerHTML = opciones;
          
        }else{
          let opciones = "";
          opciones += '<option value="">Seleccione una materia</option>';
        JSON.parse(xhr.response).forEach(function (valor, indice) {
          opciones += '<option value="' + valor.clave + '">' + valor.unidad_contenido + '</option>';
        });

        document.getElementById("materias").innerHTML = opciones;
        }
        
      };

      xhr.send(null);
    } else {
      document.getElementById("materias").innerHTML = '';
    }

  }


  function calificaciones(e,tipo,columna_activa,fila,activo_examen_final) {
    var string = e.value.toString();
    var tipo_materia=tipo;

    for (var i = 0, output = '', validos = "0123456789./"; i < string.length; i++) {
      if (validos.indexOf(string.charAt(i)) != -1)
        output += string.charAt(i)
    }
    console.log(output);
    if (output != "") {


      
      if(tipo_materia==='EXTRAESCOLAR'){
          if (output >= 6 && output <= 10) {
              var valor = parseFloat(output);
              valor = Math.round(valor);
              console.log(valor)
              e.value = valor;
              e.style.color = "black";
            }
            else if(output==="/"){
                e.value ="/";
            }

            else{
                e.value =6;
            }
      }

      else{
                if (output >= 6 && output <= 10) {
              var valor = parseFloat(output);
              valor = Math.round(valor);
              console.log(valor)
              e.value = valor;
              e.style.color = "black";
            } else if (output === "/") {
              e.style.color = "black";
            } else if (output >= 0 && output < 6) {
              e.value = 5;
              e.style.color = "red";
            } else {
              console.log("valor no valido")
              e.value = "";
            }

      }

      


    } else {
      e.value = "";
    }
    //e.value=output;
    //-----------comienza validación de filas activas
    validar_vacios_input();
    //validacion para calcular promedio del semestre por alumno
    promedio_semestral(fila,activo_examen_final)

  }


function validar_vacios_input() {
  var validar_tabla = document.getElementById("tablagrupo");
  var contar_vacios=0;
  for (let i = 0; i < validar_tabla.childNodes.length; i++) {
      if(validar_tabla.childNodes[i].childNodes[2].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[2].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[3].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[3].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[4].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[4].childNodes[0].value===""){
        contar_vacios++;
      }

      if(validar_tabla.childNodes[i].childNodes[6].childNodes[0].disabled===false && validar_tabla.childNodes[i].childNodes[6].childNodes[0].value===""){
        contar_vacios++;
      }

      

    }
    console.log('vacios: '+contar_vacios);
    if(contar_vacios>0){
        document.getElementById("boton_agregar").disabled=true;
    }
    else{
        document.getElementById("boton_agregar").disabled=false;
    }


}


  function redondeo(e) {
    if (e >= 6 && e <= 10) {
      var valor = parseFloat(e);
      valor = Math.round(valor);
      return valor;
    } else if (e === 0) {
      return "/";
    } else if (e > 0 && e < 6) {
      return 5;
    } else {
      return "";
    }
  }



  function promedio_semestral(fila,activo_examen_final) {
    var tabla = document.getElementById("tablagrupo");
    var promedio=0;
    primer_parcial=(tabla.childNodes[fila].childNodes[2].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[2].childNodes[0].value==='/') ? 0 : tabla.childNodes[fila].childNodes[2].childNodes[0].value;
    segundo_parcial=(tabla.childNodes[fila].childNodes[3].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[3].childNodes[0].value === "/") ? 0 : tabla.childNodes[fila].childNodes[3].childNodes[0].value;
    tercer_parcial=(tabla.childNodes[fila].childNodes[4].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[4].childNodes[0].value === "/") ? 0 : tabla.childNodes[fila].childNodes[4].childNodes[0].value;
    examen_final=(tabla.childNodes[fila].childNodes[6].childNodes[0].value === "" || tabla.childNodes[fila].childNodes[6].childNodes[0].value === "/") ? 0 : tabla.childNodes[fila].childNodes[6].childNodes[0].value;

    
promedio_modular=redondeo((parseInt(primer_parcial)+parseInt(segundo_parcial)+parseInt(tercer_parcial))/3);
	

	
if(promedio_modular>=6){
		tabla.childNodes[fila].childNodes[5].innerHTML='<input type="text" class="form-control" name="promedio_modular" value="' +promedio_modular+'" id="promedio_modular" disabled style="background-color:#1F934C;color: white;font-weight:bold">';
   
		 if(activo_examen_final===1){
		 	tabla.childNodes[fila].childNodes[6].childNodes[0].disabled=false;

		 	
		 }
	}

	else{
		tabla.childNodes[fila].childNodes[5].innerHTML='<input type="text" class="form-control" name="promedio_modular" value="' +promedio_modular+'" id="promedio_modular" disabled style="background-color:#C4131B;color: white;font-weight:bold">';
		if(activo_examen_final===1){
      
		 	tabla.childNodes[fila].childNodes[6].childNodes[0].disabled=true;
		 	tabla.childNodes[fila].childNodes[6].childNodes[0].value="/";
		 	examen_final=0;
		 }
	}



	

    promedio=redondeo((parseInt(promedio_modular)+parseInt(examen_final))/2);
    /*console.log('p1:'+primer_parcial+', p2:'+segundo_parcial+', p3:'+tercer_parcial+', ef:'+examen_final);
    console.log('este es el promedio Modular: '+promedio_modular);
    console.log('este es el promedio: '+promedio);
    console.log('este es la fila: '+fila);*/



	if(promedio>=6){
		tabla.childNodes[fila].childNodes[7].innerHTML='<input type="text" class="form-control" name="promediot" value="' + ((promedio === "0" || promedio==='') ? "/" : promedio) + '" id="promediot" disabled="disabled" style="background-color:#1F934C;color: white;font-weight:bold">';
	}
	else{
		tabla.childNodes[fila].childNodes[7].innerHTML='<input type="text" class="form-control" name="promediot" value="' + ((promedio === "0" || promedio==='') ? "/" : promedio) + '" id="promediot" disabled="disabled" style="background-color:#C4131B;color: white; font-weight:bold">';
	}

     

  }
  var bPreguntar = true;
window.onbeforeunload = preguntarAntesDeSalir;
function preguntarAntesDeSalir()
{
  if (bPreguntar)
    return "¿Seguro que quieres salir?";
}


$("body").on("keydown", "input, select, textarea", function(e) {
  var self = $(this),
    form = self.parents("form:eq(0)"),
    focusable,
    next;
  
  // si presiono el enter
  if (e.keyCode == 13) {
    // busco el siguiente elemento
    focusable = form.find("input").filter(":enabled");
    next = focusable.eq(focusable.index(this) + 1);
    // si existe siguiente elemento, hago foco
    if (next.length) {
      next.focus();
    }
    return false;
  }
});

</script>