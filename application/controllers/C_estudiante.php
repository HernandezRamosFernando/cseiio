<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_estudiante extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_estudiante');
        $this->load->model('M_documentacion');
        $this->load->model('M_plantel');
        $this->load->model('M_localidad');
        $this->load->model('M_escuela_procedencia');
        $this->load->model('M_lengua');
        $this->load->model('M_ciclo_escolar');
        $this->load->model('M_resolucion_equivalencia');
        $this->load->model('M_friae');
        $this->load->model('M_regularizacion');

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
        $fecha_inscripcion_del_ciclo = $this->M_ciclo_escolar->fecha_inscripcion();

        if($this->input->post("aspirante_procedencia_combo")=="igual"){
            $localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_direccion_localidad'))->nombre_localidad.'-'.$this->M_localidad->get_nombre_localidad($this->input->post('aspirante_direccion_localidad'))->nombre_municipio;
        }

        else if($this->input->post("aspirante_procedencia_combo")=="diferente"){
            $localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_localidad.'-'.$this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_municipio;
            //$localidad_origen = $this->M_localidad->get_nombre_localidad($this->input->post('aspirante_procedencia_localidad'))->nombre_localidad;
        }

        else if($this->input->post("aspirante_procedencia_combo")=="extranjero"){
            $localidad_origen = $this->input->post("aspirante_procedencia_extranjero");
        }

        //inicio estudiante
        $datos_estudiante = array(
            'no_control' => $no_control,
            'nombre' => mb_strtoupper($this->input->post('aspirante_nombre')),
            'primer_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_paterno')),
            'segundo_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_materno')),
            //'fecha_nacimiento' => $this->input->post('aspirante_fecha_nacimiento'),
            'fecha_nacimiento' => $this->input->post('aspirante_anio_nacimiento').'-'.$this->input->post('aspirante_mes_nacimiento').'-'.(strlen($this->input->post('aspirante_dia_nacimiento'))==1?('0'.$this->input->post('aspirante_dia_nacimiento')):$this->input->post('aspirante_dia_nacimiento')),
            'sexo' => $this->input->post('aspirante_sexo'),
            'curp' => mb_strtoupper($this->input->post('aspirante_curp')),
            'fecha_registro' => mb_strtoupper(date("Y-m-d")),
            'folio_programa_social' => $this->input->post('aspirante_programa_social'),
            'correo' => mb_strtoupper($this->input->post('aspirante_correo')),
            'nss' => mb_strtoupper($this->input->post('aspirante_nss')),
            'calle' => mb_strtoupper($this->input->post('aspirante_direccion_calle')),
            'colonia' => mb_strtoupper($this->input->post('aspirante_direccion_colonia')),
            'cp' => $this->input->post('aspirante_direccion_cp'),
            'id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'fecha_inscripcion' => $fecha_inscripcion_del_ciclo,
            'telefono' => $this->input->post('aspirante_telefono'),
            'Plantel_cct_plantel' => $this->input->post('aspirante_plantel'),
            'lugar_nacimiento' => mb_strtoupper($this->input->post('aspirante_lugar_nacimiento')),
            'nacionalidad' => $this->input->post('aspirante_nacionalidad'),
            'localidad_origen' => $localidad_origen,
            'etnia'=>$this->input->post("aspirante_etnia")
        );

        if($tipo_estudiante=='nuevo_ingreso'){
            $datos_estudiante['tipo_ingreso'] = 'NUEVO INGRESO';
            $datos_estudiante['semestre'] = 1;
            $datos_estudiante['semestre_en_curso'] = 1;
            $datos_estudiante['semestre_ingreso'] = 1;

            
            $datos_escuela_procedencia['secundaria']=array(
                'Estudiante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct')
            );
        }

        else{
            $datos_estudiante['tipo_ingreso'] = 'PORTABILIDAD';
            $datos_estudiante['semestre'] = $this->input->post('aspirante_semestre');
            $datos_estudiante['semestre_en_curso'] = $this->input->post('aspirante_semestre');
            $datos_estudiante['semestre_ingreso'] = $this->input->post('aspirante_semestre');
            $datos_escuela_procedencia['secundaria']=array(
                'Estudiante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct')
            );

            $datos_escuela_procedencia['bachillerato']=array(
                'Estudiante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_bachillerato_cct')
            );
        }


        

        //print_r($datos_estudiante);
        
        //fin estudiante

        $datos_estudiante_tutor = array(
            'nombre_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_nombre')),
            'primer_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellido')),
            'segundo_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellidodos')),
            'folio_programa_social_tutor' => $this->input->post('aspirante_tutor_prospera'),
            'telefono_comunidad' => mb_strtoupper($this->input->post('aspirante_tutor_telefono_comunidad')),
            'telefono_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_telefono')==''?null:$this->input->post('aspirante_tutor_telefono')),
            'ocupacion' => mb_strtoupper($this->input->post('aspirante_tutor_ocupacion'))
        );

        $parentesco_estudiante_tutor = mb_strtoupper($this->input->post('aspirante_tutor_parentesco')); 

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
            'valor' => mb_strtoupper($this->input->post('aspirante_alergia')),
            'Estudiante_no_control' => $no_control
        );

        $datos_estudiante_medicos['discapacidad'] = array(
            'descripcion' => 'DISCAPACIDAD',
            'valor' => mb_strtoupper($this->input->post('aspirante_discapacidad')),
            'Estudiante_no_control' => $no_control
        );

        $datos_estudiante_medicos['sangre'] = array(
            'descripcion' => 'TIPO DE SANGRE',
            'valor' => mb_strtoupper($this->input->post('tipo_sangre')),
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

            $check = $this->input->post('aspirante_documento_carta_extemporaneo');

            if($check=="8"){
                $datos_estudiante_documentos['aspirante_documento_carta_extemporaneo'] = array(
                    'id_documento' => 8,
                    'entregado' => 1,
                    'Estudiante_no_control' => $no_control
                );
            }

            else if($check==""){
                $datos_estudiante_documentos['aspirante_documento_carta_extemporaneo'] = array(
                    'id_documento' => 8,
                    'entregado' => 0,
                    'Estudiante_no_control' => $no_control
                );
            }

           

       
        echo $this->M_estudiante->insertar_estudiante_nuevo_ingreso(
            $datos_estudiante,
            $datos_estudiante_tutor,
            $parentesco_estudiante_tutor,
            $datos_estudiante_lengua_materna,
            $datos_estudiante_documentos,
            $datos_estudiante_medicos,
            $datos_escuela_procedencia
        );

        
        

        //print_r($datos_estudiante);
        
    
        //print_r($datos_estudiante_documentos['aspirante_documento_carta_extemporaneo']);
       // print $check;

    }

    public function update_estudiante(){
        //$no_control=$this->generar_numcontrol(1);


        //inicio estudiante
        $no_control = $this->input->post("aspirante_no_control");
        $id_tutor = $this->input->post("id_tutor");
        $datos_estudiante = array(
            //'no_control' => $no_control,
            'nombre' => mb_strtoupper($this->input->post('aspirante_nombre')),
            'primer_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_paterno')),
            'segundo_apellido' => mb_strtoupper($this->input->post('aspirante_apellido_materno')),
            'fecha_nacimiento' => $this->input->post('aspirante_anio_nacimiento').'-'.$this->input->post('aspirante_mes_nacimiento').'-'.$this->input->post('aspirante_dia_nacimiento'),
            'sexo' => $this->input->post('aspirante_sexo'),
            'curp' => $this->input->post('aspirante_curp'),
            //'tipo_ingreso' => 'NUEVO INGRESO',
            //'semestre' => 1,
            'folio_programa_social' => $this->input->post('aspirante_programa_social'),
            //'matricula' => mb_strtoupper($this->input->post('aspirante_curp')),
            'correo' => mb_strtoupper($this->input->post('aspirante_correo')),
            'nss' => mb_strtoupper($this->input->post('aspirante_nss')),
            'calle' => mb_strtoupper($this->input->post('aspirante_direccion_calle')),
            'colonia' => mb_strtoupper($this->input->post('aspirante_direccion_colonia')),
            'cp' => $this->input->post('aspirante_direccion_cp'),
            'id_localidad' => $this->input->post('aspirante_direccion_localidad'),
            'semestre_en_curso' => $this->input->post('aspirante_semestre'),
            'telefono' => $this->input->post('aspirante_telefono'),
            'Plantel_cct_plantel' => $this->input->post('aspirante_plantel'),
            //'nacinalidad' => $this->input->post('/d'),
            'lugar_nacimiento' => mb_strtoupper($this->input->post('aspirante_lugar_nacimiento')),
            //'cct_escuela_procedencia' => $this->input->post('aspirante_secundaria_cct'),
            'nacionalidad' => $this->input->post('aspirante_nacionalidad')
            //'semestre' => $this->input->post('aspirante_semestre')
        );

        $tipo_ingreso = $this->M_estudiante->get_tipo_ingreso_estudiante($no_control);

        if($tipo_ingreso=="NUEVO INGRESO"){
            $datos_escuela_procedencia['secundaria']=array(
                'Estudiante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct')
            );
        }

        else{
            $datos_escuela_procedencia['secundaria']=array(
                'Estudiante_no_control'=>$no_control,
                'Escuela_procedencia_cct_escuela_procedencia'=>$this->input->post('aspirante_secundaria_cct')
            );
        }

       

        //print_r($datos_estudiante);
        //fin estudiante

        $datos_estudiante_tutor = array(
            'nombre_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_nombre')),
            'primer_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellido')),
            'segundo_apellido_tutor' =>mb_strtoupper($this->input->post('aspirante_tutor_apellidodos')),
            'folio_programa_social_tutor' => $this->input->post('aspirante_tutor_prospera'),
            'telefono_comunidad' => mb_strtoupper($this->input->post('aspirante_tutor_telefono_comunidad')),
            'telefono_tutor' => mb_strtoupper($this->input->post('aspirante_tutor_telefono')==''?null:$this->input->post('aspirante_tutor_telefono')),
            'ocupacion' => mb_strtoupper($this->input->post('aspirante_tutor_ocupacion'))
        );

        $parentesco_estudiante_tutor = mb_strtoupper($this->input->post('aspirante_tutor_parentesco')); 

        //print_r($datos_estudiante_tutor);


        //inicio lenguas maternas

        $id_lengua = $this->input->post('aspirante_lengua_nombre');

        $datos_estudiante_lengua_materna['lee'] = array(
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'LEE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_lee')
        );


        $datos_estudiante_lengua_materna['habla'] = array(
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'HABLA',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_habla')
        );


        $datos_estudiante_lengua_materna['escribe'] = array(
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'ESCRIBE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_escribe')
        );


        $datos_estudiante_lengua_materna['entiende'] = array(
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'ENTIENDE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_entiende')
        );


        $datos_estudiante_lengua_materna['traduce'] = array(
            'id_lengua' => $this->input->post('aspirante_lengua_nombre'),
            'descripcion' => 'TRADUCE',
            'porcentaje' => $id_lengua==0?'null':$this->input->post('aspirante_lengua_traduce')
        );
            
        //datos medicos

        $datos_estudiante_medicos['alergia'] = array(
            'descripcion' => 'ALERGIA',
            'valor' => mb_strtoupper($this->input->post('aspirante_alergia'))
        );

        $datos_estudiante_medicos['discapacidad'] = array(
            'descripcion' => 'DISCAPACIDAD',
            'valor' => mb_strtoupper($this->input->post('aspirante_discapacidad'))
        );

        $datos_estudiante_medicos['sangre'] = array(
            'descripcion' => 'TIPO DE SANGRE',
            'valor' => mb_strtoupper($this->input->post('tipo_sangre'))
        );

        //fin datos medicos

       
        echo $this->M_estudiante->update_estudiante(
            $datos_estudiante,
            $datos_estudiante_tutor,
            $parentesco_estudiante_tutor,
            $datos_estudiante_lengua_materna,
            $datos_estudiante_medicos,
            $no_control,
            $id_tutor,
            $datos_escuela_procedencia
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


    public function delete_estudiante(){
        $no_control = $this->input->get('no_control');
        echo $this->M_estudiante->delete_estudiante($no_control);
    }


    public function get_plantel_estudiante(){
        $no_control = $this->input->get('no_control');
        echo json_encode($this->M_estudiante->get_plantel_estudiante($no_control));
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
        case 75:
            $resultado= "Bien 75%";
        break;
         case 100:
            $resultado= "Muy bien 100%";
            break;
    }

    return $resultado;

}


 
public function estudiantes_sin_matricula(){
    $curp = $this->input->get('curp');
    $plantel = $this->input->get('plantel');
   echo json_encode($this->M_estudiante->estudiantes_sin_matricula( 
        $curp,
        $plantel
        ));
}


public function get_docxaspirante(){
    $no_control = $this->uri->segment(3);
    $nombre = $this->uri->segment(4);
    $primer_apellido = $this->uri->segment(5);
    $segundo_apellido = $this->uri->segment(6);
    
    $datos['numcontrol']=$no_control;
    $datos['nombre_completo']=$nombre.' '.$primer_apellido.' '.$segundo_apellido;
    $datos['documentacion_aspirante'] = $this->M_documentacion->get_documentacion_xnombrede_aspirante($no_control);

    echo json_encode($datos);
}
public function buscar_aspirantesxplantel(){
    $plantel = $this->input->get('plantel');
    $curp = $this->input->get('curp');
     echo json_encode($this->M_estudiante->listar_aspirantes_xplantel($curp, $plantel));
 }
 
  public function generar_formato_inscripcion(){
    $this->load->library('pdf');
    $no_control = $this->input->get('no_control');
    $datos['estudiante'] = $this->M_estudiante->get_estudiante($no_control);
    $datos['plantel']= $this->M_plantel->get_plantel($datos['estudiante']['estudiante'][0]->Plantel_cct_plantel);

    $datos['domicilio_estudiante'] = $this->M_localidad->get_nombre_estado_municipio_localidad($datos['estudiante']['estudiante'][0]->id_localidad);



    
    $datos['escuela_procedencia']=$datos['estudiante']['escuela_procedencia'];

    if(isset($datos['estudiante']['lengua_materna'][0]->id_lengua)){
        $datos['nombre_lengua'] = $this->M_lengua->get_nombre_lengua($datos['estudiante']['lengua_materna'][0]->id_lengua)->nombre_lengua;
    $datos['lengua_lee'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][0]->porcentaje);
    $datos['lengua_habla'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][1]->porcentaje);
    $datos['lengua_escribe'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][2]->porcentaje);
    $datos['lengua_entiende'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][3]->porcentaje);
    $datos['lengua_traduce'] =$this->valor_Lengua($datos['estudiante']['lengua_materna'][4]->porcentaje);

    }
    else{

    $datos['nombre_lengua'] = "";
    $datos['lengua_lee'] ="";
    $datos['lengua_habla'] ="";
    $datos['lengua_escribe'] ="";
    $datos['lengua_entiende'] ="";
    $datos['lengua_traduce'] ="";

    }
    
    
    $datos['lista_documentacion'] =$this->M_documentacion->get_documentacion_xnombrede_aspirante($no_control);
    $this->load->view('reportes/formatofichainscripcion',$datos);
}


public function generar_formato_observaciones_expedientes(){
    $plantel = $this->input->post('plantel_busqueda');
    $datos['ciclo_escolar'] = $this->M_ciclo_escolar->get_ciclo_escolar();
    $datos['dato_plantel']=$this->M_plantel->get_plantel($plantel);
    $datos['lista_doc']=$this->M_documentacion->lista_observaciones_en_documentacion($plantel);
    $this->load->library('pdf');
    $this->load->view('reportes/formatoobservacionesexpedientes',$datos);
}

public function generar_matricula(){
    $no_control = $this->input->get('no_control');
    //$nombre_completo = $this->input->get('nombre_completo');
    $matricula='';
    $mensaje='';
    $datos= $this->M_estudiante->obtener_fecha_inscripcion_semestre($no_control);
        $fecha_inscripcion=$datos->fecha_inscripcion;
        $semestre=$datos->semestre_ingreso;
        $anio_ciclo=$this->M_estudiante->obtener_ciclo_escolar($fecha_inscripcion);
        if($anio_ciclo!=null ){
            $numconsecutivo=$this->M_estudiante->numero_consecutivo_matricula($anio_ciclo);
            $matricula=$anio_ciclo.$semestre.str_pad($numconsecutivo,4,'0',STR_PAD_LEFT);
            $datos = array(
            'no_control' => $no_control,
            'matricula' => $matricula,
            'fecha_asignacion_matricula' => date("Y-m-d")
            );
            echo $this->M_estudiante->insertar_matricula($datos);
        }
        else{
            $matricula=null;
            echo "no";
        }
}
    

public function estudiantes_portabilidad(){
    $curp = $this->input->get('curp');
    $plantel = $this->input->get('plantel');
   echo json_encode($this->M_estudiante->estudiantes_portabilidad( 
        $curp,
        $plantel
        ));
}


public function nombre_del_semestre($idsemestre){
    $nombre='';
        switch ($idsemestre) {
        case 1:
            $nombre='primer';
            break;
        case 2:
            $nombre="segundo";
            break;
        case 3:
             $nombre="tercer";
            break;
        case 4:
             $nombre="cuarto";
            break;
        case 5:
             $nombre="quinto";
            break;
        case 6:
             $nombre="sexto";
            break;
            }
    return $nombre;
    
}


public function ciclos_escolares_acreditados($ciclo_escolar,$semestre_acreditado){
    $ciclos_escolares='';
    $ciclo = explode("-",$ciclo_escolar);
    $num_ciclos=round($semestre_acreditado/2);
    $anio_inicial=$ciclo[1]-$num_ciclos; 
    $anio_final=$anio_inicial+1;
    
    if($num_ciclos>1){
        for($x=1;$x<=$num_ciclos;$x++){
        if($x>1){
            $ciclos_escolares.=', ';
        }
        $ciclos_escolares.=$anio_inicial.'-'.$anio_final;
        $anio_inicial=$anio_inicial+1;
        $anio_final=$anio_final+1;
        }
    }
    else{
        $ciclos_escolares=$ciclo_escolar;
    }

    return $ciclos_escolares;

}




public function generar_resolucion_equivalencia(){
    $no_control = $this->input->post('num_control_estudiante');
    $num_folio = mb_strtoupper($this->input->post('num_folio'));
    $plantel_inscrito = $this->input->post('plantel_inscrito');
    $fecha_expedicion = $this->input->post('fecha_expedicion');
    $ciclo_escolar= $this->input->post('ciclo_escolar');
    $promedio_acreditado = $this->input->post('promedio_acreditado');
    $semestre_acreditado = $this->input->post('semestre_acreditado');
       
     echo $this->M_resolucion_equivalencia->generar_resolucion($no_control,$num_folio,$plantel_inscrito,$fecha_expedicion,$ciclo_escolar,$promedio_acreditado,$semestre_acreditado);

    
}


public function descargar_resolucion_equivalencia(){
    $no_control=$this->input->get('no_control');
    $datos_resolucion=$this->M_resolucion_equivalencia->get_resolucion_equivalencia($no_control);
    $datos_estudiante=$this->M_estudiante->get_plantel_estudiante($no_control);
    $datos_escuela_procedencia=$this->M_escuela_procedencia->get_escuela_procedencia_repetidor($datos_estudiante[0]->no_control);
    $datos['escuela_procedencia'] = $datos_escuela_procedencia[0]->nombre_escuela_procedencia;
    $datos['cct_procedencia'] = $datos_escuela_procedencia[0]->cct_escuela_procedencia;
    $datos['nombre_completo']=$datos_estudiante[0]->nombre." ".$datos_estudiante[0]->primer_apellido." ".$datos_estudiante[0]->segundo_apellido;
    $datos['plantel_inscrito']=$datos_estudiante[0]->Plantel_cct_plantel;
    $datos['semestre_acreditado']=" a ".$this->nombre_del_semestre($datos_resolucion[0]->ultimo_semestre_acreditado);
    $datos['promedio_acreditado']=$datos_resolucion[0]->promedio_acreditado;
   
    $datos['nombre_plantel_inscrito']=$this->M_plantel->get_nombre_localidad($datos_estudiante[0]->Plantel_cct_plantel)[0]->nombre_localidad;
    

     date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    //$hora = strftime("%I:%M:%S %p", strtotime($timestamp));Descomentar en caso de requerir hora
    setlocale(LC_TIME, 'spanish');
   
    $datos['fecha_expedicion'] =utf8_encode(strftime("%d de %B del %Y", strtotime($datos_resolucion[0]->fecha_expedicion)));
    $datos['num_folio'] = $datos_resolucion[0]->folio;
    $nombre_ciclo_escolar=$this->M_ciclo_escolar->obtener_nombre_ciclo_escolar($datos_resolucion[0]->id_ciclo_escolar)[0]->nombre_ciclo_escolar;
    $semestre_acreditado=$datos_resolucion[0]->ultimo_semestre_acreditado;
    $datos['ciclos_escolares']=$this->ciclos_escolares_acreditados($nombre_ciclo_escolar,$semestre_acreditado);
    

    $this->load->library('pdf');
    $this->load->view('reportes/resolucion_equivalencia',$datos);

}
 




public function get_resolucion_equivalencia(){
    $no_control = $this->input->get('no_control');
   echo json_encode($this->M_resolucion_equivalencia->get_resolucion_equivalencia($no_control));
}


public function editar_resolucion_equivalencia(){
    $no_control=$this->input->post('mnum_control_estudiante');
    $plantel_inscrito=$this->input->post('mplantel_inscrito');
    $num_folio=$this->input->post('mnum_folio');
    $semestre_acreditado=$this->input->post('msemestre_acreditado');
    $fecha_expedicion=$this->input->post('mfecha_expedicion');
    $ciclo_escolar=$this->input->post('mciclo_escolar');
    $promedio=$this->input->post('mpromedio_acreditado');
    $datos = array(
        'folio' => $num_folio,
        'fecha_expedicion' => $fecha_expedicion,
        'usuario_elaboro' =>10,
        'ultimo_semestre_acreditado' =>$semestre_acreditado,
        'promedio_acreditado' =>$promedio,
        'id_ciclo_escolar' =>$ciclo_escolar,
        'id_plantel_inscrito' =>$plantel_inscrito,
    );


    echo $this->M_resolucion_equivalencia->editar_resolucion($datos,$no_control);
}

public function get_num_resolucion(){
    $resultado='';
    $numero=$this->M_resolucion_equivalencia->num_resolucion();
    if($numero==NULL){
        $resultado='';
    }
    else{
        $numero=$numero+1;
        $resultado=$datos['num_resolucion']='BIC-E '.str_pad($numero,4,'0',STR_PAD_LEFT);
    }

    echo $resultado;
    
}

public function get_estudiantes_porsibles_incorporados(){
    $plantel = $this->input->get("cct_plantel");
    $curp = $this->input->get("curp");
    echo json_encode($this->M_estudiante->get_estudiantes_porsibles_incorporados($plantel,$curp));
}

public function incorporar_estudiante(){
    $datos = json_decode($this->input->raw_input_stream);
    echo $this->M_estudiante->incorporar_estudiante($datos);
}

public function get_estudiantes_reprobados(){
    $plantel = $this->input->get("cct_plantel");
    $curp = $this->input->get("curp");
    echo json_encode($this->M_estudiante->get_estudiantes_reprobados($plantel,$curp));
}

public function reinscribir_reprobado(){
    $datos = json_decode($this->input->raw_input_stream);
    echo $this->M_estudiante->reinscribir_reprobado($datos);
}


function get_estudiantes_probables_desertores(){
    $plantel = $this->input->get("cct_plantel");
    $curp = $this->input->get("curp");

    echo json_encode($this->M_estudiante->get_estudiantes_probables_desertores($plantel,$curp));
}


function set_desertor(){
    $no_control = $this->input->post('no_control');
    $motivo_desercion = $this->input->post('motivo_desercion');
    $fecha_desercion = $this->input->post('fecha_desercion');
    $semestre=$this->input->post('semestre_en_curso');
    $grupo=$this->M_regularizacion->ultimo_grupo_cursado($no_control)->nombre_grupo;
    echo $this->M_estudiante->set_desertor($no_control,$motivo_desercion,$fecha_desercion,$semestre,$grupo);
}

function set_baja(){
    $datos = json_decode($this->input->raw_input_stream);
    echo $this->M_estudiante->set_baja($datos);
}

//-----------------------------------------------------------------------------
public function get_estudiantes_derecho_a_traslado(){
    $curp = $this->input->get('curp');
     $plantel = $this->input->get('plantel');
     echo json_encode($this->M_estudiante->get_estudiantes_derecho_a_traslado( 
         $curp,
         $plantel
         ));
 }
 
 
 public function get_estudiante_traslado(){
     $no_control = $this->input->get('no_control');
     echo json_encode($this->M_estudiante->get_estudiante_traslado($no_control));
 }
 
 
 public function nuevo_traslado(){
     $no_control = $this->input->post('num_control');
     $cct_plantel_traslado = $this->input->post('plantel_para_traslado');
     $cct_plantel_origen = $this->input->post('cct_plantel_origen');
     $id_grupo = $this->input->post('id_grupo');
     $id_grupo_traslado = $this->input->post('grupos');
     $tipo_ingreso = $this->input->post('tipo_ingreso');
     $semestre_en_curso = $this->input->post('semestre_en_curso');
     $grupo=$this->M_regularizacion->ultimo_grupo_cursado($no_control)->nombre_grupo;
     
     
 
      $id_friae_origen=(isset($this->M_friae->id_friae($id_grupo)[0]->folio)) ? $this->M_friae->id_friae($id_grupo)[0]->folio : "";
      $id_friae_destino=(isset($this->M_friae->id_friae($id_grupo_traslado)[0]->folio)) ? $this->M_friae->id_friae($id_grupo_traslado)[0]->folio : "";
 
     if($this->input->post('documento_presentacion_bic_bic')!=''){
                 $datos_estudiante_documentos['documento_presentacion_bic_bic'] = array(
                     'id_documento' => 9,
                     'entregado' => true,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
             else{
                 $datos_estudiante_documentos['documento_presentacion_bic_bic'] = array(
                     'id_documento' => 9,
                     'entregado' => 0,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
 
     if($this->input->post('documento_carta_buena_conducta')!=''){
                 $datos_estudiante_documentos['documento_carta_buena_conducta'] = array(
                     'id_documento' => 10,
                     'entregado' => true,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
             else{
                 $datos_estudiante_documentos['documento_carta_buena_conducta'] = array(
                     'id_documento' => 10,
                     'entregado' => 0,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
 
     if($this->input->post('documento_historial_academico')!=''){
                 $datos_estudiante_documentos['documento_historial_academico'] = array(
                     'id_documento' => 11,
                     'entregado' => true,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
             else{
                 $datos_estudiante_documentos['documento_historial_academico'] = array(
                     'id_documento' =>11,
                     'entregado' => 0,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
 
         if($this->input->post('documento_constancia_de_no_adeudo')!=''){
                 $datos_estudiante_documentos['documento_constancia_de_no_adeudo'] = array(
                     'id_documento' => 12,
                     'entregado' => true,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
             else{
                 $datos_estudiante_documentos['documento_constancia_de_no_adeudo'] = array(
                     'id_documento' =>12,
                     'entregado' => 0,
                     'Estudiante_no_control' => $no_control,
                     'id_plantel' => $cct_plantel_origen
                 );
             }
 
 
             echo $this->M_estudiante->realizar_traslado_estudiante(
             $no_control,
             $cct_plantel_traslado,
             $cct_plantel_origen,
             $datos_estudiante_documentos,
             $id_grupo,
             $id_grupo_traslado,
             $id_friae_origen,
             $id_friae_destino,
             $tipo_ingreso,
             $grupo,
             $semestre_en_curso
             );
 
        
     
 }
 
 public function get_estudiante_datos_semestre_grupo(){
     $no_control = $this->input->get('no_control');
     echo json_encode($this->M_estudiante->get_estudiante_datos_semestre_grupo($no_control));
 }
 
 
 public function get_estudiante_datos_semestre_grupo_calificacion(){
     $no_control = $this->input->get('no_control');
     echo json_encode($this->M_estudiante->get_estudiante_datos_semestre_grupo_calificacion($no_control));
 }
 
 
 public function get_estudiantes_porsibles_traslados(){
    $matricula = $this->input->get("matricula");
    $curp = $this->input->get("curp");
    echo json_encode($this->M_estudiante->get_estudiantes_porsibles_traslados($matricula,$curp));
}


public function generar_lista_desercion(){
    $cct_plantel = $this->input->post("plantel");
    $id_ciclo_escolar = $this->input->post("ciclo_escolar");
    $ciclo_escolar=$this->M_ciclo_escolar->obtener_nombre_ciclo_escolar($id_ciclo_escolar);
    $lista=$this->M_estudiante->generar_lista_desercion($cct_plantel,$ciclo_escolar[0]->fecha_inicio,$ciclo_escolar[0]->fecha_terminacion,$id_ciclo_escolar);
    
    $datos['ciclo_escolar']=$this->M_ciclo_escolar->obtener_nombre_ciclo_escolar($id_ciclo_escolar);
    $datos['plantel']=$this->M_plantel->get_plantel($cct_plantel);
   
    $datos['lista']=$lista;

    $this->load->library('pdf');
    $this->load->view('reportes/reporte_desertor',$datos);
}
 
 }
 ?>