<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Inscripción Nuevo Ingreso</title>

  <!-- Bootstrap core CSS-->
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="/cseiio/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="/cseiio/assets/css/sb-admin.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="/cseiio/assets/css/main.css">
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">

</head>

<body>
  <!-- Barra de arriba -->
  <nav class="navbar navbar-expand navbar-dark static-top" style="background:#545555">
    <a class="navbar-brand mr-1" href="/cseiio/index.php/c_menu/principal">SISE</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link disabled" style="color:rgb(182, 197, 193)" href="/cseiio/index.php/c_menu/principal">Sistema integral de
          servicios escolares</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:rgb(150, 163, 159)">Bienvenido Usuario</a>
      </li>
    </ul>

    <!-- eventos de navbar -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <span class="badge badge-danger">9+</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <span class="badge badge-danger">7</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>
    </form>
  </nav>


  <div id="wrapper">


    <!-- Barra de lado derecho -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-chalkboard-teacher"></i>
          <span>Menú</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/cseiio/index.php/c_menu/inscripcion">
          <i class="fas fa-fw fa-address-card"></i>
          <span>Inscripción</span>
        </a>
      </li>

      <li class="nav-item active">
        <a class="nav-link active" href="/cseiio/index.php/c_aspirante/nuevo_ingreso">
          <i class="fas fa-fw fa-id-card"></i>
          <span>Inscripción Nuevo Ingreso</span>
        </a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Inscripcion Nuevo Ingreso</a>
          </li>
          <li class="breadcrumb-item active">Rellene todos los campos</li>
        </ol>



        <form action="/cseiio/index.php/c_aspirante/registrar_datos_nuevo_ingreso" method="post">

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
                  <input type="text" pattern="[0-9]{10}" title="El numero de telefono debe de ser a 10 digitos"
                    class="form-control" id="aspirante_telefono" name="aspirante_telefono" placeholder="Telefono">
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
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos" class="form-control"
                    id="aspirante_nss" name="aspirante_nss" placeholder="Numero de Seguro Social">
                  <label for="aspirante_nss">NSS (IMSS)</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control" id="aspirante_programa_social"
                    name="aspirante_programa_social" placeholder="Folio de programa social">
                  <label for="aspirante_programa_social">Folio de Prospera</label>
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
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ 0-9]+" title="La colonia tiene caracteres incorrectos"
                    class="form-control" id="aspirante_direccion_colonia" name="aspirante_direccion_colonia"
                    placeholder="Colonia">
                  <label for="aspirante_direccion_colonia">Colonia</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{5}" title="El codigo postal solo debe contener 5 digitos"
                    class="form-control" id="aspirante_direccion_cp" name="aspirante_direccion_cp"
                    placeholder="Codigo Postal">
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
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" title="Introduzca solo letras"
                    class="form-control" id="aspirante_tutor_ocupacion" name="aspirante_tutor_ocupacion"
                    placeholder="Ocupacion">
                  <label for="aspirante_tutor_ocupacion">Ocupacion</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" required="required"
                    title="Introduzca solo letras" class="form-control" id="aspirante_tutor_parentezco"
                    name="aspirante_tutor_parentezco" placeholder="Parentezco">
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
                  <select class="form-control form-control-lg" required="required"
                    name="aspirante_secundaria_tipo_subsistema">
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
                  <select class="form-control form-control-lg" required="required" name="aspirante_secundaria_localidad"
                    id="selector_localidad_secundaria">
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
          <!--fin datos secundaria------------------------------------------------------>

          <!--documentos solicitados------------------------------------------------------>
          <p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
            Documentos solcitados para generación de Matrícula
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
          <br>

          <!-- fin documentos solicitados------------------------------------------------------>

          <!--documentos extras------------------------------------------------------>
          <p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
            Documentos Extras
            <hr>
          </p>



          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="aspirante_documento_acta_nacimiento"
                id="aspirante_documento_acta_nacimiento" value="1" unchecked>
              Carta de conducta
            </label>
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="aspirante_documento_curp"
                id="aspirante_documento_curp" value="2" unchecked>
              Certificado Médico
            </label>
          </div>


          <!-- fin documentos extras------------------------------------------------------>

          <br>
          <button type="submit" class="btn btn-success btn-lg btn-block">Registrar</button>


        </form>

      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" ¿Seguro que deseas salir?</h5> <button class="close"
              type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

      <!-- Bootstrap core JavaScript-->
  <script src="/cseiio/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/cseiio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/cseiio/assets/vendor/jquery-easing/jquery.easing.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="/cseiio/assets/js/sb-admin.min.js"></script>

    

    <script src="/cseiio/assets/js/cambio_estado.js"></script>
    <script src="/cseiio/assets/js/cambio_municipio.js"></script>

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