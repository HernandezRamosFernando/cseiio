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



public function portabilidad(){
    $datos['estados'] = $this->M_estado->get_estados();
        //$datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        //$datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        //$datos['secundarias'] = $this->M_secundaria->get_secundarias();
        
        


        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
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

    public function nuevo_ingreso(){

        $datos['estados'] = $this->M_estado->get_estados();
        //$datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        //$datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['escuela_procedencia'] = $this->M_escuela_procedencia->get_escuelas();

       



        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
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
    
    public function control_alumnos(){
        $datos['estados'] = $this->M_estado->get_estados();
        //$datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        //$datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        
        //$datos['secundarias'] = $this->M_secundaria->get_secundarias();
       
        

        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
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

    public function acreditacion(){
        $data= array('title'=>'Acreditación');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/acreditacion");
        $this->load->view("footers/footer");
    }

    public function crear_grupo(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        
        $data= array('title'=>'Creación de grupos');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/creargrupo", $datos);
        $this->load->view("footers/footer");
    }

    public function buscar_grupo(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        
        $data= array('title'=>'Buscador de grupos');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/buscar_grupo", $datos);
        $this->load->view("footers/footer");
    }
    public function asesor_grupo(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Asignación de Asesor');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/asesor_grupo", $datos);
        $this->load->view("footers/footer");
    }

    public function terminar_ciclo(){
    
        $data= array('title'=>'Terminacion de ciclo escolar');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/terminar_ciclo");
        $this->load->view("footers/footer");
    }

    public function calificacion(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
    
        $data= array('title'=>'Calificaciones');
        $this->load->view("headers/cabecera", $data);
        $this->load->view("headers/menuarriba");
        $this->load->view("headers/menuizquierda");
        $this->load->view("admin/calificacion", $datos);
        $this->load->view("footers/footer");
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
    }
        
    //-------------------------------------------------termina vistas
}