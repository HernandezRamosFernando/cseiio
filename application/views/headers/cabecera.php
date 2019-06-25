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
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->

  <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/funciones.js"></script>


  <title><?=$title?></title>

  <script>
    function cargar_notificaciones() {
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



      //peticion de permisos de parciales
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '/server', true);

      xhr.onload = function () {
        // Request finished. Do processing here.
      };

      xhr.send(null);

    }

    $(document).ready(function () {
      cargar_notificaciones();
    });
  </script>


</head>