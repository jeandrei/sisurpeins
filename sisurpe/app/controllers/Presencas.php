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


        public function add(){ 
          // Check for POST            
          if($_SERVER['REQUEST_METHOD'] == 'POST'){        
              
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
            
            $data = [              
              'id' => $_POST['inscricoes_id'],              
              'carga_horaria' => $_POST['carga_horaria'] ,
              'curso' => $this->inscricaoModel->getInscricaoById($_POST['inscricoes_id'])                        
            ];       
                    
                      

            if(empty($data['carga_horaria'])){
              $data['carga_horaria_err'] = 'Por favor informe a carga horária';
            }  
           
            
            // Make sure errors are empty
            if(     
                empty($data['carga_horaria_err'])
              ){ 
                  die('vai gravar');
                    try {                          
                      if($lastId = $this->inscricaoModel->register($data)){
                        // verifico se a inscrição é editavel ou seja se ela não está fechada ou arquivada
                        $data['editavel'] = $this->inscricaoModel->inscricaoEditavel($lastId);
                        // pego o id da inscrição criada
                        $data['inscricoes_id'] = $lastId; 
                        // pega os temas se o usuário estiver adicionando
                        $data['temas'] = $this->temaModel->getTemasInscricoesById($lastId);
                        flash('message', 'Dados registrados com sucesso');  
                        $this->view('presencas/add', $data);  
                      } else {
                          throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                      }                 
                    } catch (Exception $e) {
                      $erro = 'Erro: '.  $e->getMessage(). "\n";
                      flash('message', $erro,'alert alert-danger');
                      $this->view('presencas/index', $data);
                    }  
    
                } else {                  
                  // Load the view with errors
                  $this->view('presencas/index', $data);
                } 
        
          } else {
            // Init data             
            $data = [  
              'carga_horaria' => ''             
          ];
            // Load view          
            $this->view('presencas/index/', $data);
          }     
      }//add

        
       
        
}