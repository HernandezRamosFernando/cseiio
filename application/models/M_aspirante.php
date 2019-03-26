<?php
class M_aspirante extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   /*
   public function asignar_num_control(){

      //SELECT IF(COUNT(*)<=0,1,COUNT(*)+1) numero FROM control_escolar.aspirante a where no_control like 'CSEIIO%' AND SUBSTRING(a.no_control,7,2)=19;
     $this->db->select('IF(COUNT(*)<=0,1,COUNT(*)+1) numero');
     $this->db->from('Aspirante a');
     $this->db->like('a.no_control','CSEIIO','after');
     $this->db->where('SUBSTRING(a.no_control,7,2)',date("y"));
     $consulta = $this->db->get();
     $resultado=$consulta->row()->numero;
     return $resultado;
      
}
*/

public function asignar_numero_consecutivo(){
   /*SELECT  max(CONVERT(SUBSTRING(a.no_control,10,LENGTH(a.no_control)), SIGNED INTEGER)) as numero FROM control_escolar.aspirante a where no_control like 'CSEIIO20%';*/
  $this->db->select('max(CONVERT(SUBSTRING(a.no_control,10,LENGTH(a.no_control)), SIGNED INTEGER)) as numero');
  $this->db->from('Aspirante a');
  $this->db->like('a.no_control','CSEIIO'.date("y"),'after');

  $consulta = $this->db->get();
  $resultado=$consulta->row()->numero;

  return $resultado;
   
}

   //===========================================
   public function aspirantes_sin_matricula(){
      /*
      select * from aspirante a where a.no_control not in (select Aspirante_no_control from estudiante);
      */
           $this->db->select('*');
           $this->db->from('Aspirante a');
           $this->db->where('a.no_control not in (select Aspirante_no_control from Estudiante)');
           $consulta = $this->db->get();
           $resultado=$consulta->result();
           return $resultado;
         }


  


   public function actualizar_datos_aspirante(
      $datos_aspirante,
      $datos_aspirante_direccion,
      $datos_aspirante_tutor,
      $datos_aspirante_lengua,
      $datos_aspirante_medicos,
      $no_control){


    $this->db->trans_start();    
    //actualizacion apirante
    $this->db->where('no_control', $no_control);
    $this->db->update('Aspirante', $datos_aspirante);

    //actualizacion Direccion aspira
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Direccion_Aspirante', $datos_aspirante_direccion);

    //actualizacion Tutor aspirante
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Tutor', $datos_aspirante_tutor);

    //actualizacion lengua
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Lengua_materna', $datos_aspirante_lengua);

    //actualizacion datos medicos
    $this->db->where('Aspirante_no_control', $no_control);
    $this->db->update('Datos_medicos_aspirante', $datos_aspirante_medicos);
    $this->db->trans_complete();

if ($this->db->trans_status() === FALSE)
{
   ?>
    <script>
      alert("algo salio mal");
      </script>
   <?php
        //return "alert(algo salio mal)";
}
   
else{
   ?>
    <script>
      alert("Aspirante actualizado correctamente");
      </script>
   <?php
}
     
      
    
      

   }


public function insertar_aspirante_nuevo_ingreso(
   $datos_aspirante,
   $datos_aspirante_direccion,
   $datos_aspirante_tutor,
   $datos_aspirante_lengua,
   $datos_aspirante_documentos,
   $datos_aspirante_medicos){

      

            $this->db->trans_start();
            $this->db->insert('Aspirante',$datos_aspirante);
            $this->db->insert('Direccion_Aspirante',$datos_aspirante_direccion);
            $this->db->insert('Tutor',$datos_aspirante_tutor);
            $this->db->insert('Lengua_materna',$datos_aspirante_lengua);
            $this->db->insert('Datos_medicos_aspirante',$datos_aspirante_medicos);
            foreach($datos_aspirante_documentos as $documento){
               $registro = array(
                  'Aspirante_no_control' => $datos_aspirante['no_control'],
                  'Documento_id_documento' => $documento['Documento_id_documento'],
                  'entregado' => $documento['entregado']
               );
               $this->db->insert('Documentacion',$registro);
         }
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
               ?>
                <script>
                  alert("algo salio mal");
                  </script>
               <?php
                    //return "alert(algo salio mal)";
            }
               
            else{
               ?>
                <script>
                  alert("Registro agregado correctamente");
                  </script>
               <?php
            }
   //print_r($datos_aspirante_documentos);

   
}


public function get_aspirantes_nombre(
   $curp,
   $plantel){
   

$consulta = "SELECT * FROM Aspirante as a left outer join Estudiante as e 
on a.no_control=e.Aspirante_no_control where Plantel_cct like '".$plantel."%' and curp like '".$curp."%'";

return $this->db->query($consulta)->result();
//return $this->db->get('Aspirante')->result();
}





//=====================================================================

public function get_aspirantes_nombre_documentos(
   $no_control){

   $consulta = array(
   'Aspirante_no_control =' => $no_control,
   'tipo =' => 'base',
   'entregado =' => '0'
);



$this->db->select('*');
$this->db->from('Documentacion');
$this->db->join('Documento', 'Documentacion.Documento_id_documento = Documento.id_documento');
$this->db->where($consulta);


return $this->db->get()->result();
}



function listar_aspirantes_xplantel($curp, $plantel){
   return $this->db->query(
      "select * 
      from Aspirante
      where Plantel_cct like'".$plantel."%' and curp like'".$curp."%' ")->result();


  }



public function aspirantes_carta_compromiso(
   $curp,
   $plantel
   ){

return $this->db->query("select * from (select Aspirante_no_control as no_control, count(*) as total_documentos 
from  Documentacion inner join Documento on Documento.id_documento = Documentacion.Documento_id_documento 
where Documento.tipo = 'base' and Documentacion.entregado = 0 group by Aspirante_no_control) as aspirantes_faltantes 
inner join Aspirante on  aspirantes_faltantes.no_control=Aspirante.no_control
where total_documentos<5 and Plantel_cct like'".$plantel."%' and curp like'".$curp."%'" )->result();

}



//=====================================================================






function get_aspirante($no_control){

   return $this->db->get_where('Aspirante', array('no_control' => $no_control))->result();
}


function delete_aspirante($no_control){

   $this->db->trans_start();
    $this->db->delete('Aspirante', array('no_control' => $no_control)); 
   $this->db->trans_complete();

if ($this->db->trans_status() === FALSE)
{
        return "algo salio mal";
}

else{
   return "registro borrado correctramente";
}
   
   
}


function aspirante_plantel($no_control){
return $this->db->query("select * from Aspirante as a inner join Plantel as p on a.Plantel_cct=p.cct where a.no_control like '".$no_control."%'")->result();
}



function agregar_observaciones($observaciones){
   //$id = $observaciones[0]->id;
//return $id;
//return "hola";
$this->db->trans_start();
foreach($observaciones as $observacion){
      //$datos.=$observacion->observacion.",".$observacion->id.",".$observacion->no_control.";;;";
      $this->db->query("update Documentacion set observacion = '".$observacion->observacion."' where Documento_id_documento=".$observacion->id." and Aspirante_no_control='".$observacion->no_control."'");
}
$this->db->query("insert into Documentacion(Documento_id_documento,Aspirante_no_control,fecha_entrega) values (5,'".$observacion->no_control."','".date("Y-m-d")."')");

$this->db->trans_complete();

if ($this->db->trans_status() === FALSE)
{
        return "algo salio mal";
}

else{
   return "bien";
}


}
//aqui terminan las funcoines


}
?>