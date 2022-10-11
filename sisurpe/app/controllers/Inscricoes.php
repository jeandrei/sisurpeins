<?php 
    class Inscricoes extends Controller{
         public function __construct(){            
          $this->inscricaoModel = $this->model('Inscricoe');
        }
        
        public function index(){  
            
                $data = [
                'title' => 'Inscrições abertas',
                'description'=> 'Inscrições abertas',
                'inscricoes' => $this->inscricaoModel->getInscricoesAberto()
            ];
           
            $this->view('inscricoes/index', $data);
        }     
}