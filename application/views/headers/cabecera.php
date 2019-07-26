<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Language" content="es">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">




  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>assets/css/sb-admin.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">
  <!--<link href="<?php echo base_url();?>assets/vendor/material-design-icons/iconfont/material-icons.css" rel="stylesheet">-->
  <script src="<?php echo base_url();?>assets/js/sweetalert2.all.min.js"></script>
  <!--<script src="<?php echo base_url();?>assets/vendor/promise-polyfill.js"></script> -->
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

  <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/funciones.js"></script>


  <title><?=$title?></title>

  <script>
    function cargar_notificaciones() {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_notificacion/notificaciones_plantel?plantel=<?php echo $this->session->userdata('user')['plantel'] ?>', true);
      
      xhr.onload = function () {
        // aqui estan las notificaciones
        var a = "";
        if (JSON.parse(xhr.response).length != 0) {
          $("#ic_notificacion").text('notifications_active');
          $("#ic_notificacion").css("color", "red");
          JSON.parse(xhr.response).forEach(function (valor, indice) {
            a = "<a class='dropdown-item'><span style= 'font-weight: bold'>" + valor.titulo + "</span><br> <span class='btn-responsive' >" + valor.mensaje + "</span><br> <span class='notificacion'>Enviado: " + valor.autor + "</span></a>";
            $("#icononotificacion").append(a);
          });
        } else {
          a = "<a class='dropdown-item'><span style= 'font-weight: bold'>No tiene notificaciones </span></a>";
          $("#icononotificacion").append(a);
        }
      };
      xhr.send(null);



      //peticion de permisos de parciales-------------------------------------
      var permisos_parciales = new XMLHttpRequest();
      permisos_parciales.open('GET', '<?php echo base_url();?>index.php/c_permisos/get_permiso_plantel?plantel=<?php echo $this->session->userdata('user')['plantel'] ?>', true);

      permisos_parciales.onload = function () {
        if(permisos_parciales.response.length != 2){
        let permisos = JSON.parse(permisos_parciales.response)[0];

        if(permisos.primer_parcial==="1" || permisos.segundo_parcial==="1" || permisos.tercer_parcial==="1"){
            //aqui va la alerta que mostrara si tiene permisos de parciales
            if(permisos.examen_final==="1"){
              $("#alerta").css("display", "");
              $("#alerta").append('Hay permisos de parciales y examen final y terminan el <strong>'+permisos.fecha_fin+'</strong>')
            }

            else{
              $("#alerta").css("display", "");
              $("#alerta").append('Hay permisos de parciales y terminan el <strong>'+permisos.fecha_fin+'</strong>')
            }
        }
        else if(permisos.examen_final==="1"){
          $("#alerta").css("display", "");
          $("#alerta").append('Hay permisos de examen final y terminan el <strong>'+permisos.fecha_fin+'</strong>')
        }
        else{
          $("#alerta").css("display", "none");
        }
      };
      }

      permisos_parciales.send(null);
      


      //permisos de regularizacion-------------------------------------
      var permisos_regularizacion = new XMLHttpRequest();
          permisos_regularizacion.open('GET', '<?php echo base_url();?>index.php/c_permisos/permisos_regularizacion_plantel?plantel=<?php echo $this->session->userdata('user')['plantel'] ?>', true);

          permisos_regularizacion.onload = function () {
            if(JSON.parse(permisos_regularizacion.response).length>0){
              $("#alerta_reg").css("display", "");
              $("#alerta_reg").append('Recuerde que hay periodo de regularizacion');
            }else{
              $("#alerta_reg").css("display", "none");
            }
          };
          permisos_regularizacion.send(null);
    }

    $(document).ready(function () {
      cargar_notificaciones();
    });
  </script>


</head>