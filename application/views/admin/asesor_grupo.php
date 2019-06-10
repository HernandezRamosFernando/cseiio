<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Asignar Asesor a Grupos</a>
      </li>
      <li class="breadcrumb-item active">Seleccione e ingrese los datos solicitados</li>
    </ol>

    <form class="card" id="formulario">
    <div class="card-body">

    <div class="form-group">
        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="plantel" name="plantel">
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
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" onchange="cargargrupos()" name="semestre_grupo"
                id="semestre_grupo">
                <option value="">Seleccione uno</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
              <span>Semestre del grupo a buscar</span>
            </label>
          </div>

        </div>
      </div>

      <div class="form-group">
        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="grupos" id="grupos">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de grupos</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="validarcomponente_asesor()" style="padding: 1rem" id="crear_grupo">Mostrar grupo</button>
            </div>
          </div>
      </div>

                                    



    <div class="card" style="overflow:scroll; display: none" id="tabla_oculto_asesor" >
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa_asesor" style="width: 100%">
          <caption>Lista de las materias del grupo</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col">Materia</th>
              <th scope="col" >Clave</th>
              <th scope="col" style="width:35%">Nombre de Asesor</th>
            </tr>
          </thead>



          <tbody id="tabla_asesor">

          </tbody>
        </table>
      </div>
      </div>
      </div>
                                      </form>
        <br>
    <div class="form-group" id="boton_oculto_asesor" style="display: none">
      <div class="row">
        <div class="col-md-12">
          <button class="btn btn-success btn-lg btn-block btn-guardar" style="padding: 1rem" onclick="guardar()">Guardar</button>
        </div>
      </div>
    </div>





  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>
function validarcomponente_asesor(){

if(document.getElementById("plantel").value != '' && document.getElementById("grupos").value != '' && document.getElementById("semestre_grupo").value != '' ){
  cargar_select_asesores();
}else{
  Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
  }
}

function cargargrupos() {
  if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel',
        showConfirmButton: false,
        timer: 2500
      });
      $("#semestre_grupo").val('');
    }else{
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      var semestre = document.getElementById("semestre_grupo").value;
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




function cargar_select_asesores(){
    //cargar select de asesores de ese plantel
    var asesores = new XMLHttpRequest();
    asesores.open('GET', '<?php echo base_url();?>index.php/c_asesor/get_asesores_plantel?plantel='+document.getElementById("plantel").value, true);
    asesores.onloadstart = function(){
        $('#div_carga').show();
      }
      asesores.error = function (){
        console.log("error de conexion");
      }
      asesores.onload = function(){
        //console.log(xhr.response);
        $('#div_carga').hide();
      //cargar materia y asesores ya guardados
  document.getElementById("tabla_asesor").innerHTML= "";
  var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_grupo/get_materias_grupo_asesor?grupo='+document.getElementById("grupos").value, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        //console.log(xhr.response);
        $('#div_carga').hide();
        
      console.log(JSON.parse(xhr.response));
      
      JSON.parse(xhr.response).forEach(async function(valor,indice){
        var fila ="<tr>";
        fila+="<td>"+valor.unidad_contenido+"</td>";
        fila+="<td>"+valor.clave+"</td>";
        fila+='<td><select id="s'+indice+'" class="form-control form-control-lg">'+asesores.response+'</select><td>';
        //var asesor = valor.asesor==="null"?"":valor.asesor;
        //fila+='<td><input type="text" class="form-control" name="input_asesor" id="input_asesor" value="'+asesor+'" placeholder="Nombre de asesor"></td>';
        fila+="</tr>";
        document.getElementById("tabla_asesor").innerHTML+=fila;
        $("#s"+indice+" option[value="+valor.id_asesor+"]").attr('selected', 'selected');
  
      });
      
    };
    xhr.send(null);
    limpiarbusqueda();
    document.getElementById("tabla_oculto_asesor").style.display="";
    document.getElementById("boton_oculto_asesor").style.display="";
    };
    asesores.send(null);
}


function limpiarbusqueda(){
    document.getElementById("grupos").disabled = true;
    document.getElementById("plantel").disabled = true;
    document.getElementById("semestre_grupo").disabled = true;
    document.getElementById('crear_grupo').classList.remove('btn-success');
    document.getElementById('crear_grupo').classList.add('btn-info');
    document.getElementById('crear_grupo').setAttribute("onClick", "limpiar();");
    document.getElementById('crear_grupo').innerHTML = 'Limpiar Búsqueda';
  }



function guardar(){
  
  
  var tabla = document.getElementById("tabla_asesor").children;
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

  console.log(datos);


  var xhr = new XMLHttpRequest();
      xhr.open("POST", '<?php echo base_url();?>index.php/c_grupo/agregar_asesor_materias', true);

      //Send the proper header information along with the request
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onreadystatechange = function() { // Call a function when the state changes.
          if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            $('#div_carga').hide();
              if (xhr.responseText.trim() === "si") {
                console.log(xhr.response);
                    swalWithBootstrapButtons.fire({
                    type: 'success',
                    text: 'Datos guardados correctamente',
                    allowOutsideClick: false,
                    confirmButtonText: 'Aceptar'
                    }).then((result) => {
                    if (result.value) {
                    //aqui va el aceptar
                    $(document).scrollTop(0);
                    location.reload(); 
                      }
                    //aqui va si cancela
                    });
               }else{
                Swal.fire({
                  type: 'error',
                  text: 'Datos no guardados'
                 });
               }
          }
      }
      xhr.send(JSON.stringify(datos));

 // console.log(datos);
 
}
</script>

</html>