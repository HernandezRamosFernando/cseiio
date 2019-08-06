 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">


 <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chartist.min.css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
 <script src="https://code.highcharts.com/highcharts.src.js"></script>


 <div id="content-wrapper">

<div class="container-fluid ">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a>Gráficas</a>
    </li>
    <li class="breadcrumb-item active">Seleccione un elemento de los mostrados</li>
  </ol>

 
<div id="div_grafica">
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>



      </div>
    </div>


</div>
</div>
<script src="<?php echo base_url();?>assets/css/chartist.min.js"></script>
<!-- /.content-wrapper -->

 <script>


 function numero_estudiantes_hombres_mujeres_por_plantel(){

  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/numero_estudiantes_hombres_mujeres_por_plantel', true);

      xhr.onload = function () {
        console.log(xhr.response);
        var planteles = new Array();
        JSON.parse(xhr.response).forEach(function(valor,indice){

          planteles.pusg(valor.plantel);

        });

        console.log(planteles);

        //grafica despues de tener los datos
        Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Cantidad de estudantes hombres y mujeres por plantel'
          },
          xAxis: {
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Hombres',
            data: [5, 3, 4, 7, 2]
          }, {
            name: 'Mujeres',
            data: [2, -2, -3, 2, 1]
          }]
        });

        //------------------------------------
      };

      xhr.send(null);

 }


function numero_aleatorio(){
  return parseInt(Math.random() * (256 - 0) + 0);
}




//etiuetas y valores es un arreglo
function grafica(){
  
}

</script>