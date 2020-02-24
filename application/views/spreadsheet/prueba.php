<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Importar datos de alumno de ciclos anteriores</a>
      </li>
      <li class="breadcrumb-item active">Seleccione un archivo en excel</li>
    </ol>

    <div class="card">
      <div class="card-body">
      
		  <?php 
          
          $this->load->library('form_validation');
          
          if(form_error('fileURL')) {?>    
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php print form_error('fileURL'); 
                
                ?>
            </div>       
        <?php } ?>

        <?php if($this->session->flashdata('msg_exito')): ?>
          <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
    <p><?php echo $this->session->flashdata('msg_exito'); 
    echo '<script>window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
  }, 2000);</script>';
    ?></p>
    </div>
<?php endif; ?>
      

      
        <form action="<?php print site_url();?>C_prueba/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row padall">
        <div class="col-lg-4 order-lg-1">
          
          <input type="file" id="validatedCustomFile" name="fileURL">
          
        </div>
        <div class="col-lg-6 order-lg-2">
          <button type="submit" name="import" class="btn btn-primary">Importar Excel</button>
        </div>
      </div>
    </form>
      </div>
    </div>
    
  </div>


</div>
<!-- /.content-wrapper -->


  