<?php require APPROOT . '/views/inc/header.php';?>

<?php flash('mensagem');?>

 <div class="row align-items-center mb-3">
    <div class="col-md-12">
        <h2>Dados do Curso</h2>        
           

        <?php  //var_dump($data);?>


        <form action="<?php echo URLROOT; ?>/inscricoes/add" method="post" enctype="multipart/form-data">        

            <!--NOME-->
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nome_aluno"><sup class="obrigatorio">*</sup> Nome do Curso:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['nome_curso_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="nome_curso"
                        id="nome_curso"
                        value="<?php echo $data['nome_curso']; ?>"                       
                        placeholder="Nome do curso"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['nome_curso_err']; ?>
                    </div>                   
                </div>
            </div> 


            

            <!-- DESCRIÇÃO DO CURSO -->
            <div class="form-group">
              <label for="descricao">Descrição do curso</label>
              <textarea 
                class="form-control <?php echo (!empty($data['nome_curso_err'])) ? 'is-invalid' : ''; ?>" 
                id="descricao" 
                name="descricao"
                rows="3"><?php echo $data['descricao']; ?></textarea>
                <div class="invalid-feedback">
                    <?php echo $data['descricao_err']; ?>
                </div>  
            </div>


            <!--CARGA HORÁRIA-->
            <div class="form-row">
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
            </div>                                 
            
            
                              
            <legend>Período do Curso</legend>
            <fieldset>
              <!--PERÍODO-->
              <div class="form-row">
                  
                  <div class="form-group col-md-2">
                      <label for="data_inicio"><sup class="obrigatorio">*</sup>Início</label>
                      <input 
                        class="form-control <?php echo (!empty($data['data_inicio_err'])) ? 'is-invalid' : ''; ?>"
                        type="date"  
                        id="data_inicio"
                        name="data_inicio"
                        value="<?php echo $data['data_inicio']; ?>"
                      > 
                      <div class="invalid-feedback">
                          <?php echo $data['data_inicio_err']; ?>
                      </div>  
                  </div>

                  <div class="form-group col-md-2">
                      <label for="data_termino"><sup class="obrigatorio">*</sup>Fim</label>
                      <input 
                        class="form-control <?php echo (!empty($data['data_termino_err'])) ? 'is-invalid' : ''; ?>"
                        type="date"  
                        id="data_termino"
                        name="data_termino"
                        value="<?php echo $data['data_termino']; ?>"
                      > 
                      <div class="invalid-feedback">
                          <?php echo $data['data_termino_err']; ?>
                      </div>  
                  </div>

              </div>  
            <fieldset>

            <legend>Fase do Curso</legend>
            <fieldset>
              <!-- FASE -->          
              <div class="form-row">    
                  <div class="form-group col-md-4">                      
                      <select 
                          name="fase" 
                          id="fase" 
                          class="form-control <?php echo (!empty($data['fase_err'])) ? 'is-invalid' : ''; ?>"                                       
                      >
                          <option value="">Selecione a fase atual do curso</option>
                          <option value="A" <?php echo $data['fase'] == 'A' ? 'selected':'';?>>Aberto</option>
                          <option value="F" <?php echo $data['fase'] == 'F' ? 'selected':'';?>>Fechado</option>  
                          <option value="C" <?php echo $data['fase'] == 'C' ? 'selected':'';?>>Certificado Liberado</option>    
                          <option value="AR" <?php echo $data['fase'] == 'AR' ? 'selected':'';?>>Arquivado</option>                                                                                                               
                                  
                      </select>                                           
                      <span class="text-danger">
                              <?php echo $data['fase_err'];?>
                      </span>
                  </div>
              </div>            
              <!-- FASE -->
            </fieldset>
            
                       
            <?php if($this->inscricaoModel->inscricaoEditavel($data['inscricao_id'])) : ?>
                <button type="submit" class="btn btn-success">Adicionar tema</button>            
            <?php endif; ?>

            
            <?php if($data['inscricao_id'] == NULL) : ?>
                <button type="submit" class="btn btn-primary">Gravar</button>         
            <?php else: ?>
                <button type="submit" class="btn btn-warning">Atualizar</button>
            <?php endif; ?>
            
        </form>

    </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3-->    
<?php require APPROOT . '/views/inc/footer.php'; ?>

