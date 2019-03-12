<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_subir_doc extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_plantel');
        $this->load->model('M_aspirante');
        $this->load->model('M_documentacion');
        $this->folder = '/cseiio/ims/';
        $this->load->helper('download');
        
    }



 public function subir_documentos(){ 
        $datos['laspirante'] = $this->M_aspirante->aspirantes_sin_matricula();
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $this->load->view("subirdocumentos/buscar_aspirante",$datos);

    }


    public function subir_doc(){ 
        $config = [
          "upload_path" => "./ims",
          'allowed_types' => "gif|jpg|jpeg|png|pdf",
          'max_size'=>2048
        ];
        
        $this->load->library("upload",$config);
        $iddocumento=$this->input->post('iddocumento');
        $no_control=$this->input->post('numcontrol');
        

        $existe_registro=$this->M_documentacion->existe_documentacion_de_aspirante($iddocumento,$no_control);

        

                if ($this->upload->do_upload('file1')) {
                $data = array("upload_data" => $this->upload->data());
                $nombrearchivo= $data['upload_data']['file_name'];
                  if($existe_registro){
                        $actualizo=$this->M_documentacion->update_aspirante_doc($iddocumento,$nombrearchivo,$no_control);
                        if($actualizo){
                            $datos['status']='Los datos se actualizaron correctamente';
                            $datos['ruta']=$nombrearchivo;
                            $datos['acta_nacimiento']=$iddocumento;
                            $datos['no_control']=$no_control;
                        }
                        else{
                           $datos['status_error']="Ha ocurrido un error en la actualización.";
                        }
                  }


                   else{
              $ingreso=$this->M_documentacion->ingresar_documentacion_aspirante($iddocumento,$nombrearchivo,$no_control);
                      if($ingreso){
                              $datos['status']='Los datos se actualizaron correctamente';
                              $datos['ruta']=$nombrearchivo;
                              $datos['acta_nacimiento']=$iddocumento;
                              $datos['no_control']=$no_control;
                      }
                      else{
                          $datos['status_error']="Ha ocurrido un error en la actualización.";
                      }
                   }
                
          }

          else{
                $datos['status_error']=$this->upload->display_errors();
              }

        echo json_encode($datos);

    }

   

   public function descargar($name)
  {
    $data = file_get_contents($this->folder.$name); 
    force_download($name,$data); 
  }


  
}
?>