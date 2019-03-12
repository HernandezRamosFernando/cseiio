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
        $this->load->model('M_datos_secundaria');
        $this->load->model('M_documentacion');
    }


//------------------------------------------vistas



public function portabilidad(){
    $datos['estados'] = $this->M_estado->get_estados();
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['planteles'] = $this->M_plantel->get_planteles();

 
        $this->load->view("admin/portabilidad",$datos);
}

    public function nuevo_ingreso(){

        $datos['estados'] = $this->M_estado->get_estados();
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['planteles'] = $this->M_plantel->get_planteles();

 
        $this->load->view("admin/nuevoingreso",$datos);
    }
    
    public function asignar_matricula(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $this->load->view("admin/asignacionmatricula", $datos);
    }
    public function carta_compromiso(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $this->load->view("admin/carta_compromiso",$datos);
    }
    


    public function control_alumnos(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['planteles'] = $this->M_plantel->get_planteles();
       
        $this->load->view("admin/controlalumnos",$datos);
    }

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

    



    //-------------------------------------------------
   


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
        $this->load->view('contratos/formatocontrato');

    }

    public function get_aspirantes_nombre_documentos_faltantes(){
        $cct = $this->input->get('cct');
        //echo json_encode($this->M_aspirante->get_aspirantes_nombre_documentos_faltantes($no_control));
        echo json_encode($this->M_aspirante->get_aspirantes_nombre_documentos_faltantes($cct));
    }


    public function actualizar_datos_aspirante(){

        $no_control = $this->input->post('aspirante_no_control');

        $datos_aspirante = array(
            
            'nombre' => $this->input->post('aspirante_nombre'),
            'apellido_paterno' => $this->input->post('aspirante_apellido_paterno'),
            'apellido_materno' => $this->input->post('aspirante_apellido_materno'),
            'curp' => $this->input->post('aspirante_curp'),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'telefono' => $this->input->post('aspirante_telefono'),
            'correo' => $this->input->post('aspirante_correo'),
            'nss' => $this->input->post('aspirante_nss'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'programa_social' => $this->input->post('aspirante_programa_social'),
            'Plantel_cct' => $this->input->post('aspirante_plantel'),
            'semestre' => $this->input->post('aspirante_semestre'),
          
        );

        

        $datos_aspirante_direccion = array(
            'Localidad_id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'calle' => $this->input->post('aspirante_direccion_calle').' '.$this->input->post('aspirante_direccion_numero'),
            'colonia' => $this->input->post('aspirante_direccion_colonia'),
            'cp' => $this->input->post('aspirante_direccion_cp')
        );

        $datos_aspirante_tutor = array(
            'nombre' => $this->input->post('aspirante_tutor_nombre'),
            'telefono' => $this->input->post('aspirante_tutor_telefono'),
            'ocupacion' => $this->input->post('aspirante_tutor_ocupacion'),
            'parentezco' => $this->input->post('aspirante_tutor_parentezco')
        );


        $datos_aspirante_lengua = array(
            'Lengua_id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'lee' => $this->input->post('aspirante_lengua_lee'),
            'habla' => $this->input->post('aspirante_lengua_habla'),
            'escribe' => $this->input->post('aspirante_lengua_escribe'),
            'entiende' => $this->input->post('aspirante_lengua_entiende'),
            'traduce' => $this->input->post('aspirante_lengua_traduce')
        );


        $datos_aspirante_secundaria = array(
            'nombre_secundaria' => $this->input->post('aspirante_secundaria_nombre'),
            'tipo_subsistema' => $this->input->post('aspirante_secundaria_tipo_subsistema'),
            'Localidad_id_localidad' => $this->input->post('aspirante_secundaria_localidad')
        );


        $datos_aspirante_documentos = array();
            //'aspirante_documento_acta_nacimiento' => $this->input->post('aspirante_documento_acta_nacimiento'),
            //'aspirante_documento_curp' => $this->input->post('aspirante_documento_curp'),
            //'aspirante_documento_certificado_secundaria' => $this->input->post('aspirante_documento_certificado_secundaria'),
            //'aspirante_documento_fotos' => $this->input->post('aspirante_documento_fotos')
    

        if($this->input->post('aspirante_documento_acta_nacimiento')!=''){
            $datos_aspirante_documentos['aspirante_documento_acta_nacimiento'] = $this->input->post('aspirante_documento_acta_nacimiento');
        }

        if($this->input->post('aspirante_documento_curp')!=''){
            $datos_aspirante_documentos['aspirante_documento_curp'] = $this->input->post('aspirante_documento_curp');
        }

        if($this->input->post('aspirante_documento_certificado_secundaria')!=''){
            $datos_aspirante_documentos['aspirante_documento_certificado_secundaria'] = $this->input->post('aspirante_documento_certificado_secundaria');
        }

        if($this->input->post('aspirante_documento_fotos')!=''){
            $datos_aspirante_documentos['aspirante_documento_fotos'] = $this->input->post('aspirante_documento_fotos');
        }





        $this->M_aspirante->actualizar_datos_aspirante(
            $datos_aspirante,
            $datos_aspirante_direccion,
            $datos_aspirante_tutor,
            $datos_aspirante_lengua,
            $datos_aspirante_secundaria,
            $datos_aspirante_documentos,
            $no_control
        );
        //$this->M_aspirante->insertar_aspirante($datos_aspirante);

    }

    public function get_datos_aspirante(){
        $no_control = $this->uri->segment(3);

        $datos['aspirante'] = $this->M_aspirante->get_aspirante($no_control);
        $datos['direccion_aspirante'] = $this->M_direccion_aspirante->get_direccion_aspirante($no_control);
        $datos['tutor_aspirante'] = $this->M_tutor->get_tutor_aspirante($no_control);
        $datos['lengua_materna_aspirante'] = $this->M_lengua_materna->get_lengua_materna_aspirante($no_control);
        $datos['datos_secundaria_aspirante'] = $this->M_datos_secundaria->get_datos_secundaria_aspirante($no_control);
        $datos['documentacion_aspirante'] = $this->M_documentacion->get_documentacion_aspirante($no_control);
    
        echo json_encode($datos);
    }




    public function buscar_aspirantes_nombre(){
        $nombre = $this->input->get('nombre');
        $apellido_paterno = $this->input->get('apellido_paterno');
        $apellido_materno = $this->input->get('apellido_materno');
        $plantel = $this->input->get('plantel');
        echo json_encode($this->M_aspirante->get_aspirantes_nombre(
            $nombre,
            $apellido_paterno,
            $apellido_materno,
            $plantel
        ));
    }

    
    public function registrar_datos_nuevo_ingreso(){
        $this->load->view("admin/nuevoingreso");
        $numero=$this->M_aspirante->asignar_num_control();
        $num=10000+$numero;
        //$no_control = 'CSEIIO'.date('y').str_pad($numero,4,'0',STR_PAD_LEFT);
        $no_control = 'CSEIIO'.date('y').$num;

        $datos_aspirante = array(
            'no_control' => $no_control,
            'nombre' => $this->input->post('aspirante_nombre'),
            'apellido_paterno' => $this->input->post('aspirante_apellido_paterno'),
            'apellido_materno' => $this->input->post('aspirante_apellido_materno'),
            'curp' => $this->input->post('aspirante_curp'),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'telefono' => $this->input->post('aspirante_telefono'),
            'correo' => $this->input->post('aspirante_correo'),
            'nss' => $this->input->post('aspirante_nss'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'programa_social' => $this->input->post('aspirante_programa_social'),
            'Plantel_cct' => $this->input->post('aspirante_plantel'),
            'semestre' => 1,
            'tipo_ingreso' => 'NUEVO INGRESO',
            'fecha_registro' => date("Y-m-d")
        );

        

        $datos_aspirante_direccion = array(
            'Localidad_id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'Aspirante_no_control' => $no_control,
            'calle' => $this->input->post('aspirante_direccion_calle').' '.$this->input->post('aspirante_direccion_numero'),
            'colonia' => $this->input->post('aspirante_direccion_colonia'),
            'cp' => $this->input->post('aspirante_direccion_cp')
        );

        $datos_aspirante_tutor = array(
            'nombre' => $this->input->post('aspirante_tutor_nombre'),
            'telefono' => $this->input->post('aspirante_tutor_telefono'),
            'ocupacion' => $this->input->post('aspirante_tutor_ocupacion'),
            'parentezco' => $this->input->post('aspirante_tutor_parentezco'),
            'Aspirante_no_control' => $no_control
        );


        $datos_aspirante_lengua = array(
            'Aspirante_no_control' => $no_control,
            'Lengua_id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'lee' => $this->input->post('aspirante_lengua_lee'),
            'habla' => $this->input->post('aspirante_lengua_habla'),
            'escribe' => $this->input->post('aspirante_lengua_escribe'),
            'entiende' => $this->input->post('aspirante_lengua_entiende'),
            'traduce' => $this->input->post('aspirante_lengua_traduce')
        );


        $datos_aspirante_secundaria = array(
            'nombre_secundaria' => $this->input->post('aspirante_secundaria_nombre'),
            'tipo_subsistema' => $this->input->post('aspirante_secundaria_tipo_subsistema'),
            'Localidad_id_localidad' => $this->input->post('aspirante_secundaria_localidad'),
            'Aspirante_no_control' => $no_control
        );


        $datos_aspirante_documentos = array();
            //'aspirante_documento_acta_nacimiento' => $this->input->post('aspirante_documento_acta_nacimiento'),
            //'aspirante_documento_curp' => $this->input->post('aspirante_documento_curp'),
            //'aspirante_documento_certificado_secundaria' => $this->input->post('aspirante_documento_certificado_secundaria'),
            //'aspirante_documento_fotos' => $this->input->post('aspirante_documento_fotos')

            
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



        $this->M_aspirante->insertar_aspirante_nuevo_ingreso(
            $datos_aspirante,
            $datos_aspirante_direccion,
            $datos_aspirante_tutor,
            $datos_aspirante_lengua,
            $datos_aspirante_secundaria,
            $datos_aspirante_documentos
        );

       

    }

    public function registrar_datos_portabilidad(){
        $this->load->view("admin/portabilidad");
        $numero=$this->M_aspirante->asignar_num_control();
        $num=10000+$numero;
        //$no_control = 'CSEIIO'.date('y').str_pad($numero,4,'0',STR_PAD_LEFT);
        $no_control = 'CSEIIO'.date('y').$num;

        $datos_aspirante = array(
            'no_control' => $no_control,
            'nombre' => $this->input->post('aspirante_nombre'),
            'apellido_paterno' => $this->input->post('aspirante_apellido_paterno'),
            'apellido_materno' => $this->input->post('aspirante_apellido_materno'),
            'curp' => $this->input->post('aspirante_curp'),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'telefono' => $this->input->post('aspirante_telefono'),
            'correo' => $this->input->post('aspirante_correo'),
            'nss' => $this->input->post('aspirante_nss'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'programa_social' => $this->input->post('aspirante_programa_social'),
            'Plantel_cct' => $this->input->post('aspirante_plantel'),
            'semestre' => $this->input->post('aspirante_semestre'),
            'tipo_ingreso' => 'PORTABILIDAD'
        );

        

        $datos_aspirante_direccion = array(
            'Localidad_id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'Aspirante_no_control' => $no_control,
            'calle' => $this->input->post('aspirante_direccion_calle').' '.$this->input->post('aspirante_direccion_numero'),
            'colonia' => $this->input->post('aspirante_direccion_colonia'),
            'cp' => $this->input->post('aspirante_direccion_cp')
        );

        $datos_aspirante_tutor = array(
            'nombre' => $this->input->post('aspirante_tutor_nombre'),
            'telefono' => $this->input->post('aspirante_tutor_telefono'),
            'ocupacion' => $this->input->post('aspirante_tutor_ocupacion'),
            'parentezco' => $this->input->post('aspirante_tutor_parentezco'),
            'Aspirante_no_control' => $no_control
        );


        $datos_aspirante_lengua = array(
            'Aspirante_no_control' => $no_control,
            'Lengua_id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'lee' => $this->input->post('aspirante_lengua_lee'),
            'habla' => $this->input->post('aspirante_lengua_habla'),
            'escribe' => $this->input->post('aspirante_lengua_escribe'),
            'entiende' => $this->input->post('aspirante_lengua_entiende'),
            'traduce' => $this->input->post('aspirante_lengua_traduce')
        );


        $datos_aspirante_secundaria = array(
            'nombre_secundaria' => $this->input->post('aspirante_secundaria_nombre'),
            'tipo_subsistema' => $this->input->post('aspirante_secundaria_tipo_subsistema'),
            'Localidad_id_localidad' => $this->input->post('aspirante_secundaria_localidad'),
            'Aspirante_no_control' => $no_control
        );


        $datos_aspirante_documentos = array();
        $datos_aspirante_documentos = array();
        //'aspirante_documento_acta_nacimiento' => $this->input->post('aspirante_documento_acta_nacimiento'),
        //'aspirante_documento_curp' => $this->input->post('aspirante_documento_curp'),
        //'aspirante_documento_certificado_secundaria' => $this->input->post('aspirante_documento_certificado_secundaria'),
        //'aspirante_documento_fotos' => $this->input->post('aspirante_documento_fotos')

        
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



        if($this->input->post('aspirante_documento_certificado_parcial')!=''){
            $datos_aspirante_documentos['aspirante_documento_certificado_parcial'] = array(
                'Documento_id_documento' => 5,
                'entregado' => true
            );
        }

        else{
            $datos_aspirante_documentos['aspirante_documento_certificado_parcial'] = array(
                'Documento_id_documento' => 5,
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





        $this->M_aspirante->insertar_aspirante_nuevo_ingreso(
            $datos_aspirante,
            $datos_aspirante_direccion,
            $datos_aspirante_tutor,
            $datos_aspirante_lengua,
            $datos_aspirante_secundaria,
            $datos_aspirante_documentos
        );
        //$this->M_aspirante->insertar_aspirante($datos_aspirante);
    }


    function delete_aspirante(){
        $no_control = $this->input->get('no_control');
        echo $this->M_aspirante->delete_aspirante($no_control);
    }
    
    
  
}
?>