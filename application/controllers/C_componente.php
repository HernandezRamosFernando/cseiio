<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_componente extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_componente");
    }

    public function get_id_componente(){
        $nombre_corto_componente = $this->input->get('nombre');
        echo json_encode($this->M_componente->get_id_componente($nombre_corto_componente));
    }

    public function get_lista()
    {
      echo json_encode($this->M_componente->get_lista());
    }


    public function agregar_componente()
    {
     
     $datos_componente = array(
            'nombre' => mb_strtoupper($this->input->post('componente')),
            'nombre_corto' => mb_strtoupper($this->input->post('nombre_corto'))
        );
     echo $this->M_componente->insertar_componente($datos_componente);
    }

     public function get_componente(){
     $componente = $this->uri->segment(3);
     $datos['componente'] = $this->M_componente->get_componente($componente);
     echo json_encode($datos);
 }


public function modificar_componente()
    {
     
     $datos_componente = array(
            'nombre' => mb_strtoupper($this->input->post('mcomponente')),
            'nombre_corto' => mb_strtoupper($this->input->post('mnombre_corto'))
        );
     $idcomponente=mb_strtoupper($this->input->post('midcomponente'));
     echo $this->M_componente->modificar_componente($datos_componente,$idcomponente);
    }


    public function eliminar_componente()
    {
     $id=mb_strtoupper($this->input->post('eidcomponente'));
     echo $this->M_componente->eliminar_componente($id);
    }
    

}