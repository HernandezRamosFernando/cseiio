<?php
class M_aspirante extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   public function asignar_num_control(){

      /*SELECT IF(COUNT(*)<=0,1,COUNT(*)+1) numero FROM control_escolar.aspirante a where no_control like 'CSEIIO%' AND SUBSTRING(a.no_control,7,2)=19;*/
     $this->db->select('IF(COUNT(*)<=0,1,COUNT(*)+1) numero');
     $this->db->from('Aspirante a');
     $this->db->like('a.no_control','CSEIIO','after');
     $this->db->where('SUBSTRING(a.no_control,7,2)',date("y"));
     $consulta = $this->db->get();
     $resultado=$consulta->row()->numero;
     return $resultado;
      
   }


   public function actualizar_datos_aspirante(
      $datos_aspirante,
      $datos_aspirante_direccion,
      $datos_aspirante_tutor,
      $datos_aspirante_lengua,
      $datos_aspirante_secundaria,
      $datos_aspirante_documentos,
      $no_control){

        
    //actualizacion apirante
    $this->db->where('no_control', $no_control);
    $this->db->update('Aspirante', $datos_aspirante);

    //actualizacion Direccion aspira
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Direccion_Aspirante', $datos_aspirante_direccion);

    //actualizacion Tutor aspirante
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Tutor', $datos_aspirante_tutor);

    //actualizacion Tutor aspirante
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Lengua_materna', $datos_aspirante_lengua);


    //actualizacion Tutor aspirante
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Datos_Secundaria', $datos_aspirante_secundaria);
   
      //$this->db->insert('Aspirante',$datos_aspirante);
      //$this->db->insert('Direccion_Aspirante',$datos_aspirante_direccion);
      //$this->db->insert('Tutor',$datos_aspirante_tutor);
      //$this->db->insert('Lengua_materna',$datos_aspirante_lengua);
      //$this->db->insert('Datos_Secundaria',$datos_aspirante_secundaria);
      
      
    
      

      ?>
   
      <script>
      alert("Registro actualizados correctamente");
      </script>
   
      <?php
   }


public function insertar_aspirante_nuevo_ingreso(
   $datos_aspirante,
   $datos_aspirante_direccion,
   $datos_aspirante_tutor,
   $datos_aspirante_lengua,
   $datos_aspirante_secundaria,
   $datos_aspirante_documentos){

   echo $this->db->insert('Aspirante',$datos_aspirante);
   $this->db->insert('Direccion_Aspirante',$datos_aspirante_direccion);
   $this->db->insert('Tutor',$datos_aspirante_tutor);
   $this->db->insert('Lengua_materna',$datos_aspirante_lengua);
   $this->db->insert('Datos_Secundaria',$datos_aspirante_secundaria);
   
   foreach($datos_aspirante_documentos as $documento){
      $registro = array(
         'Aspirante_no_control' => $datos_aspirante['no_control'],
         'Documento_id_documento' => $documento
      );
      //print_r($registro);
      $this->db->insert('Documentacion',$registro);
   }
   //print_r($datos_aspirante_documentos);
   ?>

   <script>
   alert("Registro agregado correctamente");
   </script>

   <?php
}


public function get_aspirantes_nombre(
   $nombre_aspirantes,
   $apellido_paterno_aspirantes,
   $apellido_materno_aspirantes,
   $plantel){
   $consulta = array(
   'nombre like' => $nombre_aspirantes.'%',
   'apellido_paterno like' => $apellido_paterno_aspirantes.'%',
   'apellido_materno like' => $apellido_materno_aspirantes.'%',
   'Plantel_cct=' => $plantel
);

$this->db->where($consulta);
return $this->db->get('Aspirante')->result();
}

function get_aspirante($no_control){

   return $this->db->get_where('Aspirante', array('no_control' => $no_control))->result();
}

}
?>