
    <div id="content-wrapper">

<div class="container-fluid ">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Control de alumnos</a>
    </li>
    <li class="breadcrumb-item active">Ingrese la búsqueda que desea realizar</li>
  </ol>

  <div class="card">
    <div class="card-body">



      <div class="form-group">

        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">
              <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                id="aspirante_curp_busqueda" placeholder="CURP">
              <label for="aspirante_curp_busqueda">CURP</label>
            </div>
          </div>

        </div>


      </div>

      <div class="form-group">
        <div class="row">


          <div class="col-md-8">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" required="required" id="aspirante_plantel_busqueda"
                name="aspirante_plantel">

                <?php
                foreach ($planteles as $plantel)
                {
                echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct.'</option>';
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
  <div class="card" style="overflow:scroll">
    <div class="card-body">
      <table class="table table-hover" id="tabla_completa" style="width: 100%">
        <caption>Lista de todos los alumnos</caption>
        <thead class="thead-light">
          <tr>
            <th scope="col" class="col-md-1">Nombre completo</th>
            <th scope="col" class="col-md-1">CURP</th>
            <th scope="col" class="col-md-1">N° control</th>
            <th scope="col" class="col-md-1">Matrícula</th>
            <th scope="col" class="col-md-1">Fecha Ingreso</th>
            <th scope="col" class="col-md-1">Imprimir</th>
          </tr>
        </thead>



        <tbody id="tabla">

        </tbody>
      </table>
    </div>
  </div>
</div>






</div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<input type="text" style="display:none" id="no_control_borrar">








<script>
var boton;
function eliminar_aspirante(e) {
document.getElementById("no_control_borrar").value = e.value;
//document.getElementById("btn-confirmacion") = e;
console.log(e);
boton = e;
console.log(boton);

}

function confirmacion_eliminar() {
console.log("este aspirante ha sido borrado " + document.getElementById("no_control_borrar").value);
var xhr = new XMLHttpRequest();
xhr.open('GET', '<?php echo base_url();?>index.php/c_aspirante/delete_aspirante?no_control=' + document.getElementById("no_control_borrar").value, true);

xhr.onload = function () {
  if(xhr.responseText === "si")
  {
    Swal.fire({
      type: 'success',
      title: 'Alumno eliminado correctamente',
      showConfirmButton: false,
      timer: 2500 
    })
    $(boton).parents('tr').detach();
    
  }else{
    Swal.fire({
      type: 'error',
      title: 'Alumno no eliminado',
      confirmButtonText: 'Cerrar'
      })
  }
};

xhr.send(null);


}
</script>



<script>

function cargar_datos_aspirante(e) {

document.getElementById("selector_municipio_aspirante").innerHTML = "";
document.getElementById("selector_localidad_aspirante").innerHTML = "";
document.getElementById("aspirante_no_control").value = e.value;
var xhr = new XMLHttpRequest();
xhr.open('GET', '<?php echo base_url();?>index.php/c_aspirante/get_datos_aspirante/' + e.value, true);

xhr.onload = function () {
  console.log(JSON.parse(xhr.response));
  let datos = JSON.parse(xhr.response);
  //datos personales
  document.getElementById("aspirante_nombre").value = datos.aspirante[0].nombre;
  document.getElementById("aspirante_apellido_paterno").value = datos.aspirante[0].apellido_paterno;
  document.getElementById("aspirante_apellido_materno").value = datos.aspirante[0].apellido_materno;

  document.getElementById("aspirante_curp").value = datos.aspirante[0].curp;
  document.getElementById("aspirante_fecha_nacimiento").value = datos.aspirante[0].fecha_nacimiento;
  document.getElementById("aspirante_telefono").value = datos.aspirante[0].telefono;
  document.getElementById("aspirante_correo").value = datos.aspirante[0].correo;

  document.getElementById("aspirante_sexo").value = datos.aspirante[0].sexo;

  document.getElementById("tipo_sangre").value = datos.datos_medicos_aspirante[0].tipo_sangre;

  if (datos.datos_medicos_aspirante[0].alergia_medicamento === null || datos.datos_medicos_aspirante[0].alergia_medicamento === "") {
    document.getElementById("aspirante_alergia_combo").value = "2";
  }

  else {
    document.getElementById("aspirante_alergia_combo").value = "1";
    document.getElementById("aspirante_alergia").value = datos.datos_medicos_aspirante[0].alergia_medicamento;
    document.getElementById("a").style.display = "";
  }

  if (datos.datos_medicos_aspirante[0].discapacidad === null || datos.datos_medicos_aspirante[0].discapacidad === "") {
    document.getElementById("aspirante_discapacidad_combo").value = "2";
  }

  else {
    document.getElementById("aspirante_discapacidad_combo").value = "1";
    document.getElementById("aspirante_discapacidad").value = datos.datos_medicos_aspirante[0].discapacidad;
    document.getElementById("b").style.display = "";
  }


  document.getElementById("aspirante_plantel").value = datos.aspirante[0].Plantel_cct;
  document.getElementById("aspirante_semestre").value = datos.aspirante[0].semestre;

  //fin datos personales

  //direccion aspirante
  var direccion = new XMLHttpRequest();
  direccion.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_estado_municipio_localidad?id_localidad=' + datos.direccion_aspirante[0].Localidad_id_localidad, true);


  direccion.onload = function () {

    document.getElementById("selector_estado_aspirante").value = JSON.parse(direccion.response)[0].id_estado;

    //console.log(JSON.parse(direccion.response)[0].id_estado);
    var municipios = new XMLHttpRequest();
    municipios.open('GET', '<?php echo base_url();?>index.php/c_municipio/get_municipios_estado?id_estado=' + JSON.parse(direccion.response)[0].id_estado, true);

    municipios.onload = function () {
      document.getElementById("selector_municipio_aspirante").innerHTML = "";
      JSON.parse(municipios.response).forEach(function (valor, indice) {
        document.getElementById("selector_municipio_aspirante").innerHTML += '<option value="' + valor.id_municipio + '">' + valor.nombre_municipio + '</option>';
      });

      document.getElementById("selector_municipio_aspirante").value = JSON.parse(direccion.response)[0].id_municipio;

    };

    municipios.send(null);



    var localidades = new XMLHttpRequest();
    localidades.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_localidades_municipio?id_municipio=' + JSON.parse(direccion.response)[0].id_municipio, true);

    localidades.onload = function () {
      document.getElementById("selector_localidad_aspirante").innerHTML = "";
      JSON.parse(localidades.response).forEach(function (valor, indice) {
        document.getElementById("selector_localidad_aspirante").innerHTML += '<option value="' + valor.id_localidad + '">' + valor.nombre_localidad + '</option>'
      });
      document.getElementById("selector_localidad_aspirante").value = JSON.parse(direccion.response)[0].id_localidad;
    };

    localidades.send(null);
  };

  direccion.send(null);

  document.getElementById("aspirante_direccion_calle").value = datos.direccion_aspirante[0].calle;
  document.getElementById("aspirante_direccion_colonia").value = datos.direccion_aspirante[0].colonia;
  document.getElementById("aspirante_direccion_cp").value = datos.direccion_aspirante[0].cp;

  //fin direccion aspirante

  //datos tutor
  document.getElementById("aspirante_tutor_nombre").value = datos.tutor_aspirante[0].nombre;
  document.getElementById("aspirante_tutor_ocupacion").value = datos.tutor_aspirante[0].ocupacion;
  document.getElementById("aspirante_tutor_telefono").value = datos.tutor_aspirante[0].telefono_particular;
  document.getElementById("aspirante_tutor_telefono_comunidad").value = datos.tutor_aspirante[0].telefono_comunidad;
  document.getElementById("aspirante_tutor_prospera").value = datos.tutor_aspirante[0].folio_prospera;
  $parentesco = datos.tutor_aspirante[0].parentezco;

  if ($parentesco !== "PADRE" && $parentesco !== "MADRE" && $parentesco !== "HERMANO/A" && $parentesco !== "TIO" && $parentesco !== "TIA" && $parentesco !== "ABUELO" && $parentesco !== "ABUELA") {
    document.getElementById("aspirante_tutor_parentesco").value = "otro";
    document.getElementById("aspirante_tutor_otro").value = $parentesco;
    document.getElementById("parentescootro").style.display = "";
  }

  else {
    document.getElementById("aspirante_tutor_parentesco").value = $parentesco;
  }
  //fin datos tutor
  //datos lengua materna
  if (datos.lengua_materna_aspirante[0].Lengua_id_lengua === "0") {
    document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna_aspirante[0].Lengua_id_lengua;
  }
  else {
    document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna_aspirante[0].Lengua_id_lengua;

    document.getElementById("aspirante_lengua_lee").disabled = false;
    document.getElementById("aspirante_lengua_lee").value = datos.lengua_materna_aspirante[0].lee;

    document.getElementById("aspirante_lengua_habla").disabled = false;
    document.getElementById("aspirante_lengua_habla").value = datos.lengua_materna_aspirante[0].lee;

    document.getElementById("aspirante_lengua_escribe").disabled = false;
    document.getElementById("aspirante_lengua_escribe").value = datos.lengua_materna_aspirante[0].lee;

    document.getElementById("aspirante_lengua_entiende").disabled = false;
    document.getElementById("aspirante_lengua_entiende").value = datos.lengua_materna_aspirante[0].lee;

    document.getElementById("aspirante_lengua_traduce").disabled = false;
    document.getElementById("aspirante_lengua_traduce").value = datos.lengua_materna_aspirante[0].lee;
  }

  //fin datos lengua materna

  //secundaria
  document.getElementById("aspirante_secundaria_cct").value = datos.secundaria_aspirante[0].cct_secundaria;

  document.getElementById("aspirante_secundaria_nombre").value = datos.secundaria_aspirante[0].nombre_secundaria;
  document.getElementById("aspirante_secundaria_nombre").disabled = true;
  document.getElementById("nombre_secundaria_oculto").style.display = "";
  //document.getElementById("nombre_secundaria_oculto").disabled = true;

  document.getElementById("aspirante_secundaria_tipo_subsistema").value = datos.secundaria_aspirante[0].tipo_subsistema;
  document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
  document.getElementById("tipo_subsistema_oculto").style.display = "";
  //document.getElementById("tipo_subsistema_oculto").disabled = true;
}

xhr.send(null);
}


function formato_tabla() {
$('#tabla_completa').DataTable({
  //"order": [[ 0, 'desc' ]],
  "language": {
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ningún dato disponible en esta tabla",
    "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
    "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar específico:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }
});
}

function buscar() {
document.getElementById("aspirante_plantel_busqueda").disabled = true;
document.getElementById("aspirante_curp_busqueda").disabled = true;
document.getElementById("tabla").innerHTML = "";
var xhr = new XMLHttpRequest();
var curp = document.getElementById("aspirante_curp_busqueda").value;
var plantel = document.getElementById("aspirante_plantel_busqueda").value;
var query = 'curp=' + curp + '&plantel=' + plantel;

xhr.open('GET', '<?php echo base_url();?>index.php/c_aspirante/buscar_aspirantes_curp?' + query, true);

xhr.onload = function () {
  JSON.parse(xhr.response).forEach(function (valor, indice) {
    console.log(valor);
    var fila = '<tr>';

    fila += '<td>';
    fila += valor.nombre + " " + valor.apellido_paterno + " " + valor.apellido_materno;
    fila += '</td>';

    fila += '<td>';
    fila += valor.curp;
    fila += '</td>';

    fila += '<td>';
    fila += valor.no_control;
    fila += '</td>';

    fila += '<td>';
    fila += valor.matricula === null ? "" : valor.matricula;
    fila += '</td>';

    fila += '<td>';
    fila += valor.fecha_registro;
    fila += '</td>';


    fila += '<td>';
    fila += '<a href="<?php echo base_url();?>index.php/C_aspirante/generar_formato_inscripcion?no_control='+valor.no_control+'" class="btn btn-lg btn-block btn-info btn btn-primary" target="_blank">Imprimir</a>';
    fila += '</td>';


    fila += '</tr>';

    document.getElementById("tabla").innerHTML += fila;
  });

  formato_tabla();

};

xhr.send(null);
document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
document.getElementById('btn_buscar').classList.remove('btn-success');
document.getElementById('btn_buscar').classList.add('btn-dark');
}

function limpiar() {
location.reload();

}

function lenguas_evento(e) {
//console.log(e.value);
if (e.value > 0) {
  document.getElementById("aspirante_lengua_lee").disabled = false;
  document.getElementById("aspirante_lengua_habla").disabled = false;
  document.getElementById("aspirante_lengua_escribe").disabled = false;
  document.getElementById("aspirante_lengua_entiende").disabled = false;
  document.getElementById("aspirante_lengua_traduce").disabled = false;
}

else {
  document.getElementById("aspirante_lengua_lee").disabled = true;
  document.getElementById("aspirante_lengua_habla").disabled = true;
  document.getElementById("aspirante_lengua_escribe").disabled = true;
  document.getElementById("aspirante_lengua_entiende").disabled = true;
  document.getElementById("aspirante_lengua_traduce").disabled = true;
}
}
function parentesco(e) {
if (document.getElementById("aspirante_tutor_parentesco").value === "otro") {
  $("#parentescootro").show()
  document.getElementById("aspirante_tutor_otro").name = 'aspirante_tutor_parentesco';
  document.getElementById("aspirante_tutor_parentesco").name = '';
}
else {
  $("#parentescootro").hide()
}

}

function alergia(e) {
document.getElementById("aspirante_alergia").value = "";
console.log(e.value);
if (e.value == 1) {
  document.getElementById("a").style = "display:"
}

else {
  document.getElementById("a").style = "display:none"
}
}


function discapacidad(e) {
//aspirante_discapacidad
document.getElementById("aspirante_discapacidad").value = ""
console.log(e.value);
if (e.value == 1) {
  document.getElementById("b").style = "display:"
}

else {
  document.getElementById("b").style = "display:none"
}
}

function obtener_secundaria(e) {
console.log(e.value);
if (e.value.length == 10) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '<?php echo base_url();?>index.php/c_secundaria/get_secundaria?cct_secundaria=' + e.value, true);

  xhr.onload = function () {
    //console.log(JSON.parse(xhr.response));
    let secundaria = JSON.parse(xhr.response);
    //console.log(xhr.responseText.length);



    if (secundaria.length == 1) {
      document.getElementById("nombre_secundaria_oculto").style.display = "";
      document.getElementById("aspirante_secundaria_nombre").value = secundaria[0].nombre_secundaria;
      document.getElementById("aspirante_secundaria_nombre").disabled = true;
      //tipo_subsistema_oculto
      document.getElementById("tipo_subsistema_oculto").style.display = "";
      //aspirante_secundaria_tipo_subsistema
      document.getElementById("aspirante_secundaria_tipo_subsistema").value = secundaria[0].tipo_subsistema;
      document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
    }

    else {
      document.getElementById("nombre_secundaria_oculto").style.display = "none";
    }
  };

  xhr.send(null);
}
}


function insertar_secundaria() {
let secundaria = "";
secundaria = {
  "cct_secundaria": document.getElementById("aspirante_nuevasecundaria_cct").value,
  "nombre_secundaria": document.getElementById("aspirante_nuevasecundaria_nombre").value,
  "subsistema": document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value,
  "localidad": parseInt(document.getElementById("selector_localidad_secundaria").value)
};

document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevasecundaria_cct").value + '">'
console.log(secundaria);


var xhr = new XMLHttpRequest();
xhr.open("POST", '<?php echo base_url();?>index.php/c_secundaria/insert_secundaria', true);


xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

xhr.onreadystatechange = function () {
  if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
    if(xhr.responseText === "si")
    {
      Swal.fire({
      type: 'success',
      title: 'Secundaria agregada correctamente',
      showConfirmButton: false,
      timer: 2500
    })
    }else{
      Swal.fire({
      type: 'error',
      title: 'Secundaria no agregada',
      confirmButtonText: 'Cerrar'

      })//alert(xhr.responseText);
    }
  }
xhr.send(JSON.stringify(secundaria));
}
}

function borrarmodal() {
$('#aspirante_nuevasecundaria_cct').val('');
$('#aspirante_nuevasecundaria_nombre').val('');
$('#aspirante_nuevasecundaria_tipo_subsistema').val('');
$('#selector_estado_secundaria').val('');
$('#selector_municipio_secundaria').val('');
$('#selector_localidad_secundaria').val('');
}

function cct() {
document.getElementById("aspirante_nuevasecundaria_cct").value = document.getElementById("aspirante_secundaria_cct").value;
}




</script>


<script>   

var form = document.getElementById("formulario");
form.onsubmit = function(e){
  e.preventDefault();
  var formdata = new FormData(form);
  var xhr =  new XMLHttpRequest();
  xhr.open("POST","<?php echo base_url();?>index.php/c_aspirante/actualizar_datos_aspirante",true);
xhr.onreadystatechange = function() { 
if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
//console.log();
if(xhr.responseText==="si"){
  Swal.fire({
      type: 'success',
      title: 'Actualizacion exitosa',
      showConfirmButton: false,
      timer: 2500 
    });

    $('#modalaspirante').modal('toggle');
}

else{
  Swal.fire({
      type: 'error',
      title: 'Ocurrio un error al actualizar los datos',
      showConfirmButton: false,
      timer: 2500 
    });
}
}
}
  xhr.send(formdata);
  
}

</script>