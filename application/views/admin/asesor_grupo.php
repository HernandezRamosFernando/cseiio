<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Asignar Asesor a Grupos</a>
      </li>
      <li class="breadcrumb-item active">Seleccione e ingrese los datos solicitados</li>
    </ol>

    <div class="form-group">
        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"="" id="plantel"   name="plantel">
                <option value="">Seleccione el plantel donde buscar el grupo</option>

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
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg" onchange="cargargrupos()" name="semestre_grupo"
                id="semestre_grupo">
                <option value="">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              <span>Seleccione el semestre del grupo a  buscar</span>
            </label>
          </div>

        </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label">
              <select class="form-control form-control-lg"  name="grupos" id="grupos">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de grupos</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="cargar_materias()" style="padding: 1rem" id="crear_grupo">Mostrar grupo</button>
            </div>
          </div>
      </div>



    <div class="card" style="overflow:scroll">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de las materias del grupo</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col">Materia</th>
              <th scope="col" >Clave</th>
              <th scope="col" style="width:35%">Nombre de Asesor</th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-4 offset-md-3">
          <button class="btn btn-success btn-lg btn-block" style="padding: 1rem" onclick="guardar()">Guardar</button>
        </div>
      </div>
    </div>





  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>
function cargargrupos() {
  if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel',
        showConfirmButton: false,
        timer: 2500
      });
    }else{
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);
  
      var semestre = document.getElementById("semestre_grupo").value;
      console.log(semestre);
      grupos.innerHTML="";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_plantel/get_grupos_plantel_html?plantel=' + plantel + '&semestre='+ semestre , true);
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
       if(xhr.response === ""){
       var option = document.createElement("option");
       option.text = "Ningun grupo creado";
       option.value = "";
       grupos.add(option); 
       }else{
        console.log(xhr.response);
         grupos.innerHTML = xhr.responseText;
        }
        };  
       xhr.send(null);
    }
}



function cargar_materias(){
  document.getElementById("tabla").innerHTML= "";
  var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_materias_grupo?grupo='+document.getElementById("grupos").value, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
      console.log(JSON.parse(xhr.response));
      JSON.parse(xhr.response).forEach(function(valor,indice){
        var fila ="<tr>";
        fila+="<td>"+valor.unidad_contenido+"</td>";
        fila+="<td>"+valor.clave+"</td>";
        fila+='<td><input type="text" class="form-control" name="input_asesor" id="input_asesor" placeholder="Nombre de asesor" style="width:100%"></td>';
        fila+="</tr>";
        document.getElementById("tabla").innerHTML+=fila;
      });
    };
    xhr.send(null);
}


function guardar(){
  var tabla = document.getElementById("tabla").children;
  var datos = new Array();
  
  for(let i=0;i<tabla.length;i++){
    //var a = tabla[i].children[2].children
    //console.log(a[0].value);
    var dato={
      id_grupo:document.getElementById("grupos").value,
      id_materia:tabla[i].children[1].innerText,
      asesor:tabla[i].children[2].children[0].value
    }

    datos.push(dato);
  }


  var xhr = new XMLHttpRequest();
      xhr.open("POST", '/cseiio/c_grupo/agregar_asesor_materias', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");

      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
              console.log(xhr.response);
          }
      }
      xhr.send(JSON.stringify(datos));

 // console.log(datos);
}
</script>

</html>