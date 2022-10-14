<?php 
    class Temas extends Controller{
        public function __construct(){            
          $this->inscricaoModel = $this->model('Inscricoe');
          $this->temaModel = $this->model('Tema');
        }
        
        
        public function add($inscricoes_id){
             $data=[
                'inscricoes_id' => $inscricoes_id,
                'tema'=>$_POST['tema'],
                'carga_horaria'=>$_POST['carga_horaria'],
                'formador'=>$_POST['formador']                
            ];
            

            $error=[];

            //valida pessoaNome
            if(empty($data['tema'])){
                $error['tema_err'] = 'Por favor informe o tema!';
            }
                       


            if(
                empty($error['tema_err']) 
              )
            {
                //Se não teve nenhum erro grava os dados
                try{

                    if($this->temaModel->register($data)){
                        //para acessar esses valores no jquery
                        //exemplo responseObj.message
                        $json_ret = array(
                                            'classe'=>'alert alert-success', 
                                            'message'=>'Dados gravados com sucesso',
                                            'error'=>false
                                        );                     
                        
                        echo json_encode($json_ret); 
                    }     
                } catch (Exception $e) {
                    $json_ret = array(
                            'classe'=>'alert alert-danger', 
                            'message'=>'Erro ao gravar os dados',
                            'error'=>$data
                            );                     
                    echo json_encode($json_ret); 
                }


                
            }   else {
                $json_ret = array(
                    'classe'=>'alert alert-danger', 
                    'message'=>'Erro ao tentar gravar os dados',
                    'error'=>$error
                );
                echo json_encode($json_ret);
            } 



            


           

                                
        }
       
    }
?>