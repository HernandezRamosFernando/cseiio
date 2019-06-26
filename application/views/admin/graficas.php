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
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="estudiantes_por_plantel()" style="padding: 1rem"
                id="btn1"> Estudiantes por plantel</button>
            </div>
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="estudiantes_hablan_lengua()" style="padding: 1rem"
                id="btn2"> Estudiantes que hablan lengua</button>
            </div>
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="()" style="padding: 1rem"
                id="btn3"> Tres</button>
            </div>
            <div class="col-md-4 ">
              <button type="button" class="btn btn-success btn-lg btn-block" onclick="()" style="padding: 1rem"
                id="btn4"> Cuatro</button>
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