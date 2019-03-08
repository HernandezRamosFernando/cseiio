function cambio_municipio(selector_municipio,selector_localidad){
    //console.log(document.getElementById("selector_estado").value);
    let id_municipio = selector_municipio.value; 
    selector_localidad.innerHTML = "";
    
    var xhr = new XMLHttpRequest();

xhr.addEventListener("progress", updateProgress);
xhr.addEventListener("load", transferComplete);
xhr.addEventListener("error", transferFailed);
xhr.addEventListener("abort", transferCanceled);


    function updateProgress (oEvent) {
        if (oEvent.lengthComputable) {
          var percentComplete = oEvent.loaded / oEvent.total * 100;
          // ...
        } else {
          // Unable to compute progress information since the total size is unknown
        }
      }
      
      function transferComplete(evt) {
        console.log("completa.");
      }
      
      function transferFailed(evt) {
        console.log("Error en transferencia");
      }
      
      function transferCanceled(evt) {
        console.log("Transferencia cancelada por el usuario");
      }
      
    xhr.open('GET', '/cseiio/index.php/c_localidad/get_localidades_municipio?id_municipio='+id_municipio, true);

    xhr.onload = function () {
        console.log(id_municipio);
        JSON.parse(xhr.response).forEach(function(valor,indice){
            selector_localidad.innerHTML += '<option value="'+valor.id_localidad+'">'+valor.nombre_localidad.toUpperCase()+'</option>';
        });
    };

    xhr.send(null);
  }