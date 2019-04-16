<?php
class M_documentacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   function get_documentacion_xnombrede_aspirante($no_control){
      $this->db->select('*');
      $this->db->from('Documentacion');
      $this->db->join('Documento', 'Documentacion.Documento_id_documento = Documento.id_documento');
      $this->db->where('Documentacion.Aspirante_no_control',$no_control);
       $resultado = $this->db->get();
       return $resultado->result();
 
    }


   function get_documentacion_aspirante($no_control){
      print_r ($no_control);
    return $this->db->get_where('Documentacion', array('numcontrol' => $no_control))->result();

   }

   function get_nombre_archivo_documentacion($no_control,$iddocumento){

      $this->db->select('*');
      $this->db->from('Documentacion');
      $this->db->where('Documento_id_documento',$iddocumento);
      $this->db->where('Aspirante_no_control',$no_control);
      $resultado = $this->db->get()->row();
      return $resultado->ruta;
  
     }
  
  
  function get_documentacion_x_tipoingreso($tipo_ingreso){
  
  
      $this->db->select('*');
      $this->db->from('Documento');
  
    if($tipo_ingreso=='PORTABILIDAD'){
       $this->db->where('tipo','base');
       $this->db->or_where('tipo','extra');
    }
  
     if($tipo_ingreso=='NUEVO INGRESO'){
        $this->db->where('tipo','base');
     }
      
      $resultado = $this->db->get();
      
      return $resultado->result();
  
     }



   //==============================================
   function ingresar_documentacion_aspirante($iddocumentacion,$ruta,$num_control){
      $this->db->set('Aspirante_no_control',$num_control);
      $this->db->set('Documento_id_documento',$iddocumentacion);
      $this->db->set('ruta',$ruta);
      $this->db->set('fecha_entrega',date('Y-m-d'));
      $this->db->set('entregado',true);
      return $this->db->insert('Documentacion');
   }



   function fecha_ultima_carta_compromiso_aspirante($datos){
      return $this->db->query("select datediff(curdate(),max(fecha_entrega)) as dias from Documentacion where Aspirante_no_control='".$datos['Aspirante_no_control']."' and Documento_id_documento=5")->result();
 }

 function existe_documentacion_de_aspirante($iddocumentacion,$num_control){
      $this->db->select('count(*) as resultado');
      $this->db->from('Documentacion');
      $this->db->where('Aspirante_no_control',$num_control);
      $this->db->where('Documento_id_documento',$iddocumentacion);
      $consulta = $this->db->get()->row();
         if($consulta->resultado>0){
            return true;
         }
         else{
            return false;
         }
   }




  


   function update_aspirante_doc($iddocumentacion,$ruta,$num_control){
     $data = array(
    'ruta' =>$ruta,
    'fecha_entrega' =>date('Y-m-d'),
    'entregado' => true
      );

   $this->db->where('Documento_id_documento', $iddocumentacion);
   $this->db->where('Aspirante_no_control', $num_control);
  $resultado=$this->db->update('Documentacion', $data);
  return $resultado;
   }

   function documentos_base_faltantes_aspirante($no_control){
      return $this->db->query("SELECT id_documento,nombre_documento FROM Documentacion inner join Documento 
      on Documentacion.Documento_id_documento = Documento.id_documento
      where Aspirante_no_control ='".$no_control."' 
      and tipo ='base'
      and entregado =false")->result();
   }
   
   public function get_estudiantes_falta_documentacion_base($curp,$cct_plantel){
     return $this->db->query("SELECT * FROM
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