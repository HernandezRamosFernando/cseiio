<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  <!-- Bootstrap core CSS-->
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="/cseiio/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="/cseiio/assets/css/sb-admin.css" rel="stylesheet">

  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <div class="card">
      <div class="card-body">



        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                  id="aspirante_nombre_busqueda" placeholder="Nombre(s)">
                <label for="aspirante_nombre_busqueda">Nombre(s)</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                   id="aspirante_apellido_paterno_busqueda" placeholder="Apellido Paterno">
                <label for="aspirante_apellido_paterno_busqueda">Apellido Paterno</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control"
                   id="aspirante_apellido_materno_busqueda" placeholder="Apellido Materno">
                <label for="aspirante_apellido_materno_busqueda">Apellido Materno</label>
              </div>
            </div>
          </div>


        </div>

        <div class="form-group">
          <div class="row">


            <div class="col-md-4">
              <label class="form-group has-float-label">
                <select class="form-control custom-select" required="required" id="aspirante_plantel_busqueda"
                  name="aspirante_plantel">

                  <?php
            foreach ($planteles as $plantel)
            {
                    echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_corto_plantel.'</option>';
            }
            ?>

                </select>
                <span>Plantel</span>
              </label>

            </div>

            <div class="col-md-4">
              <button type='button' class="btn btn-primary" onclick='buscar()'>Buscar</button>
            </div>

          </div>
        </div>



      </div>
    </div>
  </div>


  <div class="container">
    <div class="card" style="overflow:scroll">
      <div class="card-body">
        <table class="table table-bordered" id="tabla_completa">
          <thead>
            <tr>
              <th scope="col" class="col-md-1">Nombre</th>
              <th scope="col" class="col-md-1">Apellido Paterno</th>
              <th scope="col" class="col-md-1">Apellido Materno</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">Semestre</th>
              <th scope="col" class="col-md-1">Editar</th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>
  </div>




  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <!-- formulario -->
          <form action="/cseiio/c_aspirante/actualizar_datos_aspirante" method="post">

<!--datos personales------------------------------------------------------>
<p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
  Datos personales de Aspirante
  <hr>
</p>


<div class="form-group">

  <div class="row">
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
          class="form-control" id="aspirante_nombre" name="aspirante_nombre" placeholder="Nombre(s)">
        <label for="aspirante_nombre">Nombre(s)</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
          class="form-control" id="aspirante_apellido_paterno" name="aspirante_apellido_paterno"
          placeholder="Apellido Paterno">
        <label for="aspirante_apellido_paterno">Apellido Paterno</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" title="Introduzca solo letras"
          class="form-control" id="aspirante_apellido_materno" name="aspirante_apellido_materno"
          placeholder="Apellido Materno">
        <label for="aspirante_apellido_materno">Apellido Materno</label>
      </div>
    </div>
  </div>

</div>



<div class="form-group">

  <div class="row">
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text"
          pattern="[A-ZÑ]{1}[AEIOU]{1}[A-ZÑ]{1}[A-ZÑ]{1}[0-9]{6}(H|M)(AS|BC|BS|CC|CS|CH|DF|CL|CM|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QO|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS)[BCDFGHJKLMNPQRSTVWXYZ]{3}[0-9|A-Z]{1}[0-9]{1}"
          title="CURP incorrecto" class="form-control text-uppercase" id="aspirante_curp"
          name="aspirante_curp" placeholder="CURP">
        <label for="aspirante_curp">CURP</label>
      </div>
    </div>

    <div class="col-md-2 text-center">
      <div class="form-label-group">
        <input type="date" required="required" class="form-control" id="aspirante_fecha_nacimiento"
          name="aspirante_fecha_nacimiento" placeholder="Fecha de Nacimiento">
        <label for="aspirante_fecha_nacimiento">Fecha Nacimiento</label>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-label-group">
        <input type="text" pattern="[0-9]{10}" 
          title="El numero de telefono debe de ser a 10 digitos" class="form-control" id="aspirante_telefono"
          name="aspirante_telefono" placeholder="Telefono">
        <label for="aspirante_telefono">Telefono</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="email"
          pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
          title="Introduzca un correo valido" class="form-control text-lowercase" id="aspirante_correo"
          name="aspirante_correo" placeholder="Correo Electronico">
        <label for="aspirante_correo">Correo electrónico</label>
      </div>
    </div>


  </div>

</div>



<div class="form-group">

  <div class="row">
    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" id="aspirante_sexo"
          name="aspirante_sexo">
          <option value="H">Hombre</option>
          <option value="M">Mujer</option>
        </select>
        <span>Sexo</span>
      </label>
    </div>

    <div class="col-md-4">
      <div class="form-label-group">
        <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos"
          class="form-control" id="aspirante_nss" name="aspirante_nss" placeholder="Numero de Seguro Social">
        <label for="aspirante_nss">Nss</label>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" class="form-control" id="aspirante_programa_social"
          name="aspirante_programa_social" placeholder="Folio de programa social">
        <label for="aspirante_programa_social">Folio de Programa Social</label>
      </div>
    </div>



  </div>



</div>


<div class="form-group">

  <div class="row">
    <div class="col-md-8">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" id="aspirante_plantel"
          name="aspirante_plantel">

          <?php
                              foreach ($planteles as $plantel)
                              {
                                      echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.'</option>';
                              }
                              ?>

        </select>
        <span>Plantel</span>
      </label>
    </div>
    
    
    <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="aspirante_semestre" name="aspirante_semestre">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                  </select>
                  <span>Semestre al que ingresa</span>
                </label>
              </div>


  </div>
 
</div>
<!--fin datos personales------------------------------------------------------>

<!--direccion------------------------------------------------------>
<p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
  Dirección familiar del Aspirante
  <hr>
</p>

<div class="form-group">

  <div class="row">

    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" name="aspirante_direccion_estado"
          onChange="cambio_estado(selector_estado_aspirante,selector_municipio_aspirante)"
          id="selector_estado_aspirante">

          <?php
                    foreach ($estados as $estado)
                    {
                            echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                    }
                    ?>



        </select>
        <span>Estado</span>
      </label>
    </div>


    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" name="aspirante_direccion_municipio"
          onChange="cambio_municipio(selector_municipio_aspirante,selector_localidad_aspirante)"
          id="selector_municipio_aspirante">
          <option></option>
          <?php
                    foreach ($municipios as $municipio)
                    {
                            echo '<option value="'.$municipio->id_municipio.'">'.strtoupper($municipio->nombre_municipio).'</option>';
                    }
                    ?>
        </select>
        <span>Municipio</span>
      </label>
    </div>

    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" name="aspirante_direccion_localidad"
          id="selector_localidad_aspirante">
          <option></option>

          <?php
                    foreach ($localidades as $localidad)
                    {
                            echo '<option value="'.$localidad->id_localidad.'">'.strtoupper($localidad->nombre_localidad).'</option>';
                    }
                    ?>

        </select>
        <span>Localidad</span>
      </label>
    </div>
  </div>

</div>



<div class="form-group">

  <div class="row">
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ 0-9]+" required="required"
          title="La direccion tiene caracteres incorrectos" class="form-control"
          id="aspirante_direccion_calle" name="aspirante_direccion_calle" placeholder="Calle">
        <label for="aspirante_direccion_calle">Calle</label>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-label-group">
        <input type="text" pattern="[0-9]+" title="Introduzca solo numeros" class="form-control"
          id="aspirante_direccion_numero" name="aspirante_direccion_numero" placeholder="Numero Exterior">
        <label for="aspirante_direccion_numero">Numero</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ 0-9]+"
          title="La colonia tiene caracteres incorrectos" class="form-control"
          id="aspirante_direccion_colonia" name="aspirante_direccion_colonia" placeholder="Colonia">
        <label for="aspirante_direccion_colonia">Colonia</label>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-label-group">
        <input type="text" pattern="[0-9]{5}"
          title="El codigo postal solo debe contener 5 digitos" class="form-control"
          id="aspirante_direccion_cp" name="aspirante_direccion_cp" placeholder="Codigo Postal">
        <label for="aspirante_direccion_cp">Codigo Postal</label>
      </div>
    </div>
  </div>

</div>

<!--fin direccion------------------------------------------------------>

<!--datos tutor------------------------------------------------------>
<p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
  Datos de Tutor
  <hr>
</p>

<div class="form-group">

  <div class="row">
    <div class="col-md-9">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
          class="form-control" id="aspirante_tutor_nombre" name="aspirante_tutor_nombre"
          placeholder="Nombre Completo">
        <label for="aspirante_tutor_nombre">Nombre Completo</label>
      </div>
    </div>

    <div class="col-md-3">
      <div class="form-label-group">
        <input type="text" pattern="[0-9]{10}" required="required"
          title="El numero de telefono debe de ser a 10 digitos" class="form-control"
          id="aspirante_tutor_telefono" name="aspirante_tutor_telefono" placeholder="Telefono">
        <label for="aspirante_tutor_telefono">Telefono</label>
      </div>
    </div>
  </div>

</div>


<div class="form-group">

  <div class="row">
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" title="Introduzca solo letras" class="form-control"
          id="aspirante_tutor_ocupacion" name="aspirante_tutor_ocupacion" placeholder="Ocupacion">
        <label for="aspirante_tutor_ocupacion">Ocupacion</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" required="required" title="Introduzca solo letras"
          class="form-control" id="aspirante_tutor_parentezco" name="aspirante_tutor_parentezco"
          placeholder="Parentezco">
        <label for="aspirante_tutor_parentezco">Parentezco</label>
      </div>
    </div>
  </div>

</div>

<!--fin tutor------------------------------------------------------>


<!--datos lengua materna------------------------------------------------------>
<p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
  Datos de lengua materna
  <hr>
</p>

<div class="form-group">

  <div class="row">
    <div class="col-md-2">
      <label class="form-group has-float-label">
        <select class="form-control" required="required" id="aspirante_lengua_nombre" name="aspirante_lengua_nombre">

          <?php
                    foreach ($lenguas as $lengua)
                    {
                            echo '<option value="'.$lengua->id_lengua.'">'.strtoupper($lengua->nombre_lengua).'</option>';
                    }
                    ?>

        </select>
        <span>Lengua</span>
      </label>
    </div>

    <div class="col-md-2">
      <label class="form-group has-float-label">
        <select class="form-control" required="required" id="aspirante_lengua_lee" name="aspirante_lengua_lee">
          <option value="0">Nada</option>
          <option value="25">Poco</option>
          <option value="50">Regular</option>
          <option value="100">Mucho</option>
        </select>
        <span>Lee</span>
      </label>
    </div>

    <div class="col-md-2">
      <label class="form-group has-float-label">
        <select class="form-control" required="required" id="aspirante_lengua_habla" name="aspirante_lengua_habla">
          <option value="0">Nada</option>
          <option value="25">Poco</option>
          <option value="50">Regular</option>
          <option value="100">Mucho</option>
        </select>
        <span>Habla</span>
      </label>
    </div>

    <div class="col-md-2">
      <label class="form-group has-float-label">
        <select class="form-control" required="required" id="aspirante_lengua_escribe" name="aspirante_lengua_escribe">
          <option value="0">Nada</option>
          <option value="25">Poco</option>
          <option value="50">Regular</option>
          <option value="100">Mucho</option>
        </select>
        <span>Escribe</span>
      </label>
    </div>

    <div class="col-md-2">
      <label class="form-group has-float-label">
        <select class="form-control" required="required" id="aspirante_lengua_entiende" name="aspirante_lengua_entiende">
          <option value="0">Nada</option>
          <option value="25">Poco</option>
          <option value="50">Regular</option>
          <option value="100">Mucho</option>
        </select>
        <span>Entiende</span>
      </label>
    </div>


    <div class="col-md-2">
      <label class="form-group has-float-label">
        <select class="form-control" required="required" id="aspirante_lengua_traduce" name="aspirante_lengua_traduce">
          <option value="0">Nada</option>
          <option value="25">Poco</option>
          <option value="50">Regular</option>
          <option value="100">Mucho</option>
        </select>
        <span>Traduce</span>
      </label>
    </div>




  </div>

</div>

<!--fin legua materna------------------------------------------------------>



<!--datos secundaria------------------------------------------------------>
<p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
  Datos de Secundaria de procedencia
  <hr>
</p>

<div class="form-group">

  <div class="row">
    <div class="col-md-4">
      <div class="form-label-group">
        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+" required="required"
          title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control"
          id="aspirante_secundaria_nombre" name="aspirante_secundaria_nombre"
          placeholder="Nombre de Secundaria">
        <label for="aspirante_secundaria_nombre">Nombre de Secundaria</label>
      </div>
      <br>
    </div>

    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" id="aspirante_secundaria_tipo_subsistema" name="aspirante_secundaria_tipo_subsistema">
          <option value="TELESECUNDARIA">Telesecundaria</option>
          <option value="GENERAL">General</option>
          <option value="PARTICULAR">Particular</option>
          <option value="TECNICA">Tecnica</option>
          <option value="COMUNITARIA">Comunitaria</option>
          <option value="OTRO">Otro</option>
        </select>
        <span>Tipo de Subsistema</span>
      </label>
    </div>

  </div>

</div>




<div class="form-group">

  <div class="row">

    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" name="aspirante_secundaria_estado"
          onChange="cambio_estado(selector_estado_secundaria,selector_municipio_secundaria)"
          id="selector_estado_secundaria">

          <?php
                    foreach ($estados as $estado)
                    {
                            echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                    }
                    ?>

        </select>
        <span>Estado</span>
      </label>
    </div>


    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" name="aspirante_secundaria_municipio"
          onChange="cambio_municipio(selector_municipio_secundaria,selector_localidad_secundaria)"
          id="selector_municipio_secundaria">

          <?php
                    foreach ($municipios as $municipio)
                    {
                            echo '<option value="'.$municipio->id_municipio.'">'.strtoupper($municipio->nombre_municipio).'</option>';
                    }
                    ?>

        </select>
        <span>Municipio</span>
      </label>
    </div>

    <div class="col-md-4">
      <label class="form-group has-float-label">
        <select class="form-control form-control-lg" required="required" name="aspirante_secundaria_localidad"
          id="selector_localidad_secundaria">

          <?php
                    foreach ($localidades as $localidad)
                    {
                            echo '<option value="'.$localidad->id_localidad.'">'.strtoupper($localidad->nombre_localidad).'</option>';
                    }
                    ?>

        </select>
        <span>Localidad</span>
      </label>
    </div>
  </div>

</div>
<!--fin datos secundaria------------------------------------------------------>

<!--documentos solicitados------------------------------------------------------>
<p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
  Documentos recibidos
  <hr>
</p>



<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="aspirante_documento_acta_nacimiento"
      id="aspirante_documento_acta_nacimiento" value="1" unchecked>
    Acta de Nacimiento
  </label>
</div>

<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="aspirante_documento_curp"
      id="aspirante_documento_curp" value="2" unchecked>
    CURP
  </label>
</div>


<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_secundaria"
      id="aspirante_documento_certificado_secundaria" value="3" unchecked>
    Certificado de Secundaria
  </label>
</div>


<div class="form-check">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input" name="aspirante_documento_fotos"
      id="aspirante_documento_fotos" value="4" unchecked>
    Fotos
  </label>
</div>

<!-- fin documentos solicitados------------------------------------------------------>

<input type="text" id="aspirante_no_control" name="aspirante_no_control" style="display:none">

<br>
<button type="submit" class="btn btn-primary btn-lg btn-block"
  style="background-color:#1F934C; border: #1F934C">Registrar</button>


</form>

          <!-- fin cuerpo modal -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>





  <!-- Bootstrap core JavaScript-->
  <script src="/cseiio/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/cseiio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/cseiio/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <script src="/cseiio/assets/js/cambio_estado.js"></script>
  <script src="/cseiio/assets/js/cambio_municipio.js"></script>



  <script>
  

    
    function cargar_datos_aspirante(e){
       

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/cseiio/c_aspirante/get_datos_aspirante/'+e.value, true);

        xhr.onload = function () {
          console.log(JSON.parse(xhr.response));
 
          var datos = JSON.parse(xhr.response);
          //datos personales
          document.getElementById("aspirante_no_control").value = datos.aspirante[0].no_control;
          document.getElementById("aspirante_nombre").value = datos.aspirante[0].nombre;
          document.getElementById("aspirante_apellido_paterno").value = datos.aspirante[0].apellido_paterno;
          document.getElementById("aspirante_apellido_materno").value = datos.aspirante[0].apellido_materno;
          document.getElementById("aspirante_curp").value = datos.aspirante[0].curp;
          document.getElementById("aspirante_fecha_nacimiento").value = datos.aspirante[0].fecha_nacimiento;
          document.getElementById("aspirante_telefono").value = datos.aspirante[0].telefono;
          document.getElementById("aspirante_correo").value = datos.aspirante[0].correo.toLowerCase();;
          document.getElementById("aspirante_sexo").value = datos.aspirante[0].sexo;
          document.getElementById("aspirante_nss").value = datos.aspirante[0].nss;
          document.getElementById("aspirante_programa_social").value = datos.aspirante[0].programa_social;
          document.getElementById("aspirante_plantel").value = datos.aspirante[0].Plantel_cct;
          document.getElementById("aspirante_semestre").value = datos.aspirante[0].semestre;


          //direccion aspirante
          var numero = datos.direccion_aspirante[0].calle.split(" ");
          document.getElementById("aspirante_direccion_numero").value = numero[numero.length-1];
          numero.pop();
          var calle = "";
          numero.forEach(function(valor,indice){
              calle += valor+" ";
          });
          document.getElementById("aspirante_direccion_calle").value = calle;
          document.getElementById("aspirante_direccion_colonia").value = datos.direccion_aspirante[0].colonia;
          document.getElementById("aspirante_direccion_cp").value = datos.direccion_aspirante[0].cp;


          //tutor aspirante
          document.getElementById("aspirante_tutor_nombre").value = datos.tutor_aspirante[0].nombre;
          document.getElementById("aspirante_tutor_telefono").value = datos.tutor_aspirante[0].telefono;
          document.getElementById("aspirante_tutor_ocupacion").value = datos.tutor_aspirante[0].ocupacion;
          document.getElementById("aspirante_tutor_parentezco").value = datos.tutor_aspirante[0].parentezco;

          //datos lengua materna
          document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna_aspirante[0].Lengua_id_lengua;
          document.getElementById("aspirante_lengua_lee").value = datos.lengua_materna_aspirante[0].lee;
          document.getElementById("aspirante_lengua_habla").value = datos.lengua_materna_aspirante[0].habla;
          document.getElementById("aspirante_lengua_escribe").value = datos.lengua_materna_aspirante[0].escribe;
          document.getElementById("aspirante_lengua_entiende").value = datos.lengua_materna_aspirante[0].entiende;
          document.getElementById("aspirante_lengua_traduce").value = datos.lengua_materna_aspirante[0].traduce;

       
          //datos_secunadaria
          document.getElementById("aspirante_secundaria_nombre").value = datos.datos_secundaria_aspirante[0].nombre_secundaria;
          document.getElementById("aspirante_secundaria_tipo_subsistema").value = datos.datos_secundaria_aspirante[0].tipo_subsistema;


          //documentos
          datos.documentacion_aspirante.forEach(function(valor,indice){
            console.log(valor.Documento_id_documento);
              switch(parseInt(valor.Documento_id_documento)){
                case 1:
                document.getElementById("aspirante_documento_acta_nacimiento").checked=true;
                break;

                case 2:
                document.getElementById("aspirante_documento_curp").checked=true;
                break;

                case 3:
                document.getElementById("aspirante_documento_certificado_secundaria").checked=true;
                break;

                case 4:
                document.getElementById("aspirante_documento_fotos").checked=true;
                break;
                
              }
          });


          //if(datos.documentacion_aspirante[0].Documento_id_documento = 1){
            //document.getElementById("aspirante_documento_acta_nacimiento").checked=true;
          //}
          
          //aspirante_documento_acta_nacimiento



        };

        xhr.send(null);
    }


    function formato_tabla() {
      $('#tabla_completa').DataTable({
        //"order": [[ 0, 'desc' ]],
        "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        }
      });
    }

    function buscar() {
      document.getElementById("tabla").innerHTML = "";
      var xhr = new XMLHttpRequest();
      var nombre = document.getElementById("aspirante_nombre_busqueda").value;
      var apellido_paterno = document.getElementById("aspirante_apellido_paterno_busqueda").value;
      var apellido_materno = document.getElementById("aspirante_apellido_materno_busqueda").value;
      var plantel = document.getElementById("aspirante_plantel_busqueda").value;
      var query = 'nombre=' + nombre + '&apellido_paterno=' + apellido_paterno + '&apellido_materno=' + apellido_materno + '&plantel=' + plantel;

      xhr.open('GET', 'http://localhost/cseiio/c_aspirante/buscar_aspirantes_nombre?' + query, true);

      xhr.onload = function () {
        console.log(JSON.parse(xhr.response));
        //console.log(query);


        JSON.parse(xhr.response).forEach(function (valor, indice) {
          var fila = '<tr>';

          fila += '<td>';
          fila += valor.nombre;
          fila += '</td>';

          fila += '<td>';
          fila += valor.apellido_paterno;
          fila += '</td>';

          fila += '<td>';
          fila += valor.apellido_materno;
          fila += '</td>';

          fila += '<td>';
          fila += valor.curp;
          fila += '</td>';

          fila += '<td>';
          fila += valor.semestre;
          fila += '</td>';

          fila += '<td>';
          fila += '<button type="button" value="'+valor.no_control+'" onclick="cargar_datos_aspirante(this)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Editar</button>';
          fila += '</td>';

          fila += '</tr>';

          document.getElementById("tabla").innerHTML += fila;
        });

        formato_tabla();

      };

      xhr.send(null);

    }

  </script>
</body>

</html>