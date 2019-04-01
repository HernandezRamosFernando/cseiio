  <div id="content-wrapper">

      <div class="container-fluid ">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a>Crear grupos</a>
          </li>
          <li class="breadcrumb-item active">Ingrese los datos requeridos</li>
        </ol>


        <form action="/cseiio/c_acreditacion/agregar_grupo" method="post">
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

              <div class="col-md-4">
          <label>Cantidad de alumnos</label>
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
              <button type="button" name="" id="" class="btn btn-success btn-lg btn-block" style="padding: 1rem">Crear grupo</button>
            </div>
          </div>
        </div>
      </form>





      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- /#wrapper -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" ¿Seguro que deseas salir?</h5> <button class="close"
            type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script>

function numero_alumnos(e){
if(document.getElementById("aspirante_plantel").value===""){
alert("debe seleecionar un plantel");
}

else{
          var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cseiio/c_acreditacion/numero_estudiantes_semestre_plantel?semestre='+e.value+'&cct='+document.getElementById("aspirante_plantel").value, true);

        xhr.onload = function () {
         console.log(xhr.response);
         document.getElementById("cantidad_alumnos").innerHTML = "Cantidad de Alumnos: "+JSON.parse(xhr.response)[0].total_estudiante;
        };

        xhr.send(null);
}


}
</script>

