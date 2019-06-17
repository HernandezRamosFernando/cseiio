<?php
class M_frer extends CI_Model { 
   public function __construct() {
      parent::__construct();
   }



   function folio_frer_periodo_plantel($plantel,$mes,$ano){
      return $this->db->query("select id_frer from Frer where month(fecha)=".$mes." and year(fecha)=".$ano." and Plantel_cct_plantel='".$plantel."'")->result()[0]->id_frer;
   }
}