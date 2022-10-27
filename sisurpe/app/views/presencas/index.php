<?php require APPROOT . '/views/inc/header.php';?>

<?php flash('message');?>

<div class="row align-items-center mb-3">
  <div class="col-md-12">
    <h2>Dados do Curso</h2> 
    <h6><b>Nome:</b> <?php echo $data['curso']->nome_curso;?></h6>   
    <h6><b>Descrição:</b> <?php echo $data['curso']->descricao;?></h6>            
           

      <?php // var_dump($data);?>


      <form action="<?php echo URLROOT; ?>/presencas/add" method="post" enctype="multipart/form-data">   
        <input type="hidden" id="inscricoes_id" name="inscricoes_id" value="<?php echo $data['curso']->id;?>"> 
            
          <div class="form-row">
            
              <!--CARGA HORÁRIA-->
              <div class="form-group col-md-2">
                  <label for="carga_horaria"><sup class="obrigatorio">*</sup> Carga Horária:</label>  
                  <input 
                      class="form-control <?php echo (!empty($data['carga_horaria_err'])) ? 'is-invalid' : ''; ?>"
                      type="text" 
                      name="carga_horaria"
                      id="carga_horaria"
                      value="<?php echo $data['carga_horaria']; ?>"                       
                      placeholder="Carga Horária"
                  >
                  <div class="invalid-feedback">
                      <?php echo $data['carga_horaria_err']; ?>
                  </div>                   
              </div>   

          </div><!-- row --> 
            
          <button type="submit" class="btn btn-primary">Abrir Presença</button> 
      </form>

  </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3--> 
 


<?php require APPROOT . '/views/inc/footer.php'; ?>

