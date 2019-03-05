





function cambio_municipio(selector_municipio,selector_localidad){
    //console.log(document.getElementById("selector_estado").value);
    let id_municipio = selector_municipio.value; 
    selector_localidad.innerHTML = "";
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/app/c_localidad/get_localidades_municipio?id_municipio='+id_municipio, true);

    xhr.onload = function () {
        console.log(id_municipio);
        JSON.parse(xhr.response).forEach(function(valor,indice){
            selector_localidad.innerHTML += '<option value="'+valor.id_localidad+'">'+valor.nombre_localidad.toUpperCase()+'</option>';
        });
    };

    xhr.send(null);
  }