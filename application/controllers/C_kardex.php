<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kardex extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("M_kardex");
        $this->load->model("M_portabilidad");
    }



    public function kardex_estudiante(){
        $this->load->library('pdf');
        $no_control = $this->input->get("no_control");
        $datos['estudiante'] = $this->M_kardex->datos_estudiante_tutor($no_control);

        $portabilidad = $this->M_portabilidad->estudiante_portabilidad($no_control);

        if(sizeof($portabilidad)==0){//es alumno que tiene historial completo
            $datos['portabilidad']="no";

            //necesito sus grupos en orden de semestre
            $grupos = $this->M_kardex->grupos_ordenados_estudiante_normal($no_control);

            //por cada grupo, necesito 
            $datos['materias_grupo']= array();
            $datos['regularizaciones_aprobadas']=array();
            $contador = 0;
            $contador_regularizaciones = 0;
            foreach($grupos as $grupo){
                //datos de cada materia del estudiante
                $materias = $this->M_kardex->datos_materias_grupo_estudiante($grupo->Grupo_id_grupo,$no_control);
                $datos['materias_grupo'][$contador] = $materias;//materias de un grupo

                foreach($materias as $materia){
                    if($materia->calificacion_final<6){
                        $materia_regularizada = $this->M_kardex->materia_regularizacion_estudiante($no_control,$materia->id_materia);

                        if(sizeof($materia_regularizada)>0){
                            $datos['regularizaciones_aprobadas'][$contador_regularizaciones]=$materia_regularizada[0];
                            $contador_regularizaciones+=1;
                        }
                    }
                }

                $contador+=1;
                //hay que verificar si la materia esta reprobada, si esta reprobada se 
                //debe buscar en regularizacion si ya la paso
                
            }

        }

        else{// si es de portabilidad
            $datos['datos_resolucion'] = $this->M_kardex->resolucion_equivalencia_estudiante($no_control)[0];
            $datos['portabilidad']="si";

            $datos['materias_revalidadas'] = $this->M_kardex->materias_hasta_semestre_validado($datos['datos_resolucion']->ultimo_semestre_acreditado);

            $datos['bachillerato_procedencia'] = $this->M_kardex->bachillerato_procedencia($no_control);
            //print_r($datos['materias_revalidadas']);


            //despues hace todo como si fuera un alumno normal
            $grupos = $this->M_kardex->grupos_ordenados_estudiante_normal($no_control);

            //por cada grupo, necesito 
            $datos['materias_grupo']= array();
            $datos['regularizaciones_aprobadas']=array();
            $contador = 0;
            $contador_regularizaciones = 0;
            foreach($grupos as $grupo){
                //datos de cada materia del estudiante
                $materias = $this->M_kardex->datos_materias_grupo_estudiante($grupo->Grupo_id_grupo,$no_control);
                $datos['materias_grupo'][$contador] = $materias;//materias de un grupo

                foreach($materias as $materia){
                    if($materia->calificacion_final<6){
                        $materia_regularizada = $this->M_kardex->materia_regularizacion_estudiante($no_control,$materia->id_materia);

                        if(sizeof($materia_regularizada)>0){
                            $datos['regularizaciones_aprobadas'][$contador_regularizaciones]=$materia_regularizada[0];
                            $contador_regularizaciones+=1;
                        }
                    }
                }

                $contador+=1;
                //hay que verificar si la materia esta reprobada, si esta reprobada se 
                //debe buscar en regularizacion si ya la paso
                
            }

        }


        $this->load->view('reportes/kardex',$datos);
        //print_r($datos['materias_grupo']);
    }
}