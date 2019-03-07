<?php
class M_aspirante extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


public function insertar_aspirante_nuevo_ingreso(
   $datos_aspirante,
   $datos_aspirante_direccion,
   $datos_aspirante_tutor,
   $datos_aspirante_lengua,
   $datos_aspirante_secundaria,
   $datos_aspirante_documentos){

   $this->db->insert('Aspirante',$datos_aspirante);
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

}
?>