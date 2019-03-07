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
    }

	public function index()
	{
		$this->load->view('formulario');
    }

    public function nuevo_ingreso(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['planteles'] = $this->M_plantel->get_planteles();

 
        $this->load->view("nuevoingreso",$datos);
    }

    public function portabilidad(){
        $datos['estados'] = $this->M_estado->get_estados();
        $datos['municipios'] = $this->M_municipio->get_municipios_estado(1);
        $datos['localidades'] = $this->M_localidad->get_localidades_municipio(1);
        $datos['lenguas'] = $this->M_lengua->get_lenguas();
        $datos['planteles'] = $this->M_plantel->get_planteles();

 
        $this->load->view("portabilidad",$datos);
    }

    public function buscar_aspirante_editar(){
        $datos['planteles'] = $this->M_plantel->get_planteles();
        $this->load->view("busqueda_aspirante_editar",$datos);
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
        $no_control = 'AAAAAAA20';

        $datos_aspirante = array(
            'no_control' => $no_control,
            'nombre' => strtoupper($this->input->post('aspirante_nombre')),
            'apellido_paterno' => strtoupper($this->input->post('aspirante_apellido_paterno')),
            'apellido_materno' => strtoupper($this->input->post('aspirante_apellido_materno')),
            'curp' => strtoupper($this->input->post('aspirante_curp')),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'telefono' => $this->input->post('aspirante_telefono'),
            'correo' => strtoupper($this->input->post('aspirante_correo')),
            'nss' => $this->input->post('aspirante_nss'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'programa_social' => $this->input->post('aspirante_programa_social'),
            'Plantel_cct' => $this->input->post('aspirante_plantel'),
            'semestre' => 1,
            'tipo_ingreso' => 'NUEVO INGRESO'
        );

        

        $datos_aspirante_direccion = array(
            'Localidad_id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'Aspirante_no_control' => $no_control,
            'calle' => strtoupper($this->input->post('aspirante_direccion_calle').' '.$this->input->post('aspirante_direccion_numero')),
            'colonia' => strtoupper($this->input->post('aspirante_direccion_colonia')),
            'cp' => $this->input->post('aspirante_direccion_cp')
        );

        $datos_aspirante_tutor = array(
            'nombre' => strtoupper($this->input->post('aspirante_tutor_nombre')),
            'telefono' => $this->input->post('aspirante_tutor_telefono'),
            'ocupacion' => strtoupper($this->input->post('aspirante_tutor_ocupacion')),
            'parentezco' => strtoupper($this->input->post('aspirante_tutor_parentezco')),
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
            'nombre_secundaria' => strtoupper($this->input->post('aspirante_secundaria_nombre')),
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
    
    
  
}
?>