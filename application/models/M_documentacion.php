<?php
class M_documentacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   function get_documentacion_aspirante($no_control){
      print_r ($no_control);
    return $this->db->get_where('Documentacion', array('numcontrol' => $no_control))->result();

   }


//-----------------modificado--------------------------------------
function get_nombre_archivo_documentacion($no_control,$iddocumento,$plantel){

   $this->db->select('*');
   $this->db->from('Documentacion');
   $this->db->where('id_documentacion',$iddocumento);
  // $this->db->where('id_plantel',$plantel);
   //$this->db->where('Estudiante_no_control',$no_control);
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
      $this->db->set('Estudiante_no_control',$num_control);
      $this->db->set('id_documento',$iddocumentacion);
      $this->db->set('ruta',$ruta);
      $this->db->set('fecha_entrega',date('Y-m-d'));
      $this->db->set('entregado',true);
      return $this->db->insert('Documentacion');
   }



   function fecha_ultima_carta_compromiso_aspirante($datos){
      return $this->db->query("select datediff(curdate(),max(fecha_entrega)) as dias from Documentacion where Estudiante_no_control='".$datos['Estudiante_no_control']."' and id_documento=5")->result();
 }

 function existe_documentacion_de_aspirante($iddocumentacion,$num_control){
      $this->db->select('count(*) as resultado');
      $this->db->from('Documentacion');
      $this->db->where('Estudiante_no_control',$num_control);
      $this->db->where('id_documento',$iddocumentacion);
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
    //$this->db->where('id_plantel', $cct_plantel);
    $this->db->where('id_documentacion', $iddocumentacion);
    //$this->db->where('Estudiante_no_control', $num_control);
   $resultado=$this->db->update('Documentacion', $data);
   return $resultado;
    }

   function documentos_base_faltantes_aspirante($no_control){
      return $this->db->query("SELECT Documento.id_documento,Documento.nombre_documento FROM Documentacion inner join Documento 
      on Documentacion.id_documento = Documento.id_documento
      where Estudiante_no_control ='".$no_control."' 
      and tipo ='base'
      and entregado = 'false' ")->result();
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

   function get_documentacion_xnombrede_aspirante($no_control){
      $this->db->select('*');
      $this->db->from('Documentacion');
      $this->db->join('Documento', 'Documentacion.id_documento = Documento.id_documento');
      $this->db->join('Plantel', 'Documentacion.id_plantel=Plantel.cct_plantel', 'left');
      $this->db->where('Documentacion.Estudiante_no_control',$no_control);
       $resultado = $this->db->get();
       return $resultado->result();
 
    }


    //-----
    public function lista_observaciones_en_documentacion($plantel){

      return $this->db->query(
       "select * from Documentacion d1
         inner join Documento doc on d1.id_documento=doc.id_documento
         inner join Estudiante e on e.no_control=d1.Estudiante_no_control
         left join (select ge.Estudiante_no_control,g.nombre_grupo from Grupo_Estudiante ge LEFT JOIN Grupo g on g.id_grupo=ge.Grupo_id_grupo where g.estatus=1 group by ge.Estudiante_no_control, g.nombre_grupo) as datos_escuela on e.no_control=datos_escuela.Estudiante_no_control
         where doc.tipo='base' and d1.entregado='0'  and Plantel_cct_plantel like '".$plantel."%' order by e.semestre_en_curso, concat(e.nombre,' ',e.primer_apellido,' ',e.segundo_apellido)")->result();

   }


   function get_datos_documento($no_control,$iddocumento){

      $this->db->select('*');
      $this->db->from('Documentacion');
      $this->db->where('id_documento',$iddocumento);
      $this->db->where('Estudiante_no_control',$no_control);
      $resultado = $this->db->get();
      return $resultado->result();
  
     }


}

