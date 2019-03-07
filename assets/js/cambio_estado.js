function cambio_estado(selector_estado,selector_municipio){
    //console.log(document.getElementById("selector_estado").value);
    let id_estado = selector_estado.value; 
    selector_municipio.innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/cseiio/index.php/c_municipio/get_municipios_estado?id_estado='+id_estado, true);

    xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));
        JSON.parse(xhr.response).forEach(function(valor,indice){
            selector_municipio.innerHTML += '<option value="'+valor.id_municipio+'">'+valor.nombre_municipio.toUpperCase()+'</option>';
        });
    };

    xhr.send(null);
  }