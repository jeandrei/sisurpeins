<?php 
    class Relatorios extends Controller{
        public function __construct(){            
          $this->relatoriosModel = $this->model('Relatorio'); 
          $this->inscritoModel = $this->model('Inscrito');         
          $this->inscricoesModel = $this->model('Inscricoe');  
        }


        public function inscritos($inscricoes_id){
         $data['inscritos'] = $this->inscritoModel->getInscritos($inscricoes_id);         
         $data['curso'] = $this->inscricoesModel->getInscricaoById($inscricoes_id);
         $this->view('relatorios/inscritos',$data);
          
        }
       
       
    }
?>