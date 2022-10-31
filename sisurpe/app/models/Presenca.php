<?php
  class Presenca {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }
  
    public function register($data){       
      $this->db->query('INSERT INTO presenca (abre_presenca_id, user_id) VALUES (:abre_presenca_id, :user_id)');
      // Bind values
      $this->db->bind(':abre_presenca_id',$data['abre_presenca_id']);
      $this->db->bind(':user_id',$data['user_id']);       
      
      // Execute
      if($this->db->execute()){
          return  true;              
      } else {
          return false;
      }
  }


  public function jaRegistrado($data){
    $this->db->query('
                        SELECT 
                          * 
                        FROM 
                          presenca 
                        WHERE 
                          abre_presenca_id = :abre_presenca_id
                        AND 
                          user_id = :user_id                                   
                      ');
        $this->db->bind(':abre_presenca_id',$data['abre_presenca_id']);
        $this->db->bind(':user_id',$data['user_id']);

       $row = $this->db->single();        
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
  }

    
}