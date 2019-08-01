


var selector_estado_aspirante = document.getElementById("selector_estado_aspirante");
var selector_municipio_aspirante = document.getElementById("selector_municipio_aspirante");
var selector_localidad_aspirante = document.getElementById("selector_localidad_aspirante");

var selector_estado_secundaria = document.getElementById("selector_estado_secundaria");
var selector_municipio_secundaria = document.getElementById("selector_municipio_secundaria");
var selector_localidad_secundaria = document.getElementById("selector_localidad_secundaria");

var patron = new Array(2, 2, 4);

var boton;

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success btn-block',
    cancelButton: 'btn btn-secondary btn-block'
  },
  buttonsStyling: false,
})



function fecha_curp(fecha) {
  var fechas = fecha.split("/").reverse();
console.log(fechas);
  fechas[0] = fechas[0].substring(2, 4);
  console.log(fechas[0]);
  return fechas.join("");
}

function generarCURP() {
  let estados = ["nació en otro país", "aguascalientes", "baja california", "baja california sur", "campeche", "chiapas", "chihuahua", "coahuila de zaragoza", "colima", "méxico", "distrito federal", "durango", "guanajuato", "guerrero", "hidalgo", "jalisco", "estado de mexico", "michoacán", "morelos", "nayarit", "nuevo león", "oaxaca", "puebla", "querétaro", "quintana roo", "san luis potosí", "sinaloa", "sonora", "tabasco", "tamaulipas", "tlaxcala", "veracruz", "yucatán", "zacatecas"];
  let abreviacion = ["EX", "AS", "BC", "BS", "CC", "CS", "CH", "CL", "CM", "CX", "DF", "DG", "GT", "GR", "HG", "JC", "MC", "MN", "MS", "NT", "NL", "OC", "PL", "QT", "QR", "SP", "SL", "SR", "TC", "TS", "TL", "VZ", "YN", "ZS"];

  var consonantes = /[bcdfghjklmnpqrstvwxyz]/gi;
  var CURP = [];
  CURP[0] = $("#aspirante_apellido_paterno").val().charAt(0).toUpperCase();
  CURP[1] = $("#aspirante_apellido_paterno").val().slice(1).replace(consonantes, "").charAt(0).toUpperCase();
  if ($("#aspirante_apellido_materno").val() === "") {
    CURP[2] = "X";
  } else {
    CURP[2] = $("#aspirante_apellido_materno").val().charAt(0).toUpperCase();
  }
  CURP[3] = $("#aspirante_nombre").val().charAt(0).toUpperCase();
  CURP[4] = $("#aspirante_anio_nacimiento").val().substring(2,4)+$("#aspirante_mes_nacimiento").val()+($("#aspirante_dia_nacimiento").val().length===1?("0"+$("#aspirante_dia_nacimiento").val()):$("#aspirante_dia_nacimiento").val());

  CURP[5] = $("#aspirante_sexo").val().toUpperCase();
  CURP[6] = abreviacion[estados.indexOf($("#selector_estado_nacimiento_aspirante option:selected").text().toLowerCase())];
  CURP[7] = $("#aspirante_apellido_paterno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
  if ($("#aspirante_apellido_materno").val() === "") {
    CURP[8] = "X";
  } else {
    CURP[8] = $("#aspirante_apellido_materno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
  }
  CURP[9] = $("#aspirante_nombre").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
  document.getElementById("aspirante_curp").value = CURP.join("");
}

function curp() {
  generarCURP();
}



function lenguas_evento(e) {
  if(document.getElementById("aspirante_lengua_nombre").value === "otra"){
    console.log("agregue otra");
    $("#lengua_oculto").show()
    document.getElementById("aspirante_lengua_oculto").name = 'aspirante_lengua_nombre';
    document.getElementById("aspirante_lengua_nombre").name = '';
    document.getElementById("aspirante_lengua_oculto").required = true;
  }
  else {
    $("#lengua_oculto").hide()
    document.getElementById("aspirante_lengua_oculto").required = false;
    document.getElementById("aspirante_lengua_oculto").value = '';
  }

  if (e.value != "0") {
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

    document.getElementById("aspirante_lengua_lee").value = "0";
    document.getElementById("aspirante_lengua_habla").value = "0";
    document.getElementById("aspirante_lengua_escribe").value = "0";
    document.getElementById("aspirante_lengua_entiende").value = "0";
    document.getElementById("aspirante_lengua_traduce").value = "0";
  }
}

function etnias_evento(e) {
  if(document.getElementById("aspirante_etnia").value === "otra"){
    $("#etnia_oculto").show()
    document.getElementById("aspirante_etnia_oculto").name = 'aspirante_etnia';
    document.getElementById("aspirante_etnia").name = '';
    document.getElementById("aspirante_etnia_oculto").required = true;
  }
  else {
    $("#etnia_oculto").hide()
    document.getElementById("aspirante_etnia_oculto").required = false;
    document.getElementById("aspirante_etnia_oculto").value = '';
  }
}


function parentesco(e) {
  if (document.getElementById("aspirante_tutor_parentesco").value === "otro") {
    $("#parentescootro").show()
    document.getElementById("aspirante_tutor_otro").name = 'aspirante_tutor_parentesco';
    document.getElementById("aspirante_tutor_parentesco").name = '';
    document.getElementById("aspirante_tutor_otro").required = true;
  }
  else {
    $("#parentescootro").hide()
    document.getElementById("aspirante_tutor_otro").required = false;
    document.getElementById("aspirante_tutor_otro").value = '';
  }
}

function otro_secundaria(e) {
  if (document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value === "OTRO") {
    $("#otro_secundaria_oculto").show()
    document.getElementById("aspirante_secundaria_tipo_otro").name = 'aspirante_nuevasecundaria_tipo_subsistema';
    document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").name = '';
    document.getElementById("aspirante_secundaria_tipo_otro").required = true;
  }
  else {
    $("#otro_secundaria_oculto").hide()
    document.getElementById("aspirante_secundaria_tipo_otro").required = false;
    document.getElementById("aspirante_secundaria_tipo_otro").value = '';
  }
}


function nacionalidad(e) {
  valida(e);
  if (document.getElementById("selector_extranjero").value === "otro") {
    $("#nacionalidad").show()
  }
  else {
    $("#nacionalidad").hide()
  }
}

function alergia(e) {
  console.log(e.value);
  if (e.value == 1) {
    document.getElementById("a").style = "display:";
    document.getElementById("aspirante_alergia").required = true;
  }

  else {
    document.getElementById("a").style = "display:none";
    document.getElementById("aspirante_alergia").required = false;
    document.getElementById("aspirante_alergia").value = '';
  }
}

function discapacidad(e) {
  console.log(e.value);
  if (e.value == 1) {
    document.getElementById("b").style = "display:";
    document.getElementById("aspirante_discapacidad").required = true;
  }

  else {
    document.getElementById("b").style = "display:none";
    document.getElementById("aspirante_discapacidad").required = false;
    document.getElementById("aspirante_discapacidad").value = '';
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
function cctbachillerato() {
  document.getElementById("aspirante_nuevobachillerato_cct").value = document.getElementById("aspirante_bachillerato_cct").value;
}

function valida(e) {
  regexp = / +/g; /* Expresión regular para buscar todos los espacios múltiples */
  texto = e.value;
  texto = texto.replace(regexp, " "); /* Reemplazar todos los espacios múltiples por uno solo */
  // Definimos los caracteres que queremos eliminar
  var specialChars = "!@#$^&%*()+=-[]\/{}|:<>?,.";
  // Los eliminamos todos
  for (var i = 0; i < specialChars.length; i++) {
    texto = texto.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
  }
  // Lo queremos devolver limpio en minusculas
  texto = texto.toLowerCase();
  // Quitamos espacios y los sustituimos por _ porque nos gusta mas asi
  texto = texto.replace(/ /g, " ");
  // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
  texto = texto.replace(/á/gi, "a");
  texto = texto.replace(/é/gi, "e");
  texto = texto.replace(/í/gi, "i");
  texto = texto.replace(/ó/gi, "o");
  texto = texto.replace(/ú/gi, "u");
  e.value = texto;
}

function checkacta() {
  if (document.getElementById("aspirante_documento_acta_nacimiento").checked && document.getElementById("aspirante_nacionalidad").value === "MEXICANA") {
    document.getElementById("aspirante_anio_nacimiento_registro").required = true;
    document.getElementById("aspirante_mes_nacimiento_registro").required = true;
    document.getElementById("aspirante_dia_nacimiento_registro").required = true;

  } else {
    document.getElementById("aspirante_anio_nacimiento_registro").required = false;
    document.getElementById("aspirante_mes_nacimiento_registro").required = false;
    document.getElementById("aspirante_dia_nacimiento_registro").required = false;
  }
}

function checksecundaria() {
  if (document.getElementById("aspirante_documento_certificado_secundaria").checked) {
    document.getElementById("aspirante_secundaria_cct").required = true;

  } else {
    document.getElementById("aspirante_secundaria_cct").required = false;
  }
}

function checkbachillerato() {
  if (document.getElementById("aspirante_documento_certificado_parcial").checked) {
    document.getElementById("aspirante_secundaria_cct").required = true;

  } else {
    document.getElementById("aspirante_secundaria_cct").required = false;
  }
}





function mascara(d, sep, pat, nums) {
  if (d.valant != d.value) {
    val = d.value
    largo = val.length
    val = val.split(sep)
    val2 = ''
    for (r = 0; r < val.length; r++) {
      val2 += val[r]
    }
    if (nums) {
      for (z = 0; z < val2.length; z++) {
        if (isNaN(val2.charAt(z))) {
          letra = new RegExp(val2.charAt(z), "g")
          val2 = val2.replace(letra, "")
        }
      }
    }
    val = ''
    val3 = new Array()
    for (s = 0; s < pat.length; s++) {
      val3[s] = val2.substring(0, pat[s])
      val2 = val2.substr(pat[s])
    }
    for (q = 0; q < val3.length; q++) {
      if (q == 0) {
        val = val3[q]
      }
      else {
        if (val3[q] != "") {
          val += sep + val3[q]
        }
      }
    }
      d.value = val
      d.valant = val
  }
}

function validafecha(e){
  console.log(e.value);
  fecha= e.value.split('-');
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
  today = yyyy+mm+dd;
  fecha = fecha.join('');

  if(fecha >= today){
  }else{
    Swal.fire({
      type: 'error',
      title: 'La fecha ingresada es incorrecta',
      confirmButtonText: 'Cerrar'
    });
    e.value='';
  }
}

function validafechanormal(e){
  console.log(e.value);
  fecha= e.value.split('/');
  if(fecha[0] <= "31" && fecha[1] <= "12" ){
  }else{
    Swal.fire({
      type: 'error',
      title: 'La fecha ingresada es incorrecta',
      confirmButtonText: 'Cerrar'

    })
    e.value='';
  }
}

function validafecharegistro(e){
  fecha= e.value.split('/');
  if(fecha[0] <= "31" && fecha[1] <= "12" && fecha[2] <= "2019"){
  }else{
    Swal.fire({
      type: 'error',
      title: 'La fecha ingresada es incorrecta',
      confirmButtonText: 'Cerrar'

    })
    e.value='';
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



  function limpiar() {
    location.reload();

  }



function limpiar() {
  $('#aspirante_curp_busqueda').val('');
  location.reload();

}


function formato_tabla() {
  $('#tabla_completa').DataTable({
    //"order": [[ 0, 'desc' ]],
    "language": {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ ",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "No se encontraron resultados",
      "sInfo": "Mostrando del _START_ al _END_ de un total de _TOTAL_ ",
      "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 ",
      "sInfoFiltered": "(filtrado de un total de _MAX_ )",
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

function reverseFecha(str) {
  // Step 1. Use the split() method to return a new array
  var splitString = str.split("/"); // var splitString = "hello".split("");
  // ["h", "e", "l", "l", "o"]

  // Step 2. Use the reverse() method to reverse the new created array
  var reverseArray = splitString.reverse(); // var reverseArray = ["h", "e", "l", "l", "o"].reverse();
  // ["o", "l", "l", "e", "h"]

  // Step 3. Use the join() method to join all elements of the array into a string
  var joinArray = reverseArray.join("/"); // var joinArray = ["o", "l", "l", "e", "h"].join("");
  // "olleh"
  
  //Step 4. Return the reversed string
  return joinArray; // "olleh"
}
function validaracta(){
  var fechaInicio = document.getElementById("aspirante_anio_nacimiento").value+"," +document.getElementById("aspirante_mes_nacimiento").value;
  if(document.getElementById("aspirante_dia_nacimiento").value.length =! 1){
  fechaInicio = fechaInicio + "," + document.getElementById("aspirante_dia_nacimiento").value
  }else{
    fechaInicio = fechaInicio + "," + 0 + document.getElementById("aspirante_dia_nacimiento").value
  }
  var fechaFin = document.getElementById("aspirante_anio_nacimiento_registro").value + "," +document.getElementById("aspirante_mes_nacimiento_registro").value;
  if(document.getElementById("aspirante_dia_nacimiento_registro").value.length =! 1){
  fechaFin = fechaFin + "," + document.getElementById("aspirante_dia_nacimiento_registro").value
  }else{
    fechaFin = fechaFin + "," + 0 + document.getElementById("aspirante_dia_nacimiento_registro").value
  }
  fechaInicio=new Date(fechaInicio).getTime();
fechaFin = new Date(fechaFin).getTime();

var diff = fechaFin - fechaInicio;
var resultado = diff/(1000*60*60*24);
if(resultado > 2193 && document.getElementById("aspirante_nacionalidad").value === "MEXICANA"){
console.log("Necesita acta de registro extemporaneo");
document.getElementById("aspirante_documento_carta_extemporaneo_oculto").style = "display:";
document.getElementById("aspirante_documento_carta_extemporaneo").value="8";
document.getElementById("aspirante_documento_carta_extemporaneo").checked = false;
}else{
  console.log("No Necesita acta de registro extemporaneo");
  document.getElementById("aspirante_documento_carta_extemporaneo_oculto").style = "display: none";
  document.getElementById("aspirante_documento_carta_extemporaneo").value="7";
  document.getElementById("aspirante_documento_carta_extemporaneo").checked = true;
}

console.log(diff/(1000*60*60*24) );
}


function contador_tablas(){
  var tabla_disponibles = document.getElementById("tabla");
  document.getElementById("contador_alumnos_restantes").innerText = "Alumnos restantes: "+tabla_disponibles.childElementCount;
  var tabla_agregados = document.getElementById("tablagrupo");
  console.log(tabla_agregados.childNodes.length);
  document.getElementById("contador_alumnos_agregados").innerText = "Alumnos agregados: "+tabla_agregados.childElementCount;
}

function cambiardetabla(e) {
  var alumnos = document.getElementById("tabla_completa_grupo").children[2].children;
    var alumnos_json = new Array();
    for(let i=0;i<alumnos.length;i++){
      alumnos_json.push(alumnos[i].children[1].innerText);
    }

    console.log(alumnos_json);

    if(alumnos_json.length<35){
      $(e).parents("tr").appendTo("#tabla_completa_grupo tbody");
      e.className = "";
      e.className = "btn btn-lg btn-block btn-danger";
      e.innerText = "";
      e.innerText = "Eliminar";
      e.setAttribute("onClick", "regresartabla(this);");
      contador_tablas();
      //console.log(tabla_disponibles.childNodes.length);--------------------------
    }

    else{
      Swal.fire({
        type: 'error',
        title: 'Cupo de grupo lleno'
      });
    }
  }


function regresartabla(e) {
  $(e).parents("tr").appendTo("#tabla_completa tbody");
  e.className = "";
  e.className = "btn btn-lg btn-block btn-success";
  e.innerText = "";
  e.innerText = "Agregar";
  e.setAttribute("onClick", "cambiardetabla(this);");
  contador_tablas();
}

function componente_grupo(e) {
  if (document.getElementById("semestre_grupo").value === "5" || document.getElementById("semestre_grupo").value === "6") {
    llenar_especialidad();
    document.getElementById("seleccione_componente_oculto").style.display = "";
  } else {
    document.getElementById("seleccione_componente_oculto").style.display = "none";
  }
}

function get_dias(){
  document.getElementById("aspirante_dia_nacimiento").innerHTML ="";
  num_dias=new Date(document.getElementById("aspirante_anio_nacimiento").value,document.getElementById("aspirante_mes_nacimiento").value,0).getDate();
  lista_dias="";
  for(x=1;x<=num_dias;x++){
      lista_dias+='<option value="'+x+'">'+x+'</opcion>';
  }
  document.getElementById("aspirante_dia_nacimiento").innerHTML = lista_dias;
}

function cargar_anio(){
document.getElementById('aspirante_anio_nacimiento').innerHTML = "";
  fecha = new Date();
  anio_actual = fecha.getFullYear();
  anio_actual = anio_actual - 13;
  lista_fecha='';
  for(i=anio_actual;i>=1910;i--){
      lista_fecha+='<option value="'+i+'">'+i+'</opcion>';
  }
  document.getElementById('aspirante_anio_nacimiento').innerHTML =lista_fecha;
  get_dias();
}

function get_dias_registro(){
  document.getElementById("aspirante_dia_nacimiento_registro").innerHTML ="";
  num_dias=new Date(document.getElementById("aspirante_anio_nacimiento_registro").value,document.getElementById("aspirante_mes_nacimiento_registro").value,0).getDate();
  lista_dias="";
  lista_dias+='<option value="">Seleccione uno</opcion>';
  for(x=1;x<=num_dias;x++){
      lista_dias+='<option value="'+x+'">'+x+'</opcion>';
  }
  document.getElementById("aspirante_dia_nacimiento_registro").innerHTML = lista_dias;
}

function cargar_anio_registro(){
  document.getElementById('aspirante_anio_nacimiento_registro').innerHTML = "";
    fecha = new Date();
    anio_actual = fecha.getFullYear();
    lista_fecha='';
    lista_fecha+='<option value="">Seleccione uno</opcion>';
    for(i=anio_actual;i>=1910;i--){
        lista_fecha+='<option value="'+i+'">'+i+'</opcion>';
    }
    document.getElementById('aspirante_anio_nacimiento_registro').innerHTML =lista_fecha;
    get_dias_registro();
  }

  function procedencia_combo(){
    if(document.getElementById("aspirante_procedencia_combo").value === "extranjero"){
      document.getElementById("aspirante_procedencia_extranjero_oculto").style.display ="";
      document.getElementById("aspirante_procedencia_extranjero").required = true;
      document.getElementById("aspirante_procedencia_estado_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_municipio_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_localidad_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_estado").required = false;
      document.getElementById("aspirante_procedencia_municipio").required = false;
      document.getElementById("aspirante_procedencia_localidad").required = false;
  
    }else if(document.getElementById("aspirante_procedencia_combo").value === "diferente"){
      document.getElementById("aspirante_procedencia_estado_oculto").style.display ="";
      document.getElementById("aspirante_procedencia_municipio_oculto").style.display ="";
      document.getElementById("aspirante_procedencia_localidad_oculto").style.display ="";
      document.getElementById("aspirante_procedencia_estado").required = true;
      document.getElementById("aspirante_procedencia_municipio").required = true;
      document.getElementById("aspirante_procedencia_localidad").required = true;
      document.getElementById("aspirante_procedencia_extranjero_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_extranjero").required = false;
    }else{
      document.getElementById("aspirante_procedencia_estado_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_municipio_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_localidad_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_extranjero_oculto").style.display ="none";
      document.getElementById("aspirante_procedencia_estado").required = false;
      document.getElementById("aspirante_procedencia_municipio").required = false;
      document.getElementById("aspirante_procedencia_localidad").required = false;
      document.getElementById("aspirante_procedencia_extranjero").required = false;
    }
  }

  function getRandomInt(max) {
    min = 8;
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
  }

  function enter2tab(e) {
    if (e.keyCode == 13) {
        cb = parseInt($(this).attr('tabindex'));
 
        if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null) {
            $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
            $(':input[tabindex=\'' + (cb + 1) + '\']').select();
            e.preventDefault();
 
            return false;
        }
    }
}




