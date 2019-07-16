<?php
class M_notificacion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   function agregar_notificacion($datos){
    $this->db->trans_start();

    if($datos->plantel=="todos"){
        $planteles = $this->db->query("select cct_plantel as plantel from Plantel")->result();

        foreach($planteles as $plantel){

            $this->db->query("insert into Notificacion (autor,mensaje,titulo,plantel,fecha_fin) values 
        ('".$datos->autor."','".$datos->mensaje."','".$datos->titulo."','".$plantel->plantel."','".$datos->fecha_fin."')");

        }
    }

    else{

        foreach($datos->plantel as $plantel){
            $this->db->query("insert into Notificacion (autor,mensaje,titulo,plantel,fecha_fin) values 
            ('".$datos->autor."','".$datos->mensaje."','".$datos->titulo."','".$plantel."','".$datos->fecha_fin."')");
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



    function notificaciones_plantel($plantel){
        return $this->db->query("select * from Notificacion where plantel = '".$plantel."' and curdate()<=fecha_fin")->result();
    }


}