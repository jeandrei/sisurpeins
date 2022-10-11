<?php 
    class Inscricoes extends Controller{
         public function __construct(){            
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->inscritoModel = $this->model('Inscrito');
        }
        
        public function index(){  
            
                $data = [
                'title' => 'Inscrições Abertas',
                'description'=> 'Inscrições Abertas',
                'inscricoes' => $this->inscricaoModel->getInscricoesAberto()
            ];

            
           
            $this->view('inscricoes/index', $data);
        }  

        
        public function gravar($inscricoes_id){
            
            $error=[];
            if(empty($inscricoes_id)){
                $error['inscricoes_id_err'] = 'Id obrigatório';
            }

            
            if(empty($error['inscricoes_id_err'])){
                
                if($this->inscritoModel->gravaInscricao($inscricoes_id,$_SESSION[DB_NAME . '_user_id'])){ 
                    $data = [
                        'title' => 'Inscrições Abertas',
                        'description'=> 'Inscrições Abertas',
                        'inscricoes' => $this->inscricaoModel->getInscricoesAberto()
                    ];                        
                    $this->view('inscricoes/index', $data);  
                }                 
                
            } else {
                return $error['inscricoes_id_err'];
            } 
        }


        public function cancelar($inscricoes_id){
            
            $error=[];
            if(empty($inscricoes_id)){
                $error['inscricoes_id_err'] = 'Id obrigatório';
            }

            
            if(empty($error['inscricoes_id_err'])){
                
                if($this->inscritoModel->cancelaInscricao($inscricoes_id,$_SESSION[DB_NAME . '_user_id'])){
                    $data = [
                        'title' => 'Inscrições Abertas',
                        'description'=> 'Inscrições Abertas',
                        'inscricoes' => $this->inscricaoModel->getInscricoesAberto()
                    ];                        
                    $this->view('inscricoes/index', $data); 
                } 
                
                
            } else {
                return $error['inscricoes_id_err'];
            } 
        }



        
        
        
        
}