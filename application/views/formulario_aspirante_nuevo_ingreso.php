<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Pruebas</title>
    

    <!-- Bootstrap core CSS-->
    <link href="http://192.168.1.115/app/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="http://192.168.1.115/app/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="http://192.168.1.115/app/assets/css/sb-admin.css" rel="stylesheet">

    <link href="http://192.168.1.115/app/assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">
</head>
<body>
<div class="container">
    
      <div class="card-body">

      <form action="http://192.168.1.115/app/c_aspirante/registrar_datos_nuevo_ingreso" method="post">

      <!--datos personales------------------------------------------------------>

       <h3>Datos Personales de Aspirante</h3>
       <hr>

       <div class="form-group">

       <div class="row">
           <div class="col-md-4">
           <div class="form-label-group">
           <input type="text" pattern="[A-Za-zñ ]+" required="required" title="Introduzca solo letras" class="form-control" id="aspirante_nombre" name="aspirante_nombre" placeholder="Nombre(s)">
           <label for="aspirante_nombre">Nombre(s)</label>
           </div>
           </div>

           <div class="col-md-4">
           <div class="form-label-group">
           <input type="text" pattern="[A-Za-zñ ]+" required="required" title="Introduzca solo letras" class="form-control" id="aspirante_apellido_paterno" name="aspirante_apellido_paterno" placeholder="Apellido Paterno">
           <label for="aspirante_apellido_paterno">Apellido Paterno</label>
           </div>
           </div>

           <div class="col-md-4">
           <div class="form-label-group">
           <input type="text" pattern="[A-Za-zñ ]+" required="required" title="Introduzca solo letras" class="form-control" id="aspirante_apellido_materno" name="aspirante_apellido_materno" placeholder="Apellido Materno">
           <label for="aspirante_apellido_materno">Apellido Materno</label>
           </div>
           </div>
       </div>

       </div>



       <div class="form-group">

       <div class="row">
           <div class="col-md-6">
           <div class="form-label-group">
           <input type="text" pattern="[A-Zñ]{1}[AEIOU]{1}[A-Zñ]{1}[A-Zñ]{1}[0-9]{6}(H|M)(AS|BC|BS|CC|CS|CH|DF|CL|CM|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QO|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS)[BCDFGHJKLMNPQRSTVWXYZ]{3}[0-9|A-Z]{1}[0-9]{1}" required="required" title="CURP incorrecto" class="form-control" id="aspirante_curp" name="aspirante_curp" placeholder="CURP">
           <label for="aspirante_curp">CURP</label>
           </div>
           </div>

           <div class="col-md-6">
           <div class="form-label-group">
           <input type="date" required="required" class="form-control" id="aspirante_fecha_nacimiento" name="aspirante_fecha_nacimiento" placeholder="Fecha de Nacimiento">
           <label for="aspirante_fecha_nacimiento">Fecha Nacimiento</label>
           </div>
           </div>
       </div>

       </div>

       

        <div class="form-group">

        <div class="row">
            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text" pattern="[0-9]{10}" required="required" title="El numero de telefono debe de ser a 10 digitos" class="form-control" id="aspirante_telefono" name="aspirante_telefono" placeholder="Telefono">
            <label for="aspirante_telefono">Telefono</label>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-label-group">
            <input type="email" pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$" title="Introduzca un correo valido" class="form-control" id="aspirante_correo" name="aspirante_correo" placeholder="Correo Electronico">
            <label for="aspirante_correo">Correo</label>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text" pattern="[0-9]{11}" title="Introduzca 11 digitos" class="form-control" id="aspirante_nss" name="aspirante_nss" placeholder="Numero de Seguro Social">
            <label for="aspirante_nss">Nss</label>
            </div>
            </div>
        </div>

        </div>


        <div class="form-group">

        <div class="row">
            <div class="col-md-4">
            <label class="form-group has-float-label">
            <select class="form-control custom-select" required="required" id="aspirante_sexo" name="aspirante_sexo">
            <option value="H">Hombre</option>
            <option value="M">Mujer</option>
          </select>
          <span>Sexo</span>
            </label>
            </div>

            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text"class="form-control" id="aspirante_programa_social" name="aspirante_programa_social" placeholder="Folio de programa social">
            <label for="aspirante_programa_social">Folio de Programa Social</label>
            </div>
            </div>

            <div class="col-md-4">
            <label class="form-group has-float-label">
            <select class="form-control custom-select" required="required" id="aspirante_plantel" name="aspirante_plantel">
            
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
        </div>

        </div>

        <!--fin datos personales------------------------------------------------------>

        <!--direccion------------------------------------------------------>
        <h3>Direccion</h3>
        <hr>

        <div class="form-group">

        <div class="row">
        
            <div class="col-md-4">
            <label class="form-group has-float-label">
            <select class="form-control" required="required" name="aspirante_direccion_estado" onChange="cambio_estado(selector_estado_aspirante,selector_municipio_aspirante)" id="selector_estado_aspirante">
            
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
            <select class="form-control" required="required" name="aspirante_direccion_municipio" onChange="cambio_municipio(selector_municipio_aspirante,selector_localidad_aspirante)" id="selector_municipio_aspirante">

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
            <select class="form-control" required="required" name="aspirante_direccion_localidad" id="selector_localidad_aspirante">

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
            <input type="text"  required="required" title="La direccion tiene caracteres incorrectos" class="form-control" id="aspirante_direccion_calle" name="aspirante_direccion_calle" placeholder="Calle">
            <label for="aspirante_direccion_calle">Calle</label>
            </div>
            </div>

            <div class="col-md-2">
            <div class="form-label-group">
            <input type="text" pattern="[0-9]+"  title="Introduzca solo numeros" class="form-control" id="aspirante_direccion_numero" name="aspirante_direccion_numero" placeholder="Numero Exterior">
            <label for="aspirante_direccion_numero">Numero</label>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text"  title="La colonia tiene caracteres incorrectos" class="form-control" id="aspirante_direccion_colonia" name="aspirante_direccion_colonia" placeholder="Colonia">
            <label for="aspirante_direccion_colonia">Colonia</label>
            </div>
            </div>

            <div class="col-md-2">
            <div class="form-label-group">
            <input type="text" pattern="[0-9]{5}" title="El codigo postal solo debe contener 5 digitos" class="form-control" id="aspirante_direccion_cp" name="aspirante_direccion_cp" placeholder="Codigo Postal">
            <label for="aspirante_direccion_cp">Codigo Postal</label>
            </div>
            </div>
        </div>

        </div>

        <!--fin direccion------------------------------------------------------>

        <!--datos tutor------------------------------------------------------>

        <h3>Tutor</h3>
        <hr>

        <div class="form-group">

        <div class="row">
            <div class="col-md-9">
            <div class="form-label-group">
            <input type="text" pattern="[A-Za-zñ ]+" required="required" title="Introduzca solo letras" class="form-control" id="aspirante_tutor_nombre" name="aspirante_tutor_nombre" placeholder="Nombre Completo">
            <label for="aspirante_tutor_nombre">Nombre Completo</label>
            </div>
            </div>

            <div class="col-md-3">
            <div class="form-label-group">
            <input type="text" pattern="[0-9]{10}" required="required" title="El numero de telefono debe de ser a 10 digitos" class="form-control" id="aspirante_tutor_telefono" name="aspirante_tutor_telefono" placeholder="Telefono">
            <label for="aspirante_tutor_telefono">Telefono</label>
            </div>
            </div>
        </div>

        </div>


        <div class="form-group">

        <div class="row">
            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text" title="Introduzca solo letras" class="form-control" id="aspirante_tutor_ocupacion" name="aspirante_tutor_ocupacion" placeholder="Ocupacion">
            <label for="aspirante_tutor_ocupacion">Ocupacion</label>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text" pattern="[A-Za-zñ ]+" required="required" title="Introduzca solo letras" class="form-control" id="aspirante_tutor_parentezco" name="aspirante_tutor_parentezco" placeholder="Parentezco">
            <label for="aspirante_tutor_parentezco">Parentezco</label>
            </div>
            </div>
        </div>

        </div>

        <!--fin tutor------------------------------------------------------>


        <!--datos lengua materna------------------------------------------------------>

        <h3>Lengua Materna</h3>
        <hr>

        <div class="form-group">

        <div class="row">
        <div class="col-md-2">
            <label class="form-group has-float-label">
            <select class="form-control" required="required" name="aspirante_lengua_nombre">
            
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
            <select class="form-control" required="required" name="aspirante_lengua_lee">
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
            <select class="form-control" required="required" name="aspirante_lengua_habla">
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
            <select class="form-control" required="required" name="aspirante_lengua_escribe">
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
            <select class="form-control" required="required" name="aspirante_lengua_entiende">
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
            <select class="form-control" required="required" name="aspirante_lengua_traduce">
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

        <h3>Datos de Secundaria de Procedencia</h3>
        <hr>

        <div class="form-group">

        <div class="row">
            <div class="col-md-4">
            <div class="form-label-group">
            <input type="text" pattern="[A-Za-zñ0-9 ]+" required="required" title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control" id="aspirante_secundaria_nombre" name="aspirante_secundaria_nombre" placeholder="Nombre de Secundaria">
            <label for="aspirante_secundaria_nombre">Nombre de Secundaria</label>
            </div>
            </div>

            <div class="col-md-4">
            <label class="form-group has-float-label">
            <select class="form-control" required="required" name="aspirante_secundaria_tipo_subsistema">
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
            <select class="form-control" required="required" name="aspirante_secundaria_estado" onChange="cambio_estado(selector_estado_secundaria,selector_municipio_secundaria)" id="selector_estado_secundaria">
           
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
            <select class="form-control" required="required" name="aspirante_secundaria_municipio" onChange="cambio_municipio(selector_municipio_secundaria,selector_localidad_secundaria)" id="selector_municipio_secundaria">
            
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
            <select class="form-control" required="required" name="aspirante_secundaria_localidad" id="selector_localidad_secundaria">
            
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

        <h3>Documentos Solicitados</h3>
        <hr>

      

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_acta_nacimiento" id="aspirante_documento_acta_nacimiento" value="1" unchecked>
            Acta de Nacimiento
          </label>
        </div>

        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_curp" id="aspirante_documento_curp" value="2" unchecked>
            CURP
          </label>
        </div>


        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_secundaria" id="aspirante_documento_certificado_secundaria" value="3" unchecked>
            Certificado de Secundaria
          </label>
        </div>


        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_fotos" id="aspirante_documento_fotos" value="4" unchecked>
            Fotos
          </label>
        </div>

        <!-- fin documentos solicitados------------------------------------------------------>

        <br>
        <button type="submit" class="btn btn-primary">Registrar</button>
     

       </form>
      </div>
   

</div>







<!-- Bootstrap core JavaScript-->
<script src="http://192.168.1.115/app/assets/vendor/jquery/jquery.min.js"></script>
    <script src="http://192.168.1.115/app/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="http://192.168.1.115/app/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="http://192.168.1.115/app/assets/js/cambio_estado.js"></script>
    <script src="http://192.168.1.115/app/assets/js/cambio_municipio.js"></script>

    <script>
    var selector_estado_aspirante = document.getElementById("selector_estado_aspirante");
    var selector_municipio_aspirante = document.getElementById("selector_municipio_aspirante");
    var selector_localidad_aspirante = document.getElementById("selector_localidad_aspirante");
    
    var selector_estado_secundaria = document.getElementById("selector_estado_secundaria");
    var selector_municipio_secundaria = document.getElementById("selector_municipio_secundaria");
    var selector_localidad_secundaria = document.getElementById("selector_localidad_secundaria");
    </script>



  
</body>
</html>