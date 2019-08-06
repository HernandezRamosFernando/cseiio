<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Control de alumnos</a>
      </li>
      <li class="breadcrumb-item active">Ingrese la búsqueda que desea realizar</li>
    </ol>

    <div class="card">
      <div class="card-body">

        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group ">
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
        <table class="table table-hover" id="tabla_completa" style="width: 100%">
          <caption>Lista de todos los alumnos</caption>
          <thead class="thead-light">
            <tr>
              <th scope="col" class="col-md-1">Nombre completo</th>
              <th scope="col" class="col-md-1">CURP</th>
              <th scope="col" class="col-md-1">N° control</th>
              <th scope="col" class="col-md-1">Matrícula</th>
              <th scope="col" class="col-md-1">Plantel CCT</th>
              <th scope="col" class="col-md-1">Fecha Ingreso</th>
              <th scope="col" class="col-md-1">Editar</th>
              <th scope="col" class="col-md-1">Imprimir</th>
            </tr>
          </thead>



          <tbody id="tabla">

          </tbody>
        </table>
      </div>
    </div>
  </div>


</div>
<!-- /.content-wrapper -->



<!-- Modal -->
<div class="modal fade" id="modalaspirante" tabindex="-1" role="dialog" aria-labelledby="modalaspiranteTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
    <div class="modal-content">

      <div class="modal-body">
        <!-- formulario -->
        <form id="formulario">



          <!--datos personales------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">
            Datos personales de Aspirante
            <hr>
          </p>

          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras validas"
                    class="form-control text-uppercase" id="aspirante_nombre" name="aspirante_nombre"
                    onchange="valida(this)" placeholder="Nombre(s)" style="color: #237087">
                  <label for="aspirante_nombre">Nombre(s)</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_apellido_paterno" onchange="valida(this)"
                    name="aspirante_apellido_paterno" placeholder="Apellido Paterno" style="color: #237087">
                  <label for="aspirante_apellido_paterno">Primer Apellido</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_apellido_materno" onchange="valida(this)"
                    name="aspirante_apellido_materno" placeholder="Apellido Materno" style="color: #237087">
                  <label for="aspirante_apellido_materno">Segundo Apellido</label>
                </div>
              </div>
            </div>

          </div>



          <div class="card form-group">
            <div>
              <label class="form-group has-float-label text-center"
                style="font-size: 12pt; font-weight: bold; color:#777;">Fecha de nacimiento</label>
            </div>

            <div class="row">

              <div class=" col-md-4 ">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_anio_nacimiento" required
                    name="aspirante_anio_nacimiento" onclick="get_dias()">

                  </select>
                  <span>Año</span>
                </label>
              </div>
              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_mes_nacimiento" required
                    name="aspirante_mes_nacimiento" onclick="get_dias()">
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>
                  <span>Mes</span>
                </label>
              </div>
              <div class="col-md-4 ">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_dia_nacimiento" required
                    name="aspirante_dia_nacimiento">

                  </select>
                  <span>Día</span>
                </label>
              </div>


            </div>

          </div>

          <div class="form-group">

            <div class="row">

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" title="El numero de telefono debe de ser a 13 digitos" style="color: #237087 "
                    class="form-control text-uppercase" id="aspirante_telefono" name="aspirante_telefono"
                    placeholder="Telefono">
                  <label for="aspirante_telefono">Teléfono</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="email" title="Introduzca un correo valido" class="form-control text-lowercase"
                    id="aspirante_correo" name="aspirante_correo" placeholder="Correo Electrónico"
                    style="color: #237087 ">
                  <label for="aspirante_correo">Correo electrónico</label>
                </div>
              </div>

              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_sexo" required
                    name="aspirante_sexo">
                    <option value="">Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                  </select>
                  <span>Sexo</span>
                </label>
              </div>

            </div>

          </div>



          <div class="form-group">
            <div class="row">


              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos"
                    class="form-control text-uppercase" id="aspirante_nss" name="aspirante_nss"
                    placeholder="Numero de Seguro Social" style="color: #237087 ">
                  <label for="aspirante_nss">NSS (IMSS)</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="aspirante_programa_social"
                    name="aspirante_programa_social" placeholder="Folio de programa social" style="color: #237087 ">
                  <label for="aspirante_programa_social">Folio de Prospera</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control form-control-lg selcolor" name="tipo_sangre" required id="tipo_sangre">
                      <option value="">Seleccione una opción</option>
                      <option value="No conoce">No conoce su tipo de sangre</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                    <span>Tipo de sangre</span>
                  </label>
                </div>
              </div>

            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_alergia_combo"
                    name="aspirante_alergia_combo" onchange="alergia(this)">
                    <option value="2">No</option>
                    <option value="1">Si</option>
                  </select>
                  <span>¿Alérgico a algún medicamento?</span>
                </label>
              </div>
              <div class="col-md-4" style="display:none" id="a" name="alergia_medicamento">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*"
                    class="form-control text-uppercase" id="aspirante_alergia" name="aspirante_alergia"
                    placeholder="Ingrese el medicamento" style="color: #237087 ">
                  <label for="aspirante_alergia">Ingrese el medicamento</label>
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_discapacidad_combo"
                    name="aspirante_discapacidad_combo" onchange="discapacidad(this)">
                    <option value="2">No</option>
                    <option value="1">Si</option>
                  </select>
                  <span>¿Padece alguna discapacidad?</span>
                </label>
              </div>
              <div class="col-md-4" style="display:none" id="b" name="discapacidad">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*"
                    class="form-control text-uppercase" id="aspirante_discapacidad" name="aspirante_discapacidad"
                    placeholder="Ingrese la discapacidad" style="color: #237087 ">
                  <label for="aspirante_discapacidad">Ingrese la discapacidad</label>
                </div>
              </div>

            </div>
          </div>


          <div class="form-group">

            <div class="row">
              <div class="col-md-8">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_plantel" name="aspirante_plantel">
                    <option>Seleccione el plantel de ingreso</option>

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
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" required="required" id="aspirante_semestre"
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
          <!--curp------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">CURP</p>
          <hr>

          <div class="form-group">
            <div class="row">


              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" class="form-control text-uppercase"
                    id="aspirante_curp" name="aspirante_curp" placeholder="CURP" style="color: #237087">
                  <label for="aspirante_curp">CURP</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <a name="" id="" class="btn btn-outline-success btn-lg btn-block btn-responsive"
                    href="https://www.gob.mx/curp/" target="_blank" role="button">
                    ¿No cuenta con curp? Buscar aquí</a>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_nacionalidad" required
                    name="aspirante_nacionalidad">
                    <option value="">Seleccione</option>
                    <option value="MEXICANA">MEXICANA</option>
                    <option value="EXTRANJERA">EXTRANJERA</option>
                  </select>
                  <span>Nacionalidad</span>
                </label>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" title="Datos incorrectos" class="form-control text-uppercase"
                    id="aspirante_lugar_nacimiento" name="aspirante_lugar_nacimiento" required
                    placeholder="Lugar de nacimiento" style="color: #237087 ">
                  <label for="aspirante_lugar_nacimiento">Lugar de Nacimiento</label>
                </div>
              </div>

            </div>
          </div>

          <!--direccion------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">
            Dirección familiar del Aspirante
            <hr>
          </p>

          <div class="form-group">

            <div class="row">

              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" required" name="aspirante_direccion_estado"
                    onChange="cambio_estado(selector_estado_aspirante,selector_municipio_aspirante,selector_localidad_aspirante)"
                    id="selector_estado_aspirante">
                    <option value="">Seleccione el estado</option>

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
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="aspirante_direccion_municipio"
                    onChange="cambio_municipio(selector_municipio_aspirante,selector_localidad_aspirante)"
                    id="selector_municipio_aspirante">
                    <option></option>
                  </select>
                  <span>Municipio</span>
                </label>
              </div>
              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="aspirante_direccion_localidad"
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
                  <input type="text" title="La direccion tiene caracteres incorrectos" class="form-control"
                    id="aspirante_direccion_calle" name="aspirante_direccion_calle" placeholder="Calle y número"
                    style="color: #237087">
                  <label for="aspirante_direccion_calle">Calle y Número</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" title="La colonia tiene caracteres incorrectos" class="form-control"
                    id="aspirante_direccion_colonia" name="aspirante_direccion_colonia"
                    placeholder="Colonia/Sección/Paraje/Barrio" style="color: #237087">
                  <label for="aspirante_direccion_colonia">Colonia/Sección/Paraje/Barrio</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{5}" title="El código postal solo debe contener 5 digitos"
                    class="form-control" id="aspirante_direccion_cp" name="aspirante_direccion_cp"
                    placeholder="Código Postal" style="color: #237087">
                  <label for="aspirante_direccion_cp">Código Postal</label>
                </div>
              </div>
            </div>

          </div>

          <!--fin direccion------------------------------------------------------>



          <!--datos tutor------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">
            Datos de Tutor
            <hr>
          </p>

          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" onchange="valida(this)" required
                    title="Introduzca solo letras" class="form-control text-uppercase" id="aspirante_tutor_nombre"
                    onchange="valida(this)" name="aspirante_tutor_nombre" placeholder="Nombre Completo"
                    style="color: #237087">
                  <label for="aspirante_tutor_nombre">Nombre de Tutor</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" onchange="valida(this)" required
                    title="Introduzca solo letras" class="form-control text-uppercase" id="aspirante_tutor_apellido"
                    onchange="valida(this)" name="aspirante_tutor_apellido" placeholder="Primer Apellido"
                    style="color: #237087">
                  <label for="aspirante_tutor_apellido">Primer Apellido</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-z]+[ ]?[A-Za-z]*" onchange="valida(this)"
                    title="Introduzca solo letras" class="form-control text-uppercase" onchange="valida(this)"
                    id="aspirante_tutor_apellidodos" name="aspirante_tutor_apellidodos" placeholder="Segundo Apellido"
                    style="color: #237087">
                  <label for="aspirante_tutor_apellidodos">Segundo Apellido</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">

              <div class="col-md-4">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" id="aspirante_tutor_parentesco" required
                    name="aspirante_tutor_parentesco" onchange="parentesco(this)">
                    <option value="">Seleccione</option>
                    <option value="PADRE">PADRE</option>
                    <option value="MADRE">MADRE</option>
                    <option value="HERMANO/A">HERMANO/A</option>
                    <option value="TIO">TIO</option>
                    <option value="TIA">TIA</option>
                    <option value="ABUELO">ABUELO</option>
                    <option value="ABUELA">ABUELA</option>
                    <option value="otro">OTRO</option>
                  </select>
                  <span>Parentesco</span>

                </label>
              </div>

              <div class="col-md-4" id="parentescootro" style="display:none;">
                <div class="form-label-group">
                  <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" onchange="valida(this)"
                    class="form-control text-uppercase" id="aspirante_tutor_otro" name="aspirante_tutor_otro"
                    onchange="valida(this)" placeholder="Escriba el parentesco" style="color: #237087">
                  <label for="aspirante_tutor_otro">Escriba el parentesco</label>
                </div>
              </div>
            </div>


            <div class="form-group">

              <div class="row">
                <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" title="Introduzca solo letras"
                      class="form-control" id="aspirante_tutor_ocupacion" name="aspirante_tutor_ocupacion"
                      onchange="valida(this)" placeholder="Ocupación" style="color: #237087">
                    <label for="aspirante_tutor_ocupacion">Ocupación</label>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="text"
                      title="El numero de telefono debe de ser a 13 digitos con lada" class="form-control"
                      id="aspirante_tutor_telefono" name="aspirante_tutor_telefono" placeholder="Teléfono particular"
                      style="color: #237087">
                    <label for="aspirante_tutor_telefono">Teléfono particular</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="text"
                      title="El numero de telefono debe de ser a 13 digitos con lada" class="form-control"
                      id="aspirante_tutor_telefono_comunidad" name="aspirante_tutor_telefono_comunidad"
                      placeholder="Teléfono de la comunidad" style="color: #237087">
                    <label for="aspirante_tutor_telefono_comunidad">Teléfono de la comunidad</label>
                  </div>
                </div>


                <div class="col-md-3">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" class="form-control" style="color: #237087"
                      id="aspirante_tutor_prospera" name="aspirante_tutor_prospera" placeholder="Folio de Prospera">
                    <label for="aspirante_tutor_prospera">Folio de Prospera</label>
                  </div>
                </div>
              </div>

            </div>

            <!--fin tutor------------------------------------------------------>


            <!--datos lengua materna------------------------------------------------------>
            <p class="text-center text-white rounded titulo-form h4">
              Datos de lengua materna
              <hr>
            </p>

            <div class="form-group">

              <div class="row">
                <div class="col-md-2">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control selcolor" required="required" onchange="lenguas_evento(this)"
                      id="aspirante_lengua_nombre" name="aspirante_lengua_nombre">
                      <option value="NO CONOCE LENGUA">Seleccione una lengua</option>

                      <?php
                              foreach ($lenguas as $lengua)
                              {
                                      echo '<option value="'.$lengua->id_lengua.'">'.strtoupper($lengua->nombre_lengua).'</option>';
                              }
                              ?>
                      <option value="otra">OTRA</option>

                    </select>
                    <span>Lengua</span>
                  </label>
                </div>

                <div class="col-md-2">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control selcolor" required="required" id="aspirante_lengua_lee"
                      name="aspirante_lengua_lee" disabled>
                      <option value="0">Nada 0%</option>
                      <option value="25">Poco 25%</option>
                      <option value="50">Regular 50%</option>
                      <option value="75">Bien 75%</option>
                      <option value="100">Bien 100%</option>
                    </select>
                    <span>Lee</span>
                  </label>
                </div>

                <div class="col-md-2">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control selcolor" required="required" id="aspirante_lengua_habla"
                      name="aspirante_lengua_habla" disabled>
                      <option value="0">Nada 0%</option>
                      <option value="25">Poco 25%</option>
                      <option value="50">Regular 50%</option>
                      <option value="75">Bien 75%</option>
                      <option value="100">Muy bien 100%</option>
                    </select>
                    <span>Habla</span>
                  </label>
                </div>

                <div class="col-md-2">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control selcolor" required="required" id="aspirante_lengua_escribe"
                      name="aspirante_lengua_escribe" disabled>
                      <option value="0">Nada 0%</option>
                      <option value="25">Poco 25%</option>
                      <option value="50">Regular 50%</option>
                      <option value="75">Bien 75%</option>
                      <option value="100">Muy bien 100%</option>
                    </select>
                    <span>Escribe</span>
                  </label>
                </div>

                <div class="col-md-2">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control selcolor" required="required" id="aspirante_lengua_entiende"
                      name="aspirante_lengua_entiende" disabled>
                      <option value="0">Nada 0%</option>
                      <option value="25">Poco 25%</option>
                      <option value="50">Regular 50%</option>
                      <option value="75">Bien 75%</option>
                      <option value="100">Muy bien 100%</option>
                    </select>
                    <span>Entiende</span>
                  </label>
                </div>


                <div class="col-md-2">
                  <label class="form-group has-float-label seltitulo">
                    <select class="form-control selcolor" required="required" id="aspirante_lengua_traduce"
                      name="aspirante_lengua_traduce" disabled>
                      <option value="0">Nada 0%</option>
                      <option value="25">Poco 25%</option>
                      <option value="50">Regular 50%</option>
                      <option value="75">Bien 75%</option>
                      <option value="100">Muy bien 100%</option>
                    </select>
                    <span>Traduce</span>
                  </label>
                </div>




              </div>

              <div class="row" id="lengua_oculto" style="display: none">

                <div class="col-md-2">
                  <div class="form-label-group">
                    <input type="text" class="form-control text-uppercase" id="aspirante_lengua_oculto"
                      name="aspirante_lengua_oculto" placeholder="Agregue lengua" style="color: #237087 ">
                    <label for="aspirante_lengua_oculto">Agregue lengua</label>
                  </div>
                </div>
              </div>
            </div>


          </div>

          <!--fin legua materna------------------------------------------------------>

                  <!-- etnia ------------------------------------------------------------------>
        <div class="form-group">
        <div class="row">

          <div class="col-md-4"  >
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" onchange="etnias_evento(this)"  name="aspirante_etnia" 
                id="aspirante_etnia">
                <option value="">Seleccione la etnia de procedencia</option>
                <?php
                              foreach ($lenguas as $lengua)
                              {
                                      echo '<option value="'.$lengua->id_lengua.'">'.strtoupper($lengua->nombre_lengua).'</option>';
                              }
                              ?>
                              <option value="otra">OTRA</option>

              </select>
              <span>Etnia</span>
            </label>
          </div>

          <div class="col-md-2" id="etnia_oculto" style="display: none"  >
              <div class="form-label-group">
                <input type="text" class="form-control text-uppercase" id="aspirante_etnia_oculto"
                  name="aspirante_etnia_oculto" placeholder="Agregue etnia" style="color: #237087 ">
                <label for="aspirante_etnia_oculto">Agregue etnia</label>
              </div>
            </div>


      </div>
        <!-- fin etnia --------------------------------------------------------------->




          <!--datos secundaria------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">
            Datos de Escuela de procedencia
            <hr>
          </p>

          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">

                  <input list="secundarias" class="form-control text-uppercase" id="aspirante_secundaria_cct"
                    name="aspirante_secundaria_cct" placeholder="Buscar escuela por CCT" style="color: #237087">
                  <datalist id="secundarias">

                    <?php
                              foreach ($escuela_procedencia as $escuela)
                              {
                                      echo '<option value="'.$escuela->cct_escuela_procedencia.'">';
                              }
                              ?>
                  </datalist>

                  <label for="aspirante_secundaria_cct">Buscar secundaria por CCT</label>
                </div>
                <br>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <button type="button" class="btn btn-outline-success btn-lg"
                    onclick="obtener_secundaria(document.getElementById('aspirante_secundaria_cct').value)">
                    Buscar escuela
                  </button>


                </div>
                <br>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4" style="display: none" id="nombre_secundaria_oculto">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                    title="El nombre de la secundaria contiene caracteres incorrectos"
                    class="form-control text-uppercase" id="aspirante_secundaria_nombre" style="color: #237087"
                    name="aspirante_secundaria_nombre" placeholder="Nombre de Secundaria">
                  <label for="aspirante_secundaria_nombre">Nombre de Secundaria</label>
                </div>
                <br>
              </div>

              <div class="col-md-4" style="display: none" id="tipo_subsistema_oculto">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="aspirante_secundaria_tipo_subsistema"
                    id="aspirante_secundaria_tipo_subsistema">
                    <option value="">Seleccione un tipo</option>
                    <option value="TELESECUNDARIA">Telesecundaria</option>
                    <option value="GENERAL">General</option>
                    <option value="PARTICULAR">Particular</option>
                    <option value="TÉCNICA">Técnica</option>
                    <option value="COMUNITARIA">Comunitaria</option>
                    <option value="OTRO">Otro</option>
                  </select>
                  <span>Tipo de Subsistema</span>
                </label>
              </div>

            </div>

          </div>

          <div class="form-group" id="bachillerato_oculto" style="display:none">

            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">

                  <input list="secundarias" class="form-control text-uppercase" id="aspirante_bachillerato_cct"
                    name="aspirante_bachillerato_cct" placeholder="Buscar escuela por CCT" style="color: #237087">
                  <datalist id="secundarias">

                    <?php
                              foreach ($escuela_procedencia as $escuela)
                              {
                                      echo '<option value="'.$escuela->cct_escuela_procedencia.'">';
                              }
                              ?>
                  </datalist>

                  <label for="aspirante_bachillerato_cct">Buscar Bachillerato por CCT</label>
                </div>
                <br>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <button type="button" class="btn btn-outline-success btn-lg"
                    onclick="obtener_bachillerato(document.getElementById('aspirante_bachillerato_cct').value)">
                    Buscar escuela
                  </button>


                </div>
                <br>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4" style="display: none" id="nombre_bachillerato_oculto">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                    title="El nombre de la secundaria contiene caracteres incorrectos"
                    class="form-control text-uppercase" id="aspirante_bachillerato_nombre" style="color: #237087"
                    name="aspirante_bachillerato_nombre" placeholder="Nombre de Bachillerato">
                  <label for="aspirante_bachillerato_nombre">Nombre de Bachillerato</label>
                </div>
                <br>
              </div>

              <div class="col-md-4" style="display: none" id="tipo_subsistema_bachillerato_oculto">
                <label class="form-group has-float-label seltitulo">
                  <select class="form-control form-control-lg selcolor" name="aspirante_bachillerato_tipo_subsistema"
                    id="aspirante_bachillerato_tipo_subsistema">
                    <option value="">Seleccione un tipo</option>
                    <option value="TELESECUNDARIA">Educación Profesional Técnica</option>
                    <option value="GENERAL">Bachillerato General</option>
                    <option value="PARTICULAR">Bachillerato Tecnológico</option>
                    <option value="OTRO">Otro</option>
                  </select>
                  <span>Tipo de Subsistema</span>
                </label>
              </div>

            </div>

          </div>

          <!--fin datos secundaria------------------------------------------------------>
          <input type="text" id="aspirante_no_control" name="aspirante_no_control" style="display:none">
          <input type="text" id="id_tutor" name="id_tutor" style="display:none">



          <br>
          <button type="submit" class="btn btn-success btn-lg btn-block" style="padding: 1.5rem">Actualizar
            Datos</button>


        </form>

        <!-- fin cuerpo modal -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<input type="text" style="display:none" id="no_control_borrar">


<script>
  cargar_anio();

  function cargar_datos_aspirante(e) {
    document.getElementById("selector_municipio_aspirante").innerHTML = "";
    document.getElementById("selector_localidad_aspirante").innerHTML = "";
    document.getElementById("aspirante_no_control").value = e.value;
    document.getElementById("aspirante_alergia").value = "";
    document.getElementById("aspirante_discapacidad").value = "";
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiante?no_control=' + e.value, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      $('#modalaspirante').modal().show();
      let datos = JSON.parse(xhr.response);
      console.log(datos);
      document.getElementById("aspirante_no_control").value = datos.estudiante[0].no_control;
      document.getElementById("id_tutor").value = datos.tutor[0].id_tutor;
      //datos personales
      document.getElementById("aspirante_nombre").value = datos.estudiante[0].nombre;
      document.getElementById("aspirante_apellido_paterno").value = datos.estudiante[0].primer_apellido;
      document.getElementById("aspirante_apellido_materno").value = datos.estudiante[0].segundo_apellido;
      document.getElementById("aspirante_curp").value = datos.estudiante[0].curp;

      var anio = datos.estudiante[0].fecha_nacimiento.split("-")[0];
      var mes = datos.estudiante[0].fecha_nacimiento.split("-")[1];
      var dia = parseInt(datos.estudiante[0].fecha_nacimiento.split("-")[2]);
      dia = dia.toString();
      //console.log(anio,mes,dia.toString());
      //$('#aspirante_anio_nacimiento option[value="'+anio+'"]')
      document.getElementById("aspirante_anio_nacimiento").value = anio;
      document.getElementById("aspirante_mes_nacimiento").value = mes;
      document.getElementById("aspirante_dia_nacimiento").value = dia;
      //document.getElementById("aspirante_fecha_nacimiento").value = datos.estudiante[0].fecha_nacimiento;
      //-----------------------------------------
      document.getElementById("aspirante_telefono").value = datos.estudiante[0].telefono;
      document.getElementById("aspirante_correo").value = datos.estudiante[0].correo;
      document.getElementById("aspirante_sexo").value = datos.estudiante[0].sexo;
      document.getElementById("aspirante_lugar_nacimiento").value = datos.estudiante[0].lugar_nacimiento;
      document.getElementById("aspirante_nacionalidad").value = datos.estudiante[0].nacionalidad;
      //console.log(datos.expediente_medico);
      document.getElementById("tipo_sangre").value = datos.expediente_medico[2].valor;
      if (datos.expediente_medico[0].valor === "") {
        document.getElementById("aspirante_alergia_combo").value = "2";
        document.getElementById("a").style.display = "none";
      }
      //datos.datos_medicos_aspirante[0].alergia_medicamento === null
      else {
        document.getElementById("aspirante_alergia_combo").value = "1";
        document.getElementById("aspirante_alergia").value = datos.expediente_medico[0].valor;
        document.getElementById("a").style.display = "";
      }
      if (datos.expediente_medico[1].valor === "") {
        document.getElementById("aspirante_discapacidad_combo").value = "2";
        document.getElementById("b").style.display = "none";
      }
      else {
        document.getElementById("aspirante_discapacidad_combo").value = "1";
        document.getElementById("aspirante_discapacidad").value = datos.expediente_medico[1].valor;
        document.getElementById("b").style.display = "";
      }
      document.getElementById("aspirante_plantel").value = datos.estudiante[0].Plantel_cct_plantel;
      document.getElementById("aspirante_semestre").value = datos.estudiante[0].semestre_en_curso;
      //fin datos personales
      //direccion aspirante
      //llamada al api que regresa los ids de la direccion del estudiante
      var respuesta;
      let direccion = new XMLHttpRequest();
      direccion.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_estado_municipio_localidad_id_localidad?id_localidad=' + datos.estudiante[0].id_localidad, true);

      direccion.onloadstart = function () {
        $('#div_carga').show();
      }
      direccion.error = function () {
        console.log("error de conexion");
      }
      direccion.onload = function () {
        $('#div_carga').hide();
        var respuesta = JSON.parse(direccion.response);
        //cargar municipios
        let municipios = new XMLHttpRequest();
        municipios.open('GET', '<?php echo base_url();?>index.php/c_municipio/get_municipios_estado_html?id_estado=' + respuesta[0].id_estado, true);
        municipios.onload = function () {
          document.getElementById("selector_municipio_aspirante").innerHTML = municipios.responseText;
        };
        municipios.send(null);
        //fin cargar municipios
        //cargar localidades

        let localidades = new XMLHttpRequest();
        localidades.open('GET', '<?php echo base_url();?>index.php/c_localidad/get_localidades_municipio_html?id_municipio=' + respuesta[0].id_municipio, true);
        localidades.onload = function () {
          document.getElementById("selector_localidad_aspirante").innerHTML = localidades.responseText;
          //seleccionar las opciones de la direccion del estudiante que habia registrado
          document.getElementById("selector_estado_aspirante").value = respuesta[0].id_estado;
          document.getElementById("selector_municipio_aspirante").value = respuesta[0].id_municipio;
          document.getElementById("selector_localidad_aspirante").value = respuesta[0].id_localidad;
        };
        localidades.send(null);

        //fin cargar localidades
      };
      direccion.send(null);

      document.getElementById("aspirante_direccion_calle").value = datos.estudiante[0].calle;
      document.getElementById("aspirante_direccion_colonia").value = datos.estudiante[0].colonia;
      document.getElementById("aspirante_direccion_cp").value = datos.estudiante[0].cp;
      //fin direccion aspirante
      //datos tutor
      document.getElementById("aspirante_tutor_nombre").value = datos.tutor[0].nombre_tutor;
      document.getElementById("aspirante_tutor_apellido").value = datos.tutor[0].primer_apellido_tutor;
      document.getElementById("aspirante_tutor_apellidodos").value = datos.tutor[0].segundo_apellido_tutor;
      document.getElementById("aspirante_tutor_ocupacion").value = datos.tutor[0].ocupacion;
      //document.getElementById("aspirante_tutor_telefono").value = datos.tutor[0].telefono_tutor;
      document.getElementById("aspirante_tutor_telefono_comunidad").value = datos.tutor[0].telefono_comunidad;
      document.getElementById("aspirante_tutor_prospera").value = datos.tutor[0].folio_programa_social_tutor;
      $parentesco = datos.tutor[0].parentesco;
      if ($parentesco !== "PADRE" && $parentesco !== "MADRE" && $parentesco !== "HERMANO/A" && $parentesco !== "TIO" && $parentesco !== "TIA" && $parentesco !== "ABUELO" && $parentesco !== "ABUELA") {
        document.getElementById("aspirante_tutor_parentesco").value = "otro";
        document.getElementById("aspirante_tutor_otro").value = $parentesco;
        document.getElementById("parentescootro").style.display = "";
      }
      else {
        document.getElementById("aspirante_tutor_parentesco").value = $parentesco;
        document.getElementById("aspirante_tutor_otro").value = "";
        document.getElementById("parentescootro").style.display = "none";
      }
      //fin datos tutor
      //datos lengua materna
      if (datos.lengua_materna[0].id_lengua === "0") {
        document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna[0].id_lengua;
        document.getElementById("aspirante_lengua_lee").value = 0;
        document.getElementById("aspirante_lengua_habla").value = 0;
        document.getElementById("aspirante_lengua_escribe").value = 0;
        document.getElementById("aspirante_lengua_entiende").value = 0;
        document.getElementById("aspirante_lengua_traduce").value = 0;
      }
      else {
        document.getElementById("aspirante_lengua_nombre").value = datos.lengua_materna[0].id_lengua;
        document.getElementById("aspirante_lengua_lee").disabled = false;
        document.getElementById("aspirante_lengua_lee").value = datos.lengua_materna[0].porcentaje;
        document.getElementById("aspirante_lengua_habla").disabled = false;
        document.getElementById("aspirante_lengua_habla").value = datos.lengua_materna[1].porcentaje;
        document.getElementById("aspirante_lengua_escribe").disabled = false;
        document.getElementById("aspirante_lengua_escribe").value = datos.lengua_materna[2].porcentaje;
        document.getElementById("aspirante_lengua_entiende").disabled = false;
        document.getElementById("aspirante_lengua_entiende").value = datos.lengua_materna[3].porcentaje;
        document.getElementById("aspirante_lengua_traduce").disabled = false;
        document.getElementById("aspirante_lengua_traduce").value = datos.lengua_materna[4].porcentaje;
      }
      //fin datos lengua materna
      //secundaria
      if (datos.estudiante[0].tipo_ingreso === "PORTABILIDAD") {
        document.getElementById("aspirante_secundaria_cct").value = datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;
        document.getElementById("bachillerato_oculto").style.display = "";
        document.getElementById("aspirante_bachillerato_cct").value = datos.escuela_procedencia[1].Escuela_procedencia_cct_escuela_procedencia;

      } else {
        document.getElementById("aspirante_secundaria_cct").value = datos.escuela_procedencia[0].Escuela_procedencia_cct_escuela_procedencia;
        document.getElementById("bachillerato_oculto").style.display = "none";
      }

      /*
      document.getElementById("aspirante_secundaria_nombre").value = datos.secundaria_aspirante[0].nombre_secundaria;
      document.getElementById("aspirante_secundaria_nombre").disabled = true;
      document.getElementById("nombre_secundaria_oculto").style.display = "";
 
      document.getElementById("aspirante_secundaria_tipo_subsistema").value = datos.secundaria_aspirante[0].tipo_subsistema;
      document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
      document.getElementById("tipo_subsistema_oculto").style.display = "";
      */
    }
    xhr.send(null);
  }

  function buscar() {
    document.getElementById("aspirante_plantel_busqueda").disabled = true;
    document.getElementById("aspirante_curp_busqueda").disabled = true;
    document.getElementById("tabla").innerHTML = "";
    var xhr = new XMLHttpRequest();
    var curp = document.getElementById("aspirante_curp_busqueda").value;
    var plantel = document.getElementById("aspirante_plantel_busqueda").value;
    var query = 'curp=' + curp + '&cct_plantel=' + plantel;
    xhr.open('GET', '<?php echo base_url();?>index.php/c_estudiante/get_estudiantes_curp_plantel?' + query, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        //console.log(valor);
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
        fila += valor.matricula === null ? "" : valor.matricula;
        fila += '</td>';
        fila += '<td>';
        fila += valor.Plantel_cct_plantel;
        fila += '</td>';
        fila += '<td>';
        fila += valor.fecha_registro;
        fila += '</td>';
        fila += '<td>';
        fila += '<button class="btn btn-lg btn-block btn-success" type="button" value="' + valor.no_control + '" onclick="cargar_datos_aspirante(this)" data-toggle="modal" data-target="#">Editar</button>';
        fila += '</td>';
        fila += '<td>';
        fila += '<a href="<?php echo base_url();?>index.php/C_estudiante/generar_formato_inscripcion?no_control=' + valor.no_control + '" class="btn btn-lg btn-block btn-info btn btn-primary" target="_blank">Imprimir</a>';
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

  function obtener_secundaria(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);
      if (secundaria.length == 1) {
        document.getElementById("nombre_secundaria_oculto").style.display = "";
        document.getElementById("aspirante_secundaria_nombre").value = secundaria[0].nombre_escuela_procedencia;
        document.getElementById("aspirante_secundaria_nombre").disabled = true;
        //tipo_subsistema_oculto
        document.getElementById("tipo_subsistema_oculto").style.display = "";
        //aspirante_secundaria_tipo_subsistema
        document.getElementById("aspirante_secundaria_tipo_subsistema").value = secundaria[0].tipo_subsistema;
        document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
      }
      else {
        document.getElementById("nombre_secundaria_oculto").style.display = "none";
        document.getElementById("tipo_subsistema_oculto").style.display = "none";

        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Esta secundaria no existe',
          showCancelButton: true,
          showConfirmButton: false,
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {
            $('#nuevasecundaria').modal().show();
            cct();

          }
        })
      }
    };

    xhr.send(null);
  }

  function obtener_bachillerato(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      //console.log(JSON.parse(xhr.response));
      let secundaria = JSON.parse(xhr.response);
      //console.log(xhr.responseText.length);
      if (secundaria.length == 1) {
        document.getElementById("nombre_bachillerato_oculto").style.display = "";
        document.getElementById("aspirante_bachillerato_nombre").value = secundaria[0].nombre_escuela_procedencia;
        document.getElementById("aspirante_bachillerato_nombre").disabled = true;
        //tipo_subsistema_oculto
        document.getElementById("tipo_subsistema_bachillerato_oculto").style.display = "";
        //aspirante_secundaria_tipo_subsistema
        document.getElementById("aspirante_bachillerato_tipo_subsistema").value = secundaria[0].tipo_subsistema;
        document.getElementById("aspirante_bachillerato_tipo_subsistema").disabled = true;
      }
      else {
        document.getElementById("nombre_bachillerato_oculto").style.display = "none";
        document.getElementById("tipo_subsistema_bachillerato_oculto").style.display = "none";

        swalWithBootstrapButtons.fire({
          type: 'info',
          text: 'Esta secundaria no existe',
          showCancelButton: true,
          showConfirmButton: false,
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.value) {
            $('#nuevasecundaria').modal().show();
            cct();

          }
        })
      }
    };

    xhr.send(null);
  }
  function insertar_secundaria() {
    let secundaria = "";
    secundaria = {
      "cct_secundaria": document.getElementById("aspirante_nuevasecundaria_cct").value,
      "nombre_secundaria": document.getElementById("aspirante_nuevasecundaria_nombre").value,
      "subsistema": document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value,
      "localidad": parseInt(document.getElementById("selector_localidad_secundaria").value)
    };
    document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevasecundaria_cct").value + '">'
    console.log(secundaria);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", '<?php echo base_url();?>index.php/c_secundaria/insert_secundaria', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText === "si") {
          Swal.fire({
            type: 'success',
            title: 'Secundaria agregada correctamente',
            showConfirmButton: false,
            timer: 2500
          })
        } else {
          Swal.fire({
            type: 'error',
            title: 'Secundaria no agregada',
            confirmButtonText: 'Cerrar'

          })//alert(xhr.responseText);
        }
      }
      xhr.send(JSON.stringify(secundaria));
    }
  }

  var form = document.getElementById("formulario");
  form.onsubmit = function (e) {
    if (document.getElementById("aspirante_secundaria_cct").value === '') {
      console.log("vacio");
      swalWithBootstrapButtons.fire({
        type: 'warning',
        text: 'Esta tratando de actualizar un alumno sin Secundaria',
        showCancelButton: true,
        confirmButtonText: 'Actualizar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.value) {
          console.log("Entro a if")
          e.preventDefault();
          envioform(form);

        }
      })
      return false;
    } else {
      e.preventDefault();
      envioform(form);
    }


  }



  function envioform(form) {
    $('#modalaspirante').modal('toggle');
    var formdata = new FormData(form);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "<?php echo base_url();?>index.php/c_estudiante/update_estudiante", true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText === "si") {
          Swal.fire({
            type: 'success',
            title: 'Actualizacion exitosa'
          });

        }
        else {
          Swal.fire({
            type: 'error',
            text: 'Ocurrio un error al actualizar los datos'
          });
          $('#modalaspirante').modal().show();
        }
      }
    }
    xhr.send(formdata);

  }
</script>