<?php
class M_portabilidad extends CI_Model { 
   public function __construct() {
      parent::__construct();
      $this->load->model("M_frer");
   }




   function estudiante_portabilidad($no_control){
       return $this->db->query("select * from Resolucion_equivalencia where id_estudiante='".$no_control."'")->result();
   }

   function estudiantes_de_portabilidad($curp,$plantel){
        return $this->db->query("select * from Estudiante as e inner join (select no_control from Estudiante where tipo_ingreso='PORTABILIDAD' and no_control not in
        (select Estudiante_no_control as no_control from Friae_Estudiante as fe inner join Estudiante as e on fe.Estudiante_no_control=e.no_control where tipo_ingreso_inscripcion='PORTABILIDAD' and e.curp like '".$curp."%' and Plantel_cct_plantel like '".$plantel."%')) as sin_grupo on e.no_control=sin_grupo.no_control
        union
        select no_control, nombre, primer_apellido, segundo_apellido, fecha_nacimiento, sexo, curp, fecha_registro, tipo_ingreso, folio_programa_social, matricula, semestre, estatus, correo, nss, calle, colonia, cp, id_localidad, semestre_en_curso, fecha_inscripcion, telefono, Plantel_cct_plantel, nacionalidad, lugar_nacimiento, semestre_ingreso, observaciones, localidad_origen, etnia, no_control from Friae_Estudiante as fe inner join Estudiante as e on fe.Estudiante_no_control=e.no_control where tipo_ingreso_inscripcion='PORTABILIDAD' and e.curp like '".$curp."%' and Plantel_cct_plantel like '".$plantel."%';")->result();
   }

   //select if(datediff(curdate(),fecha_inscripcion)<=60,"si","no") as dias from Estudiante where no_control='CSEIIO1910001';

   function fecha_valida_agregar_materias($no_control){
      return $this->db->query("select if(datediff(curdate(),fecha_inscripcion)<=60,'si','no') as dias from Estudiante where no_control='".$no_control."'")->result()[0]->dias;
   }

   function datos_cargar_materias_estudiante($no_control){
      return $this->db->query("select nombre,primer_apellido,segundo_apellido,cct_escuela_procedencia,nombre_escuela_procedencia,nombre_plantel,no_control from Estudiante as e inner join Estudiante_Escuela_procedencia as eep on e.no_control=eep.Estudiante_no_control inner join Escuela_procedencia as ep on eep.Escuela_procedencia_cct_escuela_procedencia=ep.cct_escuela_procedencia inner join Plantel as p on e.Plantel_cct_plantel=p.cct_plantel where e.no_control='".$no_control."' and ep.tipo_escuela_procedencia='BACHILLERATO'")->result()[0];
   }

   function materias(){
      return $this->db->query("select * from Materia group by clave")->result();
   }

   function agregar_materias($datos){
     // $this->db->trans_start();
      if($datos->materias_pasadas=="no"){//se agregan como materias que debe con calificion 5
         $claves_materias="";
         foreach($datos->materias as $materia){
            $claves_materias.=$materia.",";
            $this->db->query("insert into Portabilidad_adeudos (Estudiante_no_control,Materia_id_materia,calificacion)
            values ('".$datos->no_control."','".$materia."',5)");
         }

         $this->db->query("update Estudiante set estatus='IRREGULAR' where no_control='".$datos->no_control."'");

         $folio = $this->db->query("select min(folio) as folio from Friae as f inner join Friae_Estudiante as fe on f.folio=fe.Friae_folio where Estudiante_no_control='".$datos->no_control."'")->result();//-------------------------------------------------------------------------------------------------------------------------------------------
      
         if(sizeof($folio)>0){//si ya tiene grupo
            
            $this->db->query("update Friae_Estudiante set estatus_inscripcion='IRREGULAR',numero_adeudos_inscripcion=".sizeof($datos).",id_materia_adeudos_inscripcion='".$claves_materias."' where Friae_folio=".$folio[0]->folio." and Estudiante_no_control='".$datos->no_control."'");
         }
      }



      else{//se agregan como materias pasadas con la calificacion qque ellos asignen
         //claves de materias
         $claves = "";
         $plantel = $this->db->query("select Plantel_cct_plantel as plantel from Estudiante where no_control='".$datos->no_control."'")->result()[0]->plantel;
         $ano_entro = $this->db->query("select year(fecha_inscripcion) as year from Estudiante where no_control='".$datos->no_control."'")->result()[0]->year;
         $semestre_entro = $this->db->query("select semestre from Friae as f inner join Friae_Estudiante as fe on f.folio=fe.Friae_folio inner join Grupo as g on g.id_grupo=f.id_grupo where Estudiante_no_control='".$datos->no_control."' and folio=(select min(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='".$datos->no_control."')")->result()[0]->semestre;
         

         $mes = "";

         if($semestre_entro=="1" || $semestre_entro=="3" || $semestre_entro=="5"){
            $mes = "10";
         }

         else{
            $mes = "05";
         }

         $folio = $this->M_frer->folio_frer_periodo_plantel($plantel,intval($mes),intval($ano_entro));
         $folio_friae = $this->db->query("select min(Friae_folio) as folio from Friae_Estudiante where Estudiante_no_control='CSEIIO1910080'")->result()[0]->folio;
         foreach($datos->materias as $materia){
            $claves.= $materia.',';
         }
         //echo "update Friae_Estudiante set estatus_inscripcion='IRREGULAR',numero_adeudos_inscripcion=".sizeof($datos->materias).",id_materia_adeudos_inscripcion='".$claves."' where Estudiante_no_control='".$datos->no_control."' and Friae_folio=".$folio;

         
         $this->db->query("update Friae_Estudiante set estatus_inscripcion='IRREGULAR',numero_adeudos_inscripcion=".sizeof($datos->materias).",id_materia_adeudos_inscripcion='".$claves."' where Estudiante_no_control='".$datos->no_control."' and Friae_folio=".$folio_friae);

         
         
        

         $fecha_regularizacion = $ano_entro."-".$mes."-10";

         $this->db->query("insert into Detalle_frer (Estudiante_no_control,ultimo_semestre_cursado,numero_adeudos,situacion_estudiante,observaciones,Frer_id_frer) values ('".$datos->no_control."','',0,'REGULAR','',".$folio.")");

         $contador = 0;
         foreach($datos->materias as $materia){
            $this->db->query("insert into Regularizacion (id_materia,calificacion,Estudiante_no_control,fecha_calificacion,estatus,fecha,Plantel_cct_plantel)
            values ('".$materia."',".$datos->calificaciones[$contador].",'".$datos->no_control."','".$fecha_regularizacion."',0,'".$fecha_regularizacion."','".$plantel."')");
            $contador+=1;
         }
         
         
      }

         
      
      $this->db->trans_complete();
      if ($this->db->trans_status() === FALSE)
         {
               return "no";
         }

         else{
            return "si";
         }

         
   }
}