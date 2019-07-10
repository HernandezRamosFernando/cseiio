<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Generacion de Matrícula</a>
      </li>
      <li class="breadcrumb-item active">Ingrese el Aspirante que desee:</li>
    </ol>

    <div class="card">
      <div class="card-body">


        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group text-uppercase">
                <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                  id="aspirante_curp_busqueda" placeholder="CURP" style="color: #237087">
                <label for="aspirante_curp_busqueda">CURP</label>
              </div>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-8">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" required="required"
                  id="aspirante_plantel_busqueda" name="aspirante_plantel">
                  <option value="">Buscar en todos los planteles</option>
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

            <div class="col-md-4">
              <button type='button' class="btn btn-success btn-lg btn-block" id="btn_buscar"
                onclick='buscar()'>Buscar</button>
            </div>

          </div>
        </div>



      </div>
    </div>



    <div class="card" style="overflow:scroll; display:none" id="busqueda_oculto">
      <div class="card-body">
        <table class="table table-hover" id="tabla_completa">
          <caption>Lista de Alumnos sin matrícula asignada</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Semestre</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Matrícula</th>

            </tr>
          </thead>
          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>



</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<script>

  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&plantel=' + plantel;
    console.log(query);
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/estudiantes_sin_matricula?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();

      JSON.parse(xhr.response).forEach(function (valor, indice) {
        var fila = '<tr>';

        fila += '<td>';
        var nombre_completo = valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += nombre_completo;
        fila += '</td>';

        fila += '<td>';
        var curp = valor.curp
        fila += curp;
        fila += '</td>';

        fila += '<td>';
        fila += valor.no_control;
        fila += '</td>';

        fila += '<td>';
        fila += valor.semestre_en_curso;
        fila += '</td>';

        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';

        fila += '<td>';
        fila += '<button class="btn btn-success" type="button" value="' + valor.no_control + '" onclick="asignar_matricula(this,\'' + nombre_completo + '\', \'' + curp + '\')"  data-toggle="modal" data-target="#exampleModalCenter">Generar Matrícula</button>';
        fila += '</td>';

        fila += '</tr>';

        document.getElementById("tabla").innerHTML += fila;
      });

      formato_tabla();

    };

    xhr.send(null);
    document.getElementById('btn_buscar').setAttribute("onClick", "limpiar();");
    document.getElementById('btn_buscar').innerHTML = 'Limpiar Búsqueda';
    document.getElementById('btn_buscar').classList.remove('btn-success');
    document.getElementById('btn_buscar').classList.add('btn-info');
    document.getElementById('busqueda_oculto').style.display="";

  }


  function asignar_matricula(e, e2, curp) {
    console.log(e)

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_documentacion/get_estudiantes_falta_documentacion_base?curp=' + curp, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      console.log(xhr.responseText.length);
      if (xhr.responseText.length <= 2) {
        console.log("se puede generar matricula");
        var xhrmatricula = new XMLHttpRequest();
        xhrmatricula.open('GET', '<?php echo base_url();?>index.php/c_estudiante/generar_matricula?no_control=' + e.value, true);
        xhrmatricula.onloadstart = function () {
          $('#div_carga').show();
        }
        xhrmatricula.error = function () {
          console.log("error de conexion");
        }
        xhrmatricula.onload = function () {
          $('#div_carga').hide();
          console.log(xhrmatricula.responseText);

          if (xhrmatricula.responseText.trim() !== "no") {
            Swal.fire({
              type: 'success',
              title: 'Matrícula generada correctamente<br>' + xhrmatricula.responseText + '<br> asignada a:<br>' + e2
            })
            //$(e).parents('tr').detach();
            refrescar_tabla();
          } else {
            Swal.fire({
              type: 'error',
              title: 'Matrícula no generada',
              confirmButtonText: 'Cerrar'
            })
          }
        };

        xhrmatricula.send(null);
        
      } else {

        var documentos_faltantes = new XMLHttpRequest();
        documentos_faltantes.open('GET', '<?php echo base_url();?>index.php/c_documentacion/get_documentacion_base_faltante_estudiante?no_control='+e.value, true);
        documentos_faltantes.onloadstart = function(){
        $('#div_carga').show();
      }
      documentos_faltantes.error = function (){
        console.log("error de conexion");
      }
      documentos_faltantes.onload = function(){
        //console.log(xhr.response);
        $('#div_carga').hide();
            console.log(JSON.parse(documentos_faltantes.response));
            //console.log(e.value);
            //console.log(documentos_faltantes.response);
            var docs = "";
            JSON.parse(documentos_faltantes.response).forEach(function(valor,indice){
                docs+="<p style='text-align:left;margin-left:30%'> - "+valor.nombre_documento+"</p>";
            });

            docs = docs.substring(0,docs.length-1);
          
        //-------------------------------------------------------
        console.log("No se puede generar matricula");
        swalWithBootstrapButtons.fire({
          title: 'Información!',
          html: "<p>El alumno no ha entregado la documentación base completa. ¿Desea generar la carta compromiso sin la documentación?</p> <p>Documentos faltantes: </p>"+docs,
          type: 'warning',
          confirmButtonText: 'Aceptar',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then(function (result) {
          if (result.value) {
            var xhrmatricula = new XMLHttpRequest();
            xhrmatricula.open('GET', '<?php echo base_url();?>index.php/c_estudiante/generar_matricula?no_control=' + e.value, true);
            xhrmatricula.onloadstart = function () {
              $('#div_carga').show();
            }
            xhrmatricula.error = function () {
              console.log("error de conexion");
            }
            xhrmatricula.onload = function () {
              $('#div_carga').hide();
              console.log(xhrmatricula.responseText);

              if (xhrmatricula.responseText.trim() !== "no") {
                Swal.fire({
                  type: 'success',
                  title: 'Matrícula generada correctamente<br>' + xhrmatricula.responseText + '<br> asignada a:<br>' + e2
                })
                //$(e).parents('tr').detach();
                refrescar_tabla();
              } else {
                Swal.fire({
                  type: 'error',
                  title: 'Matrícula no generada',
                  confirmButtonText: 'Cerrar'
                })
              }
            };
            
            xhrmatricula.send(null);
           
            
          }
          
        });
        
        //---------------------------------------------------------------------------------
      };
        documentos_faltantes.send(null);
        
        
      }
    };
    
    xhr.send(null);
    
    
    
  }


  function refrescar_tabla(){
  borrar_formato_tabla();
  buscar();
}

 function borrar_formato_tabla(){
      $("#tabla_completa").dataTable().fnDestroy();
      
    }
</script>