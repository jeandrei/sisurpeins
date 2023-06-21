<?php 
    class Adminusers extends Controller{

        public function __construct(){
            //vai procurar na pasta model um arquivo chamado User.php e incluir
            $this->userModel = $this->model('User');
        }     

    public function index(){ 

        if((!isLoggedIn())){ 
            flash('message', 'Você deve efetuar o login para ter acesso a esta página', 'error'); 
            redirect('pages/index');
            die();
        } else if ((!isAdmin()) && (!isSec())){                
            flash('message', 'Você não tem permissão de acesso a esta página', 'error'); 
            redirect('pages/index'); 
            die();
        }  
        
        $limit = 10;
        $data = [
            'title' => 'Busca por Usuários',
            'description' => 'Busca por registros de Usuários'          
        ]; 

        // INÍCIO PARTE PAGINAÇÃO SÓ COPIAR ESSA PARTE MUDAR A URL E COLOCAR OS PARAMETROS EM named_params
        // O STATUS EU NÃO PASSO PARA O A CONSULTA É APENAS PARA MANTER AS INFORMAÇÕES APÓS CLICAR NO LINK DA PAGINAÇÃO
        // CASO CONTRÁRIO TODA VEZ QUE CLICASSE NO LINK DA PAGINAÇÃO ELE VOLTA PARA O VALOR PADRÃO DO CAMPO DE BUSCA
        if(isset($_GET['page']))  
        {  
            $page = $_GET['page'];  
        }  
            else  
        {  
            $page = 1;  
        }  
                  
        $options = array(
          'results_per_page' => 10,
          'url' => URLROOT . '/adminusers/index.php?page=*VAR*&name=' . $_GET['name'] . '&type=' . $_GET['usertype'],
          'named_params' => array(
                                    ':name' => $_GET['name'],
                                    ':type' => $_GET['usertype']
                                )     
        );
      
        $paginate = $this->userModel->getUsers($page, $options); 
              
        if($paginate->success == true) 
        {            
            // $data['paginate'] é só a parte da paginação tem que passar os dois arraya paginate e result
            $data['paginate'] = $paginate;
            // $result são os dados propriamente dito depois eu fasso um foreach para passar
            // os valores como posição que utilizo um métido para pegar
            $results = $paginate->resultset->fetchAll();  
        }   
      
        $data['results'] =  $results;        
        //FIM PARTE PAGINAÇÃO RETORNANDO O ARRAY $data['paginate']  QUE VAI PARA A VARIÁVEL $paginate DO VIEW NESSE CASO O INDEX
        
      
        $this->view('adminusers/index', $data);
    }   
}   
?>