<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_permisos_extemporaneo extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_permisos_extemporaneo");
    }

    public function get_datos_materia(){
        $grupo = $this->input->get('grupo');
        echo json_encode($this->M_permisos_extemporaneo->get_datos_materia($grupo));
    }


    public function agregar_permiso(){
        $no_control = $this->input->post('no_control');
        $id_grupo = $this->input->post('id_grupo');
        $fecha_inicio = $this->input->post('fecha_inicio');
        $fecha_fin = $this->input->post('fecha_fin');
        $examen = $this->input->post('examen');
        echo $this->M_permisos_extemporaneo->agregar_permiso($examen,$no_control,$id_grupo,$fecha_inicio,$fecha_fin);

    }


    

}