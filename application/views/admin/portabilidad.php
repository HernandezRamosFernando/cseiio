
<div id="content-wrapper">

<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Inscripción Portabilidad</a>
    </li>
    <li class="breadcrumb-item active">Rellene todos los campos</li>
    <div class=" col-md-4 text-right " style="font-weight:bold"> Ciclo escolar:
      <?php
         echo ($ciclo_escolar[0]->nombre_ciclo_escolar);
        ?>
    </div>
  </ol>



  <form id="formulario">

    <input type="text" name="formulario" value="portabilidad" style="display:none">

    <!--datos personales------------------------------------------------------>
    <p class="text-center text-white rounded titulo-form h4 ">Datos personales de Aspirante</p>
    <hr>


    <div class="form-group">

<div class="row">
  <div class="col-md-4">
    <div class="form-label-group">
      <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras validas"
        class="form-control text-uppercase" id="aspirante_nombre" name="aspirante_nombre"
        onchange="valida(this);" placeholder="Nombre(s)" style="color: #237087 ">
      <label for="aspirante_nombre">Nombre(s)</label>
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-label-group">
      <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required title="Introduzca solo letras"
        class="form-control text-uppercase" id="aspirante_apellido_paterno" name="aspirante_apellido_paterno"
        onchange="valida(this);" placeholder="Apellido Paterno" style="color: #237087 ">
      <label for="aspirante_apellido_paterno">Primer Apellido</label>
    </div>
  </div>

  <div class="col-md-4">
    <div class="form-label-group">
      <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
        class="form-control text-uppercase" id="aspirante_apellido_materno" name="aspirante_apellido_materno"
        onchange="valida(this);" placeholder="Apellido Materno" style="color: #237087 ">
      <label for="aspirante_apellido_materno">Segundo Apellido</label>
    </div>
  </div>
</div>

</div>





<div class="card form-group">
<div>
<label class="form-group has-float-label text-center" style="font-size: 12pt; font-weight: bold; color:#777;" >Fecha de nacimiento</label>
</div>

<div class="row">
 
  <div class=" col-md-4 ">
  <label class="form-group has-float-label seltitulo">
      <select class="form-control form-control-lg selcolor" id="aspirante_anio_nacimiento" required name="aspirante_anio_nacimiento" onclick="get_dias()">

      </select>
      <span>Año</span>
    </label>
  </div>
  <div class="col-md-4">
  <label class="form-group has-float-label seltitulo">
      <select class="form-control form-control-lg selcolor" id="aspirante_mes_nacimiento" required name="aspirante_mes_nacimiento" onclick="get_dias()">
      <option value="01">Enero 01</option>
            <option value="02">Febrero 02</option>
            <option value="03">Marzo 03</option>
            <option value="04">Abril 04</option>
            <option value="05">Mayo 05</option>
            <option value="06">Junio 06</option>
            <option value="07">Julio 07</option>
            <option value="08">Agosto 08</option>
            <option value="09">Septiembre 09</option>
            <option value="10">Octubre 10</option>
            <option value="11">Noviembre 11</option>
            <option value="12">Diciembre 12</option>
      </select>
      <span>Mes</span>
    </label>
  </div>
  <div class="col-md-4 ">
  <label class="form-group has-float-label seltitulo">
      <select class="form-control form-control-lg selcolor" id="aspirante_dia_nacimiento" required name="aspirante_dia_nacimiento">

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
      <input type="email"
        title="Introduzca un correo valido" class="form-control text-lowercase" id="aspirante_correo"
        name="aspirante_correo" placeholder="Correo Electrónico" style="color: #237087 ">
      <label for="aspirante_correo">Correo electrónico</label>
    </div>
  </div>

  <div class="col-md-4">
    <label class="form-group has-float-label seltitulo">
      <select class="form-control form-control-lg selcolor" id="aspirante_sexo" required name="aspirante_sexo">
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
      <input type="number" pattern="[0-9]{11}" title="Introduzca 11 digitos" class="form-control text-uppercase"
        id="aspirante_nss" name="aspirante_nss" placeholder="Numero de Seguro Social" style="color: #237087 ">
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
          <option value="NO CONOCE">No conoce su tipo de sangre</option>
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

  </div>
</div>

  <div class="form-group">
<div class="row">

  <div class="col-md-4">
    <label class="form-group has-float-label seltitulo">
      <select class="form-control form-control-lg selcolor" id="aspirante_alergia_combo" name="aspirante_alergia_combo"
        onchange="alergia(this)">
        <option value="2">No</option>
        <option value="1">Sí</option>
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
        <option value="1">Sí</option>
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
            <select class="form-control form-control-lg selcolor" id="aspirante_plantel" required name="aspirante_plantel">
              <option value="">Seleccione el plantel de ingreso</option>

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
              <select class="form-control form-control-lg selcolor" required id="aspirante_semestre" name="aspirante_semestre"
                >
                <option value="">Seleccione un semestre</option>
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
          <label class="form-group has-float-label seltitulo">
            <select class="form-control form-control-lg selcolor" required name="aspirante_nacimiento_estado"
              onChange="curp();" id="selector_estado_nacimiento_aspirante">
              <option value="">Seleccione el estado de nacimiento</option>
              <option value="otro">NACIÓ EN OTRO PAÍS</option>

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
            <input type="text" pattern="[A-Za-z0-9]{18}" title="Faltan datos" 
              class="form-control text-uppercase" id="aspirante_curp" name="aspirante_curp" 
              onchange="valida(this);" placeholder="CURP" style="color: #237087">
            <label for="aspirante_curp">CURP</label>
          </div>
        </div>
        <div class="col-md-4">
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
              <select class="form-control form-control-lg selcolor" id="aspirante_nacionalidad" required name="aspirante_nacionalidad">
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
                 placeholder="Lugar de nacimiento"style="color: #237087 ">
              <label for="aspirante_lugar_nacimiento">Lugar de Nacimiento</label>
            </div>
          </div>

                            </div>
                            </div>

      <div class="form-group">
        <div class="row">
        <div class=" col-md-2 ">
          <label class="form-group has-float-label text-center" style="font-size: 12pt; font-weight: bold; color:#777;">Fecha de registro de Acta</label>
          </div>

          <div class=" col-md-2 ">
          <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="aspirante_anio_nacimiento_registro"  name="aspirante_anio_nacimiento_registro" onclick="get_dias_registro()">

              </select>
              <span>Año</span>
            </label>
          </div>
          <div class="col-md-2">
          <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="aspirante_mes_nacimiento_registro"  name="aspirante_anio_nacimiento_registro" onclick="get_dias_registro()">
              <option value="">Seleccione uno</option>
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
          <div class="col-md-2 ">
          <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" id="aspirante_dia_nacimiento_registro"  name="aspirante_dia_nacimiento_registro" onchange="validaracta()">

              </select>
              <span>Día</span>
            </label>
          </div>


        </div>

      </div>


    <!--direccion------------------------------------------------------>
    <p class="text-center text-white rounded titulo-form h4">Dirección familiar del Aspirante</p>
    <hr>


    <div class="form-group">

      <div class="row">

        <div class="col-md-4">
          <label class="form-group has-float-label seltitulo" >
            <select class="form-control form-control-lg selcolor"  name="aspirante_direccion_estado" required
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
          <label class="form-group has-float-label seltitulo" >
            <select class="form-control form-control-lg selcolor"  name="aspirante_direccion_municipio" required
            onChange="cambio_municipio(selector_municipio_aspirante,selector_localidad_aspirante)"
              id="selector_municipio_aspirante">
              <option value="">Seleccione un municipio</option>

            </select>
            <span>Municipio</span>
          </label>

        </div>

        <div class="col-md-4">
          <label class="form-group has-float-label seltitulo" >
            <select class="form-control form-control-lg selcolor"  name="aspirante_direccion_localidad" required
              id="selector_localidad_aspirante">
              <option value="">Seleccione una localidad</option>


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
            <input type="text" 
              title="La direccion tiene caracteres incorrectos"  class="form-control text-uppercase" 
              id="aspirante_direccion_calle" name="aspirante_direccion_calle"  style="color: #237087"
              placeholder="Calle y número">
            <label for="aspirante_direccion_calle">Calle y número</label>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-label-group">
            <input type="text"  title="La colonia tiene caracteres incorrectos"
              class="form-control text-uppercase" id="aspirante_direccion_colonia"
              name="aspirante_direccion_colonia" placeholder="Colonia/Sección/Paraje/Barrio" style="color: #237087">
            <label for="aspirante_direccion_colonia">Colonia/Sección/Paraje/Barrio</label>
          </div>
        </div>

        <div class="col-md-2">
          <div class="form-label-group">
            <input type="number" pattern="[0-9]{5}" title="El código postal solo debe contener 5 dígitos"
              class="form-control text-uppercase" id="aspirante_direccion_cp" name="aspirante_direccion_cp"
              placeholder="Código Postal" style="color: #237087">
            <label for="aspirante_direccion_cp">Código Postal</label>
          </div>
        </div>
      </div>

    </div>

    <!--fin direccion------------------------------------------------------>

      <!--direccion procedencia------------------------------------------------------>
      <p class="text-center text-white rounded titulo-form h4">Dirección de procedencia del Aspirante</p>
      <hr>

      <div class="form_group">
        <div class="row">
        <div class="col-md-8">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_combo" required
                id="aspirante_procedencia_combo" onchange="procedencia_combo();">
                <option value="">Seleccione una</option>
                <option value="igual">Dirección de procedencia igual a direccion actual</option>
                <option value="diferente">Dirección de procedencia diferente a direccion actual</option>
                <option value="extranjero">Dirección de procedencia del extranjero</option>

              </select>
              <span>Procedencia</span>
            </label>
          </div>                    
      </div>                  
    </div>


      <div class="form-group">

        <div class="row">

          <div class="col-md-4" id="aspirante_procedencia_estado_oculto" style="display:none">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_estado" 
                onChange="cambio_estado(aspirante_procedencia_estado,aspirante_procedencia_municipio,aspirante_procedencia_localidad)"
                id="aspirante_procedencia_estado">
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


          <div class="col-md-4" id="aspirante_procedencia_municipio_oculto" style="display:none">
            <label class="form-group has-float-label seltitulo" >
              <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_municipio" 
              onChange="cambio_municipio(aspirante_procedencia_municipio,aspirante_procedencia_localidad)"
                id="aspirante_procedencia_municipio">
                <option value="">Seleccione un municipio</option>

              </select>
              <span>Municipio</span>
            </label>

          </div>

          <div class="col-md-4" id="aspirante_procedencia_localidad_oculto" style="display:none">
            <label class="form-group has-float-label seltitulo" >
              <select class="form-control form-control-lg selcolor"  name="aspirante_procedencia_localidad" 
                id="aspirante_procedencia_localidad">
                <option value="">Seleccione una localidad</option>


              </select>
              <span>Localidad</span>
            </label>
          </div>

          <div class="col-md-4" id="aspirante_procedencia_extranjero_oculto" style="display:none">
            <div class="form-label-group">
              <input type="text" class="form-control text-uppercase" id="aspirante_procedencia_extranjero" name="aspirante_procedencia_extranjero"
                placeholder="Ingrese la localidad" style="color: #237087 ">
              <label for="aspirante_procedencia_extranjero">Ingrese la localidad</label>
            </div>
          </div>


      </div>



      </div>

      <!--fin direccion procedencia------------------------------------------------------>


    <!--datos tutor------------------------------------------------------>
    <p class="text-center text-white rounded titulo-form h4">Datos de Tutor</p>
    <hr>

    <div class="form-group">

      <div class="row">
        <div class="col-md-4">
          <div class="form-label-group">
            <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required
              title="Introduzca solo letras" class="form-control text-uppercase" id="aspirante_tutor_nombre"
              name="aspirante_tutor_nombre" placeholder="Nombre Completo" style="color: #237087">
            <label for="aspirante_tutor_nombre">Nombre de Tutor</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-label-group">
            <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" required
              title="Introduzca solo letras" class="form-control text-uppercase" id="aspirante_tutor_apellido"
              name="aspirante_tutor_apellido" placeholder="Primer Apellido" style="color: #237087">
            <label for="aspirante_tutor_apellido">Primer Apellido</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-label-group">
            <input type="text" pattern="[A-ZÑña-z]+[ ]*[A-ZÑña-z ]*" title="Introduzca solo letras"
              class="form-control text-uppercase" id="aspirante_tutor_apellidodos" name="aspirante_tutor_apellidodos"
              placeholder="Segundo Apellido" style="color: #237087">
            <label for="aspirante_tutor_apellidodos">Segundo Apellido</label>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">

        <div class="col-md-4">
          <label class="form-group has-float-label seltitulo">
            <select class="form-control form-control-lg selcolor"  id="aspirante_tutor_parentesco" required
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
            <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
              class="form-control text-uppercase" id="aspirante_tutor_otro" name="aspirante_tutor_otro"
              placeholder="Escriba el parentesco" style="color: #237087">
            <label for="aspirante_tutor_otro">Escriba el parentesco</label>
          </div>
        </div>
      </div>





      <div class="form-group">

        <div class="row">
          <div class="col-md-3">
            <div class="form-label-group">
              <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z ]*" 
                title="Introduzca solo letras" class="form-control text-uppercase" id="aspirante_tutor_ocupacion"
                name="aspirante_tutor_ocupacion" placeholder="Ocupación" style="color: #237087">
              <label for="aspirante_tutor_ocupacion">Ocupación</label>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-label-group">
              <input type="number" title="El numero de telefono debe de ser a 13 dígitos con lada"
                class="form-control text-uppercase" id="aspirante_tutor_telefono" name="aspirante_tutor_telefono"
                placeholder="Teléfono particular" style="color: #237087">
              <label for="aspirante_tutor_telefono">Teléfono particular</label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-label-group">
              <input type="number" title="El numero de telefono debe de ser a 13 digitos con lada"
                class="form-control text-uppercase" id="aspirante_tutor_telefono_comunidad"
                name="aspirante_tutor_telefono_comunidad" placeholder="Teléfono de la comunidad" style="color: #237087">
              <label for="aspirante_tutor_telefono_comunidad">Teléfono de la comunidad</label>
            </div>
          </div>


          <div class="col-md-3">
            <div class="form-label-group">
              <input type="text" class="form-control text-uppercase" id="aspirante_tutor_prospera"
                name="aspirante_tutor_prospera" placeholder="Folio de Prospera" style="color: #237087">
              <label for="aspirante_tutor_prospera">Folio de Prospera</label>
            </div>
          </div>
        </div>

      </div>

      <!--fin tutor------------------------------------------------------>


      <!--datos lengua materna------------------------------------------------------>
      <p class="text-center text-white rounded titulo-form h4">Datos de lengua materna</p>
      <hr>

      <div class="form-group">

        <div class="row">
          <div class="col-md-2">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control selcolor" onchange="lenguas_evento(this)"  id="aspirante_lengua_nombre" required
                name="aspirante_lengua_nombre">
                <option value="">Seleccione una lengua</option>

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
              <select class="form-control selcolor" id="aspirante_lengua_lee" name="aspirante_lengua_lee" disabled>
                <option value="0">Nada 0%</option>
                <option value="25">Poco 25%</option>
                <option value="50">Regular 50%</option>
                  <option value="75">Bien 75%</option>
                  <option value="100">Muy bien 100%</option>
              </select>
              <span>Lee</span>
            </label>
          </div>

          <div class="col-md-2">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control selcolor" id="aspirante_lengua_habla" name="aspirante_lengua_habla" disabled>
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
              <select class="form-control selcolor" id="aspirante_lengua_escribe" name="aspirante_lengua_escribe" disabled>
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
              <select class="form-control selcolor" id="aspirante_lengua_entiende" name="aspirante_lengua_entiende"
                disabled>
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
              <select class="form-control selcolor" id="aspirante_lengua_traduce" name="aspirante_lengua_traduce" disabled>
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

<div class="col-md-2"  >
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
              <p class="text-center text-white rounded titulo-form h4">Datos de Secundaria de procedencia</p>
        <hr>

        <div class="form-group">

          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">

                <input list="secundarias" class="form-control text-uppercase" id="aspirante_secundaria_cct"
                  name="aspirante_secundaria_cct" placeholder="Buscar secundaria por CCT" style="color: #237087 ">
                <datalist id="secundarias">

                  <?php
                              foreach ($secundarias as $secundaria)
                              {
                                      echo '<option value="'.$secundaria->cct_escuela_procedencia.'">';
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
                  Buscar secundaria
                </button>


              </div>
              <br>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4" style="display: none" id="nombre_secundaria_oculto">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                  title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_secundaria_nombre" name="aspirante_secundaria_nombre"
                  placeholder="Nombre de Secundaria" style="color: #237087 ">
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

        <!--fin datos secundaria------------------------------------------------------>



      <!--datos bachillerato------------------------------------------------------>
      <p class="text-center text-white rounded titulo-form h4">Datos de Bachillerato de procedencia</p>
      <hr>

      <div class="form-group">

        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">

              <input list="bachilleratos" class="form-control text-uppercase" id="aspirante_bachillerato_cct"
                name="aspirante_bachillerato_cct" placeholder="Buscar Bachillerato por CCT" style="color: #237087">
              <datalist id="bachilleratos">

                <?php
                            foreach ($bachilleratos as $bachillerato)
                            {
                                    echo '<option value="'.$bachillerato->cct_escuela_procedencia.'">';
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
                Buscar Bachillerato
              </button>


            </div>
            <br>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4" style="display: none" id="nombre_bachillerato_oculto">
            <div class="form-label-group">
              <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                id="aspirante_bachillerato_nombre" name="aspirante_bachillerato_nombre"style="color: #237087"
                placeholder="Nombre de Bachillerato">
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

      <!--documentos solicitados------------------------------------------------------>
      <p class="text-center text-white rounded titulo-form h4">Documentos solicitados para generación de Matrícula
      </p>
      <hr>



      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="aspirante_documento_acta_nacimiento"
            id="aspirante_documento_acta_nacimiento" value="1" unchecked onchange="checkacta();">
          Acta de Nacimiento
        </label>
      </div>

      <div class="form-check" id="aspirante_documento_carta_extemporaneo_oculto" style="display:none">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_carta_extemporaneo"
              id="aspirante_documento_carta_extemporaneo" value="7" checked>
            Carta de registro extemporaneo
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

      <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_certificado_parcial"
              id="aspirante_documento_certificado_parcial" value="5" unchecked onclick="checkbachillerato()">
            Certificado Parcial de Estudios
          </label>
        </div>


        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="aspirante_documento_resolucion"
              id="aspirante_documento_resolucion" value="6" unchecked>
            Solicitud de Equivalencia
          </label>
        </div>
        <br>


      <!-- fin documentos solicitados------------------------------------------------------>

      <!--documentos extras------------------------------------------------------>
      <p class="text-center text-white rounded titulo-form h4">Documentos Extras</p>
      <hr>



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
      <button type="submit" id="btn_enviar" class="btn btn-success btn-lg btn-block"
        style="padding: 1.5rem">Registrar</button>


  </form>

</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->



<!-- Modal -->
<div class="modal fade" id="nuevobachillerato" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Agregar nuevo Bachillerato</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">
              <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                id="aspirante_nuevobachillerato_cct" name="aspirante_nuevobachillerato_cct" style="color: #237087"
                placeholder="CCT de Bachillerato">
              <label for="aspirante_nuevobachillerato_cct">C C T</label>
            </div>
            <br>
          </div>
          <div class="col-md-4">
            <div class="form-label-group">
              <input type="text" ppattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                class="form-control text-uppercase" id="aspirante_nuevobachillerato_nombre" style="color: #237087"
                name="aspirante_nuevobachillerato_nombre" placeholder="Nombre de Bachillerato">
              <label for="aspirante_nuevobachillerato_nombre">Nombre de Bachillerato</label>
            </div>
            <br>
          </div>

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor" name="aspirante_nuevobachillerato_tipo_subsistema" 
                  id="aspirante_nuevobachillerato_tipo_subsistema" onchange="otro_secundaria();">
                <option value="">Seleccione un tipo</option>
                <option value="TELESECUNDARIA">Educación Profesional Técnica</option>
                <option value="GENERAL">Bachillerato General</option>
                <option value="PARTICULAR">Bachillerato Tecnológico</option>
                <option value="OTRO">Otro</option>
              </select>
              <span>Tipo de Subsistema</span>
            </label>
          </div>

          <div class="col-md-4" style="display: none" id="otro_secundaria_oculto">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                  title="El tipo de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_secundaria_tipo_otro" name="aspirante_secundaria_tipo_otro"
                  placeholder="Tipo de Bachillerato" style="color: #237087">
                <label for="aspirante_secundaria_tipo_otro">Tipo de Bachillerato</label>
              </div>
            </div>
          

        </div>
        <br>

        <div class="row">

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="selector_estado_bachillerato"
              onChange="cambio_estado(document.getElementById('selector_estado_bachillerato'),document.getElementById('selector_municipio_bachillerato'),document.getElementById('selector_localidad_bachillerato'))"
                  id="selector_estado_bachillerato">
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
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="aspirante_bachillerato_municipio"
              onChange="cambio_municipio(document.getElementById('selector_municipio_bachillerato'),document.getElementById('selector_localidad_bachillerato'))"
                  id="selector_municipio_bachillerato">
                <option></option>


              </select>
              <span>Municipio</span>
            </label>
          </div>

          <div class="col-md-4">
            <label class="form-group has-float-label seltitulo">
              <select class="form-control form-control-lg selcolor"  name="aspirante_bachillerato_localidad"
                id="selector_localidad_bachillerato">
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
      <button type="button" class="btn btn-success" id="insertarsecundaria" onclick="insertar_bachillerato()">Guardar</button>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="nuevasecundaria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 80% !important;" role="document">
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
                <input type="text" pattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                  title="El nombre de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_nuevasecundaria_cct" name="aspirante_nuevasecundaria_cct"
                  placeholder="CCT de Secundaria" style="color: #237087 ">
                <label for="aspirante_nuevasecundaria_cct">C C T</label>
              </div>
              <br>
            </div>
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" ppattern="[A-ZÁÉÍÓÚáéíóúa-z0-9]+[ ]*[A-ZÁÉÍÓÚáéíóúa-z0-9]*" 
                  class="form-control text-uppercase" id="aspirante_nuevasecundaria_nombre"
                  name="aspirante_secundaria_nombre" placeholder="Nombre de Secundaria" style="color: #237087 ">
                <label for="aspirante_nuevasecundaria_nombre">Nombre de Secundaria</label>
              </div>
              <br>
            </div>

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor" name="aspirante_nuevasecundaria_tipo_subsistema" 
                  id="aspirante_nuevasecundaria_tipo_subsistema" onchange="otro_secundaria();">
                  <option value="">Seleccione un tipo</option>
                  <option value="TELESECUNDARIA">Telesecundaria</option>
                  <option value="GENERAL">General</option>
                  <option value="PARTICULAR">Particular</option>
                  <option value="TÉCNICA">Técnica</option>
                  <option value="COMUNITARIA">Comunitaria</option>
                  <option value="OTRO" >Otro</option>
                </select>
                <span>Tipo de Subsistema</span>
              </label>
            </div>

            <div class="col-md-4" style="display: none" id="otro_secundaria_oculto">
              <div class="form-label-group">
                <input type="text" pattern="[A-Za-zÉÁÍÓÚÑéáíóúñ. 0-9]+"
                  title="El tipo de la secundaria contiene caracteres incorrectos" class="form-control text-uppercase"
                  id="aspirante_secundaria_tipo_otro" name="aspirante_secundaria_tipo_otro"
                  placeholder="Tipo de Secundaria" style="color: #237087 ">
                <label for="aspirante_secundaria_tipo_otro">Tipo de Secundaria</label>
              </div>
            </div>

          </div>
          <br>


          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="selector_estado_secundaria"
                onChange="cambio_estado(document.getElementById('selector_estado_secundaria'),document.getElementById('selector_municipio_secundaria'),document.getElementById('selector_localidad_secundaria'))"
                  id="selector_estado_secundaria">
                  <option value ="">Seleccione un estado</option>

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
                <select class="form-control form-control-lg selcolor"  name="selector_municipio_secundaria"
                  onChange="cambio_municipio(document.getElementById('selector_municipio_secundaria'),document.getElementById('selector_localidad_secundaria'))"
                  id="selector_municipio_secundaria">
                  <option></option>


                </select>
                <span>Municipio</span>
              </label>
            </div>

            <div class="col-md-4">
              <label class="form-group has-float-label seltitulo">
                <select class="form-control form-control-lg selcolor"  name="selector_localidad_secundaria"
                  id="selector_localidad_secundaria">
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
  cargar_anio();
  cargar_anio_registro();

  function obtener_secundaria(e) {
    console.log(e);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
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
function obtener_bachillerato(e) {
  console.log(e);
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '<?php echo base_url();?>index.php/c_escuela_procedencia/get_escuela?cct=' + e, true);
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
      xhr.onload = function(){
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
        text: 'Este Bachillerato no existe porfavor agreguelo:',
        showCancelButton: true,
        confirmButtonText: 'Agregar',
        cancelButtonText: 'Cancelar',
      }).then((result) => {
        if (result.value) {
          $('#nuevobachillerato').modal().show();
          cctbachillerato();

        }
      })
    }
  };

  xhr.send(null);

}


var form = document.getElementById("formulario");
form.onsubmit = function (e) {
  if (document.getElementById("aspirante_secundaria_cct").value === '') {
    console.log("vacio");
    swalWithBootstrapButtons.fire({
      type: 'warning',
      text: 'Esta tratando de agregar un alumno sin Secundaria',
      showCancelButton: true,
      confirmButtonText: 'Registrar',
      allowOutsideClick: false,
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
  bPreguntar = false;
  var formdata = new FormData(form);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "<?php echo base_url();?>index.php/c_estudiante/registrar_datos_estudiante", true);
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
      $('#div_carga').hide();
      if (xhr.responseText.trim() === "si") {
        Swal.fire({
          type: 'success',
          title: 'Registro exitoso',
          allowOutsideClick: false,
          confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.value) {
              //aqui va el aceptar
              $(document).scrollTop(0);
              location.reload();
            }
            //aqui va si cancla
          }); 
      }

      else {
        Swal.fire({
          type: 'error',
          title: 'Ya existe un alumno registrado con ese curp o no selecciono la secundaria de procedencia',
          showConfirmButton: false,
          timer: 2500
        });
      }
    }
  }
  xhr.send(formdata);

}

function insertar_bachillerato() {
  if(document.getElementById("aspirante_nuevobachillerato_cct").value === ''||document.getElementById("aspirante_nuevobachillerato_nombre").value === ''||document.getElementById("aspirante_nuevobachillerato_tipo_subsistema").value===''){
    Swal.fire({
          type: 'error',
          title: 'Bachillerato no agregado',
          confirmButtonText: 'Cerrar'

        })
  }else{

  let secundaria = "";
  secundaria = {
    "cct_escuela_procedencia": document.getElementById("aspirante_nuevobachillerato_cct").value.toUpperCase(),
    "nombre_escuela_procedencia": document.getElementById("aspirante_nuevobachillerato_nombre").value,
    "tipo_subsistema": document.getElementById("aspirante_nuevobachillerato_tipo_subsistema").value,
    "id_localidad_escuela_procedencia": parseInt(document.getElementById("selector_localidad_bachillerato").value),
    "tipo_escuela_procedencia": "BACHILLERATO"
  };

  document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevobachillerato_cct").value + '">'
  //console.log(secundaria);
  var xhr = new XMLHttpRequest();
  
  xhr.open("POST", '<?php echo base_url();?>index.php/c_escuela_procedencia/insert_escuela', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      $('#div_carga').hide();
      if (xhr.responseText.trim() === "si") {
        Swal.fire({
          type: 'success',
          title: 'Bachillerato agregado correctamente',
          showConfirmButton: false,
          timer: 2500
        })
        $('#nuevobachillerato').modal('toggle');
        obtener_bachillerato(document.getElementById("aspirante_bachillerato_cct").value);
      } else {
        Swal.fire({
          type: 'error',
          title: 'Bachillerato no agregado',
          confirmButtonText: 'Cerrar'

        })
      }

    }
  }
  xhr.send(JSON.stringify(secundaria));

  }
}

function insertar_secundaria() {
    if(document.getElementById("aspirante_nuevasecundaria_cct").value === ''||document.getElementById("aspirante_nuevasecundaria_nombre").value === ''||document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value===''){
    Swal.fire({
          type: 'error',
          title: 'Secundaria no agregada',
          confirmButtonText: 'Cerrar'

        })
   }else{
    let secundaria = "";
    secundaria = {
      "cct_escuela_procedencia": document.getElementById("aspirante_nuevasecundaria_cct").value,
      "nombre_escuela_procedencia": document.getElementById("aspirante_nuevasecundaria_nombre").value,
      "tipo_subsistema": document.getElementById("aspirante_nuevasecundaria_tipo_subsistema").value,
      "id_localidad_escuela_procedencia": parseInt(document.getElementById("selector_localidad_secundaria").value),
      "tipo_escuela_procedencia": "SECUNDARIA"
    };

    document.getElementById("secundarias").innerHTML += '<option value="' + document.getElementById("aspirante_nuevasecundaria_cct").value + '">'
    //console.log(secundaria);
    var xhr = new XMLHttpRequest();
    
    xhr.open("POST", '<?php echo base_url();?>index.php/c_escuela_procedencia/insert_escuela', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onloadstart = function(){
        $('#div_carga').show();
      }
      xhr.error = function (){
        console.log("error de conexion");
      }

    xhr.onreadystatechange = function () {
      if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        $('#div_carga').hide();
        if (xhr.responseText.trim() === "si") {
          Swal.fire({
            type: 'success',
            title: 'Secundaria agregada correctamente',
            showConfirmButton: false,
            timer: 2500
          })
          $('#nuevasecundaria').modal('toggle');
          obtener_secundaria(document.getElementById("aspirante_secundaria_cct").value);
        } else {
          Swal.fire({
            type: 'error',
            title: 'Secundaria no agregada',
            confirmButtonText: 'Cerrar'
          })
        }

      }
    }
    xhr.send(JSON.stringify(secundaria));

  }

}
var bPreguntar = true;
window.onbeforeunload = preguntarAntesDeSalir;
function preguntarAntesDeSalir()
{
  if (bPreguntar)
    return "¿Seguro que quieres salir?";
}

</script>