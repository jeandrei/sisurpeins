<?php
  class Abrepresenca {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }
  
    public function register($data){            
      $this->db->query('INSERT INTO abre_presenca (inscricoes_id, carga_horaria) VALUES (:inscricoes_id, :carga_horaria)');
      // Bind values
      $this->db->bind(':inscricoes_id',$data['inscricoes_id']);
      $this->db->bind(':carga_horaria',$data['carga_horaria']); 
      
      // Execute
      if($this->db->execute()){
          return $this->db->lastId;               
      } else {
          return false;
      }
  }

    public function deletaTema($id){
      $this->db->query('
                        DELETE FROM abre_presenca WHERE
                          id = :id                                 
        ');
        $this->db->bind(':id',$id);         
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
       
  public function deleteAbrePresenca($id){  
    
    $this->db->query('DELETE FROM abre_presenca WHERE id = :id');
    // Bind values
    $this->db->bind(':id',$id);           
                
    // Execute
    if($this->db->execute()){
        return true;
    } else {
        return false;
    }
  }


  public function temPresencaEmAndamento($inscricoes_id){   
    $this->db->query("SELECT * FROM abre_presenca WHERE inscricoes_id = :inscricoes_id AND status = 'ABERTO'");
      $this->db->bind(':inscricoes_id',$inscricoes_id); 
      $data = $this->db->single();
      if($this->db->rowCount() > 0){
          return $data;
      } else {
          return false;
      }           
  }

  public function fecharPresenca($id){    
    $this->db->query("UPDATE abre_presenca SET status = 'FECHADO' WHERE id=:id");              
    $this->db->bind(':id',$id); 
    // Execute
    if($this->db->execute()){
      return true;
    } else {
        return false;
    }    
  }


  public function getInscricaoId($abre_presenca_id){
    $this->db->query("SELECT inscricoes_id FROM abre_presenca WHERE id = :id");
      $this->db->bind(':id',$abre_presenca_id); 
      $data = $this->db->single();
      if($this->db->rowCount() > 0){
          return $data;
      } else {
          return false;
      }           
  }

 public function getTotalCargaHorariaPresencas($inscricoes_id){
  $this->db->query("SELECT SUM(carga_horaria) as carga_horaria FROM abre_presenca WHERE inscricoes_id = :inscricoes_id");
      $this->db->bind(':inscricoes_id',$inscricoes_id); 
      $row = $this->db->single();  
      if($this->db->rowCount() > 0){
          return $row->carga_horaria;
      } else {
          return false;
      }   
 }
    
    

}