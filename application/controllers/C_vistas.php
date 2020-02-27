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
        $this->load->model('M_usuario');
    }
    
    public function prueba(){
        $data= array('title'=>'Inscripcion Nuevo Ingreso');
        
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("spreadsheet/prueba");
        $this->load->view("footers/footer");
    }


    public function crear_friae(){
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
            $this->load->view("admin/actualizar_friae",$datos);
            $this->load->view("footers/footer");
        }
        
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Inscripcion Nuevo Ingreso');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/actualizar_friae",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Inscripcion Nuevo Ingreso');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/actualizar_friae",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
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
            $this->load->view("headers/menuizquierdacescolar");
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


    public function nuevo_ingreso_ciclo_anterior(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/nuevoingreso",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Inscripcion Nuevo Ingreso');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/nuevoingreso_cicloanterior",$datos);
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
            $this->load->view("headers/menuizquierdacescolar");
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
    else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
        $data= array('title'=>'Resolución de Equivalencia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierdacescolar");
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
            $this->load->view("headers/menuizquierdacescolar");
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
            $this->load->view("headers/menuizquierdacescolar");
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
    public function materias_adeudo_portabilidad(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Asignación de materias de adeudo portabilidad');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/materias_adeudo_portabilidad",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Asignación de materias de adeudo portabilidad');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/materias_adeudo_portabilidad",$datos);
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/reinscripcion");
            $this->load->view("footers/footer");
            }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Reinscripción');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/reinscripcion");
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/repetidores",$datos);
            $this->load->view("footers/footer");
        } 
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Repetidores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/repetidores",$datos);
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/incorporados",$datos);
            $this->load->view("footers/footer");
        } 
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Incorporados');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/incorporados",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function traslado(){
        
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['lista_planteles'] = $this->M_plantel->get_planteles();
            $datos['cct'] = "";
            $data= array('title'=>'Traslado');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/traslado",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['lista_planteles'] = $this->M_plantel->get_planteles();
            $datos['cct'] = "";
            $data= array('title'=>'Traslado');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/traslado",$datos);
            $this->load->view("footers/footer");
        }  
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] =  $this->M_plantel->get_planteles();
            $datos['lista_planteles'] = $this->M_plantel->get_planteles();
            $datos['cct'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/desertores",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Desertores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/desertores",$datos);
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
            $this->load->view("headers/menuizquierdacescolar");
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

    public function control_asesores(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Control Asesores');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/control_asesores",$datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Control Asesores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            //$this->load->view("admin/acreditacion");
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Control Asesores');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            //$this->load->view("plantel/acreditacion");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }



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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/acreditacion");
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Acreditación');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/acreditacion");
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/creargrupo", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
            
            $data= array('title'=>'Creación de grupos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/buscar_grupo", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
            $data= array('title'=>'Buscador de grupos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
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
    
        $data= array('title'=>'Cambio de Asesor');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/asesor_grupo", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Cambio de Asesor');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/asesor_grupo", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Cambio de Asesor');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/calificacion", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/calificacion", $datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }

    public function calificacion_extemporanea(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/calificacion_extemporanea", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/calificacion_extemporanea", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/calificacion_extemporanea", $datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }
    public function cerrar_cal(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Cerrar calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/cerrar_calificaciones", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Cerrar calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierdacescolar");
        $this->load->view("admin/cerrar_calificaciones", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Cerrar calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/cerrar_calificaciones", $datos);
            $this->load->view("footers/footer");
            }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }
    public function regularizacion(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Regularización');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/regularizacion" , $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Regularización');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/regularizacion" , $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Regularización');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/regularizacion", $datos);
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
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Cerrar regularización intermedia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierdacescolar");
        $this->load->view("admin/cerrar_reg_intermedia", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Cerrar regularización intermedia');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/cerrar_reg_intermedia", $datos);
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
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/bajas",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Bajas');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/bajas",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }


    public function lectura_excel(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            
            $data= array('title'=>'Importar archivo de Excel');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("spreadsheet/upload_excel");
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            
            $data= array('title'=>'Importar archivo de Excel');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("spreadsheet/upload_excel");
            $this->load->view("footers/footer");
        }

        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }


    public function panel_alumnos_baja(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Panel alumnos de baja');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/alumnosdebaja",$datos);
            $this->load->view("footers/footer");
        }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Panel alumnos de baja');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/alumnosdebaja",$datos);
            $this->load->view("footers/footer");
        }

        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Panel alumnos de baja');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("plantel/alumnosdebaja",$datos);
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
        $data= array('title'=>'Reportes');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/reportes");
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Reportes');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/reportes");
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Reportes');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/reportes");
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function friae(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
        $data= array('title'=>'FRIAE');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/friae", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/friae", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'FRIAE');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/friae", $datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function frer(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'FRER');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/frer", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'FRER');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/frer", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'FRER');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/frer",$datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function kardex(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Kardex');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/kardex", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Kardex');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/kardex", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Kardex');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/kardex", $datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }
    public function lista_grupo_sc(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Lista de grupo sin calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_grupos_sc", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Lista de grupo sin calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/lista_grupos_sc", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Lista de grupo sin calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/lista_grupos_sc",$datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    public function lista_grupo_cc(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Lista de grupo con calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_grupos_cc", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Lista de grupo con calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/lista_grupos_cc", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Lista de grupo con calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/lista_grupos_cc",$datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    public function lista_reg_sc(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Lista de regularización sin calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_reg_sc", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Lista de grupo sin calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/lista_reg_sc", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
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
    public function lista_reg_cc(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Lista de regularización sin calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_reg_cc", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Lista de grupo sin calificaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/lista_reg_cc", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
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


    public function observaciones(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $data= array('title'=>'Formato de observaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/formato_observaciones", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $data= array('title'=>'Formato de observaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/formato_observaciones", $datos);
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Formato de observaciones');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/formato_observaciones",$datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    public function lista_asistencia(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Lista de Asistencia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/generar_lista_asistencia", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Lista de Asistencia');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/generar_lista_asistencia", $datos);
            $this->load->view("footers/footer");
            }

            else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
                $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
                $data= array('title'=>'Lista de Asistencia');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierdaplantel");
                $this->load->view("plantel/generar_lista_asistencia", $datos);
                $this->load->view("footers/footer");
                }

         else{
            redirect(base_url().'index.php/c_usuario');
            }
        
    }

    public function actas_regu(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Actas de Regularización');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/actas_regu", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Actas de Regularización');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/actas_regu", $datos);
            $this->load->view("footers/footer");
        }

            else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
                $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
                $data= array('title'=>'Actas de Regularización');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierdaplantel");
                $this->load->view("plantel/actas_regu", $datos);
                $this->load->view("footers/footer");
            }
            else{
                redirect(base_url().'index.php/c_usuario');
                }
        }



    public function lista_desercion_escolar(){
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Lista de Asistencia');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/generar_lista_desercion", $datos);
        $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
        
            $data= array('title'=>'Lista de Asistencia');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/generar_lista_desercion", $datos);
            $this->load->view("footers/footer");
            }

            else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
                $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
                
                $data= array('title'=>'Lista de Asistencia');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierdaplantel");
                $this->load->view("plantel/generar_lista_desercion", $datos);
                $this->load->view("footers/footer");
                }

         else{
            redirect(base_url().'index.php/c_usuario');
            }
        }

        public function lista_bajas_escolar(){
                $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
                if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
                $datos['planteles'] = $this->M_plantel->get_planteles();
            
                $data= array('title'=>'Lista de Bajas');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierda");
                $this->load->view("admin/generar_lista_bajas", $datos);
                $this->load->view("footers/footer");
                }
                else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
                    $datos['planteles'] = $this->M_plantel->get_planteles();
                
                    $data= array('title'=>'Lista de Bajas');
                    $this->load->view("headers/cabecera", $data);
                    $this->load->view("headers/menuarriba");
                    $this->load->view("headers/menuizquierdacescolar");
                    $this->load->view("admin/generar_lista_bajas", $datos);
                    $this->load->view("footers/footer");
                    }
        
                    else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
                        $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
                        
                        $data= array('title'=>'Lista de Bajas');
                        $this->load->view("headers/cabecera", $data);
                        $this->load->view("headers/menuarriba");
                        $this->load->view("headers/menuizquierdaplantel");
                        $this->load->view("plantel/generar_lista_bajas", $datos);
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
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Formatos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdacescolar");
            $this->load->view("admin/formatos" );
            $this->load->view("footers/footer");
            }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $data= array('title'=>'Formatos');
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

    // control de documentos ---------------------------------------------------------------- c_subir_doc

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


    public function lista_permisos_calificaciones_ex(){
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Lista de Permisos calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/lista_p_calificacion_extemporanea");
        $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }
    }


    public function panel_permisos_alumnos_baja(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Lista de Permisos calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/panel_alumnos_baja",$datos);
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


    public function permisos_cal_extemporaneas(){
        $datos['planteles'] = $this->M_plantel->get_planteles();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $dato= array('title'=>'Permisos de calificaciones extemporaneas');
            $this->load->view("headers/cabecera",$dato);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/permisos_cal_extemporanea", $datos);
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
        $datos['usuarios'] = $this->M_usuario->usuarios_registrados();

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
    public function notificaciones(){
        $datos['planteles'] = $this->M_plantel->get_planteles();

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Notificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/notificaciones", $datos );
        $this->load->view("footers/footer");
        }else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
                $data= array('title'=>'Notificaciones');
                $this->load->view("headers/cabecera", $data);
                $this->load->view("headers/menuarriba");
                $this->load->view("headers/menuizquierda");
                $this->load->view("admin/notificaciones", $datos );
                $this->load->view("footers/footer");
                }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    }

    // fin de administracion del sistema -----------------------------------------------------  
    
    //-------------------------------------------------termina vistas

    public function graficas(){

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
        $data= array('title'=>'Gráficas');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/graficas" );
        $this->load->view("footers/footer");
    }
    else{
    redirect(base_url().'index.php/c_usuario');
    }

    }


//-------------------------------------------------termina vistas





     public function nulidad_semestre(){
        

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
            $data= array('title'=>'Autorizar Nulidad de Semestre');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("admin/autorizarnulidadsemestre", $datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
            $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $datos['ciclo_escolar'] = $this->M_ciclo_escolar->lista_ciclo_escolar();
            $data= array('title'=>'Nulidad semestre');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/nulidadsemestre", $datos);
            $this->load->view("footers/footer");
            }
            else{
            redirect(base_url().'index.php/c_usuario');
            }
    } 

    
}