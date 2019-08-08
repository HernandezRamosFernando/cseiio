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

  <div class="card">
      <div class="card-body">
      <div class="form-group">
          <div class="row">
            <div class="col-md-8 ">
            <label class="form-group has-float-label seltitulo">
            <!-- aqui va el selecct de las graficas hasta ahora --> 
            <select class="form-control form-control-lg selcolor" id="graficas" required name="graficas" onchange="selectgraficas(this)">
            <option value="">Seleeccione una grafica a crear</option>  
            <option value="1">Cantidad de alumnos en cada plantel</option>
              <option value="2">Cantidad de hombres y mujeres en los planteles</option>
              <option value="3">Diferentes tipos de ingreso de estudiantes</option>
              <option value="4">Estatus de los alumnos en los planteles</option>
              <option value="5">Alumnos inscritos en este periodo y anteriores</option>
              <option value="6">Procedencia de alumnos inscritos por distrito</option>
              <option value="7">Estudiantes hablantes de lengua materna</option>
              <option value="8">Materias con mas reprobados</option>
              </select>
              <span>Graficas</span>
            </label>
            </div>
            

          </div>
        </div>
 
<div id="div_grafica">
<div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>


<div id="total_datos">

</div>
</div>



      </div>
    </div>


</div>
</div>
<script src="<?php echo base_url();?>assets/css/chartist.min.js"></script>
<!-- /.content-wrapper -->

 <script>

 function selectgraficas (e){
  switch (e.value) {
  case '1':
  total_estudiantes_por_plantel();
    break;
  case '2':
  numero_estudiantes_hombres_mujeres_por_plantel();
    break;
  case '3':
  estudiantes_tipo_ingreso();
    break;
  case '4':
  estatus_estudiantes_por_plantel();
  break;
  case '5':

  break;
  case '6':
  estudiantes_por_distrito();
  break;
  case '7':
  estudiantes_lengua();
  break;
  case '8':
  materias_con_reprobados();
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



function total_estudiantes_por_plantel(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/total_estudiantes_por_plantel', true);

      xhr.onload = function () {
        console.log(xhr.response);
        var planteles = new Array();
        var totales = new Array();
        var total_estudiantes = 0;
        JSON.parse(xhr.response).forEach(function(valor,indice){

          planteles.push(valor.plantel);
          totales.push(parseInt(valor.total_estudiantes));
          total_estudiantes += parseInt(valor.total_estudiantes);

        });

        //grafica despues de tener los datos
      Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Cantidad total de estudiantes por plantel'
          },
          xAxis: {
            categories: planteles
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Numero de estudiantes'
            }
          },
          credits: {
            enabled: false
          },
          plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
              }
            }
          }
          ,
          series: [{
            name: 'Total',
            data: totales
          }]
        });


        document.getElementById('total_datos').innerHTML = '<h3>Total de estudiantes: '+total_estudiantes;
      };

      xhr.send(null);

      
}


 function numero_estudiantes_hombres_mujeres_por_plantel(){

  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/numero_estudiantes_hombres_mujeres_por_plantel', true);

      xhr.onload = function () {
        console.log(xhr.response);
        var planteles = new Array();
        var hombres = new Array();
        var mujeres = new Array();
        var total_hombres = 0;
        var total_mujeres = 0;
        JSON.parse(xhr.response).forEach(function(valor,indice){
          planteles.push(valor.plantel);
          hombres.push(parseInt(valor.hombres));
          mujeres.push(parseInt(valor.mujeres));
          total_hombres += parseInt(valor.hombres);
          total_mujeres += parseInt(valor.mujeres);
        });

        //console.log(planteles);

        //grafica despues de tener los datos
        Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Cantidad de estudiantes hombres y mujeres por plantel'
          },
          xAxis: {
            categories: planteles
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Numero de estudiantes'
            }
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Hombres',
            data: hombres
          }, {
            name: 'Mujeres',
            data: mujeres
          }]
        });

        //------------------------------------
        //cargar totales en div
        document.getElementById('total_datos').innerHTML = '<h3>Total de Hombres: '+total_hombres+'</h3><h3>Total de Mujeres: '+total_mujeres+'</h3>';
      };

      xhr.send(null);

 }




 function estatus_estudiantes_por_plantel(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/estatus_estudiantes_por_plantel', true);

      xhr.onload = function () {
        console.log(xhr.response);
        var planteles = new Array();
        var regulares = new Array();
        var irregulares = new Array();
        var total_regulares = 0;
        var total_irregulares = 0;

        JSON.parse(xhr.response).forEach(function(valor,indice){

          planteles.push(valor.nombre_corto);
          regulares.push(parseInt(valor.regulares));
          irregulares.push(parseInt(valor.irregulares));

          total_regulares+=parseInt(valor.regulares);
          total_irregulares+=parseInt(valor.irregulares);

        });


        //grafica cargar
        Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Cantidad de estudiantes regulares e irregulares por plantel'
          },
          xAxis: {
            categories: planteles
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Numero de estudiantes'
            }
          },
          credits: {
            enabled: false
          },
          series: [{
            name: 'Regulares',
            data: regulares
          }, {
            name: 'Irregulares',
            data: irregulares
          }]
        });
        

        document.getElementById('total_datos').innerHTML = '<h3>Total de Regulares: '+total_regulares+'</h3><h3>Total de Irregulares: '+total_irregulares+'</h3>';

      };

      xhr.send(null);
 }




 function estudiantes_por_distrito(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/estudiantes_por_distrito', true);

      xhr.onload = function () {
        console.log(xhr.response);
        var datos = new Array();
        JSON.parse(xhr.response).forEach(function(valor,indice){

          datos.push([valor.distrito,parseInt(valor.total)]);

        });

        ///grafica
        Highcharts.chart('container', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'Procedencia de estudiantes por distrito'
            },
            xAxis: {
              type: 'category',
              labels: {
                rotation: -45,
                style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                }
              }
            },
            yAxis: {
              min: 0,
              title: {
                text: 'Numero de estudiantes'
              }
            },
            legend: {
              enabled: false
            },
            tooltip: {
              pointFormat: '<b>{point.y:.0f} estudiantes</b>'
            },
            plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
              }
            }
          },
            series: [{
              name: 'Population',
              data:datos
              
            }]
});
      };

      xhr.send(null);
 }






 function estudiantes_lengua(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/estudiantes_lengua', true);

      xhr.onload = function () {
        //lengua, leen, hablan, escriben, entienden, traducen
        var lenguas = new Array();
        var leen = new Array();
        var hablan = new Array();
        var escriben = new Array();
        var entienden = new Array();
        var traducen = new Array();
        JSON.parse(xhr.response).forEach(function(valor,indice){

          lenguas.push(valor.lengua);

          leen.push(parseInt(valor.entienden));
          hablan.push(parseInt(valor.hablan));
          escriben.push(parseInt(valor.escriben));
          entienden.push(parseInt(valor.entienden));
          traducen.push(parseInt(valor.traducen));

        });



        //grafica
        Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Estudiantes hablantes de lengua materna'
          },
          xAxis: {
            categories: lenguas
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Numero de estudiantes'
            }
          },
          tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
            shared: true
          },
          series: [{
            name: 'leen',
            data: leen
          }, {
            name: 'hablan',
            data: hablan
          }, {
            name: 'escriben',
            data: escriben
          }, {
            name: 'entienden',
            data: entienden
          }, {
            name: 'traducen',
            data: traducen
          }]
        });
      };

      xhr.send(null);
 }



 function materias_con_reprobados(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/materias_con_reprobados', true);


      xhr.onload = function () {
        var datos = new Array();

        JSON.parse(xhr.response).forEach(function(valor,indice){
          datos.push([valor.unidad_contenido,parseInt(valor.reprobados)]);
        });
        console.log(xhr.response);

        ///grafica
        Highcharts.chart('container', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'Materias con reprobados'
            },
            xAxis: {
              type: 'category',
              labels: {
                rotation: -45,
                style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                }
              }
            },
            yAxis: {
              min: 0,
              title: {
                text: 'Numero de estudiantes'
              }
            },
            legend: {
              enabled: false
            },
            tooltip: {
              pointFormat: '<b>{point.y:.0f} estudiantes</b>'
            },
            plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
              }
            }
          },
            series: [{
              name: 'Population',
              data:datos
              
            }]
});
      };

      xhr.send(null);
 }



 function estudiantes_tipo_ingreso(){
  var xhr = new XMLHttpRequest();
      xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/estudiantes_tipo_ingreso', true);

      xhr.onload = function () {
        console.log(xhr.response);
        var datos = new Array();
        JSON.parse(xhr.response).forEach(function(valor,indice){
          datos.push([valor.tipo_ingreso,parseInt(valor.total)]);
        });

         ///grafica
         Highcharts.chart('container', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'Tipos de ingreso de estudiantes'
            },
            xAxis: {
              type: 'category',
              labels: {
                rotation: -45,
                style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                }
              }
            },
            yAxis: {
              min: 0,
              title: {
                text: 'Numero de estudiantes'
              }
            },
            legend: {
              enabled: false
            },
            tooltip: {
              pointFormat: '<b>{point.y:.0f} estudiantes</b>'
            },
            plotOptions: {
            series: {
              borderWidth: 0,
              dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
              }
            }
          },
            series: [{
              name: 'Population',
              data:datos
              
            }]
});
      };

      xhr.send(null);
 }


</script>