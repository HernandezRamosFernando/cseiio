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

}