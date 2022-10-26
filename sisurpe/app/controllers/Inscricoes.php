<?php 
    class Inscricoes extends Controller{
         public function __construct(){            
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->inscritoModel = $this->model('Inscrito');
          $this->temaModel = $this->model('Tema');
        }
        
        public function index(){  
            
                $data = [
                'title' => 'Inscrições Abertas',
                'description'=> 'Inscrições Abertas',
                'inscricoes' => $this->inscricaoModel->getInscricoes()
            ];

            
           
            $this->view('inscricoes/index', $data);
        }  

        
        public function inscrever($inscricoes_id){
            
            $error=[];
            if(empty($inscricoes_id)){
                $error['inscricoes_id_err'] = 'Id obrigatório';
            }

            
            if(empty($error['inscricoes_id_err'])){
                
                if($this->inscritoModel->gravaInscricao($inscricoes_id,$_SESSION[DB_NAME . '_user_id'])){ 
                    $data = [
                        'title' => 'Inscrições Abertas',
                        'description'=> 'Inscrições Abertas',
                        'inscricoes' => $this->inscricaoModel->getInscricoes()                      
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
                        'inscricoes' => $this->inscricaoModel->getInscricoes()
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
                'nome_curso' => mb_strtoupper(trim($_POST['nome_curso'])),
                'descricao' => mb_strtoupper(trim($_POST['descricao'])),
                'carga_horaria' => $_POST['carga_horaria'],
                'data_inicio' => $_POST['data_inicio'],
                'data_termino' => trim($_POST['data_termino']),
                'fase' => $_POST['fase']                
              ];
              
              
              if(empty($data['nome_curso'])){
                  $data['nome_curso_err'] = 'Por favor informe o nome do curso';
              }
              
              if(empty($data['descricao'])){
                  $data['descricao_err'] = 'Por favor informe a descrição do curso';
              }

              if(empty($data['carga_horaria'])){
                $data['carga_horaria_err'] = 'Por favor informe a carga horária';
              }
              
               if (!valida($data['data_inicio'])){
                $data['data_inicio_err'] = 'Data inválida';
              }

              if (!valida($data['data_termino'])){
                $data['data_termino_err'] = 'Data inválida';
              } else {
                if($data['data_termino'] < $data['data_inicio']){
                    $data['data_termino_err'] = 'Data de termino menor que data de início';
                }
              }


             
              
              // Make sure errors are empty
              if(                    
                  empty($data['nome_curso_err']) &&
                  empty($data['descricao_err']) && 
                  empty($data['carga_horaria_err']) &&
                  empty($data['data_inicio_err']) &&
                  empty($data['data_termino_err']) 
                  ){ 
                    
                      try {                          
                        if($lastId = $this->inscricaoModel->register($data)){
                          // verifico se a inscrição é editavel ou seja se ela não está fechada ou arquivada
                          $data['editavel'] = $this->inscricaoModel->inscricaoEditavel($lastId);
                          // pego o id da inscrição criada
                          $data['inscricoes_id'] = $lastId; 
                          // pega os temas se o usuário estiver adicionando
                          $data['temas'] = $this->temaModel->getTemasInscricoesById($lastId);
                          flash('message', 'Dados registrados com sucesso');  
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
        }//add


        public function edit($id){
          // Check for POST            
          if($_SERVER['REQUEST_METHOD'] == 'POST'){        
              
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
          
          $data = [     
            'id' => $id,                     
            'nome_curso' => mb_strtoupper(trim($_POST['nome_curso'])),
            'descricao' => mb_strtoupper(trim($_POST['descricao'])),
            'carga_horaria' => $_POST['carga_horaria'],
            'data_inicio' => $_POST['data_inicio'],
            'data_termino' => trim($_POST['data_termino']),
            'fase' => $_POST['fase']                
          ];
          
          
          if(empty($data['nome_curso'])){
              $data['nome_curso_err'] = 'Por favor informe o nome do curso';
          }
          
          if(empty($data['descricao'])){
              $data['descricao_err'] = 'Por favor informe a descrição do curso';
          }

          if(empty($data['carga_horaria'])){
            $data['carga_horaria_err'] = 'Por favor informe a carga horária';
          }
          
            if (!valida($data['data_inicio'])){
            $data['data_inicio_err'] = 'Data inválida';
          }

          if (!valida($data['data_termino'])){
            $data['data_termino_err'] = 'Data inválida';
          } else {
            if($data['data_termino'] < $data['data_inicio']){
                $data['data_termino_err'] = 'Data de termino menor que data de início';
            }
          }


          
          
          // Make sure errors are empty
          if(                    
              empty($data['nome_curso_err']) &&
              empty($data['descricao_err']) && 
              empty($data['carga_horaria_err']) &&
              empty($data['data_inicio_err']) &&
              empty($data['data_termino_err']) 
              ){ 
                
                  try { 
                    if($this->inscricaoModel->update($data)){                      
                      // verifico se a inscrição é editavel ou seja se ela não está fechada ou arquivada
                      $data['editavel'] = $this->inscricaoModel->inscricaoEditavel($id);
                      // pego o id da inscrição 
                      $data['inscricoes_id'] = $id;  
                      flash('message', 'Dados atualizados com sucesso');  
                      $this->view('inscricoes/edit', $data);  
                    } else {
                        throw new Exception('Ops! Algo deu errado ao tentar gravar os dados!');
                    }                 
                  } catch (Exception $e) {        
                    $erro = 'Erro: '.  $e->getMessage(). "\n";
                    flash('message', $erro,'alert alert-danger');
                    $this->view('inscricoes/edit');
                  }  
  
              } else {
                // Load the view with errors
                $this->view('inscricoes/edit', $data);
              } 
      
          } else {
            $data = $this->inscricaoModel->getInscricaoById($id); 
            
            $data = [
              'editavel' => $this->inscricaoModel->inscricaoEditavel($id),
              'inscricoes_id' => $id,
              'nome_curso' => $data->nome_curso,
              'descricao' => $data->descricao,
              'carga_horaria' => $data->carga_horaria,
              'data_inicio' => $data->data_inicio,
              'data_termino' => $data->data_termino,
              'numero_certificado' => $data->numero_certificado,
              'livro' => $data->livro,
              'folha' => $data->folha,
              'fase' => $data->fase              
            ];
            // Load view
            $this->view('inscricoes/edit', $data);
          }     
        }//edit



        
        
        
        
}