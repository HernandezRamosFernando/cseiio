<?php
class M_resolucion_equivalencia extends CI_Model { 
   public function __construct() {
      parent::__construct();
      

   }

   
   public function generar_resolucion($no_control,$num_folio,$plantel_inscrito,$fecha_expedicion,$ciclo_escolar,$promedio_acreditado,$semestre_acreditado){

      $this->db->trans_start();
      
      $this->db->set('folio',$num_folio);
      $this->db->set('id_estudiante',$no_control);
      $this->db->set('fecha_expedicion',$fecha_expedicion);
      $this->db->set('usuario_elaboro',10);
      $this->db->set('ultimo_semestre_acreditado',$semestre_acreditado);
      $this->db->set('promedio_acreditado',$promedio_acreditado);
      $this->db->set('id_ciclo_escolar',$ciclo_escolar);
      $this->db->set('id_plantel_inscrito',$plantel_inscrito);
      $this->db->insert('Resolucion_equivalencia');

      $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {

               return "no";

            }
               
            else{
               return "si";
            }
        
   }



    public function editar_resolucion($datos,$no_control){

      $this->db->trans_start();

      $this->db->where('id_estudiante',$no_control);
      $this->db->update('Resolucion_equivalencia',$datos);

      $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {

               return "no";

            }
               
            else{
               return "si";
            }
        
   }


    public function get_resolucion_equivalencia($no_control){
        return $this->db->query("select * from Resolucion_equivalencia where id_estudiante='".$no_control."'")->result();
   }






   //----------------------------- inicia operacion panzer
public function num_resolucion(){
    $consulta=$this->db->query("SELECT max(CONVERT(SUBSTRING(r.folio,7,LENGTH(r.folio)),SIGNED INTEGER)) as numero from Resolucion_equivalencia r")->result();
    return $consulta[0]->numero;    
   }


}

?>