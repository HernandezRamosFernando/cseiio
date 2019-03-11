 <script type="text/javascript">
$(document).ready(function() {

function estilotabla() { 
    $('#dataTables-example').DataTable({
            responsive: true
     });
 }

estilotabla();

//empieza codigo del modulo de contratos del procedimiento a agregar
 $('#idubicacion').change(function(e) {
    var idubicacion = $("#idubicacion").val();
    var ajax_data = {"idubicacion":idubicacion};
   $.ajax({
                type: "POST",
                url:"<?=base_url()?>AdminContrato/ajaxdireccion",
                data:ajax_data,
                success: function(mag){
                     
                  }
                  
            }).done(function (data) {
                $("#iddireccion").html(data);
                $('#iddepartamento').html('<option value="">Seleccione el depto.</option>');

            }).fail(function (jqXHR, textStatus, errorThrown) {
            
            });  

             $.ajax({
                type: "POST",
                url:"<?=base_url()?>AdminContrato/ajaxcategoria",
                data:ajax_data,
                success: function(mag){
                     
                  }
                  
            }).done(function (data) {
                $("#idcategoria").html(data);

            }).fail(function (jqXHR, textStatus, errorThrown) {
            
            });              
});


  $('#iddireccion').change(function(e) {
    var iddireccion = $("#iddireccion").val();
    var ajax_data = {"iddireccion":iddireccion};
   $.ajax({
                type: "POST",
                url:"<?=base_url()?>AdminContrato/ajaxdepartamento",
                data:ajax_data,
                success: function(mag){
                     
                  }
                  
            }).done(function (data) {
                if(data=='desabilitar_campo'){
                    $("#iddepartamento").prop('disabled', true);
                     $('#iddepartamento').html('<option value="">Sin departamentos</option>');
                }
                else{
                    $("#iddepartamento").prop('disabled', false);
                    $('#iddepartamento').html(data);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
            
            });                
});

//


$('#agregarcontrato').submit(function(e) {
        e.preventDefault();

        var me = $(this);

        // perform ajax
        $.ajax({
             url:"<?php echo base_url()?>AdminContrato/agregarcontrato",
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success == true) {
                    // if success we would show message
                    // and also remove the error class
                    location.href ="<?php echo base_url()?>AdminContrato/listaContratos?id="+response.id;
                    $('#the-message').html('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Los datos del empleado han sido guardados exitosamente.' +
                        '</div>');
                    $('.form-group .group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();

                    // reset the form
                    me[0].reset();

                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    })
                }
                else {

                    $('#the-message').html('<div class="alert alert-danger">' +
                        '<span class="fa fa-warning mensajeerror"></span> AVISO!<BR/>' +
                        ' Se han producido los siguientes errores.' +
                        '</div>');
                    $.each(response.messages, function(key, value) {
                        var element = $('#' + key);
                        
                        element.closest('div.form-group .group')
                        .removeClass('has-error')
                        .addClass(value.length > 0 ? 'has-error' : 'has-success')
                        .find('.text-danger')
                        .remove();
                        
                        element.after(value);
                    });
                }
            }
        });
    });


//Metodos para la plantilla de actualización de contratos
 $(document).on("click", '.modalmodificar', function(){
        var idcontrato = $(this).data('idcontrato');
        var ajax_data = {"idcontrato":idcontrato};
        $.ajax({
                    type: "POST",
                    url:"<?php echo base_url()?>AdminContrato/interfazmodificar",// Ajax que muestra la interfaz para modificar empleados de acuerdo al ID.
                    data:ajax_data,
                    success: function(mag){
                        
                      }
                }).done(function (data) {
                    $("#ajaxmodificar").html(data);

                }).fail(function (jqXHR, textStatus, errorThrown) {
                
                });
     });


  $(document).on("change", '#midubicacion', function(){
    var idubicacion = $("#midubicacion").val();
    var ajax_data = {"idubicacion":idubicacion};
   $.ajax({
                type: "POST",
                url:"<?=base_url()?>AdminContrato/ajaxdireccion",
                data:ajax_data,
                success: function(mag){
                     
                  }
                  
            }).done(function (data) {
                $("#middireccion").html(data);
                $('#middepartamento').html('<option value="">Seleccione el depto.</option>');
                //$("#midubicacion").val($contrato->idubicacion);

            }).fail(function (jqXHR, textStatus, errorThrown) {
            
            });  

             $.ajax({
                type: "POST",
                url:"<?=base_url()?>AdminContrato/ajaxcategoria",
                data:ajax_data,
                success: function(mag){
                     
                  }
                  
            }).done(function (data) {
                $("#midcategoria").html(data);

            }).fail(function (jqXHR, textStatus, errorThrown) {
            
            });      
     });


$(document).on("change", '#middireccion', function(){
    var iddireccion = $("#middireccion").val();
    var ajax_data = {"iddireccion":iddireccion};
   $.ajax({
                type: "POST",
                url:"<?=base_url()?>AdminContrato/ajaxdepartamento",
                data:ajax_data,
                success: function(mag){
                     
                  }
                  
            }).done(function (data) {
                if(data=='desabilitar_campo'){
                    $("#middepartamento").prop('disabled', true);
                     $('#middepartamento').html('<option value="">Sin departamentos</option>');
                }
                else{
                    $("#middepartamento").prop('disabled', false);
                    $('#middepartamento').html(data);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
            
            });   
     });

//script que permite modificar los datos de un contrato


$(document).on("submit", '#modificarcontrato', function(e){
    e.preventDefault();
        var me = $(this);

        // perform ajax
        $.ajax({
             url:"<?php echo base_url()?>AdminContrato/modificarcontrato",
            type: 'post',
            data: me.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success == true) {
                    // if success we would show message
                    // and also remove the error class
                    $('#the-message').html('<div class="alert alert-success">' +
                        '<span class="glyphicon glyphicon-ok"></span>' +
                        ' Los datos del empleado han sido guardados exitosamente.' +
                        '</div>');
                    $('.form-group .group').removeClass('has-error')
                                    .removeClass('has-success');
                    $('.text-danger').remove();

                    // reset the form
                    me[0].reset();

                    // close the message after seconds
                    $('.alert-success').delay(500).show(10, function() {
                        $(this).delay(3000).hide(10, function() {
                            $(this).remove();
                        });
                    })
                }
                else {

                    $('#the-message').html('<div class="alert alert-danger">' +
                        '<span class="fa fa-warning mensajeerror"></span> AVISO!<BR/>' +
                        ' Se han producido los siguientes errores.' +
                        '</div>');
                    $.each(response.messages, function(key, value) {
                        var element = $('#' + key);
                        
                        element.closest('div.form-group .group')
                        .removeClass('has-error')
                        .addClass(value.length > 0 ? 'has-error' : 'has-success')
                        .find('.text-danger')
                        .remove();
                        
                        element.after(value);
                    });
                }
            }
        });
    });

});
</script>