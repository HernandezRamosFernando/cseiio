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
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="mujeres_hombres()" style="padding: 1rem"
                id="agregar_usuario"> Mujeres hombres</button>
            </div>

          </div>
        </div>
 
<div>
 <canvas id="myChart" width="600" height="400"></canvas>
</div>



      </div>
    </div>


</div>
</div>
<!-- /.content-wrapper -->

 <script>

 function mujeres_hombres(){
     var hombres_valor ="";
     var mujeres ="";
    var hombres = new XMLHttpRequest();
    hombres.open('GET', '<?php echo base_url();?>index.php/c_graficas/count_estudiantes_hombres' , true);
    hombres.onloadstart = function () {
      $('#div_carga').show();
    }
    hombres.error = function () {
      console.log("error de conexion");
    }
    hombres.onload = function () {
      $('#div_carga').hide();
      JSON.parse(hombres.response).forEach(function (valor, indice) {
      hombres_valor = valor.hombres;
      });
    }
    hombres.send(null);

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url();?>index.php/c_graficas/count_estudiantes_mujeres' , true);
    xhr.onloadstart = function () {
      $('#div_carga').show();
    }
    xhr.error = function () {
      console.log("error de conexion");
    }
    xhr.onload = function () {
      $('#div_carga').hide();
      JSON.parse(xhr.response).forEach(function (valor, indice) {
        mujeres = valor.mujeres;
      });
      
    }
    xhr.send(null);

    console.log(hombres_valor);

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Hombres', 'Mujeres', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 16, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
    }
});
}
</script>