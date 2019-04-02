
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Inscripción Portabilidad</a>
          </l
          <li class="breadcrumb-item active">Rellene todos los campos</li>
        </ol>




        
        <form id="formulario">

        <input type="text" name="formulario" value="portabilidad" style="display:none">

          <!--datos personales------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">
            Datos personales de Aspirante
            <hr>
          </p>

          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_nombre" name="aspirante_nombre" placeholder="Nombre(s)">
                  <label for="aspirante_nombre">Nombre(s)</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_apellido_paterno" name="aspirante_apellido_paterno"
                    placeholder="Apellido Paterno">
                  <label for="aspirante_apellido_paterno">Primer Apellido</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_apellido_materno" name="aspirante_apellido_materno"
                    placeholder="Apellido Materno">
                  <label for="aspirante_apellido_materno">Segundo Apellido</label>
                </div>
              </div>
            </div>

          </div>



          <div class="form-group">

            <div class="row">

              <div class="col-md-4 text-center">
                <div class="form-label-group">
                  <input type="date" required="required" class="form-control text-uppercase" id="aspirante_fecha_nacimiento" max="2006-01-01" title="La edad minima para ingresar es 14 años"
                    name="aspirante_fecha_nacimiento" placeholder="Fecha de Nacimiento">
                  <label for="aspirante_fecha_nacimiento">Fecha Nacimiento</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{10}" title="El numero de telefono debe de ser a 10 digitos"
                    class="form-control text-uppercase" id="aspirante_telefono" name="aspirante_telefono" placeholder="Teléfono">
                  <label for="aspirante_telefono">Teléfono</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="email"
                    pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$"
                    title="Introduzca un correo valido" class="form-control text-lowercase " id="aspirante_correo"
                    name="aspirante_correo" placeholder="Correo Electrónico">
                  <label for="aspirante_correo">Correo electrónico</label>
                </div>
              </div>


            </div>

          </div>



          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
                <label class="form-group has-float-label">
                <select class="form-control form-control-lg" required id="aspirante_sexo"
                    name="aspirante_sexo">
                    <option value="">Seleccione</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                  </select>
                  <span>Sexo</span>
                </label>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="number" pattern="[0-9]{11}" title="Introduzca 11 dígitos" class="form-control text-uppercase"
                    id="aspirante_nss" name="aspirante_nss" placeholder="Numero de Seguro Social">
                  <label for="aspirante_nss">NSS (IMSS)</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="aspirante_programa_social"
                    name="aspirante_programa_social" placeholder="Folio de programa social">
                  <label for="aspirante_programa_social">Folio de Prospera</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                <label class="form-group has-float-label">
                <select class="form-control form-control-lg" name="tipo_sangre" id="tipo_sangre" required>
                   <option value="">Seleccione una opción</option>
                   <option value="No conoce">No conoce su tipo de sangre</option>
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
                    <option value="2">No</option>
                    <option value="1">Si</option>
                   
                  </select>
                  <span>¿Alérgico a algún medicamento?</span>
                </label>
              </div>
              <div class="col-md-4" style="display:none" id="a" name="alergia_medicamento">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="aspirante_alergia" name="aspirante_alergia"
                    placeholder="Ingrese el medicamento">
                  <label for="aspirante_alergia">Ingrese el medicamento</label>
                </div>
              </div>


              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" id="aspirante_discapacidad_combo"
                    name="aspirante_discapacidad_combo" onchange="discapacidad(this)">
                    <option value="2">No</option>
                    <option value="1">Si</option>
                    
                  </select>
                  <span>¿Padece alguna discapacidad?</span>
                </label>
              </div>
              <div class="col-md-4" style="display:none" id="b" name="discapacidad">
                <div class="form-label-group">
                  <input type="text" class="form-control text-uppercase" id="aspirante_discapacidad" name="aspirante_discapacidad"
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
                  <select class="form-control form-control-lg" required id="aspirante_plantel"
                    name="aspirante_plantel">
                    <option value="">Seleccione el plantel de ingreso</option>

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

              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required id="aspirante_semestre" name="aspirante_semestre" required>
                  <option value="">Seleccione un semestre</option>
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
        <p class="text-center text-white rounded titulo-form h4">
            CURP
            <hr>
          </p>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required name="aspirante_nacimiento_estado"
                    onChange="curp();" id="selector_estado_nacimiento_aspirante">
                    <option value="">Seleccione el estado de nacimiento</option>

                    <?php
                              foreach ($estados as $estado)
                              {
                                      echo '<option value="'.$estado->id_estado.'">'.$estado->nombre_estado.'</option>';
                              }
                              ?>



                  </select>
                  <span>Estado de nacimiento</span>
                </label>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text"
                    pattern="([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)"
                    title="Ingrese los datos faltantes" class="form-control text-uppercase" id="aspirante_curp"
                    name="aspirante_curp" placeholder="CURP">
                  <label for="aspirante_curp">CURP</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
              <a name="" id="" class="btn btn-outline-success btn-lg btn-block btn-responsive" href="https://www.gob.mx/curp/" target="_blank" role="button">
              ¿No cuenta con curp? Buscar aquí</a>
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
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required name="aspirante_direccion_estado"
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
                    title="La direccion tiene caracteres incorrectos" class="form-control text-uppercase"
                    id="aspirante_direccion_calle" name="aspirante_direccion_calle" placeholder="Calle y número">
                  <label for="aspirante_direccion_calle">Calle y número</label>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ 0-9]+" title="La colonia tiene caracteres incorrectos"
                    class="form-control text-uppercase" id="aspirante_direccion_colonia" name="aspirante_direccion_colonia"
                    placeholder="Colonia">
                  <label for="aspirante_direccion_colonia">Colonia</label>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{5}" title="El codigo postal solo debe contener 5 digitos"
                    class="form-control text-uppercase" id="aspirante_direccion_cp" name="aspirante_direccion_cp"
                    placeholder="Código Postal">
                  <label for="aspirante_direccion_cp">Código Postal</label>
                </div>
              </div>
            </div>

          </div>

          <!--fin direccion------------------------------------------------------>

 
          <!--datos tutor------------------------------------------------------>
          <p class="text-center text-white rounded titulo-form h4">Datos de Tutor</p>
          <hr>

          <div class="form-group">

            <div class="row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" required="required" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_tutor_nombre" name="aspirante_tutor_nombre"
                    placeholder="Nombre Completo">
                  <label for="aspirante_tutor_nombre">Nombre de Tutor</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_tutor_apellido" name="aspirante_tutor_apellido"
                    placeholder="Nombre Completo">
                  <label for="aspirante_tutor_apellido">Primer Apellido</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+"  title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_tutor_apellidodos" name="aspirante_tutor_apellidodos"
                    placeholder="Nombre Completo">
                  <label for="aspirante_tutor_apellidodos">Segundo Apellido</label>
                </div>
              </div>
            </div>
          </div>

            <div class="form-group">
              <div class="row">

                <div class="col-md-4">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" id="aspirante_tutor_parentesco" required
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
                    <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ ]+" class="form-control text-uppercase"
                      id="aspirante_tutor_otro" name="aspirante_tutor_otro" placeholder="Escriba el parentesco">
                    <label for="aspirante_tutor_otro">Escriba el parentesco</label>
                  </div>
                </div>
              </div>

            
          


          <div class="form-group">

            <div class="row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" title="Introduzca solo letras"
                    class="form-control text-uppercase" id="aspirante_tutor_ocupacion" name="aspirante_tutor_ocupacion"
                    placeholder="Ocupación">
                  <label for="aspirante_tutor_ocupacion">Ocupación</label>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{10}" title="El numero de telefono debe de ser a 10 dígitos con lada"
                    class="form-control text-uppercase" id="aspirante_tutor_telefono" name="aspirante_tutor_telefono"
                    placeholder="Teléfono particular">
                  <label for="aspirante_tutor_telefono">Teléfono particular</label>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[0-9]{10}" title="El numero de telefono debe de ser a 10 digitos con lada"
                    class="form-control text-uppercase" id="aspirante_tutor_telefono_comunidad"
                    name="aspirante_tutor_telefono_comunidad" placeholder="Teléfono de la comunidad">
                  <label for="aspirante_tutor_telefono_comunidad">Teléfono de la comunidad</label>
                </div>
              </div>


              <div class="col-md-3">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. ]+" class="form-control text-uppercase"
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
                <label class="form-group has-float-label">
                  <select class="form-control" required onchange="lenguas_evento(this)"
                    id="aspirante_lengua_nombre" name="aspirante_lengua_nombre">
                    <option value="">Seleccione una lengua</option>

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
          <p class="text-center text-white rounded titulo-form h4">
            Datos de Secundaria de procedencia
            <hr>
          </p>

          <div class="form-group">
            <div class="row">
            <div class="col-md-4">
                <div class="form-label-group">
                  
                    <input list="secundarias" 
                    required="required" class="form-control text-uppercase" id="aspirante_secundaria_cct" 
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
                <button type="button" class="btn btn-outline-success btn-lg" onclick="obtener_secundaria(document.getElementById('aspirante_secundaria_cct').value)">
                   Buscar secundaria
                  </button>

                  <!-- Button trigger modal 
                  <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#nuevasecundaria" onclick="cct()">
                    Agregar nueva secundaria
                  </button>
                  -->

                </div>
                <br>
              </div>
            </div>

              <div class="row">
              <div class="col-md-4" style="display: none" id="nombre_secundaria_oculto">
                <div class="form-label-group">
                  <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+" required="required"
                    title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
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
                    <option value="TÉCNICA">Técnica</option>
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
          <p class="text-center text-white rounded titulo-form h4">
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
          <p class="text-center text-white rounded titulo-form h4">
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
          <button type="submit" class="btn btn-success btn-lg btn-block" style="padding: 1.5rem">Registrar</button>


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
                      title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                      id="aspirante_nuevasecundaria_cct" name="aspirante_nuevasecundaria_cct" placeholder="CCT de Secundaria">
                    <label for="aspirante_nuevasecundaria_cct">C C T</label>
                  </div>
                  <br>
                </div>
                <div class="col-md-4">
                  <div class="form-label-group">
                    <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+" class="form-control text-uppercase"
                      id="aspirante_nuevasecundaria_nombre" name="aspirante_secundaria_nombre"
                      placeholder="Nombre de Secundaria">
                    <label for="aspirante_nuevasecundaria_nombre">Nombre de Secundaria</label>
                  </div>
                  <br>
                </div>

                <div class="col-md-4">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg"
                      name="aspirante_nuevasecundaria_tipo_subsistema" id="aspirante_nuevasecundaria_tipo_subsistema" required>
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


              <div class="row">

                <div class="col-md-4">
                  <label class="form-group has-float-label">
                    <select class="form-control form-control-lg" required name="aspirante_secundaria_estado"
                      onChange="cambio_estado(selector_estado_secundaria,selector_municipio_secundaria,selector_localidad_secundaria)"
                      id="selector_estado_secundaria">
                      <option value="">Seleccione un estado</option>

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
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="borrarmodal()">Cancelar</button>
            <button type="button" class="btn btn-success" onclick="insertar_secundaria()">Guardar</button>
          </div>
        </div>
      </div>
    </div>



  


    <script>
const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success btn-block',
    cancelButton: 'btn btn-secondary btn-block'
  },
  buttonsStyling: false,
})


function fecha_curp(fecha){

var fechas = fecha.split("-");
fechas[0] = fechas[0].substring(2,4);
return fechas.join("");
}

function generarCURP() {

var consonantes = /[bcdfghjklmnpqrstvwxyz]/gi;
var CURP = [];
CURP[0] = $("#aspirante_apellido_paterno").val().charAt(0).toUpperCase();
CURP[1] = $("#aspirante_apellido_paterno").val().slice(1).replace(consonantes, "").charAt(0).toUpperCase();
if($("#aspirante_apellido_materno").val()===""){
  CURP[2] = "X";
}else{
  CURP[2] = $("#aspirante_apellido_materno").val().charAt(0).toUpperCase();
}
CURP[3] = $("#aspirante_nombre").val().charAt(0).toUpperCase();
CURP[4] = fecha_curp($("#aspirante_fecha_nacimiento").val());
CURP[5] = $("#aspirante_sexo").val().toUpperCase();
CURP[6] = abreviacion[estados.indexOf($("#selector_estado_nacimiento_aspirante option:selected").text().toLowerCase())];
CURP[7] = $("#aspirante_apellido_paterno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
if($("#aspirante_apellido_materno").val()===""){
  CURP[8] = "X";
}else{
  CURP[8] = $("#aspirante_apellido_materno").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
}
CURP[9] = $("#aspirante_nombre").val().slice(1).replace(/[aeiou]/gi, "").charAt(0).toUpperCase();
document.getElementById("aspirante_curp").value = CURP.join("");
}

function curp(){
  generarCURP();
}
var estados = ["aguascalientes","baja california","baja california sur","campeche","chiapas","chihuahua","coahuila","colima","ciudad de mexico","distrito federal","durango","guanajuato","guerrero","hidalgo","jalisco","estado de mexico","michoacan","morelos","nayarit","nuevo leon","oaxaca","puebla","queretaro","quintana roo","san luis potosi","sinaloa","sonora","tabasco","tamaulipas","tlaxcala","veracruz","yucatan","zacatecas"];
var abreviacion = ["AS","BC","BS","CC","CS","CH","CL","CM","CX","DF","DG","GT","GR","HG","JC","MC","MN","MS","NT","NL","OC","PL","QT","QR","SP","SL","SR","TC","TS","TL","VZ","YN","ZS"];



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
        
          var xhr = new XMLHttpRequest();
          console.log("manda",e);
            xhr.open('GET', '<?php echo base_url();?>index.php/c_secundaria/get_secundaria?cct_secundaria='+e, true);

            xhr.onload = function () {
              //console.log(JSON.parse(xhr.response));
              let secundaria = JSON.parse(xhr.response);
              //console.log(e);
              console.log(xhr.responseText.length);



              if(secundaria.length==1){
                  document.getElementById("nombre_secundaria_oculto").style.display="";
                  document.getElementById("aspirante_secundaria_nombre").value=secundaria[0].nombre_secundaria;
                  document.getElementById("aspirante_secundaria_nombre").disabled = true;
                  //tipo_subsistema_oculto
                  document.getElementById("tipo_subsistema_oculto").style.display = "";
                  //aspirante_secundaria_tipo_subsistema
                  document.getElementById("aspirante_secundaria_tipo_subsistema").value = secundaria[0].tipo_subsistema;
                  document.getElementById("aspirante_secundaria_tipo_subsistema").disabled = true;
              }else{
                document.getElementById("nombre_secundaria_oculto").style.display="none";
                document.getElementById("tipo_subsistema_oculto").style.display="none";
                
                swalWithBootstrapButtons.fire({
                  type: 'info',
                  text: 'Esta secundaria no existe porfavor agreguela:',
                  showCancelButton: true,
                  confirmButtonText: 'Agregar',
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
                xhr.open("POST", '<?php echo base_url();?>index.php/c_secundaria/insert_secundaria', true);

          
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() { 
                    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
           if(xhr.responseText === "si")
            {
            Swal.fire({
            type: 'success',
            title: 'Secundaria agregada correctamente',
            showConfirmButton: false,
            timer: 2500
           })
           $('#nuevasecundaria').modal('toggle');
            }else{
            Swal.fire({
            type: 'error',
            title: 'Secundaria no agregada',
            confirmButtonText: 'Cerrar'

            })
            }

        }
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

<script>   

var form = document.getElementById("formulario");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/c_aspirante/registrar_datos_aspirante",true);
    xhr.onreadystatechange = function() { 
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      //console.log();
      if(xhr.responseText==="si"){
        Swal.fire({
            type: 'success',
            title: 'Registro exitoso',
            showConfirmButton: false,
            timer: 2500 
          });

          document.getElementById("formulario").reset();
          document.getElementById("selector_municipio_aspirante").value="";
          document.getElementById("selector_localidad_aspirante").value="";
      }

      else{
        Swal.fire({
            type: 'error',
            title: 'Ya existe un alumno registrado con ese curp',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
		xhr.send(formdata);
		
	}

</script>



