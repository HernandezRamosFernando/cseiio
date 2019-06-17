<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_vistas extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_estado');
        $this->load->model('M_lengua');
        $this->load->model('M_plantel');
        $this->load->model('M_escuela_procedencia');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_componente');
    }
    
    //------------------------------------------vistas

    //inscripcion.------------------------------------------

    public function nuevo_ingreso(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['escuela_procedencia'] = $this->M_escuela_procedencia->get_secundarias();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Inscripcion Nuevo Ingreso');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/nuevoingreso",$datos);
            $this->load->view("footers/footer");
        }
        elseif($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Inscripcion Nuevo Ingreso');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/nuevoingreso",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Inscripcion Nuevo Ingreso');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/nuevoingreso",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

public function portabilidad(){
    $datos['estados'] = $this->M_estado->get_estados();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['secundarias'] = $this->M_escuela_procedencia->get_secundarias();
        $datos['bachilleratos'] = $this->M_escuela_procedencia->get_bachilleratos();
        
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Inscripcion Portabilidad');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/portabilidad",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Inscripcion Portabilidad');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/portabilidad",$datos);
            $this->load->view("footers/footer");
        }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Inscripcion Portabilidad');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/portabilidad",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
}

public function resolucion_equivalencia(){
    if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
    $datos['planteles'] = $this->M_plantel->get_planteles();
    $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
    $data= array('title'=>'Resolución de Equivalencia');
    $this->load->view("headers/cabecera", $data);
    $this->load->view("headers/menuarriba");
    $this->load->view("headers/menuizquierda");
    $this->load->view("admin/resolucion_equivalencia", $datos);
    $this->load->view("footers/footer");
    }
    if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
        $data= array('title'=>'Resolución de Equivalencia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/resolucion_equivalencia", $datos);
        $this->load->view("footers/footer");
        }
    else{
        redirect(base_url().'index.php/c_usuario');
    }
}

    public function asignar_matricula(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Asignación de Matrícula');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/asignacionmatricula",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Asignación de Matrícula');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/asignacionmatricula",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
        
    }

    public function carta_compromiso(){
        
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Generación de Carta Compromiso');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/carta_compromiso",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Generación de Carta Compromiso');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/carta_compromiso",$datos);
            $this->load->view("footers/footer");
        }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Generación de Carta Compromiso');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/carta_compromiso",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    //fin inscripcion ----------------------

    //Reinscripcion --------------------------------

    public function reinscripcion(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Reinscripción');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/reinscripcion");
        $this->load->view("footers/footer");
        }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Reinscripción');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/reinscripcion");
            $this->load->view("footers/footer");
            }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Reinscripción');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    public function repetidor(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Repetidores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/repetidores",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Repetidores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/repetidores",$datos);
            $this->load->view("footers/footer");
        } 
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function incorporado(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Incorporados');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/incorporados",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Incorporados');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/incorporados",$datos);
            $this->load->view("footers/footer");
        } 
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function traslado(){
        
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Traslado');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/traslado",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Traslado');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/traslado",$datos);
            $this->load->view("footers/footer");
        }  
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Traslado');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/traslado",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function desertor(){
        
        //$datos['secundarias'] = $this->M_secundaria->get_secundarias();
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Desertores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/desertores",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Desertores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/desertores",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    // fin reinscripcion----------------------------------------------

    //control alumnos ------------------------------------------------
    
    public function control_alumnos(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    //fin control alumnos ---------------------------------------------------

    //Acreditacion------------------------------------------------------------
    public function acreditacion(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Acreditación');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/acreditacion");
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Acreditación');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/acreditacion");
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Acreditación');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    public function crear_grupo(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        
        $data= array('title'=>'Creación de grupos');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/creargrupo", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
            
            $data= array('title'=>'Creación de grupos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/creargrupo", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
            
            $data= array('title'=>'Creación de grupos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/creargrupo", $datos);
            $this->load->view("footers/footer");
            }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function buscar_grupo(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        
        $data= array('title'=>'Buscador de grupos');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/buscar_grupo", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
            
            $data= array('title'=>'Buscador de grupos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/buscar_grupo", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
            
            $data= array('title'=>'Buscador de grupos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/buscar_grupo", $datos);
            $this->load->view("footers/footer");
            }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function asesor_grupo(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Asignación de Asesor');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/asesor_grupo", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Asignación de Asesor');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/asesor_grupo", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Asignación de Asesor');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/asesor_grupo", $datos);
            $this->load->view("footers/footer");
            }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function calificacion(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/calificacion", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/calificacion", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Alumnos');
            $data= array('title'=>'Calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/calificacion", $datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }
    public function cerrar_cal(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles_sin_cerrar_calificaciones();
            $data= array('title'=>'Cerrar calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/cerrar_calificaciones", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR   '){
            $datos['planteles'] = $this->M_plantel->get_planteles_sin_cerrar_calificaciones();
            $data= array('title'=>'Cerrar calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/cerrar_calificaciones", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Cerrar calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/cerrar_calificaciones");
            $this->load->view("footers/footer");
            }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }
    public function regularizacion(){
        $datos['planteles'] = $this->M_plantel->get_planteles();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Regularización');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/regularizacion" , $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Regularización');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/regularizacion" , $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Regularización');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel", $datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function cerrar_reg(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Cerrar regularización intermedia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/cerrar_reg_intermedia", $datos);
        $this->load->view("footers/footer");
        }
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Cerrar regularización intermedia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/cerrar_reg_intermedia", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Cerrar calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/cerrar_calificaciones");
            $this->load->view("footers/footer");
            }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function bajas(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Bajas');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/bajas",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Bajas');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/bajas",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Alumnos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/controlalumnos",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }


    // fin acreditacion ------------------------------------------------------

    // Reportes -----------------------------------------------------------------
    public function reportes(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Reinscripción');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/reportes");
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Reinscripción');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/reportes");
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Reinscripción');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function friae(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'FRIAE');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/friae", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/friae", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function frer(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'FRER');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/frer", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'FRER');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/frer", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function lista_grupo_sc(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Lista de grupo sin calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_grupos_sc", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Lista de grupo sin calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/lista_grupos_sc", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    public function lista_grupo_cc(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Lista de grupo sin calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_grupos_cc", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Lista de grupo sin calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/lista_grupos_cc", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacionplantel");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    // fin de reportes ---------------------------------------------------------------------

    // Formatos -----------------------------------------------------------------------------
    public function formatos(){

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Formatos');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/formatos" );
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Regularización');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/formatos");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }   

    // fin formatos -------------------------------------------------------------------------

    // control de documentos ----------------------------------------------------------------

    // fin de control de documentos ----------------------------------------------------------

    // administracion del sistema ------------------------------------------------------------
    public function control_permisos(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Control y Permisos');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/controlypermisos");
        $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function lista_permisos_calificaciones(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Lista de Permisos calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_p_calificaciones");
        $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }
    public function lista_permisos_regularizacion(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Lista de Permisos regularización');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_p_regularizacion");
        $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function terminar_ciclo(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Terminacion de ciclo escolar');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/terminar_ciclo");
        $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function materias(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $dato= array('title'=>'Materias');
            $datos['componente']=$this->M_componente->get_lista();
            //$datos['academia']=$this->M_academia->get_lista();
            $this->load->view("headers/cabecera",$dato);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/materias",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function componentes(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $dato= array('title'=>'Componentes');
            $this->load->view("headers/cabecera",$dato);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/componente");
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function permisos_cal(){
        $datos['planteles'] = $this->M_plantel->get_planteles();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $dato= array('title'=>'Permisos de calificaciones');
            $this->load->view("headers/cabecera",$dato);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/permisos_calificacion", $datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function permisos_reg(){
        $datos['planteles'] = $this->M_plantel->get_planteles();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $dato= array('title'=>'Permisos de Regularización');
            $this->load->view("headers/cabecera",$dato);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/permisos_regularizacion", $datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function controlusuarios(){
        $datos['planteles'] = $this->M_plantel->get_planteles();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Control Usuarios');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/control_usuarios", $datos );
        $this->load->view("footers/footer");
        }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    } 

    // fin de administracion del sistema -----------------------------------------------------  
    
    //-------------------------------------------------termina vistas
}