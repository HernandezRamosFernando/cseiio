<div id="wrapper">
  <!-- Barra de lado izquierdo -->
  <ul class="sidebar navbar-nav toggled ">
    <li class="nav-item ">
      <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
      <i class="material-icons">menu</i>
        <span>Menú</span>
      </a>
    </li>

    <li class="nav-item dropdown ">
      <a class="nav-link dropdown-toggle  <?php ($this->uri->segment(2)=='inscripcion') ? print 'bg-info text-light' : print 'null'; ?>"
        data-toggle="dropdown" href="/cseiio/index.php/c_menu/inscripcion" role="button">
        <i class="material-icons">group_add</i>
        <span class="font-weight-light">Inscripción<span>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item btn-responsive btn-primary  <?php ($this->uri->segment(2)=='nuevo_ingreso') ? print 'bg-info text-light' : print 'null'; ?>" href="/cseiio/index.php/c_aspirante/nuevo_ingreso">
        <i class="material-icons">person_add</i>
          <span class="font-weight-light">Inscripción Nuevo Ingreso
          </span>
        </a>
        <a class="dropdown-item btn-responsive " href="/cseiio/index.php/c_aspirante/portabilidad">
        <i class="material-icons">person_outline</i>
          <span class="font-weight-light">Inscripción Portabilidad
          </span>
        </a>
        <a class="dropdown-item btn-responsive " href="/cseiio/index.php/c_aspirante/asignar_matricula">
        <i class="material-icons">assignment_turned_in</i>
          <span class="font-weight-light">Asignar Matrícula</span>
        </a>
        <a class="dropdown-item btn-responsive " href="/cseiio/index.php/c_aspirante/carta_compromiso">
        <i class="material-icons">thumbs_up_down</i>
          <span class="font-weight-light">Generación de Carta Compromiso</span>
        </a>
      </div>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
      <i class="material-icons">360person</i>
        <span>Reinscripción</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='control_alumnos') ? print 'bg-info text-light ' : print 'null'; ?>" href="/cseiio/index.php/c_aspirante/control_alumnos">
      <i class="material-icons">person</i>
        <span>Control de Alumnos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='acreditacion') ? print 'bg-info text-light ' : print 'null'; ?>" href="/cseiio/index.php/c_acreditacion/acreditacion">
      <i class="material-icons">beenhere</i>  
      <span>Acreditación</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
      <i class="material-icons">assessment</i>  
      <span>Reportes</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
      <i class="material-icons">description</i>  
      <span>Formatos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
      <i class="material-icons">how_to_reg</i>  
      <span>Certificación</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='subir_documentos') ? print 'bg-info text-light' : print 'null'; ?>" href="/cseiio/index.php/c_subir_doc/subir_documentos">
      <i class="material-icons">burst_mode</i>
      <span>Carga de documentos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="/cseiio/index.php/c_menu/principal">
      <i class="material-icons">supervised_user_circle</i>  
      <span>Control de usuarios</span>
      </a>
    </li>

  </ul>