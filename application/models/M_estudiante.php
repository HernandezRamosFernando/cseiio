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

/**$this->db->query("DELETE 
   FROM Estudiante 
   WHERE (no_control = '".$no_control."'") */
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



public function get_plantel_estudiante($no_control){
   return $this->db->query("SELECT * 
   FROM Estudiante as e inner join Plantel as p on e.Plantel_cct_plantel=p.cct_plantel 
   where no_control='".$no_control."'")->result();
}

function listar_aspirantes_xplantel($curp, $plantel){
   return $this->db->query(
      "select *,(SELECT count(*) noentregada FROM Documentacion d1 where d1.Estudiante_no_control=Estudiante.no_control and d1.entregado=0) as no_entregado,(SELECT count(*) nosubida FROM Documentacion d1 where d1.Estudiante_no_control=Estudiante.no_control and ruta is null or length(ruta)=0) as no_subida from Estudiante where Plantel_cct_plantel like'".$plantel."%' and curp like'".$curp."%' ")->result();


  }

  public function estudiantes_sin_matricula($curp, $plantel){

   return $this->db->query(
    "select * 
    from Estudiante
    where Plantel_cct_plantel like'".$plantel."%' and curp like'".$curp."%' and matricula is null")->result();

}

public function obtener_fecha_inscripcion_semestre($no_control){
   //select fecha_inscripcion FROM Aspirante where no_control='CSEIIO1910002' 
   $this->db->select('semestre,fecha_inscripcion');
   $this->db->from('Estudiante e');
   $this->db->where('e.no_control',$no_control);
   $consulta = $this->db->get();
   $resultado=$consulta->row();
   return $resultado;
   
   }

   public function obtener_ciclo_escolar($fecha){
      //SELECT fecha_matricula FROM ciclo_escolar where fecha_inicio<='2018-08-13' and fecha_termino>='2018-08-13'; 
      $this->db->select('fecha_matricula');
      $this->db->from('Ciclo_escolar c');
      $this->db->where('fecha_inicio<=\''.$fecha.'\' and fecha_terminacion>=\''.$fecha.'\'');
      $consulta = $this->db->get()->row();
      $resultado=0;
      if($consulta!=null)
      {
          $resultado=$consulta->fecha_matricula;
        
      }
  
      else{
         $resultado=null;
      }
      
      return $resultado;
      
      }
      public function numero_consecutivo_matricula($anio){
         //SELECT max(CONVERT(SUBSTRING(matricula,4,LENGTH(matricula)),SIGNED INTEGER)) as total FROM estudiante where matricula like '18%';
        $this->db->select('max(CONVERT(SUBSTRING(matricula,4,LENGTH(matricula)),SIGNED INTEGER)) as total');
        $this->db->from('Estudiante');
        $this->db->like('matricula',$anio,'after');
      
        $consulta = $this->db->get();
        $resultado=$consulta->row()->total;
        if($resultado==null){
          $resultado=1;
        }
        else{
          $resultado=$resultado+1;
        }
      
        return $resultado;
      }
      public function insertar_matricula($datos){
         $this->db->trans_start();
         $this->db->query("update Estudiante set matricula = '".$datos["matricula"]."' where no_control = '".$datos["no_control"]."' " );
         $this->db->trans_complete();
   
               if ($this->db->trans_status() === FALSE)
               {
                  return "no";
                }
                  
               else{
                  return $datos['matricula'];
                 
               }
   
     }
     
     public function estudiantes_portabilidad($curp, $plantel){

      return $this->db->query("select *,(select count(*) from Resolucion_equivalencia r where r.id_estudiante=e.no_control) as entregado from Estudiante e where e.Plantel_cct_plantel like'".$plantel."%' and e.curp like'".$curp."%' and e.tipo_ingreso='PORTABILIDAD'")->result();
      
   }

}
?>