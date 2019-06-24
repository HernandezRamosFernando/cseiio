
                <div id="content-wrapper">
          
          <div class="container-fluid">
  
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a >INICIO</a>
              </li>
              <li class="breadcrumb-item active">Seleccione un elemento de los mostrados</li>
            </ol>

            
  
            <!-- Botones-->
            <div class="row" style="" >
                <div class="col-md-4 col-lg-4">
                    <a href="<?php echo base_url();?>index.php/c_menu/inscripcion" 
                    class="btn btn-primary btn-lg btn-block valign-center  btn-responsive menu btn-1" > 
                    <i class="material-icons">group_add</i> &nbsp;Inscripción
                    </a>
                 
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="../views/reinscripcion.html" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-2" > 
                    <i class="material-icons">redoperson</i> &nbsp;Reinscripción
                    </a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="<?php echo base_url();?>index.php/c_aspirante/control_alumnos" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-3" > 
                    <i class="material-icons">person</i> &nbsp;Control de Alumnos
                    </a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="<?php echo base_url();?>index.php/c_vistas/acreditacion" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-4" > 
                    <i class="material-icons">beenhere</i> &nbsp;Acreditación
                    </a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="../views/reportes.html" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-5" >
                    <i class="material-icons">assessment</i> &nbsp;Reportes
                    </a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="../views/formatos.html" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-6" >
                    <i class="material-icons">description</i> &nbsp;Formatos
                    </a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="../views/certificacion.html" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-7" >
                    <i class="material-icons">assignment_turned_in</i> &nbsp;Certificación
                    </a>
                </div>
                <div class="col-md-4 col-lg-4">
                    <a href="<?php echo base_url();?>index.php/c_subir_doc/subir_documentos" 
                    class="btn btn-primary btn-lg btn-block valign-center btn-responsive menu btn-8" >
                    <i class="material-icons">burst_mode</i> &nbsp;Control de Documentos
                    </a>
                </div>
              </div>
        </div>
        <!-- /.content-wrapper -->
      </div>
      <!-- /#wrapper -->
    </div>
  



     

<script>

function cargar_notificaciones(){
    var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>index.php/c_notificacion/notificaciones_plantel?plantel=<?php echo $this->session->userdata('user')['plantel'] ?>', true);
        xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
        // aqui estan las notificaciones
        console.log(JSON.parse(xhr.response));
        var a = "";
        if(JSON.parse(xhr.response).length != 0){
            $("#ic_notificacion").text('notifications_active');
            $("#ic_notificacion").css( "color", "red" );
        JSON.parse(xhr.response).forEach(function (valor, indice) {
            a="<a class='dropdown-item'><span style= 'font-weight: bold'>" + valor.titulo + "</span><br> <span class='btn-responsive' >" + valor.mensaje +"</span><br> <span class='notificacion'>Enviado: " + valor.autor + "</span></a>";
            $("#icononotificacion").append(a);
          });
        }else{
            a="<a class='dropdown-item'><span style= 'font-weight: bold'>No tiene notificaciones </span></a>";
            $("#icononotificacion").append(a);
        }
        }; 
        xhr.send(null);
}

$( document ).ready(function() {
    cargar_notificaciones();
});

</script>
