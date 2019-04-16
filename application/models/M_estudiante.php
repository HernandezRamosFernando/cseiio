<?php
class M_estudiante extends CI_Model { 
   public function __construct() {
      parent::__construct();
      
   }


//generacion de matricula

public function asignar_numero_consecutivo(){
   /*SELECT  max(CONVERT(SUBSTRING(a.no_control,10,LENGTH(a.no_control)), SIGNED INTEGER)) as numero FROM control_escolar.aspirante a where no_control like 'CSEIIO20%';*/
  $this->db->select('max(CONVERT(SUBSTRING(e.no_control,10,LENGTH(e.no_control)), SIGNED INTEGER)) as numero');
  $this->db->from('Estudiante e');
  $this->db->like('e.no_control','CSEIIO'.date("y"),'after');

  $consulta = $this->db->get();
  $resultado=$consulta->row()->numero;

  return $resultado;
   
}

//fin generacion de matricula





public function insertar_estudiante_nuevo_ingreso(
   $datos_estudiante,
   $datos_estudiante_tutor,
   $parentesco_estudiante_tutor,
   $datos_estudiante_lengua_materna,
   $datos_estudiante_documentos,
   $datos_estudiante_medicos){

      

            $this->db->trans_start();

            $this->db->insert('Estudiante',$datos_estudiante);
            
            $this->db->insert('Tutor',$datos_estudiante_tutor);
            $id_tutor = $this->db->insert_id();
            
            $this->db->insert('Estudiante_Tutor',array(
               'Estudiante_no_control' => $datos_estudiante['no_control'],
               'Tutor_id_tutor' => $id_tutor,
               'parentesco' => $parentesco_estudiante_tutor
            ));
            
            
            
            foreach($datos_estudiante_lengua_materna as $dato_lengua){
               $this->db->insert('Datos_lengua_materna',$dato_lengua);
            }

            

            
           
            foreach($datos_estudiante_medicos as $dato_medico){
               $this->db->insert('Expediente_medico',$dato_medico);
            }
            
            
            foreach($datos_estudiante_documentos as $documento){

               $this->db->insert('Documentacion',$documento);
         }
         
         

         
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               return "no";
             //return "no";
            }
               
            else{
               return "si";
               //return "si";
            }

   
}



public function get_estudiantes_curp_plantel($curp,$cct_plantel){
   return $this->db->query("SELECT * FROM Estudiante WHERE curp LIKE '".$curp."%' and Plantel_cct_plantel LIKE '".$cct_plantel."%'")->result();
}


public function get_estudiante($no_control){
   $datos['estudiante'] = $this->db->get_where('Estudiante',array(
      'no_control' => $no_control
   ))->result();

   $datos['tutor'] =$this->db->query("SELECT * from Estudiante_Tutor as et inner join Tutor as t on et.Tutor_id_tutor=t.id_tutor  where Estudiante_no_control='".$no_control."'")->result();

   $datos['expediente_medico'] = $this->db->query("SELECT * from Expediente_medico where Estudiante_no_control='".$no_control."'")->result();
   $datos['lengua_materna'] = $this->db->query("SELECT * from Datos_lengua_materna where Estudiante_no_control='".$no_control."'")->result();
   return $datos;
}
function listar_aspirantes_xplantel($curp, $plantel){
   return $this->db->query(
      "select *,(SELECT count(*) noentregada FROM Documentacion d1 where d1.Estudiante_no_control=Estudiante.no_control and d1.entregado=0) as no_entregado,(SELECT count(*) nosubida FROM Documentacion d1 where d1.Estudiante_no_control=Estudiante.no_control and ruta is null or ruta='') as no_subida from Estudiante where Plantel_cct_plantel like'".$plantel."%' and curp like'".$curp."%' ")->result();


  }




public function update_estudiante(
   $datos_estudiante,
   $datos_estudiante_tutor,
   $parentesco_estudiante_tutor,
   $datos_estudiante_lengua_materna,
   $datos_estudiante_medicos,
   $no_control,
   $id_tutor){

      

            $this->db->trans_start();

            //tabla estudiante
            $this->db->where('no_control', $no_control);
            $this->db->update('Estudiante',$datos_estudiante);

            //tabla tutor
            $this->db->where('id_tutor', $id_tutor);
            $this->db->update('Tutor',$datos_estudiante_tutor);

            //tabla estudiante-tutor
            $this->db->where("Estudiante_no_control",$no_control);
            $this->db->update("Estudiante_Tutor",array(
               'parentesco' => $parentesco_estudiante_tutor
            ));


            
            foreach($datos_estudiante_medicos as $dato_medico){
               
               $this->db->where(array(
                  'Estudiante_no_control' =>$no_control,
                  'descripcion' => $dato_medico['descripcion']
               ));
               $this->db->update('Expediente_medico',$dato_medico);
            }
            
            
            
            foreach($datos_estudiante_lengua_materna as $dato_lengua){
               $this->db->where(array(
                  'Estudiante_no_control' => $no_control,
                  'descripcion' => $dato_lengua['descripcion']
               ));
               $this->db->update('Datos_lengua_materna',$dato_lengua);
            }

            
         
            

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               return "no";
             //return "no";
            }
               
            else{
               return "si";
               //return "si";
            }

   
}


function delete_estudiante($no_control){
   $this->db->trans_start();
   $this->db->where('no_control',$no_control);
   $this->db->delete('Estudiante');
   $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               return "no";
             //return "no";
            }
               
            else{
               return "si";
               //return "si";
            }
}

}
?>