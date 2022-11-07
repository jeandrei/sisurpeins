<?php 
    class Relatorios extends Controller{
        public function __construct(){            
          $this->relatoriosModel = $this->model('Relatorio'); 
          $this->inscritoModel = $this->model('Inscrito');         
          $this->inscricoesModel = $this->model('Inscricoe');  
          $this->presencaModel = $this->model('Presenca'); 
          $this->userModel = $this->model('User');
          $this->temaModel = $this->model('Tema');
        }


        public function inscritos($inscricoes_id){
         $data['inscritos'] = $this->inscritoModel->getInscritos($inscricoes_id);         
         $data['curso'] = $this->inscricoesModel->getInscricaoById($inscricoes_id);
         $this->view('relatorios/inscritos',$data);
          
        }

        public function presentes($inscricoes_id){
          $data['presentes'] = $this->presencaModel->getPresencas($inscricoes_id);
          $data['curso'] = $this->inscricoesModel->getInscricaoById($inscricoes_id);
          $this->view('relatorios/presentes',$data);           
        }

        
       
       
    }
?>