  <div id="content-wrapper">

      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Crear grupos</a>
          </li>
          <li class="breadcrumb-item active">Ingrese los datos requeridos</li>
        </ol>


        <form id="formulario">
        <div class="form-group">

            <div class="row">
              <div class="col-md-8">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="aspirante_plantel"
                    name="aspirante_plantel">
                    <option value="">Seleccione el plantel donde creara el grupo</option>

                    <?php
                                        foreach ($planteles as $plantel)
                                        {
                                          echo '<option value="'.$plantel->cct.'">'.$plantel->nombre_plantel.' ----- CCT: '.$plantel->cct.'</option>';
                                        }
                                        ?>

                  </select>
                  <span>Plantel</span>
                </label>
              </div>

            </div>

          </div>

        <div class="form-group">
          <div class="row">

            <div class="col-md-4">
              <label class="form-group has-float-label">
                <select class="form-control form-control-lg" onchange="numero_alumnos(this)" name="semestre_grupo" id="semestre_grupo">
                <option value="0">Seleccione uno</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
                <span>Seleccione el semestre del grupo a crear</span>
              </label>
            </div>
          

          <div class="col-md-4">
              <label class="form-group has-float-label">
                <select class="form-control form-control-lg" name="" id="">
                <option value="NO">No</option>
                </select>
                <span>¿Es de especialidad?</span>
              </label>
            </div>

          <div class="col-md-4">
          <label id="cantidad_alumnos">Cantidad de alumnos:</label>
          </div>


          </div>
        </div>

          <div class="row">
          <div class="col-md-4">
                <label class="form-group has-float-label">
                  <select class="form-control form-control-lg" required="required" id="grupo_ciclo_escolar"
                    name="grupo_ciclo_escolar">
                    <option>Seleccione el ciclo del grupo <i class="fa fa-graduation-cap" aria-hidden="true"></i></option>

                    <?php
                                        foreach ($ciclo_escolar as $ciclo)
                                        {
                                          echo '<option value="'.$ciclo->id_ciclo_escolar.'">'.$ciclo->nombre_ciclo_escolar.'</option>';
                                        }
                                        ?>

                  </select>
                  <span>Ciclo escolar</span>
                </label>
              </div>

          </div>

          <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" required="required" title="Introduzca solo letras" class="form-control"
                  id="grupo_nombre" name="grupo_nombre" placeholder="Nombre de grupo">
                <label for="grupo_nombre">Ingrese el nombre del grupo</label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <div class="form-label-group">
                <input type="text" required="required" title="Introduzca solo letras" class="form-control"
                  id="grupo_periodo" name="grupo_periodo" placeholder="Periodo del grupo(s)">
                <label for="grupo_periodo">Perido del grupo</label>
              </div>
            </div>

            <div class="col-md-4 offset-md-3">
              <button type="submit" class="btn btn-success btn-lg btn-block" style="padding: 1rem">Crear grupo</button>
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

function numero_alumnos(e){
if(document.getElementById("aspirante_plantel").value===""){
alert("debe seleecionar un plantel");
}

else{
          var xhr = new XMLHttpRequest();
        xhr.open('GET', '<?php echo base_url();?>c_acreditacion/numero_estudiantes_semestre_plantel?semestre='+e.value+'&cct='+document.getElementById("aspirante_plantel").value, true);

        xhr.onload = function () {
         console.log(xhr.response);
         document.getElementById("cantidad_alumnos").innerHTML = "Cantidad de Alumnos: "+JSON.parse(xhr.response)[0].total_estudiante;
        };

        xhr.send(null);
}


}
</script>


<script>   

var form = document.getElementById("formulario");
	form.onsubmit = function(e){
		e.preventDefault();
		var formdata = new FormData(form);
		var xhr =  new XMLHttpRequest();
		xhr.open("POST","<?php echo base_url();?>index.php/c_acreditacion/agregar_grupo",true);
    xhr.onreadystatechange = function() { 
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      //console.log();
      if(xhr.responseText.trim()==="si"){
        Swal.fire({
            type: 'success',
            title: 'Registro exitoso',
            showConfirmButton: false,
            timer: 2500 
          });

          document.getElementById("formulario").reset();
          document.getElementById("selector_municipio_aspirante").value="";
          document.getElementById("selector_localidad_aspirante").value="";
      }

      else{
        Swal.fire({
            type: 'error',
            title: 'No se puede crear el grupo',
            showConfirmButton: false,
            timer: 2500 
          });
      }
    }
}
		xhr.send(formdata);
		
	}

</script>
</html>
