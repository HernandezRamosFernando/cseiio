

<?php
class M_estudiante extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   


    public function insertar_estudiante($datos){
        if($this->db->insert('Estudiante',$datos)){
            return "Matricula generada exitosamente";
        }

        else{
            return "Algo salio mal";
        }

    }


    public function estudiantes_sin_matricula($curp, $plantel){

       return $this->db->query(
        "select * 
        from Aspirante
        where Plantel_cct like'".$plantel."%' and curp like'".$curp."%' and no_control not in(select Aspirante_no_control from Estudiante)")->result();

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
     
     public function obtener_ciclo_escolar($fecha){
         //SELECT fecha_matricula FROM ciclo_escolar where fecha_inicio<='2018-08-13' and fecha_termino>='2018-08-13'; 
         $this->db->select('fecha_matricula');
         $this->db->from('Ciclo_escolar c');
         $this->db->where('fecha_inicio<=\''.$fecha.'\' and fecha_termino>=\''.$fecha.'\'');
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
     
     
     
        public function obtener_fecha_inscripcion_semestre($no_control){
         //select fecha_inscripcion FROM Aspirante where no_control='CSEIIO1910002' 
         $this->db->select('semestre,fecha_inscripcion');
         $this->db->from('Aspirante a');
         $this->db->where('a.no_control',$no_control);
         $consulta = $this->db->get();
         $resultado=$consulta->row();
         return $resultado;
         
         }
}








