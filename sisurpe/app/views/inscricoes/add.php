<?php require APPROOT . '/views/inc/header.php';?>

<?php flash('mensagem');?>

 <div class="row align-items-center mb-3">
    <div class="col-md-12">
        <h2>Dados do Curso</h2>        
           

        <?php  var_dump($data);?>


        <form action="<?php echo URLROOT; ?>/inscricoes/add" method="post" enctype="multipart/form-data">   
            <input type="hidden" id="inscricoes_id" name="inscricoes_id" value="<?php echo $data['inscricoes_id'];?>">     

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
            
                       
            <?php if($data['editavel']) : ?>
                <!-- Button trigger modal -->
                <button type="button" id="addTema" class="btn btn-primary" data-toggle="modal" data-target="#addTemaModal">
                Adicionar Tema
                </button>           
            <?php endif; ?>

            
            <?php if($data['inscricoes_id'] == NULL) : ?>
                <button type="submit" class="btn btn-primary">Gravar</button>         
            <?php else: ?>
                <button type="submit" class="btn btn-warning">Atualizar</button>
            <?php endif; ?>
            
        </form>

    </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3--> 


<!-- fazer o foreach imprimindo os temas -->
<?php var_dump($data['temas']);?>






<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addTemaModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Adicionar Tema</h5>        
      </div>
      
      <form method="post" enctype="multipart/form-data"> 
        <!-- MODAL -->
        <div class="modal-body"> 
            
            <!--TEMA-->
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nome_aluno"><sup class="obrigatorio">*</sup> Tema:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['tema_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="tema"
                        id="tema"
                        value="<?php echo $data['tema_curso']; ?>"                       
                        placeholder="Informe o tema"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['tema_err']; ?>
                    </div>                   
                </div>
            </div> 
            <!--TEMA-->

            <!--CARGA HORÁRIA-->
            <div class="form-row">
              <div class="form-group col-md-2">
                  <label for="carga_horaria"><sup class="obrigatorio">*</sup> Carga Horária:</label>  
                  <input 
                      class="form-control <?php echo (!empty($data['carga_horaria_tema_err'])) ? 'is-invalid' : ''; ?>"
                      type="text" 
                      name="carga_horaria_tema"
                      id="carga_horaria_tema"
                      value="<?php echo $data['carga_horaria_tema']; ?>"                       
                      placeholder="Carga Horária"
                  >
                  <div class="invalid-feedback">
                      <?php echo $data['carga_horaria_tema_err']; ?>
                  </div>                   
              </div>
            </div>                        
            <!--CARGA HORÁRIA-->


            <!--FORMADOR-->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome_aluno"><sup class="obrigatorio">*</sup> Formador:</label>  
                    <input 
                        class="form-control <?php echo (!empty($data['formador_err'])) ? 'is-invalid' : ''; ?>"
                        type="text" 
                        name="formador"
                        id="formador"
                        value="<?php echo $data['formador']; ?>"                       
                        placeholder="Informe o formador"
                    >
                    <div class="invalid-feedback">
                        <?php echo $data['formador_err']; ?>
                    </div>                   
                </div>
            </div> 
            <!--NOME-->
        </div>
        <!-- FIM MODAL -->

        <!-- BOTÕES -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary gravar" data-dismiss="modal" disabled>Gravar</button>
        </div>
        <!-- FIM BOTÕES -->

      </form>
    
    
    </div>
  </div>
</div>

<script>
    $( document ).ready(function() {    
        $('.gravar').click(function() {
            //Pego os valores dos inputs            
            let tema=$("#tema").val();  
            let carga_horaria=$("#carga_horaria_tema").val(); 
            let formador=$("#formador").val();
            
            $.ajax({
                /* aqui em url passamos a url do controler e o método que iremos utilizar nesse caso ajaxs/gravar */
                
                url: '<?php echo URLROOT; ?>/temas/add/<?php echo $data['inscricoes_id']; ?>',
                /* aqui o método que utilizamos nesse caso POST */
                method:'POST', 
                //Aqui passamos os dados que queremos através do POST para o controller/método
                data:{                    
                    tema:tema,
                    carga_horaria:carga_horaria,
                    formador:formador                    
                },                                                   
                /* em retorno_php sempre receberemos o que for passado na linha lá do controller
                em  echo json_encode($json_ret);
                que sempre vai ser um array similar a este:
                {"classe":"alert alert-success","mensagem":"Dados gravados com sucesso"}
                O que a linha JSON.parse(retorno_php) faz é possibilitar o acesso aos valores como:
                responseObj.classe e responseObj.mensagem
                  */                   
                success: function(retorno_php){                     
                    var responseObj = JSON.parse(retorno_php);
                    window.location.reload();  
                    //console.log(responseObj.error);
                    
                                       
                    //se o status for true quer dizer que a validação passou
                    //se for false a validação falhou
                    if(responseObj.error!==false){                                              
                        /**
                        IMPORTANTE TEM QUE TER ID NO SPAN PARA FUNCIONAR
                        aqui key traz a chave exemplo pessoaNome_err
                        e value traz o erro exemplo Por favor informe o nome
                        então na linha  $("#"+key) ele monta $("#pessoaNome_err")
                        para cada erro que tiver no array responseObj.error que vem
                        do controller
                        */ 
                        for (let [key, value] of entries(responseObj.error)) {                            
                            $("#"+key) 
                                .addClass("text-danger")
                                .html(value)  
                                .fadeIn(4000).fadeOut(4000)                                                                            
                        }
                    }                   
                    
                    
                    //aqui o exemplo de como seria sem o for
                    /* if(responseObj.error.pessoaNome_err){                        
                        $("#pessoaNome_err")
                            .addClass("text-danger")
                            .html(responseObj.error.pessoaNome_err)  
                            .fadeIn(4000).fadeOut(4000)                                
                     */

                    //#messageBox é a id da <div role="alert" id="messageBox"
                    $("#messageBox")
                        .removeClass()
                        /* aqui em addClass adiciono a classe que vem do php se sucesso ou danger */
                        /* pode adicionar mais classes se precisar ficaria assim .addClass("confirmbox "+responseObj.classe) */
                        .addClass(responseObj.classe) 
                        /* aqui a mensagem que vem la do php responseObj.mensagem */                       
                        .html(responseObj.message) 
                        .fadeIn(2000).fadeOut(2000);
                }
            });//Fecha o ajax
        });//Fecha o .gravar click
    });//Fecha document ready function



    //Função necessária para rodar esse for  for (let [key, value] of entries(responseObj.error)) {
    function* entries(obj) {
        for (let key of Object.keys(obj)) {
            yield [key, obj[key]];
        }
    }

    document.getElementById('tema').addEventListener('keyup', validate);
    document.getElementById('carga_horaria_tema').addEventListener('keyup', validate);
    document.getElementById('formador').addEventListener('keyup', validate);

    
   

    function isEmpty(val){    
        switch (val){
        case '':
            return true;
            break;
        case null:
            return true;
            break;
        default:
            return false;
        }
    }


    function validate(){
  
        if(
            validateTema() &&
            validateCargaHoraria() &&
            validateFormador() 
          )
            {  
                document.querySelector('.gravar').disabled = false;    
            } else {
                document.querySelector('.gravar').disabled = true;
            }
    
    }

    function validateTema(){
        const tema = document.getElementById('tema');        
        if(!isEmpty(tema.value)){ 
            const re = /^([a-zA-Zà-úÀ-Ú0-9_ ]|-|_|\s){2,255}$/;
            if(!re.test(tema.value)){
                tema.classList.add('is-invalid');
                return false;
            } else {
                tema.classList.remove('is-invalid');
                return true;
            }
        }
    }

    function validateCargaHoraria(){
        const ch = document.getElementById('carga_horaria_tema');        
        if(!isEmpty(ch.value)){            
            const re = /^[0-9]*$/;
            if(!re.test(ch.value)){
                ch.classList.add('is-invalid');
                return false;
            } else {
                ch.classList.remove('is-invalid');
                return true;
            }
        }
    }

    function validateFormador(){
        const formador = document.getElementById('formador');        
        if(!isEmpty(formador.value)){            
            const re = /^([a-zA-Zà-úÀ-Ú0-9_ ]|-|_|\s){2,100}$/;
            if(!re.test(formador.value)){
                formador.classList.add('is-invalid');
                return false;
            } else {
                formador.classList.remove('is-invalid');
                return true;
            }
        }
    }


    function clearInput(){
        document.getElementById('tema').value = '';
        document.getElementById('formador').value = '';
        document.getElementById('carga_horaria_tema').value = '';
        //foco no primeiro item do modal
        $("#addTemaModal").on("shown.bs.modal", function(){
            $(this).find("input").first().focus()
        })
    }

    document.getElementById('addTema').addEventListener('click',clearInput);

    //document.getElementById('.gravar').addEventListener('click',clearInput);
</script>







<?php require APPROOT . '/views/inc/footer.php'; ?>

