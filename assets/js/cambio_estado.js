function cambio_estado(selector_estado,selector_municipio,selector_localidad){
    //console.log(document.getElementById("selector_estado").value);
    let id_estado = selector_estado.value; 
    selector_municipio.innerHTML = "";
    selector_localidad.innerHTML = "";
    var xhr = new XMLHttpRequest();

      
    //selector_municipio.innerHTML =  "<img src=\"/cseiio/assets/img/cargando.gif\"\" />";  //imagen de carga
    xhr.open('GET', '../../index.php/c_municipio/get_municipios_estado_html?id_estado='+id_estado, true);

    xhr.onreadystatechange = function() {
        //console.log(JSON.parse(xhr.response));
        if(xhr.readyState == 4){


            selector_municipio.innerHTML = xhr.responseText;
            var option = document.createElement("option");
            option.text = "Seleccione Municipio";
            option.value= "";
            selector_localidad.add(option);
         }
        
    };

    xhr.send(null);
  }