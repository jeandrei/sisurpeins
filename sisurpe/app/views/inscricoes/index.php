<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>

<hr>
<div class="p-3 text-center">
  <h2><?php echo $data['title'];?></h2>
</div>
<hr>


 
<?php  //var_dump($data);?>


<!-- SE FOR UM USUÁRIO ADMIN OU SEC ADICIONO O BOTÃO CRIAR INSCRIÇÃO -->
<?php if((isset($_SESSION[DB_NAME . '_user_type']))&&((($_SESSION[DB_NAME . '_user_type']) == "admin")||(($_SESSION[DB_NAME . '_user_type']) == "sec"))) : ?>
  
  <div class="row mb-3">  
    <div class="col-md-12">
        <a href="<?php echo URLROOT; ?>/inscricoes/add" class="btn btn-primary pull-right ml-2">
            <i class="fa fa-pencil"></i> Criar uma Inscrição
        </a>
    
        <a href="<?php echo URLROOT; ?>/inscricoes/arquivadas" class="btn btn-secondary pull-right">
            <i class="fa fa-folder ml-2"></i> Arquivadas
        </a>
    </div>
</div> 

<?php endif; ?>







<?php

// Caso ainda não tenham registros de aluno para o usuário
if(empty($data['inscricoes'])){ 
  $data = ['error' => "No momento não temos nenhuma inscrição em aberto"]; 
}

if(isset($data['error'])){ 
  die($data['error']);
} 

?> 

               
<?php foreach ($data['inscricoes'] as $registro): ?>
  <!-- CARD -->
  <div class="card text-center mb-3">
    
    <!-- CARD HEADER -->
    <div class="card-header">
     
    <!-- SE FOR UM USUÁRIO ADMIN OU SEC ADICIONO O BOTÃO EDITAR -->
    <?php if((isset($_SESSION[DB_NAME . '_user_type']))&&((($_SESSION[DB_NAME . '_user_type']) == "admin")||(($_SESSION[DB_NAME . '_user_type']) == "sec"))) : ?>
      <div class="row">
        <div class="col-10">
        <?php echo($registro->nome_curso);?> 
        </div>
        
        <div class="col-2 text-right">

              
        <?php if($this->abrePresencaModel->temPresencaEmAndamento($registro->id)) : ?>
          <span class="badge bg-secondary">P</span></h6>
        <?endif;?>
         
        <?php if($registro->fase == 'FECHADO') : ?>
          <a href="<?php echo URLROOT; ?>/abrepresencas/index/<?php echo $registro->id?>" class="edit card-link">
            <i class="fa fa-check"></i>
          </a> 
        <?php endif;?>

          <a href="<?php echo URLROOT; ?>/inscricoes/edit/<?php echo $registro->id?>" class="edit card-link">
            <i class="fa fa-pencil"></i>
          </a> 

        </div>

        
      </div>
    <?php else : ?>
      <!-- CASO CONTRÁRIO IMPRIMO SÓ O TÍTULO DO CURSO -->
      <?php echo($registro->nome_curso);?>
    <?php endif; ?>

     

    </div>
    
    <!-- CARD HEADER -->

    <!-- CARD BODY -->
    <div class="card-body">
      <h5 class="card-title"><?php echo($registro->descricao);?></h5>     
     

        <!-- FASE -->
        <!-- função retornaFase está lá em funções retorna a fase e a classe -->     
        <span class="text-center <?php echo(retornaClasseFase($registro->fase));?>">Fase: <?php echo($registro->fase);?></span>  

        <!-- PERIODO -->
        <p class="card-text"><?php echo('Período: ' . formatadata($registro->data_inicio) . ' a '. formatadata($registro->data_termino));?></p>

        <!-- SE FASE ABERTO FOR HABILITAMOS O BOTÃO INSCREVER-SE -->
        <?php if($registro->fase == 'ABERTO') : ?>

            <?php if(!$this->inscritoModel->estaInscrito($registro->id,$_SESSION[DB_NAME . '_user_id'])) : ?>
              <a href="<?php echo URLROOT; ?>/inscricoes/inscrever/<?php echo $registro->id?>" class="btn btn-primary">Inscrever-se</a>
            <?php else: ?>
            <a href="<?php echo URLROOT; ?>/inscricoes/cancelar/<?php echo $registro->id?>" class="btn btn-warning">Cancelar Inscrição</a>
            <?php endif; ?>  


        <?php endif; ?>


        <!-- SE A FASE FOR CERTIFICADO -->
        <?php if($registro->fase == 'CERTIFICADO') : ?>
            <!-- SE O USUÁRIO ESTIVER INSCRITO NO CURSO IMPRIMIMOS O BOTÃO CERTIFICADO -->
            <?php if($this->inscritoModel->estaInscrito($registro->id,$_SESSION[DB_NAME . '_user_id'])) : ?>
              <a href="<?php echo URLROOT; ?>/inscricoes/certificado/<?php echo $registro->id?>" class="btn btn-success">Certificado Disponível</a>           
            <?php endif; ?>  


        <?php endif; ?>


        

    </div>
    <!-- CARD BODY -->

    <!-- CARD FOOTER -->
    <div class="card-footer text-muted">
      <?php echo($registro->carga_horaria);?> Horas
    </div>
    <!-- CARD FOOTER -->

  </div>
  <!-- CARD -->
<?php endforeach; ?>





<?php require APPROOT . '/views/inc/footer.php'; ?>