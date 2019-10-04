<?php
class M_permisos_extemporaneo extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   public function get_datos_materia($id_grupo){
        return $this->db->query("select clave, unidad_contenido from Grupo_estudiante ge inner join Materia m on ge.id_materia=m.clave where Grupo_id_grupo='".$id_grupo."' group by ge.id_materia order by unidad_contenido")->result();
    }

    public function agregar_permiso($respuesta,$no_control,$id_grupo,$fecha_inicio,$fecha_fin){
        $this->db->trans_start();
            /*$this->db->trans_start();
                $this->db->insert('Permisos_extemporaneo', $datos);
                $this->db->trans_complete();
        
                if ($this->db->trans_status() === FALSE)
                {
                    return "no";
                }
        
                else{
                    return "si";
                }*/

                foreach ($respuesta as $id_materia => $variable) {

                    if (is_array($variable)){

                        $primer_parcial=0;
                        $segundo_parcial=0;
                        $tercer_parcial=0;
                        $examen_final=0;
                        
                      foreach($variable as $tipo => $valorArreglo)
                        {
                               
                               if($tipo=='parcial1'){
                                $primer_parcial=1;
                               }
                               if($tipo=='parcial2'){
                                $segundo_parcial=1;
                               }
                               if($tipo=='parcial3'){
                                $tercer_parcial=1;
                               }
                               if($tipo=='examen_final'){
                                $examen_final=1;
                               }
                                

                        }
                              /*echo '</br>';
                                echo '<hr />';
                                echo '<b>'.$primer_parcial.'-</b>';
                                echo '<b>'.$segundo_parcial.'-</b>';
                                echo '<b>'.$tercer_parcial.'-</b>';
                                echo '<b>'.$examen_final.'-</b>';
                                echo '<b>'.$id_materia.'</b>';
                                echo '<hr />';*/
                                $datos = array(
                                    'Estudiante_no_control' =>$no_control,
                                    'primer_parcial' =>$primer_parcial,
                                    'segundo_parcial' =>$segundo_parcial,
                                    'tercer_parcial' =>$tercer_parcial,
                                    'examen_final' =>$examen_final,
                                    'fecha_inicio' =>$fecha_inicio,
                                    'fecha_fin' =>$fecha_fin,
                                    'id_materia' =>$id_materia,
                                    'id_grupo' =>$id_grupo,
                                    'estatus' =>1,
                                    
                                );
                                $this->db->insert('Permisos_extemporaneo', $datos);
                    }
                    
              }

              $this->db->trans_complete();
                    if ($this->db->trans_status() === FALSE)
                    {
                        return "no";
                    }
                    else{
                        return "si";
                    }
           
    }


    

}
?>