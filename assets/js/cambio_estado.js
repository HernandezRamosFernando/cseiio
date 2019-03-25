function cambio_estado(selector_estado,selector_municipio,selector_localidad){
    //console.log(document.getElementById("selector_estado").value);
    let id_estado = selector_estado.value; 
    selector_municipio.innerHTML = "";
    selector_localidad.innerHTML = "";
    var xhr = new XMLHttpRequest();

      
    selector_municipio.innerHTML =  "<img src=\"/cseiio/assets/img/cargando.gif\"\" />";  //imagen de carga
    xhr.open('GET', '/cseiio/index.php/c_municipio/get_municipios_estado?id_estado='+id_estado, true);

    xhr.onreadystatechange = function() {
        //console.log(JSON.parse(xhr.response));
        if(xhr.readyState == 4)
       {
        JSON.parse(xhr.response).forEach(function(valor,indice){
            selector_municipio.innerHTML += '<option value="'+valor.id_municipio+'">'+valor.nombre_municipio.toUpperCase()+'</option>';
        });
    }
        
    };

    xhr.send(null);
  }