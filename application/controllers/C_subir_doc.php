<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_subir_doc extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_plantel');
        $this->load->model('M_estudiante');
        $this->load->model('M_documentacion');
        $this->folder = './ims/';
        $this->load->helper('download');
        
    }



 public function subir_documentos(){
  
        //$datos['laspirante'] = $this->M_estudiante->aspirantes_lista();
  
        if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='ADMINISTRADOR'){
            $data= array('title'=>'Control de Documentos');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("subirdocumentos/buscar_aspirante",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='CESCOLAR'){
            $data= array('title'=>'Control de Documentos');
            $datos['planteles'] = $this->M_plantel->get_planteles();
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierda");
            $this->load->view("subirdocumentos/buscar_aspirante",$datos);
            $this->load->view("footers/footer");
        }
        else if($this->session->userdata('user')['usuario']!='' && $this->session->userdata('user')['rol']=='PLANTEL'){
           //$datos['planteles'] = $this->M_plantel->get_plantel('20EBD0002B');
           $datos['planteles'] = $this->M_plantel->get_plantel($this->session->userdata('user')['plantel']);
            $data= array('title'=>'Control de Documentos');
            $this->load->view("headers/cabecera", $data);
            $this->load->view("headers/menuarriba");
            $this->load->view("headers/menuizquierdaplantel");
            $this->load->view("plantel/subirdocumentos",$datos);
            $this->load->view("footers/footer");
        }
        else{
            redirect(base_url().'index.php/c_usuario');
        }

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
        $cct_plantel=$this->input->post('cct_plantel');
        if($cct_plantel==''){
          $cct_plantel=NULL;
        }
        


                if ($this->upload->do_upload('file1')) {
                $data = array("upload_data" => $this->upload->data());
                $nombrearchivo=$data['upload_data']['file_name'];
                  
                        $actualizo=$this->M_documentacion->update_aspirante_doc($iddocumento,$nombrearchivo,$no_control);
                        if($actualizo){
                            $datos['status']='Los datos se actualizaron correctamente';
                            $datos['ruta']=$nombrearchivo;
                            $datos['iddocumento']=$iddocumento;
                            $datos['no_control']=$no_control;
                            $datos['cct_plantel']=$cct_plantel;
                        }
                        else{
                           $datos['status_error']="Ha ocurrido un error en la actualización.";
                        }
                  


                
          }

          else{
                $datos['status_error']=$this->upload->display_errors();
              }

        echo json_encode($datos);

    }

   

   public function descargar()
  {
    $no_control = $this->uri->segment(3);
    $iddocumento = $this->uri->segment(4);
    $cct_plantel = $this->uri->segment(5);

    if($cct_plantel==''){
          $cct_plantel=NULL;
        }


     $nombredocumento=$this->M_documentacion->get_nombre_archivo_documentacion($no_control,$iddocumento,$cct_plantel);
    $data = file_get_contents($this->folder.$nombredocumento); 
    force_download($nombredocumento,$data); 
  }




  public function visualizar()
{
$no_control = $this->uri->segment(3);
    $iddocumento = $this->uri->segment(4);
    $cct_plantel = $this->uri->segment(5);
    if($cct_plantel==''){
          $cct_plantel=NULL;
        }

     $nombredocumento=$this->M_documentacion->get_nombre_archivo_documentacion($no_control,$iddocumento,$cct_plantel);
	$file=$this->folder.$nombredocumento;
    //get the file extension
    $info = new SplFileInfo($nombredocumento);
    $contenType='';
    //var_dump($info->getExtension());

    switch ($info->getExtension()) {
        case 'pdf':
	        $contenType='Content-Type:application/pdf';
	        $contentDisposition = 'inline';
        break;
        case 'png':
	        $contenType='Content-Type: image/png';
	        $contentDisposition = 'inline';
        break;
        case 'jpeg':
        	$contenType='Content-Type: image/jpeg';
	        $contentDisposition = 'inline';
        break;
        case 'jpg':
        	$contenType='Content-Type: image/jpg';
	        $contentDisposition = 'inline';
            break;
        default:
            $contentDisposition = 'attachment';
    }

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header($contenType);
        // change inline to attachment if you want to download it instead
        header('Content-Disposition: '.$contentDisposition.'; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
    else echo "El archivo no existe, vuelva a cargar el archivo o consulte con el administrador del sistema";
}


  
}
?>