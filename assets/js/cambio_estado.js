function cambio_estado(selector_estado,selector_municipio){
    //console.log(document.getElementById("selector_estado").value);
    let id_estado = selector_estado.value; 
    selector_municipio.innerHTML = "";

    
    
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
      
    xhr.open('GET', '/cseiio/index.php/c_municipio/get_municipios_estado?id_estado='+id_estado, true);

    xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));
        JSON.parse(xhr.response).forEach(function(valor,indice){
            selector_municipio.innerHTML += '<option value="'+valor.id_municipio+'">'+valor.nombre_municipio.toUpperCase()+'</option>';
        });
    };

    xhr.send(null);
  }