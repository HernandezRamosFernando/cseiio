

<?php
class M_estudiante extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function asignar_matricula(){

    /*SELECT IF(COUNT(*)<=0,1,COUNT(*)+1) numero FROM control_escolar.aspirante a where no_control like 'CSEIIO%' AND SUBSTRING(a.no_control,7,2)=19;*/
    $this->db->select('IF(COUNT(*)<=0,1,COUNT(*)+1) numero');
    $this->db->from('Estudiante e');
    $this->db->like('e.matricula','after');
    $this->db->where('SUBSTRING(e.matricula,7,2)',date("y"));
    $consulta = $this->db->get();
    $resultado=$consulta->row()->numero;
    return $resultado;
    
    }


    public function insertar_estudiante($datos){
        if($this->db->insert('Estudiante',$datos)){
            return "Matricula generada exitosamente";
        }

        else{
            return "Algo salio mal";
        }

    }


    public function estudiantes_sin_matricula($plantel){

       return $this->db->query(
        "select * 
        from Aspirante
        where Plantel_cct='".$plantel."' and no_control not in(select Aspirante_no_control from Estudiante)")->result();

    }
}








