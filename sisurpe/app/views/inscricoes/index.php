<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>

<div class="alert alert-info p-3" role="alert">
  <?php echo $data['title'];?>
</div>
 
<?php // var_dump($data);?>

 

<?php

// Caso ainda não tenham registros de aluno para o usuário
if(empty($data)){ 
  $data = ['error' => "No momento não temos nenhuma inscrição em aberto"]; 
}

if(isset($data['error'])){ 
  die($data['error']);
} 

?> 

               
<?php foreach ($data['inscricoes'] as $registro): ?>
 
<div class="card text-center mb-3">
    <div class="card-header">
      <?php echo($registro->nome_curso);?>
    </div>
    <div class="card-body">
      <h5 class="card-title"><?php echo($registro->descricao);?></h5>
      <p class="card-text"><?php echo('Período: ' . formatadata($registro->data_inicio) . ' a '. formatadata($registro->data_termino));?></p>
      <a href="<?php echo URLROOT; ?>/inscricoes/gravar/<?php echo $registro->id?>" class="btn btn-primary">Se Inscrever</a>
    </div>
    <div class="card-footer text-muted">
      <?php echo($registro->carga_horaria);?>Horas
    </div>
  </div>      
<?php endforeach; ?>





<?php require APPROOT . '/views/inc/footer.php'; ?>