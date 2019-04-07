<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_acreditacion extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_plantel');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_especialidad');
        $this->load->model('M_acreditacion');
    }

//------------------------Vistas
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

public function asesor_grupo(){
    $datos['planteles'] = $this->M_plantel->get_planteles();

    $data= array('title'=>'Asignación de Asesor');
    $this->load->view("headers/cabecera", $data);
    $this->load->view("headers/menuarriba");
    $this->load->view("headers/menuizquierda");
    $this->load->view("admin/asesor_grupo", $datos);
    $this->load->view("footers/footer");
}

//------------------------Fin vistas

public function numero_estudiantes_semestre_plantel(){
    $datos = array(
        'semestre' => $this->input->get('semestre'),
        'cct' => $this->input->get('cct')
    );
    //$this->M_acreditacion->numero_estudiantes_semestre_plantel($datos);

    echo json_encode($this->M_acreditacion->numero_estudiantes_semestre_plantel($datos));
}

public function agregar_grupo(){
    $datos = array(
        'Plantel_cct' => $this->input->post('aspirante_plantel'),
        'semestre' => $this->input->post('semestre_grupo'),
        'Ciclo_escolar_id_ciclo_escolar' => $this->input->post('grupo_ciclo_escolar'),
        'nombre' => $this->input->post('grupo_nombre'),
        'periodo' => $this->input->post('grupo_periodo')
    );

    echo $this->M_acreditacion->agregar_grupo($datos);
}

}


?>

