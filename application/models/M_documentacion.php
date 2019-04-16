<?php
class M_documentacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function get_estudiantes_falta_documentacion_base($curp,$cct_plantel){
     return $this->db->query("SELECT 
     *
 FROM
     (SELECT 
         Estudiante_no_control,
             COUNT(*) - SUM(CASE
                 WHEN entregado = 1 THEN 1
                 ELSE 0
             END) AS faltantes
     FROM
         Documentacion AS ds
     INNER JOIN Documento AS d ON ds.id_documento = d.id_documento
     WHERE
         d.tipo = 'base'
     GROUP BY Estudiante_no_control) AS documentos_faltantes inner join Estudiante on
     documentos_faltantes.Estudiante_no_control=Estudiante.no_control
 WHERE
     faltantes > 0 and
     curp like '".$curp."%' and Plantel_cct_plantel like '".$cct_plantel."%'
 ")->result();
   }



   public function get_dias_ultima_carta_compromiso_estudiante($no_control){
         return $this->db->query("SELECT 
         DATEDIFF(CURDATE(), MAX(fecha_entrega)) AS dias
     FROM
         Documentacion
     WHERE
         Estudiante_no_control = '".$no_control."'
             AND id_documento = 5")->result();
   }


   public function get_documentos_base_faltantes_estudiante($no_control){
      return $this->db->query("SELECT 
      d.id_documento,
      d.nombre_documento,
      ds.Estudiante_no_control AS no_control,
      ds.observacion
  FROM
      Documentacion AS ds
          INNER JOIN
      Documento AS d ON ds.id_documento = d.id_documento
  WHERE
      entregado = 0
          AND Estudiante_no_control = '".$no_control."'
          AND tipo = 'base'")->result();
   }


   function add_observaciones_documentacion_faltante_estudiante($observaciones){
   $this->db->trans_start();
   foreach($observaciones as $observacion){
         $this->db->query("update Documentacion set observacion = '".$observacion->observacion."' where id_documento=".$observacion->id." and Estudiante_no_control='".$observacion->no_control."'");
   }
   $this->db->query("insert into Documentacion(id_documento,Estudiante_no_control,fecha_entrega) values (5,'".$observacion->no_control."','".date("Y-m-d")."')");
   
   $this->db->trans_complete();
   
   if ($this->db->trans_status() === FALSE)
   {
     return "no";
   }
   
   else{
      return "si";
   }
   
   
   }


   public function get_fecha_ultima_carta_compromiso_estudiante($no_control){
      return $this->db->query("SELECT max(fecha_entrega) as fecha 
      FROM control_escolar_ito.Documentacion 
      where id_documento=5 and Estudiante_no_control='".$no_control."'")->result();
   }

}