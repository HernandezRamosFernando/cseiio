<div id="wrapper">
  <!-- Barra de lado izquierdo -->
  <ul class="sidebar navbar-nav toggled ">
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">menu</i>
        <span>Menú</span>
      </a>
    </li>

    <li class="nav-item dropdown ">
      <a class="nav-link nav-dropdown-toggle  <?php ($this->uri->segment(2)=='inscripcion') ? print 'bg-info text-light' : print null; ?>"
      aria-expanded="false" data-toggle="collapse" href="#submenu" role="button">
        <i class="material-icons">group_add</i>
        <span class="font-weight-light">Inscripción<span>
      </a>
      <div id="submenu" class="<?php ($this->uri->segment(2)=='nuevo_ingreso'||$this->uri->segment(2)=='portabilidad'||$this->uri->segment(2)=='asignar_matricula'||$this->uri->segment(2)=='carta_compromiso') ? print 'null' : print 'collapse'; ?> sidebar-submenu">
        <a class="nav-link <?php ($this->uri->segment(2)=='nuevo_ingreso') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_aspirante/nuevo_ingreso">
        <i class="material-icons">person_add</i>
          <span class="font-weight-light">Inscripción Nuevo Ingreso
          </span>
        </a>
        <a class="nav-link  <?php ($this->uri->segment(2)=='portabilidad') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_aspirante/portabilidad">
        <i class="material-icons">person_outline</i>
          <span class="font-weight-light">Inscripción Portabilidad
          </span>
        </a>
        <a class="nav-link  <?php ($this->uri->segment(2)=='asignar_matricula') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_aspirante/asignar_matricula">
        <i class="material-icons">assignment_turned_in</i>
          <span class="font-weight-light">Asignar Matrícula</span>
        </a>
        <a class="nav-link   <?php ($this->uri->segment(2)=='carta_compromiso') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_aspirante/carta_compromiso">
        <i class="material-icons">thumbs_up_down</i>
          <span class="font-weight-light">Carta Compromiso</span>
        </a>
        <hr class="bg-info" style=" border: 3px solid ;">
      </div>
      
    </li>
    
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">redoperson</i>
        <span>Reinscripción</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='control_alumnos') ? print 'bg-info text-light ' : print 'null'; ?>"
        href="<?php echo base_url();?>index.php/c_aspirante/control_alumnos">
        <i class="material-icons">person</i>
        <span>Control de Alumnos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='acreditacion') ? print 'bg-info text-light ' : print 'null'; ?>"
      aria-expanded="false" data-toggle="collapse" href="#submenu1" role="button">
        <i class="material-icons">beenhere</i>
        <span>Acreditación</span>
      </a>
      <div id="submenu1" class="<?php ($this->uri->segment(2)=='crear_grupo') ? print 'null' : print 'collapse'; ?> sidebar-submenu">
        <a class="nav-link <?php ($this->uri->segment(2)=='crear_grupo') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_acreditacion/crear_grupo">
        <i class="material-icons">group_add</i>
          <span class="font-weight-light">Crear grupos
          </span>
        </a>
        <hr class="bg-info" style=" border: 3px solid ;">
      </div>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">assessment</i>
        <span>Reportes</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">description</i>
        <span>Formatos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">assignment_turned_in</i>
        <span>Certificación</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='subir_documentos') ? print 'bg-info text-light' : print 'null'; ?>"
        href="<?php echo base_url();?>index.php/c_subir_doc/subir_documentos">
        <i class="material-icons">burst_mode</i>
        <span>Carga de documentos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">people_outline</i>
        <span>Control de usuarios</span>
      </a>
    </li>

  </ul>