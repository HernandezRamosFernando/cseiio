<?php
class M_documentacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


   function get_documentacion_aspirante($no_control){
    return $this->db->get_where('Documentacion', array('Aspirante_no_control' => $no_control))->result();

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
      return $this->db->insert('Documentacion');
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
    'fecha_entrega' =>date('Y-m-d')
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

}