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
    <ul class="sidebar navbar-nav ">
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-align-justify "></i>
          <span>Menú</span>
        </a>
      </li>

      <li class="nav-item dropdown ">
      <a class="nav-link dropdown-toggle bg-info text-white fas fa-fw fa-address-card" data-toggle="dropdown" href="#" role="button" > 
      <span class="font-weight-light">Inscripción<span>
      </a>
      <div class="dropdown-menu bg-info">
      <a class="dropdown-item btn-responsive fas fa-id-card " href="/cseiio/index.php/c_aspirante/nuevo_ingreso"> <span class="font-weight-light">Inscripción Nuevo Ingreso</span></a>
      <a class="dropdown-item btn-responsive fas fa-id-card-alt" href="/cseiio/index.php/c_aspirante/portabilidad"> <span class="font-weight-light">Inscripción Portabilidad</span></a>
      <a class="dropdown-item btn-responsive fas fa-user-check" href="/cseiio/index.php/c_aspirante/asignar_matricula"> <span class="font-weight-light">Asignar Matrícula</span></a>
      <a class="dropdown-item btn-responsive fas fa-clipboard-check" href="/cseiio/index.php/c_aspirante/carta_compromiso"> <span class="font-weight-light">Generación de Carta Compromiso</span></a>
      </div>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-chalkboard-teacher"></i>
          <span>Reinscripción</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_aspirante/control_alumnos">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Control de Alumnos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-calendar-check"></i>
          <span>Acreditación</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-poll"></i>
          <span>Reportes</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Formatos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-file-signature "></i>
          <span>Certificación</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_subir_doc/subir_documentos">
          <i class="fas fa-fw fa-file-upload"></i>
          <span>Carga de documentos</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
          <i class="fas fa-fw fa-users "></i>
          <span>Control de usuarios</span>
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



        <form action="/cseiio/index.php/c_aspirante/registrar_datos_aspirante" method="post">

        <input type="text" name="formulario" value="nuevo_ingreso" style="display:none">

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

              <div class="col-md-3 text-center">
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
              <div class="col-md-3">
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

              <div class="col-md-4">
                <div class="form-group">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" name="tipo_sangre" id="tipo_sangre">
                   <option >Seleccione una opcion</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="A+">O+</option>
                    <option value="A-">O-</option>
                  </select>
                  <span>Tipo de sangre</span>
                  </label>
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" id="aspirante_alergia_combo"
                    name="aspirante_alergia_combo" onchange="alergia(this)">
                    <option value="2">Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  </select>
                  <span>¿Alergico a algún medicamento?</span>
                </label>
              </div>
              <div class="col-md-4" style="display:none" id="a" name="alergia_medicamento">
                <div class="form-label-group">
                  <input type="text" class="form-control" id="aspirante_alergia" name="aspirante_alergia"
                    placeholder="Ingrese el medicamento">
                  <label for="aspirante_alergia">Ingrese el medicamento</label>
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" id="aspirante_discapacidad_combo"
                    name="aspirante_discapacidad_combo" onchange="discapacidad(this)">
                    <option value="2">Seleccione una opción</option>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  </select>
                  <span>¿Padece alguna discapacidad?</span>
                </label>
              </div>
              <div class="col-md-4" style="display:none" id="b" name="discapacidad">
                <div class="form-label-group">
                  <input type="text" class="form-control" id="aspirante_discapacidad" name="aspirante_discapacidad"
                    placeholder="Ingrese la discapacidad">
                  <label for="aspirante_discapacidad">Ingrese la discapacidad</label>
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
                    <option>Seleccione el plantel de ingreso</option>

                    <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct.'</option>';
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
                    <option>Seleccione el estado</option>

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
                    
                  </select>
                  <span>Municipio</span>
                </label>

              </div>

              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" name="aspirante_direccion_localidad"
                    id="selector_localidad_aspirante">
                    <option></option>

                    

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
                  <input type="text" pattern="[0-9s/n]+" title="Introduzca solo numeros" class="form-control"
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
              <div class="col-md-7">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
                    class="form-control" id="aspirante_tutor_nombre" name="aspirante_tutor_nombre"
                    placeholder="Nombre Completo">
                  <label for="aspirante_tutor_nombre">Nombre Completo</label>
                </div>
              </div>

              <div class="col-md-2">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="aspirante_tutor_parentesco" required="required" name="aspirante_tutor_parentesco" onchange="parentesco(this)">
                    <option value="">Seleccione</option>
                    <option value="PADRE">Padre</option>
                    <option value="MADRE">Madre</option>
                    <option value="HERMANO/A">Hermano/a</option>
                    <option value="TIO">Tio</option>
                    <option value="TIA">Tia</option>
                    <option value="ABUELO">Abuelo</option>
                    <option value="ABUELA">Abuela</option>
                    <option value="otro">Otro</option>
                  </select>
                  <span>Parentesco</span>
                  
               </label>
              </div>

              <div class="col-md-3" id="parentescootro" style="display:none;">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" 
                    class="form-control" id="aspirante_tutor_otro" name="aspirante_tutor_otro"
                    placeholder="Escriba el parentesco">
                  <label for="aspirante_tutor_otro">Escriba el parentesco</label>
                </div>
              </div>
            </div>

          </div>


          <div class="form-group">

            <div class="row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" title="Introduzca solo letras"
                    class="form-control" id="aspirante_tutor_ocupacion" name="aspirante_tutor_ocupacion"
                    placeholder="Ocupacion">
                  <label for="aspirante_tutor_ocupacion">Ocupacion</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{10}" title="El numero de telefono debe de ser a 10 digitos con lada"
                    class="form-control" id="aspirante_tutor_telefono" name="aspirante_tutor_telefono"
                    placeholder="Telefono particular">
                  <label for="aspirante_tutor_telefono">Telefono particular</label>
                </div>
              </div>
            <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{10}" title="El numero de telefono debe de ser a 10 digitos con lada"
                    class="form-control" id="aspirante_tutor_telefono_comunidad" name="aspirante_tutor_telefono_comunidad"
                    placeholder="Telefono de la comunidad">
                  <label for="aspirante_tutor_telefono_comunidad">Telefono de la comunidad</label>
                </div>
              </div>

              
              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" class="form-control"
                    id="aspirante_tutor_prospera" name="aspirante_tutor_prospera" placeholder="Folio de Prospera">
                  <label for="aspirante_tutor_prospera">Folio de Prospera</label>
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
                  <select class="form-control" required="required" onchange="lenguas_evento(this)"
                    id="aspirante_lengua_nombre" name="aspirante_lengua_nombre">
                    <option value="NO CONOCE LENGUA">Seleccione una lengua</option>

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
                  <select class="form-control" required="required" id="aspirante_lengua_lee" name="aspirante_lengua_lee"
                    disabled>
                    <option value="0">Nada 0%</option>
                    <option value="25">Poco 25%</option>
                    <option value="50">Regular 50%</option>
                    <option value="100">Bien 100%</option>
                  </select>
                  <span>Lee</span>
                </label>
              </div>

              <div class="col-md-2">
                <label class="form-group has-float-label">
                  <select class="form-control" required="required" id="aspirante_lengua_habla"
                    name="aspirante_lengua_habla" disabled>
                    <option value="0">Nada 0%</option>
                    <option value="25">Poco 25%</option>
                    <option value="50">Regular 50%</option>
                    <option value="100">Bien 100%</option>
                  </select>
                  <span>Habla</span>
                </label>
              </div>

              <div class="col-md-2">
                <label class="form-group has-float-label">
                  <select class="form-control" required="required" id="aspirante_lengua_escribe"
                    name="aspirante_lengua_escribe" disabled>
                    <option value="0">Nada 0%</option>
                    <option value="25">Poco 25%</option>
                    <option value="50">Regular 50%</option>
                    <option value="100">Bien 100%</option>
                  </select>
                  <span>Escribe</span>
                </label>
              </div>

              <div class="col-md-2">
                <label class="form-group has-float-label">
                  <select class="form-control" required="required" id="aspirante_lengua_entiende"
                    name="aspirante_lengua_entiende" disabled>
                    <option value="0">Nada 0%</option>
                    <option value="25">Poco 25%</option>
                    <option value="50">Regular 50%</option>
                    <option value="100">Bien 100%</option>
                  </select>
                  <span>Entiende</span>
                </label>
              </div>


              <div class="col-md-2">
                <label class="form-group has-float-label">
                  <select class="form-control" required="required" id="aspirante_lengua_traduce"
                    name="aspirante_lengua_traduce" disabled>
                    <option value="0">Nada 0%</option>
                    <option value="25">Poco 25%</option>
                    <option value="50">Regular 50%</option>
                    <option value="100">Bien 100%</option>
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
                  
                    <input onselect="obtener_secundaria(this)" list="secundarias" 
                    required="required" class="form-control" id="aspirante_secundaria_cct" 
                    name="aspirante_secundaria_cct" placeholder="Buscar secundaria por CCT">
                    <datalist id="secundarias">
             

                      <?php
                              foreach ($secundarias as $secundaria)
                              {
                                      echo '<option value="'.$secundaria->cct_secundaria.'">';
                              }
                              ?>
                    </datalist>

                  <label for="aspirante_secundaria_cct">Buscar secundaria por CCT</label>
                </div>
                <br>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#nuevasecundaria" onclick="cct()">
                    Agregar nueva secundaria
                  </button>

                </div>
                <br>
              </div>
            </div>

              <div class="row">
              <div class="col-md-4" style="display: none" id="nombre_secundaria_oculto">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+" required="required"
                    title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control"
                    id="aspirante_secundaria_nombre" name="aspirante_secundaria_nombre"
                    placeholder="Nombre de Secundaria">
                  <label for="aspirante_secundaria_nombre">Nombre de Secundaria</label>
                </div>
                <br>
              </div>

              <div class="col-md-4" style="display: none" id="tipo_subsistema_oculto">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required"
                    name="aspirante_secundaria_tipo_subsistema" id="aspirante_secundaria_tipo_subsistema">
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

          <!--fin datos secundaria------------------------------------------------------>

          <!--documentos solicitados------------------------------------------------------>
          <p class="text-center text-white rounded" style="background-color: #579A8D; height: 40px">
            Documentos solicitados para generación de Matrícula
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
              <input type="checkbox" class="form-check-input" name="aspirante_documento_carta_buena_conducta"
                id="aspirante_documento_carta_buena_conducta" value="5" unchecked>
              Carta de conducta
            </label>
          </div>

          <div class="form-check">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_medico"
                id="aspirante_documento_certificado_medico" value="6" unchecked>
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



    <!-- Modal -->
    <div class="modal fade" id="nuevasecundaria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;"role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar nueva secundaria</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ 0-9]+" required="required"
                      title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control"
                      id="aspirante_nuevasecundaria_cct" name="aspirante_nuevasecundaria_cct" placeholder="CCT de Secundaria">
                    <label for="aspirante_nuevasecundaria_cct">C C T</label>
                  </div>
                  <br>
                </div>
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+" class="form-control"
                      id="aspirante_nuevasecundaria_nombre" name="aspirante_secundaria_nombre"
                      placeholder="Nombre de Secundaria">
                    <label for="aspirante_nuevasecundaria_nombre">Nombre de Secundaria</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-4">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg"
                      name="aspirante_nuevasecundaria_tipo_subsistema" id="aspirante_nuevasecundaria_tipo_subsistema">
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


              <div class="row">

                <div class="col-md-4">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required" name="aspirante_secundaria_estado"
                      onChange="cambio_estado(selector_estado_secundaria,selector_municipio_secundaria)"
                      id="selector_estado_secundaria">
                      <option>Seleccione un estado</option>

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
                      <option></option>

                     
                    </select>
                    <span>Municipio</span>
                  </label>
                </div>

                <div class="col-md-4">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required="required"
                      name="aspirante_secundaria_localidad" id="selector_localidad_secundaria">
                      <option></option>

                     

                    </select>
                    <span>Localidad</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="borrarmodal()">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="insertar_secundaria()">Guardar</button>
          </div>
        </div>
      </div>
    </div>



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


      function lenguas_evento(e) {
        //console.log(e.value);
        if (e.value > 0) {
          document.getElementById("aspirante_lengua_lee").disabled = false;
          document.getElementById("aspirante_lengua_habla").disabled = false;
          document.getElementById("aspirante_lengua_escribe").disabled = false;
          document.getElementById("aspirante_lengua_entiende").disabled = false;
          document.getElementById("aspirante_lengua_traduce").disabled = false;
        }

        else {
          document.getElementById("aspirante_lengua_lee").disabled = true;
          document.getElementById("aspirante_lengua_habla").disabled = true;
          document.getElementById("aspirante_lengua_escribe").disabled = true;
          document.getElementById("aspirante_lengua_entiende").disabled = true;
          document.getElementById("aspirante_lengua_traduce").disabled = true;
        }
      }
      function parentesco(e) {
        if(document.getElementById("aspirante_tutor_parentesco").value === "otro"){
        $("#parentescootro").show()
        document.getElementById("aspirante_tutor_otro").name = 'aspirante_tutor_parentesco';
        document.getElementById("aspirante_tutor_parentesco").name = '';
	    	}
	    	else{
	    	$("#parentescootro").hide()
		}
        
      }

      function alergia(e) {
        console.log(e.value);
        if (e.value == 1) {
          document.getElementById("a").style = "display:"
        }

        else {
          document.getElementById("a").style = "display:none"
        }
      }


      function discapacidad(e) {
        console.log(e.value);
        if (e.value == 1) {
          document.getElementById("b").style = "display:"
        }

        else {
          document.getElementById("b").style = "display:none"
        }
      }

      function obtener_secundaria(e){
        console.log(e.value);
        if(e.value.length==10){
          var xhr = new XMLHttpRequest();
            xhr.open('GET', '/cseiio/index.php/c_secundaria/get_secundaria?cct_secundaria='+e.value, true);

            xhr.onload = function () {
              //console.log(JSON.parse(xhr.response));
              let secundaria = JSON.parse(xhr.response);
              //console.log(xhr.responseText.length);



              if(secundaria.length==1){
                  document.getElementById("nombre_secundaria_oculto").style.display="";
                  document.getElementById("aspirante_secundaria_nombre").value=secundaria[0].nombre_secundaria;
                  document.getElementById("aspirante_secundaria_nombre").disabled = true;
                  //tipo_subsistema_oculto
                  document.getElementById("tipo_subsistema_oculto").style.display = "";
                  //aspirante_secundaria_tipo_subsistema
                  document.getElementById("aspirante_secundaria_tipo_subsistema").value = secundaria[0].tipo_subsistema;
                  document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
              }

              else{
                document.getElementById("nombre_secundaria_oculto").style.display="none";
              }
            };

            xhr.send(null);
        }
      }


      function insertar_secundaria(){
        let secundaria = "";
        secundaria = {
          "cct_secundaria":document.getElementById("aspirante_nuevasecundaria_cct").value,
          "nombre_secundaria":document.getElementById("aspirante_nuevasecundaria_nombre").value,
          "subsistema":document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value,
          "localidad":parseInt(document.getElementById("selector_localidad_secundaria").value)
        };

        document.getElementById("secundarias").innerHTML += '<option value="'+document.getElementById("aspirante_nuevasecundaria_cct").value+'">'
        console.log(secundaria);
   

              var xhr = new XMLHttpRequest();
                xhr.open("POST", '/cseiio/index.php/c_secundaria/insert_secundaria', true);

          
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() { 
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                        alert(xhr.responseText);
                    }
                }
                xhr.send(JSON.stringify(secundaria));

                
      }

      function borrarmodal(){
        $('#aspirante_nuevasecundaria_cct').val('');
        $('#aspirante_nuevasecundaria_nombre').val('');
        $('#aspirante_nuevasecundaria_tipo_subsistema').val('');
        $('#selector_estado_secundaria').val('');
        $('#selector_municipio_secundaria').val('');
        $('#selector_localidad_secundaria').val('');
      }

      function cct(){
        document.getElementById("aspirante_nuevasecundaria_cct").value=document.getElementById("aspirante_secundaria_cct").value;
      }

      
    </script>






</body>

</html>