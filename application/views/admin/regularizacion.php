<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Regularización</a>
      </li>
      <li class="breadcrumb-item active">Busque la materia a regularizar</li>
    </ol>


    <form class="card" id="formulario">
      <div class="form-group">

        <div class="row">
          <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="plantel"   name="plantel" onchange="cargarmaterias();">
                <option value="">Seleccione el plantel donde buscar la materia</option>

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
              <select class="form-control form-control-lg selcolor"  name="materias" id="materias">
                <option value="">Seleccione uno</option>
              </select>
              <span>Lista de materias</span>
            </label>
          </div>

            <div class="col-md-4 offset-md-3">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="" style="padding: 1rem" id="mostrar_materias">Mostrar Materia</button>
            </div>
          </div>
      </div>


      <div class="row" id="alumnos_oculto" style="display:none">
      <div class=" col-md-6">
        <div class="card card-body" style="width: 100%; overflow: scroll">
          <table class="table table-hover" id="tabla_completa" style="width: 100%; overflow: scroll">
            <caption>Lista de los alumnos que deben regularizar</caption>
            <thead class="thead-light">
              <tr>
                <th scope="col" class="col-md-1">Nombre completo</th>
                <th scope="col" class="col-md-1">N° control</th>
                <th scope="col" class="col-md-1">Semestre actual</th>
                <th scope="col" class="col-md-1">Semestre de adeudo</th>
                <th scope="col" class="col-md-1">Calificacion</th>
              </tr>
            </thead>
            <tbody id="tabla">
            </tbody>
          </table>
        </div>
      </div>

     </div>
   </form>
    <br>


    </div>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->

<script>

function validarcomponente(){

if(document.getElementById("plantel").value != '' && document.getElementById("materias").value != '' ){
  buscar();
}else{
  Swal.fire({
        type: 'warning',
        text: 'Agregue los datos faltantes'
      });
  }
}


function cargarmaterias() {
  if (document.getElementById("plantel").value === "") {
      Swal.fire({
        type: 'info',
        text: 'Debe seleccionar un plantel'
      });
      $("#materias").val('');
    }else{
      var xhr = new XMLHttpRequest();
      var plantel = document.getElementById("plantel").value;
      console.log(plantel);
  
      materias.innerHTML="";
      xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_con_reprobados_html?plantel=' + plantel , true);
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
       option.text = "Ningun alumno con adeudo en este plantel";
       option.value = "";
       materias.add(option); 
       }else{
        console.log(xhr.response);
         materias.innerHTML = xhr.responseText;
        }
        };  
       xhr.send(null);
    }
}

  function buscar() { 
    var xhr = new XMLHttpRequest();
    var plantel = document.getElementById("plantel").value;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_regularizacion/materias_con_reprobados_html?' + plantel, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
        $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
        var fila = '<tr>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';
        fila += '<td class="">';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" id="botoncambio" onclick="cambiardetabla(this);">Agregar</button>';
        fila += '</td>';
        fila += '</tr>';
        document.getElementById("tabla").innerHTML += fila;
      });
      //console.log(JSON.parse(xhr.response));
      document.getElementById("contador_alumnos_restantes").innerText="Alumnos restantes: "+JSON.parse(xhr.response).length;
      //formato_tabla();
    };
    xhr.send(null);
    document.getElementById('boton_agregar').style.display = "";
    document.getElementById('alumnos_oculto').style.display = "";
    limpiarbusqueda();
  }
</script>
</html>