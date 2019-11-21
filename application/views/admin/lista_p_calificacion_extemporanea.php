<div id="content-wrapper">

  <div class="container-fluid ">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a>Lista de permisos de subir calificaciones extemporaneas</a>
      </li>
      <li class="breadcrumb-item active"></li>
    </ol>

    <form class="card" id="formulario" name="formulario" >
      <div class="form-group">

        <div class="col-md-12" id="tabla_planteles">
          <div class="card card-body">
            <table class="table table-hover" id="tabla_completa_planteles" style="width: 100%">
              <caption>Lista de los planteles</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="col-md-1">Nombre</th>
                  <th scope="col" class="col-md-1">CCT</th>
                  <th scope="col" class="col-md-1">Materia</th>
                  <th scope="col" name="parcial1" class="col-md-1">Parcial 1</th>
                  <th scope="col" name="parcial1" class="col-md-1">Parcial 2</th>
                  <th scope="col" name="parcial1" class="col-md-1">Parcial 3</th>
                  <th scope="col" name="parcial1" class="col-md-1">Examen Final</th>
                  <th scope="col" name="parcial1" class="col-md-1">Fecha Inicio</th>
                  <th scope="col" name="parcial1" class="col-md-1">Fecha Termino</th>
                </tr>
              </thead>

              <tbody id="tablaplantel">

              </tbody>
            </table>
          </div>
        </div>


      </div>
    </form>

  </div>
</div>
<!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->


<script>
function cargar_permisos(){
  var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/C_permisos_extemporaneo/lista_permisos', true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }

    xhr.onload = function () {
      $('#div_carga').hide();
      if(JSON.parse(xhr.response).length>0){
        let tabla = document.getElementById("tablaplantel");
        JSON.parse(xhr.response).forEach(function(valor,indice){
          if(valor.fecha==="0"){//si tiene permiso pero ya vencio la fecha
            var fila = '<tr class="table-warning">';
            fila+='<td>'+valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre+'</td>';
            fila+='<td>'+valor.Plantel_cct_plantel+'</td>';
            fila+='<td>'+valor.id_materia+'</td>';
            fila+='<td>'+valor.primer_parcial+'</td>';
            fila+='<td>'+valor.segundo_parcial+'</td>';
            fila+='<td>'+valor.tercer_parcial+'</td>';
            fila+='<td>'+valor.examen_final+'</td>';
            fila+='<td>'+valor.fecha_inicio+'</td>';
            fila+='<td>'+valor.fecha_fin+'</td>';
            tabla.innerHTML+=fila;
          }

          else{//si tiene permiso y la fecha sigue vigente
            var fila = '<tr class="table-success">';
            fila+='<td>'+valor.primer_apellido+' '+valor.segundo_apellido+' '+valor.nombre+'</td>';
            fila+='<td>'+valor.Plantel_cct_plantel+'</td>';
            fila+='<td>'+valor.id_materia+'</td>';
            fila+='<td>'+valor.primer_parcial+'</td>';
            fila+='<td>'+valor.segundo_parcial+'</td>';
            fila+='<td>'+valor.tercer_parcial+'</td>';
            fila+='<td>'+valor.examen_final+'</td>';
            fila+='<td>'+valor.fecha_inicio+'</td>';
            fila+='<td>'+valor.fecha_fin+'</td>';
            tabla.innerHTML+=fila;
          }
        });
      }
    };

    xhr.send(null);
}


cargar_permisos();

</script>