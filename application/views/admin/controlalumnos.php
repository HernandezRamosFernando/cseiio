<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Control de Alumnos</title>

  <!-- Bootstrap core CSS-->
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="/cseiio/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="/cseiio/assets/css/sb-admin.css" rel="stylesheet">
  <link href="/cseiio/assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">
  <link href="/cseiio/assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="/cseiio/assets/css/main.css">




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
        <a class="nav-link disabled" style="color:rgb(182, 197, 193)" href="/cseiio/index.php/c_menu/principal">Sistema
          integral de
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

      <li class="nav-item active">
        <a class="nav-link" href="/cseiio/index.php/c_aspirante/controlalumnos">
          <i class="fas fa-fw fa-address-card"></i>
          <span>Control de Alumnos</span>
        </a>
      </li>

    </ul>
    <div id="content-wrapper">

      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Control de alumnos</a>
          </li>
          <li class="breadcrumb-item active">Ingrese la busqueda que desea realizar</li>
        </ol>

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


                <div class="col-md-6">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" id="aspirante_plantel_busqueda"
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
                  <button type='button' class="btn btn-success btn-lg btn-block" onclick='buscar()'>Buscar</button>
                </div>

              </div>
            </div>



          </div>
        </div>
      </div>


      <div class="container">
        <div class="card" style="overflow:scroll">
          <div class="card-body">
            <table class="table table-hover" id="tabla_completa" style="width: 100%">
              <caption>Lista de Alumnos</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre</th>
                  <th scope="col" class="col-md-1">Apellido Paterno</th>
                  <th scope="col" class="col-md-1">Apellido Materno</th>
                  <th scope="col" class="col-md-1">CURP</th>
                  <th scope="col" class="col-md-1">Semestre</th>
                  <th scope="col" class="col-md-1">Matrícula</th>
                  <th scope="col" class="col-md-1">Editar</th>
                  <th scope="col" class="col-md-1">Eliminar</th>
                </tr>
              </thead>



              <tbody id="tabla">

              </tbody>
            </table>
          </div>
        </div>
      </div>




      <!-- Modal -->
      <div class="modal fade" id="modalaspirante" tabindex="-1" role="dialog" aria-labelledby="modalaspiranteTitle"
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
                        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required"
                          title="Introduzca solo letras" class="form-control" id="aspirante_nombre"
                          name="aspirante_nombre" placeholder="Nombre(s)">
                        <label for="aspirante_nombre">Nombre(s)</label>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-label-group">
                        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required"
                          title="Introduzca solo letras" class="form-control" id="aspirante_apellido_paterno"
                          name="aspirante_apellido_paterno" placeholder="Apellido Paterno">
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


                    <div class="col-md-4">
                      <label class="form-group has-float-label">
                        <select class="form-control form-control-lg" required="required" id="aspirante_semestre"
                          name="aspirante_semestre">
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
                        <select class="form-control form-control-lg" required="required"
                          name="aspirante_direccion_estado"
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
                        <select class="form-control form-control-lg" required="required"
                          name="aspirante_direccion_municipio"
                          onChange="cambio_municipio(selector_municipio_aspirante,selector_localidad_aspirante)"
                          id="selector_municipio_aspirante">


                        </select>
                        <span>Municipio</span>
                      </label>
                    </div>

                    <div class="col-md-4">
                      <label class="form-group has-float-label">
                        <select class="form-control form-control-lg" required="required"
                          name="aspirante_direccion_localidad" id="selector_localidad_aspirante">


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
                          id="aspirante_direccion_numero" name="aspirante_direccion_numero"
                          placeholder="Numero Exterior">
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
                        <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required"
                          title="Introduzca solo letras" class="form-control" id="aspirante_tutor_nombre"
                          name="aspirante_tutor_nombre" placeholder="Nombre Completo">
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
                        <select class="form-control" required="required" id="aspirante_lengua_nombre"
                          name="aspirante_lengua_nombre">

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
                        <select class="form-control" required="required" id="aspirante_lengua_lee"
                          name="aspirante_lengua_lee">
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
                        <select class="form-control" required="required" id="aspirante_lengua_habla"
                          name="aspirante_lengua_habla">
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
                        <select class="form-control" required="required" id="aspirante_lengua_escribe"
                          name="aspirante_lengua_escribe">
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
                        <select class="form-control" required="required" id="aspirante_lengua_entiende"
                          name="aspirante_lengua_entiende">
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
                        <select class="form-control" required="required" id="aspirante_lengua_traduce"
                          name="aspirante_lengua_traduce">
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
                          id="aspirante_secundaria_tipo_subsistema" name="aspirante_secundaria_tipo_subsistema">
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
                        <select class="form-control form-control-lg" required="required"
                          name="aspirante_secundaria_estado"
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
                        <select class="form-control form-control-lg" required="required"
                          name="aspirante_secundaria_municipio"
                          onChange="cambio_municipio(selector_municipio_secundaria,selector_localidad_secundaria)"
                          id="selector_municipio_secundaria">



                        </select>
                        <span>Municipio</span>
                      </label>
                    </div>

                    <div class="col-md-4">
                      <label class="form-group has-float-label">
                        <select class="form-control form-control-lg" required="required"
                          name="aspirante_secundaria_localidad" id="selector_localidad_secundaria">



                        </select>
                        <span>Localidad</span>
                      </label>
                    </div>
                  </div>

                </div>
                <!--fin datos secundaria------------------------------------------------------>

                <!--documentos solicitados------------------------------------------------------>


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

      
      <!-- Modal -->
      <div class="modal fade" id="modal_eliminar_alumno" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Confirmación de eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
              <div class="container-fluid">
                ¿Esta seguro que desea eliminar a este alumno?
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="confirmacion_eliminar()">Eliminar</button>
            </div>
          </div>
        </div>
      </div>
      
      <script>
        $('#exampleModal').on('show.bs.modal', event => {
          var button = $(event.relatedTarget);
          var modal = $(this);
          // Use above variables to manipulate the DOM
          
        });
      </script>







    </div>
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

  <input type="text" style="display:none" id="no_control_borrar">

  <!-- Bootstrap core JavaScript-->
  <script src="/cseiio/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/cseiio/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/cseiio/assets/vendor/jquery-easing/jquery.easing.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="/cseiio/assets/js/sb-admin.min.js"></script>
  <script src="/cseiio/assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/cseiio/assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <script src="/cseiio/assets/js/cambio_estado.js"></script>
  <script src="/cseiio/assets/js/cambio_municipio.js"></script>

  <script>
    function eliminar_aspirante(e) {
        document.getElementById("no_control_borrar").value=e.value;
    }

    function confirmacion_eliminar(){
      console.log("este aspirante ha sido borrado "+document.getElementById("no_control_borrar").value);
      var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/index.php/c_aspirante/delete_aspirante?no_control='+document.getElementById("no_control_borrar").value, true);

        xhr.onload = function () {
          alert(xhr.response);
        };

        xhr.send(null);
      }
  </script>



  <script>

    function cargar_datos_aspirante(e) {
      //document.getElementById("selector_estado_aspirante").innerHTML = "";
      document.getElementById("selector_municipio_aspirante").innerHTML = "";
      document.getElementById("selector_localidad_aspirante").innerHTML = "";

      document.getElementById("selector_municipio_secundaria").innerHTML = "";
      document.getElementById("selector_localidad_secundaria").innerHTML = "";

      //document.getElementById("selector_estado_aspirante").innerHTML = "";
      //document.getElementById("selector_estado_aspirante").innerHTML = "";
      //document.getElementById("selector_estado_aspirante").innerHTML = "";


      var xhr = new XMLHttpRequest();
      xhr.open('GET', '/cseiio/index.php/c_aspirante/get_datos_aspirante/' + e.value, true);

      xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));

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
        document.getElementById("aspirante_direccion_numero").value = numero[numero.length - 1];
        numero.pop();
        var calle = "";
        numero.forEach(function (valor, indice) {
          calle += valor + " ";
        });
        document.getElementById("aspirante_direccion_calle").value = calle;
        document.getElementById("aspirante_direccion_colonia").value = datos.direccion_aspirante[0].colonia;
        document.getElementById("aspirante_direccion_cp").value = datos.direccion_aspirante[0].cp;

        var direccion = new XMLHttpRequest();
        direccion.open('GET', '/cseiio/index.php/c_localidad/get_estado_municipio_localidad?id_localidad=' + datos.direccion_aspirante[0].Localidad_id_localidad, true);

        direccion.onload = function () {

          document.getElementById("selector_estado_aspirante").value = JSON.parse(direccion.response)[0].id_estado;
          //municpios

          var municipios = new XMLHttpRequest();
          municipios.open('GET', '/cseiio/index.php/c_municipio/get_municipios_estado?id_estado=' + JSON.parse(direccion.response)[0].id_estado, true);

          municipios.onload = function () {
            //console.log(JSON.parse(municipios.response));
            JSON.parse(municipios.response).forEach(function (municipio, indice) {
              document.getElementById("selector_municipio_aspirante").innerHTML += '<option value=' + municipio.id_municipio + '>' + municipio.nombre_municipio.toUpperCase() + '</option>';

            });
            document.getElementById("selector_municipio_aspirante").value = JSON.parse(direccion.response)[0].id_municipio;

          };

          municipios.send(null);


          //localidades
          var localidades = new XMLHttpRequest();
          localidades.open('GET', '/cseiio/index.php/c_localidad/get_localidades_municipio?id_municipio=' + JSON.parse(direccion.response)[0].id_municipio, true);

          localidades.onload = function () {

            JSON.parse(localidades.response).forEach(function (localidad, indice) {
              document.getElementById("selector_localidad_aspirante").innerHTML += '<option value=' + localidad.id_localidad + '>' + localidad.nombre_localidad.toUpperCase() + '</option>';
            });

            document.getElementById("selector_localidad_aspirante").value = JSON.parse(direccion.response)[0].id_localidad;
          };

          localidades.send(null);



        };

        direccion.send(null);
        //-----fin xhr ireccion


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

        var direccion_secundaria = new XMLHttpRequest();
        direccion_secundaria.open('GET', '/cseiio/index.php/c_localidad/get_estado_municipio_localidad?id_localidad=' + datos.datos_secundaria_aspirante[0].Localidad_id_localidad, true);

        direccion_secundaria.onload = function () {

          //console.log(direccion_secundaria.response);

          document.getElementById("selector_estado_secundaria").value = JSON.parse(direccion_secundaria.response)[0].id_estado;

          //municpios

          var municipios_secundaria = new XMLHttpRequest();
          municipios_secundaria.open('GET', '/cseiio/index.php/c_municipio/get_municipios_estado?id_estado=' + JSON.parse(direccion_secundaria.response)[0].id_estado, true);


          municipios_secundaria.onload = function () {
            //console.log(JSON.parse(municipios_secundaria.response));
            JSON.parse(municipios_secundaria.response).forEach(function (municipio, indice) {
              document.getElementById("selector_municipio_secundaria").innerHTML += '<option value=' + municipio.id_municipio + '>' + municipio.nombre_municipio.toUpperCase() + '</option>';

            });
            document.getElementById("selector_municipio_secundaria").value = JSON.parse(direccion_secundaria.response)[0].id_municipio;

          };

          municipios_secundaria.send(null);
          //---------------------------localidades
          var localidades_secundaria = new XMLHttpRequest();
          localidades_secundaria.open('GET', '/cseiio/index.php/c_localidad/get_localidades_municipio?id_municipio=' + JSON.parse(direccion_secundaria.response)[0].id_municipio, true);

          localidades_secundaria.onload = function () {

            JSON.parse(localidades_secundaria.response).forEach(function (localidad, indice) {
              document.getElementById("selector_localidad_secundaria").innerHTML += '<option value=' + localidad.id_localidad + '>' + localidad.nombre_localidad.toUpperCase() + '</option>';
            });

            document.getElementById("selector_localidad_secundaria").value = JSON.parse(direccion_secundaria.response)[0].id_localidad;
          };

          localidades_secundaria.send(null);
          //--------------------------

        };

        direccion_secundaria.send(null);
        //-----fin xhr ireccion




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
          "sSearch": "Buscar específico:",
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

      xhr.open('GET', '/cseiio/index.php/c_aspirante/buscar_aspirantes_nombre?' + query, true);

      xhr.onload = function () {
        //console.log(JSON.parse(xhr.response));
        ////console.log(query);


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
          fila += valor.matricula;
          fila += '</td>';

          fila += '<td>';
          fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" onclick="cargar_datos_aspirante(this)" class="btn btn-primary" data-toggle="modal" data-target="#modalaspirante">Editar</button>';
          fila += '</td>';

          fila += '<td class="">';
          fila += '<button class="btn btn-lg btn-danger" type="button" value="' + valor.no_control + '" onclick="eliminar_aspirante(this)" class="btn btn-primary" data-toggle="modal" data-target="#modal_eliminar_alumno">Eliminar</button>';
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