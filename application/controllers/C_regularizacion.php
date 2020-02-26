<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_regularizacion extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_regularizacion");
    }

    
    public function modificar_datos_regularizacion(){
        $no_control = $this->input->post('no_control');
        $id_materia = $this->input->post('id_materia');
        $fecha = $this->input->post('fecha');
        $cct_plantel = $this->input->post('cct_plantel');
        $calificacion_inicial = $this->input->post('calificacion_inicial');

        $calificacion = $this->input->post('calificacion');
        $fecha_calificacion = $this->input->post('fecha_calificacion');
        $hora_inicio = $this->input->post('hora_inicio');
        $asesor = $this->input->post('asesor');

        $parametros_actualizar= array(
            'calificacion' =>$calificacion,
            'fecha_calificacion' =>$fecha_calificacion,
            'hora' =>$hora_inicio,
            'id_asesor' =>$asesor

        );

        $parametros_regu= array(
            'no_control' =>$no_control,
            'id_materia' =>$id_materia,
            'fecha' =>$fecha,
            'cct_plantel' =>$cct_plantel,
            'calificacion_inicial' =>$calificacion_inicial,


        );


        echo $this->M_regularizacion->modificar_datos_regularizacion((object)$parametros_regu,$parametros_actualizar);
    }

    public function estudiantes_regularizadas_periodo_mostrar(){
        $datos = $this->input->get('periodo');
        $plantel = $this->input->get('plantel');
        $materia = $this->input->get('materia');

        $separados = explode('-',$datos);

        switch($separados[0]){

            case 'ENERO':
            $mes = 1;
            break;

            case 'MAYO':
            $mes = 5;
            break;

            case 'JULIO':
            $mes = 7;
            break;

            case 'OCTUBRE':
            $mes = 10;
            break;
        }

        $ano = intval($separados[1]);

        
        echo json_encode($this->M_regularizacion->estudiantes_regularizadas_periodo_mostrar($mes,$ano,$plantel,$materia)); 

    }
    

    public function materias_con_reprobados_html(){
        $respuesta = "";
        $plantel = $this->input->get("plantel");
        $semestre = $this->input->get("semestre");
        $materias = $this->M_regularizacion->materias_con_reprobados_html($plantel,$semestre);
        if(sizeof($materias) == 0){
            $respuesta ="";
        }else{
            $respuesta.='<option value =""> Seleccione una materia </option>';
            foreach($materias as $materia){
                $respuesta.='<option value="'.$materia->id_materia.'">'.$materia->unidad_contenido.'  Clave:'.$materia->id_materia.'</option>';
            }
        }

        echo $respuesta;

       
    }


    public function materias_con_reprobados_html_regularizacion(){
        $respuesta = "";
        $plantel = $this->input->get("plantel");
        $semestre = $this->input->get("semestre");
        $materias = $this->M_regularizacion->materias_con_reprobados_html_regularizacion($plantel);
        if(sizeof($materias) == 0){
            $respuesta ="";
        }else{
            $respuesta.='<option value =""> Seleccione una materia </option>';
            foreach($materias as $materia){
                $respuesta.='<option value="'.$materia->id_materia.'">'.$materia->unidad_contenido.'  Clave:'.$materia->id_materia.'</option>';
            }
        }

        echo $respuesta;

       
    }


    public function semetres_con_reprobados_html(){
        $respuesta = "";
        $plantel = $this->input->get("plantel");
        $materias = $this->M_regularizacion->semetres_con_reprobados_html($plantel);
        
        if(sizeof($materias) == 0){
            $respuesta ="";
        }else{
            $respuesta.='<option value =""> Seleccione una materia </option>';
            foreach($materias as $materia){
                $respuesta.='<option value="'.$materia->semestre.'">'.$materia->semestre.'</option>';
            }
        }
        

        echo $respuesta;
        //print_r($materias);
       
    }

    public function estudiantes_materia_registrada_activa(){
        $plantel = $this->input->get("plantel");
        $materia = $this->input->get("materia");
        echo json_encode($this->M_regularizacion->estudiantes_materia_registrada_activa($plantel,$materia)); 

    }


    public function estudiantes_materia(){
        $plantel = $this->input->get("plantel");
        $materia = $this->input->get("materia");

        echo json_encode($this->M_regularizacion->estudiantes_materia($plantel,$materia));        

    }

    public function agregar_regularizacion(){
        $datos = json_decode($this->input->raw_input_stream);
        //print_r($datos);
        echo $this->M_regularizacion->agregar_regularizacion($datos);
    }


    public function materias_debe_estudiante_actualmente(){
        $no_control = $this->input->get("estudiante");
        echo $this->M_regularizacion->materias_debe_estudiante_actualmente($no_control);
    }

    public function obtener_calificacion_regularizacion_estudiante_materia_reciente(){
        $no_control = $this->input->get("no_control");
        $materia = $this->input->get("materia");

        echo json_encode($this->M_regularizacion->obtener_calificacion_regularizacion_estudiante_materia_reciente($no_control,$materia));
    }



    function periodos_regularizacion_plantel(){
        $plantel = $this->input->get("plantel");
        $regularizaciones = $this->M_regularizacion->periodos_regularizacion_plantel($plantel);

        

        $respuesta_html = "";

        foreach($regularizaciones as $regularizacion){
            $respuesta_html.='<option value="'.$regularizacion->periodo.'">'.$regularizacion->periodo.'</option>';
        }

        echo $respuesta_html;
    }

    ///debe mandar el periodo en formato 5-2021
    public function regularizaciones_plantel_periodo_sin_grupo(){
        $plantel = $this->input->get('plantel');
        $mes = $this->input->get('mes');
        $ano = $this->input->get('ano');

        echo json_encode($this->M_regularizacion->regularizaciones_plantel_periodo_sin_grupo($plantel,$mes,$ano));
    }



    function cerrar_regularizacion(){
        $plantel = $this->input->get("plantel");

        echo $this->M_regularizacion->cerrar_regularizacion($plantel);
    }


    function materias_regularizadas_periodo(){
        $datos = $this->input->get('periodo');
        $plantel = $this->input->get('plantel');

        $separados = explode('-',$datos);

        switch($separados[0]){

            case 'ENERO':
            $mes = 1;
            break;

            case 'MAYO':
            $mes = 5;
            break;

            case 'JULIO':
            $mes = 7;
            break;

            case 'OCTUBRE':
            $mes = 10;
            break;
        }

        $ano = intval($separados[1]);

        $materias = $this->M_regularizacion->materias_regularizadas_periodo($mes,$ano,$plantel);

        $respuesta = '<option value="">Seleccione materia</option>';

        foreach($materias as $materia){
            $respuesta.='<option value="'.$materia->clave.'">'.$materia->unidad_contenido.'->'.$materia->clave.'</option>';
        }

        echo $respuesta;
     }
}