<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Bootstrap core CSS-->
     <link href="http://192.168.1.115/app/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="http://192.168.1.115/app/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="http://192.168.1.115/app/assets/css/sb-admin.css" rel="stylesheet">

    <link href="http://192.168.1.115/app/assets/vendor/bootstrap/css/bootstrap-float-label.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-body">
         
           
        
        <div class="form-group">

       <div class="row">
           <div class="col-md-4">
           <div class="form-label-group">
           <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control" id="aspirante_nombre" id="aspirante_nombre" placeholder="Nombre(s)">
           <label for="aspirante_nombre">Nombre(s)</label>
           </div>
           </div>

           <div class="col-md-4">
           <div class="form-label-group">
           <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control" id="aspirante_apellido_paterno" id="aspirante_apellido_paterno" placeholder="Apellido Paterno">
           <label for="aspirante_apellido_paterno">Apellido Paterno</label>
           </div>
           </div>

           <div class="col-md-4">
           <div class="form-label-group">
           <input type="text" pattern="[A-Za-zñ]+" title="Introduzca solo letras" class="form-control" id="aspirante_apellido_materno" id="aspirante_apellido_materno" placeholder="Apellido Materno">
           <label for="aspirante_apellido_materno">Apellido Materno</label>
           </div>
           </div>
       </div>
       

       </div>

       <div class="form-group">
       <div class="row">
           
       
       <div class="col-md-4">
            <label class="form-group has-float-label">
            <select class="form-control custom-select" required="required" id="aspirante_plantel" name="aspirante_plantel">
            
            <?php
            foreach ($planteles as $plantel)
            {
                    echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_corto_plantel.'</option>';
            }
            ?>

          </select>
          <span>Plantel</span>
            </label>
       
        </div>

        <div class="col-md-4">
            <button type='button' class="btn btn-primary" onclick='buscar()'>Buscar</button>
            </div>
        
       </div>
       </div>

       
         
        </div>
    </div>
</div>
    

    <div class="container">
        <div class="card">
            <div class="card-body">
              <table class="table">
                  <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Apellido Paterno</th>
                          <th>Apellido Materno</th>
                          <th>CURP</th>
                          <th>Semestre</th>
                          <th>Editar</th>
                      </tr>
                  </thead>
                  <tbody id="tabla">
                     
                  </tbody>
              </table>
            </div>
        </div>
    </div>






    <!-- Bootstrap core JavaScript-->
<script src="http://192.168.1.115/app/assets/vendor/jquery/jquery.min.js"></script>
    <script src="http://192.168.1.115/app/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="http://192.168.1.115/app/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <script>
    function buscar(){
        document.getElementById("tabla").innerHTML = "";
        var xhr = new XMLHttpRequest();
        var nombre = document.getElementById("aspirante_nombre").value;
        var apellido_paterno = document.getElementById("aspirante_apellido_paterno").value;
        var apellido_materno = document.getElementById("aspirante_apellido_materno").value;
        var plantel = document.getElementById("aspirante_plantel").value; 
        var query = 'nombre='+nombre+'&apellido_paterno='+apellido_paterno+'&apellido_materno='+apellido_materno+'&plantel='+plantel;

        xhr.open('GET', 'http://localhost/app/c_aspirante/buscar_aspirantes_nombre?'+query, true);

        xhr.onload = function () {
        console.log(JSON.parse(xhr.response));
        //console.log(query);


               JSON.parse(xhr.response).forEach(function(valor,indice){
                    var fila = '<tr>';

                        fila+= '<td>';
                        fila+= valor.nombre;
                        fila+= '</td>';

                        fila+= '<td>';
                        fila+= valor.apellido_paterno;
                        fila+= '</td>';

                        fila+= '<td>';
                        fila+= valor.apellido_materno;
                        fila+= '</td>';

                        fila+= '<td>';
                        fila+= valor.curp;
                        fila+= '</td>';

                        fila+= '<td>';
                        fila+= valor.semestre;
                        fila+= '</td>';

                        fila+= '<td>';
                        fila+= '<button type="button" class="btn btn-primary">Editar</button>';
                        fila+= '</td>';

                        fila+= '</tr>';

                        document.getElementById("tabla").innerHTML += fila;
               });

             


        };

        xhr.send(null);
    }
    
    </script>
</body>
</html>