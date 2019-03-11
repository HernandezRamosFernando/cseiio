<div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">HISTORIAL DE CONTRATOS DEL EMPLEADO: <strong><?php echo strtoupper($nombrecompleto)?></strong></h4>
                </div>
                <!-- /.col-lg-12 -->
 </div>

 <div id="the-message"></div>

 <form class="form-horizontal" role="form" method="post" id="nuevocontrato" action="<?=base_url()?>AdminContrato/nuevoContrato">

  <input class="form-control" id="nombrecompleto" type="hidden" placeholder="" name="nombrecompleto" value="<?php echo $nombrecompleto?>" />
  <input class="form-control" id="idempleado" type="hidden" placeholder="" name="idempleado" value="<?php echo $idempleado?>" />
 <div class="row">
 	    <div class="col-lg-12">
 	    	<div class="pull-right" >
          <button type="submit" class="btn btn-success" name="guardar" value="guardar" >Crear Contrato <span class="glyphicon glyphicon-ok" ></span></button>
                </div>
            </div>
 </div>
</form>

<br/>
<br/>  

<?php
    if(!is_null($listacontrato)){

    ?>
    <div id="ajaxlista">
   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-md-1">Tipo Contrato</th>
                                        <th scope="col" class="col-md-1">Ubicación</th>
                                        <th scope="col" class="col-md-3">Dirección</th>
                                        <th scope="col" class="col-md-1">Departamento</th>
                                        <th scope="col" class="col-md-1">Categoria</th>
                                        <th scope="col" class="col-md-1">Riesgo</th>
                                        <th scope="col" class="col-md-1">Fecha de Inicio y Término</th>
                                        <th scope="col" class="col-md-1"></th>
                                        <th scope="col" class="col-md-1"></th>
                                        <th scope="col" class="col-md-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    //$cont=1;
                                    foreach($listacontrato->result_array() as $contrato){
                                      echo '<tr class="odd gradeA">';
                                      echo '<td class="text-center">'.$contrato['tcontrato'].'</td>';
                                      echo '<td class="text-center">'.$contrato['idubicacion'].'</td>';
                                      echo '<td class="text-center">'.$contrato['direccion'].'</td>';
                                      echo '<td class="text-center">'.$contrato['departamento'].'</td>';
                                      echo '<td class="text-center">'.$contrato['categoria'].'</td>';
                                      echo '<td class="text-center">'.$contrato['tiporiesgo'].'</td>';
                                      echo '<td class="text-center">'.$contrato['fechainicio'].' / '.$contrato['fechatermino'].'</td>';
                                      echo '<td class="text-center"><a href="'.base_url().'AdminContrato/contratoPDF?id='.$idempleado.'" class="btn btn-primary">PDF</a></td>';
                                      echo '<td class="text-center"><a href="'.base_url().'AdminContrato/listaContratos" class="btn btn-primary">Adjuntar<br/>contrato</a></td>';
                                      echo '<td class="text-center"><a href="#ventanamodificar" data-toggle="modal" class="modalmodificar" data-idcontrato="'.$contrato['idcontrato'].'" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></a></td>';
                                      echo '</tr>';
                                          
                                    }

                                   ?>
                                 
                                    
                                </tbody>
                            </table>

     </div>
 
 <?php

 }
 else{
   echo '
   <div class="alert alert-info alert-dismissable">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>¡Aviso!</strong> Ningun contrato se encuentra asociado a este empleado, genere un contrato, para mostrar el historial.
</div>';
 }
 ?>
<!-- Inicia la parte de modals de eliminacion logica de empleados-->
 <!-- Modal -->
  <div class="modal fade" id="ventanaeliminar" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modaleliminar">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Baja de empleado</h4>
        </div>
        <div class="modal-body">
          <strong>¿Esta seguro de dar de baja al siguiente empleado?</strong>
          <br/>
          <form class="form-horizontal" role="form" method="post" id="eliminarempleado">
            <div id="ajaxeliminar">
              
            </div>

      <div class="form-group">
            <div class="col-md-6">
              <div class="pull-left">
             
              </div>
              </div>
            <div class="col-md-6">
              <div class="pull-right" >
                <button type="submit" class="btn btn-success" name="guardar" value="guardar" >Guardar <span class="glyphicon glyphicon-ok" ></span></button>
                <button type="reset" class="btn btn-default" data-dismiss="modal" id="btnCancelar">Cancelar <span class="glyphicon glyphicon-remove"></span></button>

              </div>
            </div>
          </div>

          </form>
            
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>
<!-- Termina la parte de modals de eliminacion logica de empleados-->



<!-- Inicia la parte de modals de eliminacion logica de empleados-->
 <!-- Modal -->
  <div class="modal fade" id="ventanamodificar" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header modalprimario">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Contrato</h4>
        </div>
        <div class="modal-body">
            <div id="the-message"></div>
            <div id="ajaxmodificar"></div>
            
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div>