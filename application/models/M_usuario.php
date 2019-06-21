<?php
class M_usuario extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }

   public function login($usuario, $password){
    $query = $this->db->query("SELECT * FROM Usuario where password=md5('".$password."') and usuario='".$usuario."'");
    return $query->row_array();
}



public function crear_usuario($datos){
   $this->db->trans_start();

   $this->db->query("insert into Usuario (usuario,password,rol,plantel,id_asesor,estatus,correo) values
   ('".$datos->usuario."',MD5('".$datos->password."'),'".$datos->rol."','".$datos->plantel."',0,0,'".$datos->correo."')");

   $this->db->trans_complete();

if ($this->db->trans_status() === FALSE)
{
       return "no";
}

else{
   return "si";
}
}



public function usuarios_registrados(){
   return $this->db->query("select * from Usuario")->result();
}

public function usuarios_registrados_id($usuario){
   return $this->db->query("select * from Usuario where id_usuario='".$usuario."' ")->result();
}


public function editar_usuario($datos){
   $this->db->trans_start();
   if($datos->rol!="PLANTEL"){//no llevan plantel

      if($datos->password==""){//si no trae contrasena
         $this->db->query("update Usuario set usuario='".$datos->usuario."',correo='".$datos->correo."' where id_usuario=".$datos->id_usuario);
      }

      else{
         $this->db->query("update Usuario set usuario='".$datos->usuario."',correo='".$datos->correo."',password=MD5('".$datos->password."') where id_usuario=".$datos->id_usuario);
      }

   }

   else{
      if($datos->password==""){//si no trae contrasena
         $this->db->query("update Usuario set usuario='".$datos->usuario."',correo='".$datos->correo."',plantel='".$datos->plantel."' where id_usuario=".$datos->id_usuario);
      }

      else{
         $this->db->query("update Usuario set usuario='".$datos->usuario."',correo='".$datos->correo."',password=MD5('".$datos->password."'),plantel='".$datos->plantel."' where id_usuario=".$datos->id_usuario);
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



public function borrar_usuario($datos){
   $this->db->trans_start();

   $this->db->query("delete from Usuario where id_usuario=".$datos->id_usuario);

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