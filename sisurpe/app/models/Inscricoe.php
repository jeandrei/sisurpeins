<?php
  class Inscricoe {
    private $db;

    public function __construct(){
        $this->db = new Database;        
    }


    public function getInscricoes(){
      $this->db->query("SELECT * FROM inscricoes WHERE fase != 'ARQUIVADO' ORDER BY data_inicio DESC"); 
      $result = $this->db->resultSet(); 
      if($this->db->rowCount() > 0){
          return $result;
      } else {
          return false;
      }           
  }

    public function inscricaoEditavel($id_inscricao=null){
        $this->db->query('
                        SELECT 
                            * 
                        FROM 
                            inscricoes 
                        WHERE 
                            id = :id
                        AND
                            fase = "ABERTO" 
                        OR 
                            fase = "CERTIFICADO" 
                        ORDER BY 
                            data_inicio 
                        DESC
                        '); 
        $this->db->bind(':id',$id_inscricao);  
        $result = $this->db->resultSet(); 
        if($this->db->rowCount() > 0){
            //return $result;
            return true;
        } else {
            return false;
        }           
    }

   


    public function register($data){        
        $this->db->query('INSERT INTO inscricoes (nome_curso, descricao, carga_horaria,data_inicio,data_termino,fase) VALUES (:nome_curso, :descricao, :carga_horaria, :data_inicio, :data_termino, :fase)');
        // Bind values
        $this->db->bind(':nome_curso',$data['nome_curso']);
        $this->db->bind(':descricao',$data['descricao']);
        $this->db->bind(':carga_horaria',$data['carga_horaria']);
        $this->db->bind(':data_inicio',$data['data_inicio']);
        $this->db->bind(':data_termino',$data['data_termino']);
        
        //Se o usuário não passar a faze da inscrição definimos como Aberto
        if($data['fase'] ==''){
            $data['fase'] = 'A';
        };
        $this->db->bind(':fase',$data['fase']);

        
        // Execute
        if($this->db->execute()){
            return  $this->db->lastId;              
        } else {
            return false;
        }
    }

  





}//class Inscricoe