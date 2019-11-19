<?php
class M_configuracion extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }


function get_jefe_escolar(){
   return $this->db->query("SELECT valor FROM Configuracion where tipo='JEFE_ESCOLAR';")->result();
}


}
