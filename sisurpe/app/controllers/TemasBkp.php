<?php 
    class Temas extends Controller{
         public function __construct(){            
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->temaModel = $this->model('Tema');
        }
        
                
        public function gravar($inscricoes_id){
            
            $error=[];
            if(empty($inscricoes_id)){
                $error['inscricoes_id_err'] = 'Id obrigatório';
            }

            
            if(empty($error['inscricoes_id_err'])){
                
                if($this->temaModel->gravaTema($inscricoes_id)){ 
                                  
                    $this->view('inscricoes/add', $data);  
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





        public function add(){             
            
            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){        
                
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
              
              $data = [              
                'tema' => mb_strtoupper(trim($_POST['tema'])),                
                'carga_horaria' => $_POST['carga_horaria'],
                'formador' => mb_strtoupper(trim($_POST['formador']))
                             
              ];
              
              
              if(empty($data['tema'])){
                  $data['tema_err'] = 'Por favor informe o tema';
              }                  
              
              // Make sure errors are empty
              if(                    
                  empty($data['tema_err'])  
              ){ 
                    
                      try {                          
                        if($lastId = $this->inscricaoModel->register($data)){
                          // verifico se a inscrição é editavel ou seja se ela não está fechada ou arquivada
                          $data['editavel'] = $this->inscricaoModel->inscricaoEditavel($lastId);
                          // pego o id da inscrição criada
                          $data['inscricao_id'] = $lastId; 
                          flash('mensagem', 'Dados registrados com sucesso');  
                          $this->view('inscricoes/add', $data);  
                        } else {
                            throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                        }                 
                      } catch (Exception $e) {
                        $erro = 'Erro: '.  $e->getMessage(). "\n";
                        flash('message', $erro,'alert alert-danger');
                        $this->view('inscricoes/add');
                      }  
      
                  } else {
                    // Load the view with errors
                    $this->view('inscricoes/add', $data);
                  } 
          
            } else {
              // Init data             
              $data = [              
                'nome_curso' => '',
                'descricao' => '',
                'carga_horaria' => '',
                'data_inicio' => '',
                'data_termino' => '',
                'aberto' => ''
            ];
              // Load view
              $this->view('inscricoes/add', $data);
            }     
          }



        
        
        
        
}