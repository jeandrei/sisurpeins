<?php 
    class Inscricoes extends Controller{
         public function __construct(){            
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->inscritoModel = $this->model('Inscrito');
          $this->temaModel = $this->model('Tema');
          $this->userModel = $this->model('User');
          $this->abrePresencaModel = $this->model('Abrepresenca');
        }
        
        public function index(){ 
          
                if((!isLoggedIn())){                  
                  redirect('users/login');
                } 
                
            
                $data = [
                'title' => 'Inscrições',
                'description'=> 'Inscrições',
                'inscricoes' => $this->inscricaoModel->getInscricoes()               
            ];
           
            $this->view('inscricoes/index', $data);
        }  

        

        public function inscrever($inscricoes_id){
          
            if((!isLoggedIn())){                  
              redirect('users/login');
            } 
            
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
            
            if((!isLoggedIn())){                  
              redirect('users/login');
            } 
            
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
          
            if((!isLoggedIn())){                  
              redirect('users/login');
            } 
            elseif(($_SESSION[DB_NAME . '_user_type']) != "admin" && ($_SESSION[DB_NAME . '_user_type']) != "sec")
            {
              die("Você não tem acesso a esta página!");
            }

            // Check for POST            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){        
                
              $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
              
              $data = [              
                'nome_curso' => mb_strtoupper(trim($_POST['nome_curso'])),
                'descricao' => mb_strtoupper(trim($_POST['descricao'])),
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
              
               if (!validaData($data['data_inicio'])){
                $data['data_inicio_err'] = 'Data inválida';
              }

              if (!validaData($data['data_termino'])){
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
                'data_inicio' => '',
                'data_termino' => '',
                'aberto' => ''
            ];
              // Load view
              $this->view('inscricoes/add', $data);
            }     
        }//add




        public function edit($id){

          if((!isLoggedIn())){                  
            redirect('users/login');
          } 
          elseif(($_SESSION[DB_NAME . '_user_type']) != "admin" && ($_SESSION[DB_NAME . '_user_type']) != "sec")
          {
            die("Você não tem acesso a esta página!");
          }
          
          //pego a data atual
          $dataAtual = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
          $dataAtual = $dataAtual->format('Y-m-d');

          // Check for POST            
          if($_SERVER['REQUEST_METHOD'] == 'POST'){        
              
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);        
          
          

          $data = [     
            'id' => $id,                     
            'nome_curso' => mb_strtoupper(trim($_POST['nome_curso'])),
            'descricao' => mb_strtoupper(trim($_POST['descricao'])),            
            'data_inicio' => $_POST['data_inicio'],
            'data_termino' => trim($_POST['data_termino']),
            'data_atual' => $dataAtual,
            'fase' => $_POST['fase']                
          ];
            

          //se a data atual for menor que a data de início permito a edição e faço a validação
          if ($data['data_atual'] < $data['data_inicio']){
            if (!validaData($data['data_inicio'])){
              $data['data_inicio_err'] = 'Data inválida';
            }
          }
          //se a data atual for menor que a data de termino permito a edição e faço a validação
          if ($data['data_atual'] < $data['data_termino']){
            if (!validaData($data['data_termino'])){
              $data['data_termino_err'] = 'Data inválida';
            } else {
              if($data['data_termino'] < $data['data_inicio']){
                  $data['data_termino_err'] = 'Data de termino menor que data de início';
              }
            }
          }
          
          
          if(empty($data['nome_curso'])){
              $data['nome_curso_err'] = 'Por favor informe o nome do curso';
          }
          
          if(empty($data['descricao'])){
              $data['descricao_err'] = 'Por favor informe a descrição do curso';
          } 
          
          
          // Make sure errors are empty
          if(                    
              empty($data['nome_curso_err']) &&
              empty($data['descricao_err']) &&
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
              'data_inicio' => $data->data_inicio,
              'data_termino' => $data->data_termino,
              'numero_certificado' => $data->numero_certificado,
              'livro' => $data->livro,
              'folha' => $data->folha,
              'fase' => $data->fase,
              'data_atual' => $dataAtual            
            ];
            // Load view
            $this->view('inscricoes/edit', $data);
          }     
        }//edit




        public function certificado($inscricoes_id){
          if($this->inscritoModel->estaInscrito($inscricoes_id,$_SESSION[DB_NAME . '_user_id'])){
                        
            $data = [
              'curso' => $this->inscricaoModel->getInscricaoById($inscricoes_id),
              'temas' => $this->temaModel->getTemasInscricoesById($inscricoes_id),
              'usuario' =>$this->userModel->getUserById($_SESSION[DB_NAME . '_user_id']),
              'presencas' =>$this->inscricaoModel->getPresencasUsuarioById($_SESSION[DB_NAME . '_user_id'],$inscricoes_id)
            ];            
            $this->view('relatorios/certificado', $data);
          } else {
            echo "Você não está inscrito para este curso!";
          }          
        }




        // Retorna true or false
        function estaInscrito(){
          $userId = $_POST['user_id'];
          $inscricoes_id = $_POST['inscricoes_id'];          
          $json_ret = $this->inscritoModel->estaInscrito($inscricoes_id,$userId);   
          echo json_encode($json_ret); 
          //return $this->inscritoModel->estaInscrito($inscricoes_id,$userId);
        }



        
        
        
        
}