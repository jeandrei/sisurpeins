<?php 
    class Abrepresencas extends Controller{
         public function __construct(){            
          $this->abrePresencaModel = $this->model('Abrepresenca');    
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->inscritoModel = $this->model('Inscrito');
          $this->temaModel = $this->model('Tema');
          $this->userModel = $this->model('User');      
        }
        
        public function index($inscricoes_id){              

                $data = [                
                'title' => 'Abrir presença',
                'description'=> 'Abrir presença para o curso',
                'curso' => $this->inscricaoModel->getInscricaoById($inscricoes_id),
                'presenca_em_andamento' => $this->abrePresencaModel->temPresencaEmAndamento($inscricoes_id)
            ];

            
           
            $this->view('abrepresencas/index', $data);
        }  


        public function add(){
          // Check for POST            
          if($_SERVER['REQUEST_METHOD'] == 'POST'){        
              
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
            
            $data = [              
              'inscricoes_id' => $_POST['inscricoes_id'],              
              'carga_horaria' => $_POST['carga_horaria'],
              'curso' => $this->inscricaoModel->getInscricaoById($_POST['inscricoes_id']),   
              'presenca_em_andamento' => $this->abrePresencaModel->temPresencaEmAndamento($inscricoes_id)                   
            ];       
                    
                      

            if(empty($data['carga_horaria'])){
              $data['carga_horaria_err'] = 'Por favor informe a carga horária';
            }  
           
            
            // Make sure errors are empty
            if(     
                empty($data['carga_horaria_err'])
              ){                   
                  try {
                    if($this->abrePresencaModel->temPresencaEmAndamento($data['inscricoes_id'])){
                      $this->abrePresencaModel->fecharPresenca($data['inscricoes_id']);
                      $this->view('abrepresencas/index');
                    }                          
                    elseif($lastId = $this->abrePresencaModel->register($data)){
                      
                      flash('message', 'Dados registrados com sucesso');                        
                      redirect('abrepresencas/index/' . $data['inscricoes_id']);                   
                    } else {
                        throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                    }                 
                  } catch (Exception $e) {
                    $erro = 'Erro: '.  $e->getMessage(). "\n";
                    flash('message', $erro,'alert alert-danger');
                    $this->view('abrepresencas/index', $data);
                  }  
    
                } else {                  
                  // Load the view with errors
                  $this->view('abrepresencas/index', $data);
                } 
        
          } else {
            // Init data             
            $data = [  
              'carga_horaria' => ''             
          ];
            // Load view          
            $this->view('abrepresencas/index/', $data);
          }     
      }//add

        
       
        
}