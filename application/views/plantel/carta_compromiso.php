<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Generacion de Carta Compromiso</a>
      </li>
      <li class="breadcrumb-item active">Ingrese el Aspirante que desee:</li>
    </ol>

    <div class="card">
      <div class="card-body">



        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
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
        <table class="table table-hover"  id="tabla_completa">
          <caption>Lista de Alumnos que generan carta compromiso</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Semestre</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Editar</th>
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

<!-- Modal -->
<div class="modal fade" id="generarobservacion" tabindex="-1" role="dialog" aria-labelledby="generarobservacion "
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 95% !important;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar las observaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_documentos" style="width: 100%">
              <thead class="thead-light">
                <tr>
                  <th scope="row" class="col-md-1">N° control</th>
                  <td scope="col" class="col-md-1">Documento</th>
                  <td scope="col" class="col-md-1 ">Observación</th>
                </tr>
              </thead>
              <tbody id="tabla_observacion">

              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-warning" onclick="generar_carta_compromiso(this)">Generar carta
              compromiso</button>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>




<input type="text" id="no_control" style="display:none">


<script src="<?php echo base_url();?>assets/js/sweetalert2.all.min.js"></script>
<script>



  function aspirante_input(e) {
    document.getElementById("no_control").value = e.value;

    var dias = new XMLHttpRequest();
    dias.open('GET', '<?php echo base_url();?>index.php/c_documentacion/get_dias_ultima_carta_compromiso_estudiante?no_control=' + e.value, true);
    dias.onloadstart = function () {
      $('#div_carga').show();
    }
    dias.error = function () {
      console.log("error de conexion");
    }
    dias.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(dias.response)[0].dias);
      console.log(dias.response);
      if (JSON.parse(dias.response)[0].dias === null || JSON.parse(dias.response)[0].dias > 30) {

        //abre modal
        $("#generarobservacion").modal("show");

        document.getElementById("no_control").value = e.value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>index.php/c_documentacion/get_documentos_base_faltantes_estudiante?no_control=' + e.value, true);
        xhr.onloadstart = function () {
          $('#div_carga').show();
        }
        xhr.error = function () {
          console.log("error de conexion");
        }

        xhr.onload = function () {
          $('#div_carga').hide();
          console.log(JSON.parse(xhr.response));
          document.getElementById('tabla_observacion').innerHTML = "";
          JSON.parse(xhr.response).forEach(function (valor, indice) {
            document.getElementById('tabla_observacion').innerHTML += "<tr><td>" + valor.no_control + "</td><td>" + valor.nombre_documento + '</td><td><input style="width: 300px;" id="' + valor.id_documento + '" type="text" class="form-control"></td></tr>';
          });

        }

        xhr.send(null);
      }

      else {
        swalWithBootstrapButtons.fire({
          title: 'Error!',
          text: "Ya cuenta con una carta compromiso vigente, dias restantes: " + (30 - parseInt(JSON.parse(dias.response)[0].dias)),
          type: 'warning',
          confirmButtonText: 'Reimprimir',
          showCancelButton: true,
          cancelButtonText: 'Cerrar'
        }).then(function (result) {
          if (result.value) {
            reimprimir_carta();
          }
        });
        // alert("Ya cuenta con una carta compromiso vigente, dias restantes: "+(30-parseInt(JSON.parse(dias.response)[0].dias)));

      }
    };

    dias.send(null);
    /*
  
  data-target="#generarobservacion"
  
  
          */
  }


  function reimprimir_carta() {
    var carta_compromiso = new XMLHttpRequest();
    carta_compromiso.open('GET', '<?php echo base_url();?>index.php/c_documentacion/generar_carta_compromiso?no_control=' + document.getElementById("no_control").value, true);
    carta_compromiso.responseType = "arraybuffer";
    carta_compromiso.onloadstart = function () {
      $('#div_carga').show();
    }
    carta_compromiso.error = function () {
      console.log("error de conexion");
    }
    carta_compromiso.onload = function () {
      $('#div_carga').hide();
      //console.log(carta_compromiso.responseText);
      if (this.status === 200) {
        var blob = new Blob([carta_compromiso.response], { type: "application/pdf" });
        var objectUrl = URL.createObjectURL(blob);
        window.open(objectUrl);
      }

    };

    carta_compromiso.send(null);
  }

  function generar_carta_compromiso(e) {
    //console.log(e.value);

    var tabla = document.getElementById('tabla_observacion');
    //console.log(tabla.childNodes);
    var json_observaciones = Array();

    //console.log(json_observaciones[0]);
    tabla.childNodes.forEach(function (input, indice) {


      json_observaciones.push({
        "id": parseInt(input.childNodes[2].childNodes[0].id),
        "observacion": input.childNodes[2].childNodes[0].value,
        "no_control": document.getElementById("no_control").value
      });

    });

    //console.log(json_observaciones);

    $("#generarobservacion").modal("toggle");


    //insertar observaciones en la base de datos
    var observaciones = new XMLHttpRequest();
    observaciones.open('POST', '<?php echo base_url();?>index.php/c_documentacion/add_observaciones_documentacion_faltante_estudiante', true);
    observaciones.setRequestHeader("Content-Type", "application/json");
    observaciones.onloadstart = function () {
      $('#div_carga').show();
    }
    observaciones.error = function () {
      console.log("error de conexion");
    }

    observaciones.onreadystatechange = function () {
      //-------------------------------------- generacion de carta compromiso
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        //si se agregan las observaciones correctamente entonces se genera la carta compromiso
        if (observaciones.responseText === "si") {
          var carta_compromiso = new XMLHttpRequest();
          carta_compromiso.open('GET', '<?php echo base_url();?>index.php/c_documentacion/generar_carta_compromiso?no_control=' + document.getElementById("no_control").value, true);
          carta_compromiso.responseType = "arraybuffer";
          carta_compromiso.onloadstart = function () {
            $('#div_carga').show();
          }
          carta_compromiso.error = function () {
            console.log("error de conexion");
          }

          carta_compromiso.onload = function () {
            $('#div_carga').hide();
            //console.log(carta_compromiso.responseText);
            if (this.status === 200) {
              var blob = new Blob([carta_compromiso.response], { type: "application/pdf" });
              var objectUrl = URL.createObjectURL(blob);
              window.open(objectUrl);

              //alerta de que si se genero la carta comprimiso
             
              Swal.fire({
                type: 'success',
                title: 'Carta compromiso generada exitosamente',
                showConfirmButton: false,
                timer: 2500
              });
            }

          };

          carta_compromiso.send(null);
          //-----------------------------------------------------------------------
        }

        else {
          alert("algo salio mal");
        }
      }
    }
    observaciones.send(JSON.stringify(json_observaciones));
  }


  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";

    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_documentacion/get_estudiantes_falta_documentacion_base?' + query, true);
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
        fila += valor.nombre + " " + valor.primer_apellido + " " + valor.segundo_apellido;
        fila += '</td>';
        fila += '<td>';
        fila += valor.curp;
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
        fila += '<button class="btn btn-warning" type="button" value="' + valor.no_control + '" onclick="aspirante_input(this)" class="btn btn-primary" data-toggle="modal">Generar Carta Compromiso</button>';
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
    document.getElementById('busqueda_oculto').style.display = "";
  }


</script>