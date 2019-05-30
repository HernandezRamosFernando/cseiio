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
      <div id="submenu" class="<?php ($this->uri->segment(2)=='nuevo_ingreso'||$this->uri->segment(2)=='portabilidad'||$this->uri->segment(2)=='asignar_matricula'||$this->uri->segment(2)=='carta_compromiso' ||$this->uri->segment(2)=='resolucion_equivalencia') ? print 'null' : print 'collapse'; ?> sidebar-submenu">
        <a class="nav-link <?php ($this->uri->segment(2)=='nuevo_ingreso') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/nuevo_ingreso">
        <i class="material-icons md-24">person_add</i>
          <span class="font-weight-light">Inscripción Nuevo Ingreso
          </span>
        </a>
        <a class="nav-link  <?php ($this->uri->segment(2)=='portabilidad') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/portabilidad">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='portabilidad') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/portabilidad.png">
          <span class="font-weight-light">Inscripción Portabilidad
          </span>
        </a>
        <a class="nav-link  <?php ($this->uri->segment(2)=='resolucion_equivalencia') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/resolucion_equivalencia">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='resolucion_equivalencia') ? print 'icono_izquierda_seleccionado' : print null; ?>"  src="<?php echo base_url();?>assets/img/equivalencia.png">
          <span class="font-weight-light">Resolución equivalencia
          </span>
        </a>
        <a class="nav-link  <?php ($this->uri->segment(2)=='asignar_matricula') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/asignar_matricula">
        <i class="material-icons">assignment_turned_in</i>
          <span class="font-weight-light">Asignar Matrícula</span>
        </a>
        <a class="nav-link   <?php ($this->uri->segment(2)=='carta_compromiso') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/carta_compromiso">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='carta_compromiso') ? print 'icono_izquierda_seleccionado' : print null; ?>"  src="<?php echo base_url();?>assets/img/cartacompromiso.png">
          <span class="font-weight-light">Carta Compromiso</span>
        </a>
        <hr class="bg-info" style=" border: 3px solid ;">
      </div>
      
    </li>
    
    <li class="nav-item ">
    <a class="nav-link nav-dropdown-toggle  <?php ($this->uri->segment(2)=='reinscripcion') ? print 'bg-info text-light' : print null; ?>"
      aria-expanded="false" data-toggle="collapse" href="#submenu3" role="button">
        <i class="material-icons">redoperson</i>
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
      <a class="nav-link <?php ($this->uri->segment(2)=='acreditacion') ? print 'bg-info text-light ' : print 'null'; ?>"
      aria-expanded="false" data-toggle="collapse" href="#submenu1" role="button">
        <i class="material-icons">beenhere</i>
        <span>Acreditación</span>
      </a>
      <div id="submenu1" class="<?php ($this->uri->segment(2)=='crear_grupo'||$this->uri->segment(2)=='terminar_ciclo'||$this->uri->segment(2)=='calificacion'||$this->uri->segment(2)=='cerrar_cal'||$this->uri->segment(2)=='regularizacion'||$this->uri->segment(2)=='buscar_grupo'||$this->uri->segment(2)=='asesor_grupo') ? print 'null' : print 'collapse'; ?> sidebar-submenu">
        <a class="nav-link <?php ($this->uri->segment(2)=='crear_grupo') ? print 'bg-info text-light ' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/crear_grupo">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='crear_grupo') ? print 'icono_izquierda_seleccionado' : print null; ?>"  src="<?php echo base_url();?>assets/img/creargrupo.png">
          <span class="font-weight-light">Crear grupos
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='buscar_grupo') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/buscar_grupo">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='buscar_grupo') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/modificargrupo.png">
          <span class="font-weight-light">Modificar grupos
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='asesor_grupo') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/asesor_grupo">
        <img class="icono_izquierda_alto <?php ($this->uri->segment(2)=='asesor_grupo') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/modificarasesor.png">
          <span class="font-weight-light">Modificar Asesor
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='calificacion') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/calificacion">
        <img class="icono_izquierda_ancho <?php ($this->uri->segment(2)=='calificacion') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/calificaciones.png">
          <span class="font-weight-light">Calificaciones
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='cerrar_cal') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/cerrar_cal">
        <img class="icono_izquierda_ancho <?php ($this->uri->segment(2)=='cerrar_cal') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/calificaciones.png">
          <span class="font-weight-light">Cerrar calificaciones
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='regularizacion') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/regularizacion">
        <i class="material-icons">group_add</i>
          <span class="font-weight-light">Regularización
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
    <li class="nav-item dropdown ">
      <a class="nav-link nav-dropdown-toggle  <?php ($this->uri->segment(2)=='control_permisos') ? print 'bg-info text-light' : print null; ?>"
      aria-expanded="false" data-toggle="collapse" href="#submenu2" role="button">
        <i class="material-icons">people_outline</i>
        <span>Control Y Permisos</span>
      </a>
      <div id="submenu2" class="<?php ($this->uri->segment(2)=='permisos_cal'||$this->uri->segment(2)=='permisos_reg'||$this->uri->segment(2)=='materias'||$this->uri->segment(2)=='componentes' ||$this->uri->segment(2)=='terminar_ciclo') ? print 'null' : print 'collapse'; ?> sidebar-submenu">
        <a class="nav-link <?php ($this->uri->segment(2)=='permisos_cal') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/permisos_cal">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='permisos_cal') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/permisoscal.png">
          <span class="font-weight-light">Permisos Calificaciones
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='permisos_reg') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/permisos_reg">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='permisos_reg') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/permisoscal.png">
          <span class="font-weight-light">Permisos Regularización
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/">
        <i class="material-icons">person_add</i>
          <span class="font-weight-light">Control Usuarios
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='materias') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/materias">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='materias') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/controlmaterias.png">
          <span class="font-weight-light">Control Materias
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='componentes') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/componentes">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='componentes') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/controlcomponentes.png">
          <span class="font-weight-light">Control Componentes
          </span>
        </a>
        <a class="nav-link <?php ($this->uri->segment(2)=='terminar_ciclo') ? print 'bg-info text-light' : print null; ?>" href="<?php echo base_url();?>index.php/c_vistas/terminar_ciclo">
        <img class="icono_izquierda <?php ($this->uri->segment(2)=='terminar_ciclo') ? print 'icono_izquierda_seleccionado' : print null; ?>" src="<?php echo base_url();?>assets/img/finalizarperiodo.png">
          <span class="font-weight-light">Finalizar periodo
          </span>
        </a>
        <hr class="bg-info" style=" border: 3px solid ;">
      </div>
      
    </li>


  </ul>