<?php require APPROOT . '/views/inc/header.php';?>


<?php flash('mensagem');?>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-2">
                <h2>Editar a conta</h2>
                <p>Por favor preencha os dados abaixo para se registrar</p> 
                <form action="<?php echo URLROOT; ?>/users/edit/<?php echo $data['user_id'];?>" method="post" enctype="multipart/form-data" onsubmit="return validation(
                                                                                                                                               [noempty=['name']],
                                                                                                                                           [validaradio=['moradia']]                                                                                                                                               
                                                                                                                                               )">   
                    
                    
                    <!--Nome-->
                    <div class="form-group">   
                        <label 
                            for="name"><b class="obrigatorio">* </b>Nome:
                        </label>                        
                        <input 
                            type="text" 
                            name="name" 
                            class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"                             
                            placeholder="Informe seu nome",
                            value="<?php echo $data['name'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['name_err']; ?>
                        </span>
                    </div>


                     <!--CPF-->
                     <div class="form-group">   
                        <label 
                            for="cpf"><b class="obrigatorio">* </b>CPF:
                        </label>                        
                        <input 
                            type="text" 
                            name="cpf" 
                            class="form-control form-control-lg>"   
                            value="<?php echo $data['cpf'];?>"
                            disabled
                        >                        
                    </div>


                    <!--EMAIL-->
                    <div class="form-group">   
                        <label 
                            for="email"><b class="obrigatorio">* </b>Email: 
                        </label>                        
                        <input 
                            type="text" 
                            name="email"
                            class="form-control form-control-lg"
                            value="<?php echo $data['email'];?>"
                            disabled
                        >
                    </div>
                    
                    <!-- TIPO DO USUÁRIO -->          
                    <div class="form-group"> 
                        <label 
                            for="usertype"><b class="obrigatorio">* </b>Tipo: 
                        </label>
                        <select class="form-control form-control-lg"
                            name="usertype" 
                            id="usertype" 
                            class="form-control" 
                            >                   
                            <?php 
                            $tipos = array('admin','sec','user');                    
                            foreach($tipos as $tipo => $value) : ?> 
                                <option value="<?php echo $value; ?>" 
                                            <?php echo $value == $data['usertype'] ? 'selected':'';?>
                                >
                                    <?php echo $value;?>
                                </option>
                            <?php endforeach; ?>  
                        </select>
                    </div>
                    <!-- TIPO DO USUÁRIO -->   
                   


                    <!--PASSWORD-->
                    <div class="form-group">   
                        <label 
                            for="password">Senha:
                        </label>                        
                        <input 
                            type="password" 
                            name="password" 
                            placeholder="Informe sua senha",
                            class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>"                             
                            value="<?php echo $data['password'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['password_err']; ?>
                        </span>
                    </div>

                     
                     <!--CONFIRM PASSWORD-->
                     <div class="form-group">   
                        <label 
                            for="confirm_password">Confirma Senha:
                        </label>                        
                        <input 
                            type="password" 
                            name="confirm_password" 
                            placeholder="Confirme sua senha",
                            class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>"                             
                            value="<?php echo $data['confirm_password'];?>"
                        >
                        <span class="invalid-feedback">
                            <?php echo $data['confirm_password_err']; ?>
                        </span>
                    </div>  
                    
                    <!--BUTTONS-->
                    <div class="row">
                        <div class="col">                            
                           <?php  submit('Atualizar'); ?>                           
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>   
<?php require APPROOT . '/views/inc/footer.php'; ?>
