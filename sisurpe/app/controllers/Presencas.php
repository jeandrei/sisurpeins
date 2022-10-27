<?php 
    class Presencas extends Controller{
         public function __construct(){            
          //$this->presencaModel = $this->model('Presenca');    
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->inscritoModel = $this->model('Inscrito');
          $this->temaModel = $this->model('Tema');
          $this->userModel = $this->model('User');      
        }
        
        public function index($id){  
          
                $data = [                
                'title' => 'Abrir presença',
                'description'=> 'Abrir presença para o curso',
                'curso' => $this->inscricaoModel->getInscricaoById($id)
            ];

            
           
            $this->view('presencas/index', $data);
        }  

        
       
        
}