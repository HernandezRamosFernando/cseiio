<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_aspirante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_aspirante');
        $this->load->model('M_estado');
        $this->load->model('M_municipio');
        $this->load->model('M_localidad');
        $this->load->model('M_lengua');
        $this->load->model('M_plantel');
        $this->load->model('M_direccion_aspirante');
        $this->load->model('M_tutor');
        $this->load->model('M_lengua_materna');
        $this->load->model('M_documentacion');
        $this->load->model('M_secundaria');
        $this->load->model('M_datos_medicos');
        $this->load->model('M_ciclo_escolar');
    }


//------------------------------------------vistas



public function portabilidad(){
    $datos['estados'] = $this->M_estado->get_estados();
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        $datos['secundarias'] = $this->M_secundaria->get_secundarias();
        
        


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
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
        
        $datos['secundarias'] = $this->M_secundaria->get_secundarias();

       



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
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        
        $datos['secundarias'] = $this->M_secundaria->get_secundarias();
       
        

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
    //-------------------------------------------------termina vistas
    public function get_aspirantes_nombre_documentos(){
        $no_control = $this->input->get('no_control');
        

        echo json_encode($this->M_aspirante->get_aspirantes_nombre_documentos($no_control));
    }


    public function editar_aspirante(){
        //$no_control = $this->input->get('no_control');
        $no_control = $this->uri->segment(3);

        //$datos['aspirante'] = $this->M_aspirante->get_aspirante($no_control);
        //$datos['direccion_aspirante'] = $this->M_direccion_aspirante->get_direccion_aspirante($no_control);
        //$datos['tutor_aspirante'] = $this->M_tutor->get_tutor_aspirante($no_control);
        //$datos['lengua_materna_aspirante'] = $this->M_lengua_materna->get_lengua_materna_aspirante($no_control);
        //$datos['datos_secundaria_aspirante'] = $this->M_datos_secundaria->get_datos_secundaria_aspirante($no_control);
        //$datos['documentacion_aspirante'] = $this->M_documentacion->get_documentacion_aspirante($no_control);
        $this->load->view('formulario_aspirante_editar');
        //print_r($datos);
        
    }



    public function buscar_aspirantesxplantel(){
        $plantel = $this->input->get('plantel');
        $curp = $this->input->get('curp');
         echo json_encode($this->M_aspirante->listar_aspirantes_xplantel($curp, $plantel));
     }
 
     public function buscar_aspirantesxnombre(){
        $nombre = $this->input->get('nombre');
        $apellido_paterno = $this->input->get('apellido_paterno');
        $apellido_materno = $this->input->get('apellido_materno');
        $curp = $this->input->get('curp');
        
         echo json_encode($this->M_aspirante->listar_aspirantes_xnombreycrup($nombre,$apellido_paterno,$apellido_materno,$curp));
     }
   


           public function get_docxaspirante(){
            $no_control = $this->uri->segment(3);
            $nombre = $this->uri->segment(4);
            $apellido_paterno = $this->uri->segment(5);
            $apellido_materno = $this->uri->segment(6);
            
            $datos['numcontrol']=$no_control;
            $datos['nombre_completo']=$nombre.' '.$apellido_paterno.' '.$apellido_materno;
            $datos['documentacion_aspirante'] = $this->M_documentacion->get_documentacion_aspirante($no_control);
        
            echo json_encode($datos);
        }
        
        
        


    //=============================================


    public function generar_carta_compromiso(){
        $this->load->library('pdf');
        $no_control = $this->input->get('no_control');
        $datos['documentos'] = $this->M_aspirante->get_aspirantes_nombre_documentos($no_control);
        $datos['aspirante_plantel'] = $this->M_aspirante->aspirante_plantel($no_control);
        $datos['fecha_carta'] = $this->M_aspirante->fecha_carta($no_control);
        //$datos['aspirante_plantel'] = $this->M_aspirante->get_aspirante($no_control);
        $this->load->view('contratos/formatocontrato',$datos);


    }


   



    public function aspirantes_carta_compromiso(){
        $curp = $this->input->get('curp');
        $plantel = $this->input->get('plantel');
        echo json_encode($this->M_aspirante->aspirantes_carta_compromiso($curp, $plantel));
    }


    public function actualizar_datos_aspirante(){

        $no_control = $this->input->post('aspirante_no_control');

        $datos_aspirante = array(
            'nombre' => strtoupper($this->input->post('aspirante_nombre')),
            'apellido_paterno' => strtoupper($this->input->post('aspirante_apellido_paterno')),
            'apellido_materno' => strtoupper($this->input->post('aspirante_apellido_materno')),
            'telefono' => $this->input->post('aspirante_telefono'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'nss' => $this->input->post('aspirante_nss'),
            'correo' => strtoupper($this->input->post('aspirante_correo')),
            //'tipo_ingreso' => 'NUEVO INGRESO',
            'semestre' => $this->input->post('aspirante_semestre'),
            'programa_social' => $this->input->post('aspirante_programa_social'),
            'curp' => strtoupper($this->input->post('aspirante_curp')),
            'Plantel_cct' => strtoupper($this->input->post('aspirante_plantel')),
            'fecha_registro' => date("Y-m-d"),
            'fecha_inscripcion' => date("Y-m-d"),
            'Secundaria_cct_secundaria' => strtoupper($this->input->post('aspirante_secundaria_cct')),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento')
        );

        $datos_aspirante_direccion = array(
            //'Localidad_id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'Aspirante_no_control' => $no_control,
            'calle' => strtoupper($this->input->post('aspirante_direccion_calle')),
            'colonia' => strtoupper($this->input->post('aspirante_direccion_colonia')),
            'cp' => $this->input->post('aspirante_direccion_cp')
        );

        $datos_aspirante_tutor = array(
            'nombre' => strtoupper($this->input->post('aspirante_tutor_nombre')),
            'apellido_paterno' =>strtoupper($this->input->post('aspirante_tutor_apellido')),
            'apellido_materno' =>strtoupper($this->input->post('aspirante_tutor_apellidodos')),
            'telefono_particular' => $this->input->post('aspirante_tutor_telefono'),
            'ocupacion' => strtoupper($this->input->post('aspirante_tutor_ocupacion')),
            'parentezco' => strtoupper($this->input->post('aspirante_tutor_parentesco')==''?null:$this->input->post('aspirante_tutor_parentesco')),
            //'Aspirante_no_control' => $no_control,
            'folio_prospera' => $this->input->post('aspirante_tutor_prospera'),
            'telefono_comunidad' => $this->input->post('aspirante_tutor_telefono_comunidad')
        );

        $datos_aspirante_lengua = array(
            //'Aspirante_no_control' => $no_control,
            'Lengua_id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'lee' => $this->input->post('aspirante_lengua_lee')==''?0:$this->input->post('aspirante_lengua_lee'),
            'habla' => $this->input->post('aspirante_lengua_habla')==''?0:$this->input->post('aspirante_lengua_habla'),
            'escribe' => $this->input->post('aspirante_lengua_escribe')==''?0:$this->input->post('aspirante_lengua_escribe'),
            'entiende' => $this->input->post('aspirante_lengua_entiende')==''?0:$this->input->post('aspirante_lengua_entiende'),
            'traduce' => $this->input->post('aspirante_lengua_traduce')==''?0:$this->input->post('aspirante_lengua_traduce')
        );

        $datos_aspirante_medicos = array(
            'tipo_sangre' => $this->input->post('tipo_sangre')==''?null:$this->input->post('tipo_sangre'),
            'alergia_medicamento' => strtoupper($this->input->post('aspirante_alergia')),
            'discapacidad' => strtoupper($this->input->post('aspirante_discapacidad'))
            //'Aspirante_no_control' => $no_control
        );

        echo $this->M_aspirante->actualizar_datos_aspirante(
            $datos_aspirante,
            $datos_aspirante_direccion,
            $datos_aspirante_tutor,
            $datos_aspirante_lengua,
            $datos_aspirante_medicos,
            $no_control
        );
        //redirect('/index.php/c_aspirante/control_alumnos', 'refresh');
        //$this->M_aspirante->insertar_aspirante($datos_aspirante);

    }

    public function get_datos_aspirante(){
        $no_control = $this->uri->segment(3);

        $datos['aspirante'] = $this->M_aspirante->get_aspirante($no_control);
        $datos['direccion_aspirante'] = $this->M_direccion_aspirante->get_direccion_aspirante($no_control);
        $datos['tutor_aspirante'] = $this->M_tutor->get_tutor_aspirante($no_control);
        $datos['lengua_materna_aspirante'] = $this->M_lengua_materna->get_lengua_materna_aspirante($no_control);
        $datos['secundaria_aspirante'] = $this->M_secundaria->get_secundaria($datos['aspirante'][0]->Secundaria_cct_secundaria);
        $datos['datos_medicos_aspirante'] = $this->M_datos_medicos->get_datos_medicos_aspirante($no_control);
        $datos['documentacion_aspirante'] = $this->M_documentacion->get_documentacion_aspirante($no_control);
    
        echo json_encode($datos);
    }

    public function buscar_aspirantes_curp(){
        $curp = $this->input->get('curp');
        $plantel = $this->input->get('plantel');
        echo json_encode($this->M_aspirante->get_aspirantes_nombre(
            $curp,
            $plantel
        ));
    }

    
    public function registrar_datos_aspirante(){
        $no_control=$this->generar_numcontrol(1);
        $tipo_aspirante = $this->input->post('formulario');

        $datos_aspirante = array(
            'no_control' => $no_control,
            'nombre' => strtoupper($this->input->post('aspirante_nombre')),
            'apellido_paterno' => strtoupper($this->input->post('aspirante_apellido_paterno')),
            'apellido_materno' => strtoupper($this->input->post('aspirante_apellido_materno')),
            'telefono' => $this->input->post('aspirante_telefono'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'nss' => $this->input->post('aspirante_nss'),
            'correo' => strtoupper($this->input->post('aspirante_correo')),
            //'tipo_ingreso' => 'NUEVO INGRESO',
            //'semestre' => 1,
            'programa_social' => $this->input->post('aspirante_programa_social'),
            'curp' => strtoupper($this->input->post('aspirante_curp')),
            'Plantel_cct' => strtoupper($this->input->post('aspirante_plantel')),
            'fecha_registro' => date("Y-m-d"),
            'fecha_inscripcion' => date("Y-m-d"),
            'Secundaria_cct_secundaria' => strtoupper($this->input->post('aspirante_secundaria_cct')),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento')
        );

        if($tipo_aspirante=='nuevo_ingreso'){
            $datos_aspirante['tipo_ingreso'] = 'NUEVO INGRESO';
            $datos_aspirante['semestre'] = 1;
            $datos_aspirante['semestre_en_curso'] = 1;
        }

        else{
            $datos_aspirante['tipo_ingreso'] = 'PORTABILIDAD';
            $datos_aspirante['semestre'] = $this->input->post('aspirante_semestre');
            $datos_aspirante['semestre_en_curso'] = $this->input->post('aspirante_semestre');
        }
        

        $datos_aspirante_direccion = array(
            'Localidad_id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'Aspirante_no_control' => $no_control,
            'calle' => strtoupper($this->input->post('aspirante_direccion_calle')),
            'colonia' => strtoupper($this->input->post('aspirante_direccion_colonia')),
            'cp' => $this->input->post('aspirante_direccion_cp')
        );

        $datos_aspirante_tutor = array(
            'nombre' => strtoupper($this->input->post('aspirante_tutor_nombre')),
            'apellido_paterno' =>strtoupper($this->input->post('aspirante_tutor_apellido')),
            'apellido_materno' =>strtoupper($this->input->post('aspirante_tutor_apellidodos')),
            'telefono_particular' => $this->input->post('aspirante_tutor_telefono'),
            'ocupacion' => strtoupper($this->input->post('aspirante_tutor_ocupacion')),
            'parentezco' => strtoupper($this->input->post('aspirante_tutor_parentesco')==''?null:$this->input->post('aspirante_tutor_parentesco')),
            'Aspirante_no_control' => $no_control,
            'folio_prospera' => $this->input->post('aspirante_tutor_prospera'),
            'telefono_comunidad' => $this->input->post('aspirante_tutor_telefono_comunidad')
        );

        $datos_aspirante_lengua = array(
            'Aspirante_no_control' => $no_control,
            'Lengua_id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'lee' => $this->input->post('aspirante_lengua_lee')==''?0:$this->input->post('aspirante_lengua_lee'),
            'habla' => $this->input->post('aspirante_lengua_habla')==''?0:$this->input->post('aspirante_lengua_habla'),
            'escribe' => $this->input->post('aspirante_lengua_escribe')==''?0:$this->input->post('aspirante_lengua_escribe'),
            'entiende' => $this->input->post('aspirante_lengua_entiende')==''?0:$this->input->post('aspirante_lengua_entiende'),
            'traduce' => $this->input->post('aspirante_lengua_traduce')==''?0:$this->input->post('aspirante_lengua_traduce')
        );

        $datos_aspirante_medicos = array(
            'tipo_sangre' => $this->input->post('tipo_sangre')==''?null:$this->input->post('tipo_sangre'),
            'alergia_medicamento' => strtoupper($this->input->post('aspirante_alergia')),
            'discapacidad' => strtoupper($this->input->post('aspirante_discapacidad')),
            'Aspirante_no_control' => $no_control
        );

        $datos_aspirante_documentos = array();

            if($this->input->post('aspirante_documento_acta_nacimiento')!=''){
                $datos_aspirante_documentos['aspirante_documento_acta_nacimiento'] = array(
                    'Documento_id_documento' => 1,
                    'entregado' => true
                );
            }
            else{
                $datos_aspirante_documentos['aspirante_documento_acta_nacimiento'] = array(
                    'Documento_id_documento' => 1,
                    'entregado' => false
                );
            }

            if($this->input->post('aspirante_documento_curp')!=''){
                $datos_aspirante_documentos['aspirante_documento_curp'] = array(
                    'Documento_id_documento' => 2,
                    'entregado' => true
                );
            }
            else{
                $datos_aspirante_documentos['aspirante_documento_curp'] = array(
                    'Documento_id_documento' => 2,
                    'entregado' => false
                );
            }

            if($this->input->post('aspirante_documento_certificado_secundaria')!=''){
                $datos_aspirante_documentos['aspirante_documento_certificado_secundaria'] = array(
                    'Documento_id_documento' => 3,
                    'entregado' => true
                );
            }
            else{
                $datos_aspirante_documentos['aspirante_documento_certificado_secundaria'] = array(
                    'Documento_id_documento' => 3,
                    'entregado' => false
                );
            }

            if($this->input->post('aspirante_documento_fotos')!=''){
                $datos_aspirante_documentos['aspirante_documento_fotos'] = array(
                    'Documento_id_documento' => 4,
                    'entregado' => true
                );
            }
            else{
                $datos_aspirante_documentos['aspirante_documento_documento_fotos'] = array(
                    'Documento_id_documento' => 4,
                    'entregado' => false
                );
            }

            if($this->input->post('aspirante_documento_certificado_medico')!=''){
                $datos_aspirante_documentos['aspirante_documento_certificado_medico'] = array(
                    'Documento_id_documento' => 101,
                    'entregado' => true
                );
            }
            else{
                $datos_aspirante_documentos['aspirante_documento_certificado_medico'] = array(
                    'Documento_id_documento' => 101,
                    'entregado' => false
                );
            }

            if($this->input->post('aspirante_documento_carta_buena_conducta')!=''){
                $datos_aspirante_documentos['aspirante_documento_buena_conducta'] = array(
                    'Documento_id_documento' => 102,
                    'entregado' => true
                );
            }
            else{
                $datos_aspirante_documentos['aspirante_documento_buena_conducta'] = array(
                    'Documento_id_documento' => 102,
                    'entregado' => false
                );
            }

        echo $this->M_aspirante->insertar_aspirante_nuevo_ingreso(
            $datos_aspirante,
            $datos_aspirante_direccion,
            $datos_aspirante_tutor,
            $datos_aspirante_lengua,
            $datos_aspirante_documentos,
            $datos_aspirante_medicos
        );


       

    }

   


    function delete_aspirante(){
        $no_control = $this->input->get('no_control');
        echo $this->M_aspirante->delete_aspirante($no_control);
    }


    public function generar_numcontrol($semestre){

        $numero=$this->M_aspirante->asignar_numero_consecutivo();
        $no_control='';
        if($numero==NULL){
            $numero=1;
        }
        else{
            $numero=$numero+1;
        }
        $no_control = 'CSEIIO'.date('y').$semestre.str_pad($numero,4,'0',STR_PAD_LEFT);
        
        return $no_control;
    
}
    

function agregar_observaciones(){

    $observaciones = json_decode($this->input->raw_input_stream);
   //print_r($observaciones);
    echo $this->M_aspirante->agregar_observaciones($observaciones);

}

public function valor_Lengua($valor){
    $resultado="";
    switch ($valor) {
        case 0:
            $resultado= "Nada 0%";
            break;
        case 25:
            $resultado= "Poco 25%";
            break;
        case 50:
            $resultado= "Regular 50%";
            break;
         case 100:
            $resultado= "Bien 100%";
            break;
    }

    return $resultado;

}



public function generar_formato_inscripcion(){
        $this->load->library('pdf');
        $no_control = $this->input->get('no_control');
        $datos['aspirante'] = $this->M_aspirante->get_aspirante($no_control);
        $n_plantel= $this->M_plantel->get_nombre_plantel($datos['aspirante'][0]->Plantel_cct)->nombre_plantel;
        $datos['nombre_plantel']=$n_plantel;
        
        $datos['datos_medicos'] = $this->M_datos_medicos->get_datos_medicos_aspirante($no_control);
        $datos['direccion'] = $this->M_direccion_aspirante->get_direccion_aspirante($no_control);
        $datos['domicilio_aspirante'] = $this->M_localidad->get_nombre_estado_municipio_localidad(($datos['direccion'][0]->Localidad_id_localidad));
        $datos['tutor'] = $this->M_tutor->get_tutor_aspirante($no_control);
        $datos['secundaria_aspirante'] = $this->M_secundaria->get_secundaria($datos['aspirante'][0]->Secundaria_cct_secundaria);

        $datos['lengua_materna'] = $this->M_lengua_materna->get_lengua_materna_aspirante($no_control);
        $datos['lengua_entiende'] =$this->valor_Lengua($datos['lengua_materna'][0]->entiende);
        $datos['lengua_habla'] =$this->valor_Lengua($datos['lengua_materna'][0]->habla);
        $datos['lengua_lee'] =$this->valor_Lengua($datos['lengua_materna'][0]->lee);
        $datos['lengua_escribe'] =$this->valor_Lengua($datos['lengua_materna'][0]->escribe);
        $datos['lengua_traduce'] =$this->valor_Lengua($datos['lengua_materna'][0]->traduce);
        $datos['nombre_lengua'] = $this->M_lengua->get_nombre_lengua($datos['lengua_materna'][0]->Lengua_id_lengua)->nombre_lengua;
        $datos['lista_documentacion'] =$this->M_documentacion->get_documentacion_xnombrede_aspirante($no_control);

        $this->load->view('contratos/formatofichainscripcion',$datos);
    }

    
  
}



    

?>