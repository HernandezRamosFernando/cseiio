            <!-- Bootstrap core JavaScript-->


    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url();?>assets/js/sb-admin.min.js"></script>

        <!-- scripts para alerts -->
  

  <script src="<?php echo base_url();?>assets/js/cambio_estado.js"></script>
  <script src="<?php echo base_url();?>assets/js/cambio_municipio.js"></script>
 
  <script>
            $("#sidebar-toggle").click(function(e) {
                e.preventDefault();
                $("body").toggleClass("sidebar-toggled")
                $(".sidebar").toggleClass("toggled")
            });
        </script>
    </body>
</html>