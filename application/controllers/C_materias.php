<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_materias extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_componente');
        //$this->load->model('M_academia');
        $this->load->model('M_materia');
        $this->load->model('M_plantel');
        
        
    }


    public function materias_semestre(){
        $semestre = $this->input->get("semestre");
        echo json_encode($this->M_materia->get_materias_semestre_completo($semestre));
    }


    public function get_materias_semestre_componente(){
        $semestre = $this->input->get("semestre");
        $id_componente = $this->input->get("componente");
        echo json_encode($this->M_materia->get_materias_semestre_componente($semestre,$id_componente));
    }

   

    public function lista_materias()
    {
      
      echo json_encode($this->M_materia->get_lista());
    }

    public function agregarMateria()
    {
     
     $datos_materia = array(
            'clave' => strtoupper($this->input->post('clave')),
            'unidad_contenido' => strtoupper($this->input->post('unidad_contenido')),
            'semestre' => strtoupper($this->input->post('semestre')),
            'componente' => strtoupper($this->input->post('componente')),
            'horas' => strtoupper($this->input->post('horas')),
            'creditos' => strtoupper($this->input->post('creditos')),
            'Academia_id_academia' => strtoupper($this->input->post('academia'))
        );
     echo $this->M_materia->insertar_materia($datos_materia);
     
     
    }


    public function modificarMateria()
    {
     
     $datos_materia = array(
            'unidad_contenido' => strtoupper($this->input->post('munidad_contenido')),
            'semestre' => strtoupper($this->input->post('msemestre')),
            'componente' => strtoupper($this->input->post('mcomponente')),
            'horas' => strtoupper($this->input->post('mhoras')),
            'creditos' => strtoupper($this->input->post('mcreditos')),
           // 'Academia_id_academia' => strtoupper($this->input->post('macademia'))
        );
     $clave=strtoupper($this->input->post('mclave'));
     echo $this->M_materia->modificar_materia($datos_materia,$clave);
    }


    public function get_datos_materia()
    {
     
     $clave = $this->uri->segment(3);
     $datos['materia'] = $this->M_materia->get_materia($clave);
     echo json_encode($datos);
     
    }


    public function eliminarMateria()
    {
     $clave=strtoupper($this->input->post('clave_eliminar'));
     echo $this->M_materia->eliminar_materia($clave);
    }
}