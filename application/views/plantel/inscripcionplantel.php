
    <div id="content-wrapper">

<div class="container-fluid ">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Inscripción</a>
    </li>
    <li class="breadcrumb-item active">Seleccione un elemento de los mostrados</li>
  </ol>

  <!-- Botones-->
  <div class="row position-static" >
    <div class="col-md-4 col-lg-4">
      <a href="<?php echo base_url();?>index.php/c_aspirante/nuevo_ingreso"
        class="btn btn-primary btn-lg btn-block menu valign-center btn-1 btn-responsive">
        <i class="material-icons">person_add</i>&nbsp;
        Inscripción Nuevo Ingreso
      </a>
    </div>
    <div class="col-md-4 col-lg-4">
      <a href="<?php echo base_url();?>index.php/c_aspirante/portabilidad"
        class="btn btn-primary btn-lg btn-block menu valign-center btn-2 btn-responsive">
        <i class="material-icons">person_outline</i>&nbsp;
        Inscripción Portabilidad
      </a>
    </div>
    <div class="col-md-4 col-lg-4">
      <a href="<?php echo base_url();?>index.php/c_aspirante/carta_compromiso"
        class="btn btn-primary btn-lg btn-block menu valign-center btn-4 btn-responsive">
        <i class="material-icons">thumbs_up_down</i>&nbsp;
        Generación de Carta Compromiso
      </a>
    </div>
    <!--
    <div class="col col-lg-4">
      <a href="<?php echo base_url();?>index.php/c_aspirante/carta_compromiso"
        class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-clipboard-check btn-responsive"
        style="height: 80%; background: #B7156D; border-color: #B7156D; padding: 13% ">
        Crear ciclo escolar
      </a>
    </div>
    <div class="col col-lg-4">
      <a href="<?php echo base_url();?>index.php/c_aspirante/carta_compromiso"
        class="btn btn-primary btn-lg btn-block stretched-link center-block fas fa-clipboard-check btn-responsive"
        style="height: 80%; background: #B7156D; border-color: #B7156D; padding: 13% ">
        Datos de secundaria
      </a>
    </div>
    -->
  </div>


</div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
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
        console.log(JSON.parse(xhr.response).length === 0);
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


