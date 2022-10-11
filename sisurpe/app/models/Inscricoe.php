<?php
  class Inscricoe {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }


    public function getInscricoesAberto(){
      $this->db->query("SELECT * FROM inscricoes WHERE aberto = 'S' ORDER BY data_inicio DESC"); 
      $result = $this->db->resultSet(); 
      if($this->db->rowCount() > 0){
          return $result;
      } else {
          return false;
      }           
  }

  }