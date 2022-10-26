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


  public function getInscricaoById($id){
    $this->db->query("SELECT * FROM inscricoes WHERE id = :id"); 
    
    $this->db->bind(':id', $id);        
    
    $row = $this->db->single();
    if($this->db->rowCount() > 0){
        return $row;
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
                            fase != "ARQUIVADO"
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




    public function update($data){
        $this->db->query('UPDATE inscricoes  SET                                           
                                            nome_curso = :nome_curso,
                                            descricao = :descricao, 
                                            carga_horaria = :carga_horaria, 
                                            data_inicio = :data_inicio, 
                                            data_termino = :data_termino, 
                                            numero_certificado = :numero_certificado, 
                                            livro = :livro, 
                                            folha = :folha, 
                                            fase = :fase  
                                            WHERE id = :id');
                  
        // Bind values 
        $this->db->bind(':id',$data['id']);            
        $this->db->bind(':nome_curso',$data['nome_curso']);
        $this->db->bind(':descricao',$data['descricao']);
        $this->db->bind(':carga_horaria',$data['carga_horaria']);
        $this->db->bind(':data_inicio',$data['data_inicio']);
        $this->db->bind(':data_termino',$data['data_termino']);
        $this->db->bind(':numero_certificado',$data['numero_certificado']);
        $this->db->bind(':livro',$data['livro']);
        $this->db->bind(':folha',$data['folha']);
        $this->db->bind(':fase',$data['fase']);  

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

  





}//class Inscricoe