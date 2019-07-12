<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//el controlador debe empezar con mayuscula
class C_frer extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("M_frer");
        $this->load->model("M_regularizacion");
        $this->load->model("M_friae");
    }


    function generar_frer_plantel_periodo(){
        $this->load->library('pdf');
        
        $plantel = $this->input->get('plantel');
        $periodo = $this->input->get('periodo');

        $mes_ano = explode('-',$periodo);

        //echo $mes_ano[0];
        //echo $mes_ano[1];
        switch($mes_ano[0]){
            case "01":
            $datos['mes']="ENERO";
            break;

            case "05":
            $datos['mes']="MAYO";
            break;

            case "07":
            $datos['mes']="JULIO";
            break;

            case "10":
            $datos['mes']="OCTUBRE";
            break;
        }


        $datos['ano']=$mes_ano[1];

        //dias de periodo
        $datos['dias_periodo'] = $this->M_regularizacion->dias_regularizacion_periodio_plantel($plantel,$mes_ano[0],$mes_ano[1]);

        //nombre dek ciclo escolar
        $datos['nombre_ciclo_escolar'] = $this->M_regularizacion->nombre_ciclo_periodo_plantel($plantel,$mes_ano[0],$mes_ano[1]);

        //datos plantel
        $datos['encabezado'] = $this->M_frer->datos_plantel_frer($plantel);

        //solo numero de control y semestre regresa
       $datos ['regularizaciones_sin_grupo'] = $this->M_regularizacion->regularizaciones_plantel_periodo_sin_grupo($plantel,$mes_ano[0],$mes_ano[1]);
       //solo numero de control y semestre regresa
       $datos ['regularizaciones_con_grupo'] = $this->M_regularizacion->regularizaciones_plantel_periodo_con_grupo($plantel,$mes_ano[0],$mes_ano[1]);
       //$datos ['grupo_anterior_regularizaciones_con_grupo']= array();
       //$datos ['grupo_anterior_regularizaciones_sin_grupo']=array();

        $contador=0;

        $folio_frer = $this->M_frer->folio_frer_periodo_plantel($plantel,$mes_ano[0],$mes_ano[1]);

        foreach($datos ['regularizaciones_con_grupo'] as $regularizacion){
            //regresa un arreglo con las materias que regularizo en ese periodo
            $datos ['materias_regularizadas_con_grupo'][$contador] = $this->M_regularizacion->regularizacion_estudiante_periodo($regularizacion->no_control,$mes_ano[0],$mes_ano[1]);
            //datos completos del estudiante (select * from estyduante where no_control)
            $datos ['datos_estudiantes_con_grupo'][$contador] = $this->M_frer->datos_estudiante($regularizacion->no_control);
            //regresa los datos del ferer
            $datos ['datos_frer_estudiante_con_grupo'][$contador] = $this->M_frer->datos_frer_estudiante($folio_frer,$regularizacion->no_control);
            $datos ['materias_debe_estudiante_con_grupo'][$contador] = $this->M_regularizacion->materias_debe_estudiante_actualmente($regularizacion->no_control);
            $contador+=1;
        }
        
        $contador=0;

        foreach($datos ['regularizaciones_sin_grupo'] as $regularizacion){
            $datos ['materias_regularizadas_sin_grupo'][$contador] = $this->M_regularizacion->regularizacion_estudiante_periodo($regularizacion->no_control,$mes_ano[0],$mes_ano[1]);
            $datos ['datos_estudiantes_sin_grupo'][$contador] = $this->M_frer->datos_estudiante($regularizacion->no_control);
            $datos ['datos_frer_estudiante_sin_grupo'][$contador] = $this->M_frer->datos_frer_estudiante($folio_frer,$regularizacion->no_control);
            $datos ['materias_debe_estudiante_sin_grupo'][$contador] = $this->M_regularizacion->materias_debe_estudiante_actualmente($regularizacion->no_control);
            $contador+=1;
        }
        
        

        //$envio['saludo']="hola";
       //echo json_encode($datos ['regularizaciones_con_grupo']);
       //echo $folio_frer;
       //echo json_encode($datos ['datos_frer_estudiante_sin_grupo']);
        $this->load->view('reportes/frer',$datos);
    }



    


}