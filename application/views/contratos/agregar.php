	
<div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">CREAR CONTRATO DE: <strong><?php echo strtoupper($nombrecompleto)?></strong></h4>
                </div>
                <!-- /.col-lg-12 -->
 </div>
<div id="the-message"></div>
<form class="form-horizontal" role="form" method="post" id="agregarcontrato" action="">
<input class="form-control" id="nombrecompleto" type="hidden" placeholder="" name="nombrecompleto" value="<?php echo $nombrecompleto?>" />
<input class="form-control" id="idempleado" type="hidden" placeholder="" name="idempleado" value="<?php echo $idempleado?>" />

<fieldset class="scheduler-border">
    <legend class="scheduler-border">Datos Generales</legend>
<div class="form-group">
          <div class="group">
              <label for="numempleado" class="col-md-2">Fecha de Inicio<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-3"><input class="form-control" id="fechainicio" type="date" placeholder="" name="fechainicio"/> 
              </div>
            </div>

         <div class="group">
           <label for="numproyecto" class="col-md-2">Fecha de Termino<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-3"><input class="form-control" id="fechatermino" type="date" placeholder="" name="fechatermino"/> 
              </div>
          </div>
  </div>


  <div class="form-group">
              <div class="group">
           <label for="idcontrato" class="col-md-2">Tipo de Contrato<samp class="obligatorio">*</samp>:</label>
               <div class="col-md-3">
                    <select name="idtipocontrato" id="idtipocontrato" class="form-control">
                            <option value="">Seleccione el tipo</option>
                            <?php
                          foreach($listatcontrato->result() as $tipocontrato)
                            {
                              echo '<option value='.$tipocontrato->idtipo.'>'.$tipocontrato->nombre.'</option>';  
                            }
                          ?>
                    </select> 
                  </div>
          </div>
            <div class="group">
              <label for="idubicacion" class="col-md-2">Lugar de trabajo<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-4">
                    <select name="idubicacion" id="idubicacion" class="form-control">
                            <option value="">Seleccione la ubicación</option>
                             <option value="OF">Oficinas Centrales</option>
                             <option value="PLANTEL">Planteles</option>

                    </select> 
                  </div>
            </div>

  </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border">Área de Adscripción</legend>
<div class="form-group">

          <div class="group">
              <label for="iddireccion" class="col-md-2">Dirección<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-10">
                    <select name="iddireccion" id="iddireccion" class="form-control">
                            <option value="">Seleccione la dirección</option>

                    </select> 
                  </div>
            </div>

      </div>

<div class="form-group">
             <div class="group">
           <label for="iddepartamento" class="col-md-2">Departamento<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-10">
                    <select name="iddepartamento" id="iddepartamento" class="form-control">
                            <option value="">Seleccione el depto.</option>
                    </select> 
                  </div>
          </div>
  </div>
<div class="form-group">
          <div class="group">
              <label for="idcategoria" class="col-md-2">Categoria<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-10">
                    <select name="idcategoria" id="idcategoria" class="form-control">
                            <option value="">Seleccione la categoria</option>
                    </select> 
                  </div>
          </div>
      </div>
<div class="form-group">
         <div class="group">
           <label for="idriesgotrabajo" class="col-md-3">Clase de Riesgo de Trabajo<samp class="obligatorio">*</samp>:</label>
              <div class="col-md-4">
                    <select name="idriesgotrabajo" id="idriesgotrabajo" class="form-control">
                            <option value="">Seleccione el tipo de riesgo</option>
                            <?php
                          foreach($listariesgo->result() as $riesgo)
                            {
                              echo '<option value='.$riesgo->idriesgo.'>'.$riesgo->tiporiesgo.'</option>';  
                            }
                          ?>
                    </select> 
                  </div>
          </div>
      </div>
 </fieldset>

<div class="form-group">
          <div class="col-md-6">
            <div class="pull-left">
            Los campos marcados con <samp class="obligatorio">*</samp> son obligatorios.
            </div>
            </div>
        <div class="col-md-6">
          <div class="pull-right" >
            <button type="submit" class="btn btn-success" name="guardar" value="guardar" >Aceptar <span class="glyphicon glyphicon-ok" ></span></button>
            <button type="reset" class="btn btn-default" data-dismiss="modal" id="btnCancelar">Cancelar <span class="glyphicon glyphicon-remove"></span></button>

          </div>
        </div>
        </div>
</form>