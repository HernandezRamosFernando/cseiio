<div id="wrapper">
  <!-- Barra de lado izquierdo -->
  <ul class="sidebar navbar-nav toggled ">
    <li class="nav-item ">
      <a class="nav-link" href="<?php echo base_url();?>index.php/c_menu/principal">
        <i class="material-icons">menu</i>
        <span>Menú</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='inscripcion'||$this->uri->segment(2)=='nuevo_ingreso'||$this->uri->segment(2)=='portabilidad'||$this->uri->segment(2)=='asignar_matricula'||$this->uri->segment(2)=='carta_compromiso' ||$this->uri->segment(2)=='resolucion_equivalencia'||$this->uri->segment(2)=='materias_adeudo_portabilidad') ? print 'bg-info text-light' : print null; ?>"
      href="<?php echo base_url();?>index.php/c_menu/inscripcion">
        <i class="material-icons">group_add</i>
        <span class="font-weight-light">Inscripción<span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='reinscripcion' || $this->uri->segment(2)=='repetidor'||$this->uri->segment(2)=='incorporado'||$this->uri->segment(2)=='desertor'||$this->uri->segment(2)=='traslado' ||$this->uri->segment(2)=='nulidad_semestre') ? print 'bg-info text-light' : print null; ?>"
      href="<?php echo base_url();?>index.php/c_vistas/reinscripcion">
        <i class="material-icons">group_add</i>
        <span class="font-weight-light">Reinscripción<span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='control_alumnos') ? print 'bg-info text-light ' : print 'null'; ?>"
        href="<?php echo base_url();?>index.php/c_vistas/control_alumnos">
        <i class="material-icons">person</i>
        <span>Control de Alumnos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='acreditacion'||$this->uri->segment(2)=='crear_grupo'||$this->uri->segment(2)=='terminar_ciclo'||$this->uri->segment(2)=='calificacion'||$this->uri->segment(2)=='cerrar_cal'||$this->uri->segment(2)=='regularizacion'||$this->uri->segment(2)=='buscar_grupo'||$this->uri->segment(2)=='asesor_grupo'||$this->uri->segment(2)=='cerrar_reg'||$this->uri->segment(2)=='bajas') ? print 'bg-info text-light ' : print 'null'; ?>"
      href="<?php echo base_url();?>index.php/c_vistas/acreditacion">
        <i class="material-icons">beenhere</i>
        <span>Acreditación</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='reportes'||$this->uri->segment(2)=='friae'||$this->uri->segment(2)=='frer'||$this->uri->segment(2)=='kardex'||$this->uri->segment(2)=='lista_grupo_sc'||$this->uri->segment(2)=='lista_grupo_cc'||$this->uri->segment(2)=='observaciones'||$this->uri->segment(2)=='lista_asistencia'||$this->uri->segment(2)=='actas_regu') ? print 'bg-info text-light ' : print 'null'; ?>"
      href="<?php echo base_url();?>index.php/c_vistas/reportes">
        <i class="material-icons">assessment</i>
        <span>Reportes</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link <?php ($this->uri->segment(2)=='formatos') ? print 'bg-info text-light ' : print 'null'; ?>"
      href="<?php echo base_url();?>index.php/c_vistas/formatos">
        <i class="material-icons">description</i>
        <span>Formatos</span>
      </a>
    </li>
    <li class="nav-item ">
      <a class="nav-link " 
      href="<?php echo base_url();?>index.php/c_menu/principal">
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
      <a class="nav-link <?php ($this->uri->segment(2)=='control_permisos'||$this->uri->segment(2)=='permisos_cal'||$this->uri->segment(2)=='permisos_reg'||$this->uri->segment(2)=='materias'||$this->uri->segment(2)=='componentes' ||$this->uri->segment(2)=='terminar_ciclo') ? print 'bg-info text-light' : print null; ?>"
      href="<?php echo base_url();?>index.php/c_vistas/control_permisos">
        <i class="material-icons">people_outline</i>
        <span>Control Y Permisos</span>
      </a>
    </li>
  </ul>