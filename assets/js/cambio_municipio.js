function cambio_municipio(selector_municipio,selector_localidad){
    //console.log(document.getElementById("selector_estado").value);
    let id_municipio = selector_municipio.value; 
    selector_localidad.innerHTML = "";
    
    var xhr = new XMLHttpRequest();

    
    //selector_localidad.innerHTML =  "<img src=\"/cseiio/assets/img/cargando.gif\"\" />";  //imagen de carga

    xhr.open('GET', '../c_localidad/get_localidades_municipio_html?id_municipio='+id_municipio, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      } 
    xhr.onreadystatechange = function() {
        $('#div_carga').hide();
        console.log(id_municipio);
        if(xhr.readyState == 4){
            selector_localidad.innerHTML = xhr.responseText;
        }
    };
    xhr.send(null);
  }