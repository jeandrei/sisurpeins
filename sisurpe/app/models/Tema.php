<?php
  class Tema {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }
  
    public function gravaTema($inscricoes_id){
      $this->db->query('
                        INSERT INTO inscricoes_temas SET
                        inscricoes_id   = :inscricoes_id, 
                        formador        = :formador,
                        tema            = :tema,  
                        carga_horaria        = :carga_horaria,               
        ');
        $this->db->bind(':inscricoes_id',$inscricoes_id);           
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deletaTema($tema_id){
      $this->db->query('
                        DELETE FROM inscricoes_temas WHERE
                          id = :id                                 
        ');
        $this->db->bind(':id',$tema_id);         
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }    

  }