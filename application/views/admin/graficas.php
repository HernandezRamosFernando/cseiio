 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

 <div id="content-wrapper">

<div class="container-fluid ">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Gráficas</a>
    </li>
    <li class="breadcrumb-item active">Seleccione un elemento de los mostrados</li>
  </ol>

  <div class="card">
      <div class="card-body">
      <div class="form-group">
          <div class="row">
            <div class="col-md-8 ">
            <label class="form-group has-float-label seltitulo">
            <!-- aqui va el selecct de las graficas hasta ahora --> 
            <select class="form-control form-control-lg selcolor" id="graficas" required name="graficas" onchange="selectgraficas()">
            <option value="">Seleeccione una grafica a crear</option>  
            <option value="1">Cantidad de alumnos en cada plantel</option>
              <option value="2">Cantidad de hombres y mujeres en los planteles</option>
              <option value="3">Diferentes tipos de ingreso de alumnos en los planteles</option>
              <option value="4">Estatus de los alumnos en los planteles</option>
              <option value="5">Alumnos inscritos en este periodo y anteriores</option>
              <option value="6">Procedencia de alumnos inscritos por distrito</option>
              <option value="7">Estudiantes hablantes de lengua materna</option>
              <option value="8">Materias reprobadas de los alumnos por plantel</option>
              </select>
              <span>Graficas</span>
            </label>
            </div>
            

          </div>
        </div>
 
<div id="div_grafica">
 <canvas id="myChart" width="600" height="400"></canvas>
</div>



      </div>
    </div>


</div>
</div>
<!-- /.content-wrapper -->

 <script>

 function selectgraficas (e){
  switch (e.value) {
  case '1':

    break;
  case '2':

    break;
  case '3':

    break;
  case '4':

  break;
  case '5':

  break;
  case '6':

  break;
  case '7':
  
  break;
  case '8':
  
  break;
  default:
  
    Swal.fire({
            type: 'info',
            title: 'Seleccione un elemento',
            confirmButtonText: 'Cerrar'
          });
    break;
}
 }

 function mujeres_hombres(){
     //peticion de datos
     var xhr = new XMLHttpRequest();
          xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/hombres_mujeres_total', true);

          xhr.onload = function () {
            console.log(JSON.parse(xhr.response));
            let datos = JSON.parse(xhr.response);
            //etiquetas,valores,colores rgb
            grafica(['Hombres','Mujeres'],[parseInt(datos[0].total),parseInt(datos[1].total)],['rgb(54, 162, 235)','rgb(255, 99, 132)'],'doughnut');
          };

          xhr.send(null);


}


function estudiantes_por_plantel(){

  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/estudiantes_por_plantel', true);

      xhr.onload = function () {
        let datos = JSON.parse(xhr.response);

        var etiquetas = new Array();
        var valores = new Array();
        var colores = new Array();

        datos.forEach(function(valor,indice){

          etiquetas.push(valor.nombre_plantel);
          valores.push(parseInt(valor.total));
          colores.push('rgb('+numero_aleatorio()+', '+numero_aleatorio()+', '+numero_aleatorio()+')');

        });

        grafica(etiquetas,valores,colores,'pie');
      };

      xhr.send(null);

}



function estudiantes_hablan_lengua(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/estudiantes_hablan_lengua', true);

      var etiquetas = new Array();
        var valores = new Array();
        var colores = new Array();

      xhr.onload = function () {
        let datos = JSON.parse(xhr.response);
        
        datos.forEach(function(valor,indice){
        etiquetas.push(valor.nombre_lengua);
        valores.push(parseInt(valor.total));
        colores.push('rgb('+numero_aleatorio()+', '+numero_aleatorio()+', '+numero_aleatorio()+')');
        });

        grafica(etiquetas,valores,colores,'pie');
      };

      xhr.send(null);
}


function numero_aleatorio(){
  return parseInt(Math.random() * (256 - 0) + 0);
}




//etiuetas y valores es un arreglo
function grafica(etiquetas,valores,colores,tipo){

  document.getElementById("div_grafica").innerHTML="";
  document.getElementById("div_grafica").innerHTML='<canvas id="myChart" width="600" height="400"></canvas>';
   //grafica
var ctx = document.getElementById('myChart').getContext('2d'); 





var myChart = new Chart(ctx, {
    type: tipo,
    data: {
        labels: etiquetas,
        datasets: [{
            label: '# of Votes',
            data: valores,
            backgroundColor: colores,
            borderWidth: 1
        }]
    },
    options: {
    }
});
}

</script>