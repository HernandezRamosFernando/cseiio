<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_estudiante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_estudiante');
    }


    //generacion de matricula
    public function generar_numcontrol($semestre){

        $numero=$this->M_estudiante->asignar_numero_consecutivo();
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

        //fin generacion de matriucla






  


    public function registrar_datos_estudiante(){
        $no_control=$this->generar_numcontrol(1);
        $tipo_estudiante = $this->input->post('formulario');

        //inicio estudiante
        $datos_estudiante = array(
            'no_control' => $no_control,
            'nombre' => strtoupper($this->input->post('aspirante_nombre')),
            'primer_apellido' => strtoupper($this->input->post('aspirante_apellido_paterno')),
            'segundo_apellido' => strtoupper($this->input->post('aspirante_apellido_materno')),
            'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'curp' => $this->input->post('aspirante_curp'),
            'fecha_registro' => strtoupper(date("Y-m-d")),
            //'tipo_ingreso' => 'NUEVO INGRESO',
            //'semestre' => 1,
            'folio_programa_social' => $this->input->post('aspirante_programa_social'),
            //'matricula' => strtoupper($this->input->post('aspirante_curp')),
            'correo' => strtoupper($this->input->post('aspirante_correo')),
            'nss' => strtoupper($this->input->post('aspirante_nss')),
            'calle' => strtoupper($this->input->post('aspirante_direccion_calle')),
            'colonia' => strtoupper($this->input->post('aspirante_direccion_colonia')),
            'cp' => $this->input->post('aspirante_direccion_cp'),
            'id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            //'semestre_en_curso' => $this->input->post('/d'),
            'fecha_inscripcion' => date("Y-m-d"),
            'telefono' => $this->input->post('aspirante_telefono'),
            'Plantel_cct_plantel' => $this->input->post('aspirante_plantel'),
            //'nacinalidad' => $this->input->post('/d'),
            'lugar_nacimiento' => strtoupper($this->input->post('aspirante_lugar_nacimiento')),
            'Escuela_procedencia_cct_escuela_procedencia' => $this->input->post('aspirante_secundaria_cct')
        );

        if($tipo_estudiante=='nuevo_ingreso'){
            $datos_estudiante['tipo_ingreso'] = 'NUEVO INGRESO';
            $datos_estudiante['semestre'] = 1;
            $datos_estudiante['semestre_en_curso'] = 1;
        }

        else{
            $datos_estudiante['tipo_ingreso'] = 'PORTABILIDAD';
            $datos_estudiante['semestre'] = $this->input->post('aspirante_semestre');
            $datos_estudiante['semestre_en_curso'] = $this->input->post('aspirante_semestre');
        }

        //print_r($datos_estudiante);
        //fin estudiante

        $datos_estudiante_tutor = array(
            'nombre_tutor' => strtoupper($this->input->post('aspirante_tutor_nombre')),
            'primer_apellido_tutor' =>strtoupper($this->input->post('aspirante_tutor_apellido')),
            'segundo_apellido_tutor' =>strtoupper($this->input->post('aspirante_tutor_apellidodos')),
            'folio_programa_social_tutor' => $this->input->post('aspirante_tutor_prospera'),
            'telefono_comunidad' => strtoupper($this->input->post('aspirante_tutor_telefono_comunidad')),
            'telefono_tutor' => strtoupper($this->input->post('aspirante_tutor_telefono')==''?null:$this->input->post('aspirante_tutor_parentesco')),
            'ocupacion' => $this->input->post('aspirante_tutor_ocupacion')
        );

        $parentesco_estudiante_tutor = $this->input->post('aspirante_tutor_parentesco'); 

        //print_r($datos_estudiante_tutor);


        //inicio lenguas maternas

        $id_lengua = $this->input->post('aspirante_lengua_nombre');

        $datos_estudiante_lengua_materna['lee'] = array(
            'Estudiante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'LEE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_lee')
        );


        $datos_estudiante_lengua_materna['habla'] = array(
            'Estudiante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'HABLA',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_habla')
        );


        $datos_estudiante_lengua_materna['escribe'] = array(
            'Estudiante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'ESCRIBE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_escribe')
        );


        $datos_estudiante_lengua_materna['entiende'] = array(
            'Estudiante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'ENTIENDE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_entiende')
        );


        $datos_estudiante_lengua_materna['traduce'] = array(
            'Estudiante_no_control' => $no_control,
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'TRADUCE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_traduce')
        );

        //print_r($datos_estudiante_lengua_materna);

        //fin datos lengua materna

        $datos_estudiante_medicos['alergia'] = array(
            'descripcion' => 'ALERGIA',
            'valor' => strtoupper($this->input->post('aspirante_alergia')),
            'Estudiante_no_control' => $no_control
        );

        $datos_estudiante_medicos['discapacidad'] = array(
            'descripcion' => 'DISCAPACIDAD',
            'valor' => strtoupper($this->input->post('aspirante_discapacidad')),
            'Estudiante_no_control' => $no_control
        );

        $datos_estudiante_medicos['sangre'] = array(
            'descripcion' => 'TIPO DE SANGRE',
            'valor' => strtoupper($this->input->post('tipo_sangre')),
            'Estudiante_no_control' => $no_control
        );



      



      //documentacion estudiante


        //acta de nacimiento
            if($this->input->post('aspirante_documento_acta_nacimiento')!=''){
                $datos_estudiante_documentos['aspirante_documento_acta_nacimiento'] = array(
                    'id_documento' => 1,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_acta_nacimiento'] = array(
                    'id_documento' => 1,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }


        //curp
            if($this->input->post('aspirante_documento_curp')!=''){
                $datos_estudiante_documentos['aspirante_documento_curp'] = array(
                    'id_documento' => 2,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_curp'] = array(
                    'id_documento' => 2,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }


            //certiicado secundaria
            if($this->input->post('aspirante_documento_certificado_secundaria')!=''){
                $datos_estudiante_documentos['aspirante_documento_certificado_secundaria'] = array(
                    'id_documento' => 3,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_certificado_secundaria'] = array(
                    'id_documento' => 3,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }


            //fotos
            if($this->input->post('aspirante_documento_fotos')!=''){
                $datos_estudiante_documentos['aspirante_documento_fotos'] = array(
                    'id_documento' => 4,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_documento_fotos'] = array(
                    'id_documento' => 4,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }

            


            //certificado medico
            if($this->input->post('aspirante_documento_certificado_medico')!=''){
                $datos_estudiante_documentos['aspirante_documento_certificado_medico'] = array(
                    'id_documento' => 101,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_certificado_medico'] = array(
                    'id_documento' => 101,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }


            //carta buena conducta
            if($this->input->post('aspirante_documento_carta_buena_conducta')!=''){
                $datos_estudiante_documentos['aspirante_documento_buena_conducta'] = array(
                    'id_documento' => 102,
                    'entregado' => true,
                    'Estudiante_no_control' => $no_control
                );
            }
            else{
                $datos_estudiante_documentos['aspirante_documento_buena_conducta'] = array(
                    'id_documento' => 102,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }


            //documentacion extra
            if($tipo_estudiante!='nuevo_ingreso'){

                if($this->input->post('aspirante_documento_certificado_parcial')!=''){
                    $datos_estudiante_documentos['aspirante_documento_certificado_parcial'] = array(
                        'id_documento' => 6,
                        'entregado' => true,
                        'Estudiante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_certificado_parcial'] = array(
                        'id_documento' => 6,
                        'entregado' => 0,
                        'Estudiante_no_control' => $no_control
                    );
                }


                if($this->input->post('aspirante_documento_resolucion')!=''){
                    $datos_estudiante_documentos['aspirante_documento_resolucion'] = array(
                        'id_documento' => 7,
                        'entregado' => true,
                        'Estudiante_no_control' => $no_control
                    );
                }
                else{
                    $datos_estudiante_documentos['aspirante_documento_resolucion'] = array(
                        'id_documento' => 7,
                        'entregado' => 0,
                        'Estudiante_no_control' => $no_control
                    );
                }

            }

           

       
        echo $this->M_estudiante->insertar_estudiante_nuevo_ingreso(
            $datos_estudiante,
            $datos_estudiante_tutor,
            $parentesco_estudiante_tutor,
            $datos_estudiante_lengua_materna,
            $datos_estudiante_documentos,
            $datos_estudiante_medicos
        );
        
        
        

    }


    public function get_estudiantes_curp_plantel(){
        $curp = $this->input->get('curp');
        $cct_plantel = $this->input->get('cct_plantel');
        echo json_encode($this->M_estudiante->get_estudiantes_curp_plantel($curp,$cct_plantel));
    }


    public function get_estudiante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_estudiante->get_estudiante($no_control));
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

    
  
}



    

?>