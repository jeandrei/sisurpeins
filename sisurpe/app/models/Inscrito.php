<?php
  class Inscrito {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }
  
    public function gravaInscricao($inscricoes_id,$user_id){
      $this->db->query('
                        INSERT INTO inscritos SET
                        inscricoes_id   = :inscricoes_id, 
                        user_id         = :user_id             
        ');
        $this->db->bind(':inscricoes_id',$inscricoes_id);
        $this->db->bind(':user_id',$user_id);    
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

  }