<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>


<h1><?php echo $data['title']; ?></h1>
<p><?php echo $data['description']; ?></p>

<?php
  $paginate = $data['paginate'];
  $result = $data['results'];  
?>


<form id="filtrar" action="<?php echo URLROOT; ?>/adminusers/index" method="get" enctype="multipart/form-data">
  <div class="row">
    
    <!-- COLUNA 1 name-->
    <div class="col-lg-4">
        <label for="name">
            Buscar por name
        </label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            maxlength="60"
            class="form-control"
            value="<?php if(isset($_GET['name'])){htmlout($_GET['name']);} ?>"
            onkeydown="upperCaseF(this)"   
            >
    </div>
    <!-- COLUNA 1 name-->

     <!-- TIPO DO USUÁRIO -->  
     <div class="col-lg-2">
            <label for="usertype">
                Buscar tipo
            </label>
            <select class="form-control"
              name="usertype" 
              id="usertype" 
              class="form-control" 
              >
              <option value='NULL'>todos</option>                   
              <?php              
              $tipos = array('admin','sec','user');                    
              foreach($tipos as $tipo => $value) : ?> 
                  <option value="<?php echo $value; ?>" 
                              <?php echo $value == $_GET['usertype'] ? 'selected':'';?>
                  >
                      <?php echo $value;?>
                  </option>
              <?php endforeach; ?>  
          </select>
    </div>
    <!-- TIPO DO USUÁRIO -->                
      
      
    <!-- LINHA PARA O BOTÃO ATUALIZAR -->
    <div class="row" style="margin-top:30px;">
        <div class="col" style="padding-left:0;">
            <div class="form-group mx-sm-3 mb-2">
                <input type="submit" class="btn btn-primary mb-2" value="Atualizar">    
            </div>                                                
        </div>  
    </div> 
    <!-- FIM LINHA BOTÃO ATUALIZAR -->     
            

  <!--div class="row"-->
  </div>

</form>

<br>

<!-- MONTAR A TABELA -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nome</th>      
      <th scope="col">Email</th>           
      <th scope="col">Criado em</th> 
      <th scope="col">Tipo</th>
      <th scope="col" >Ações</th> 
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row) : ?> 
            <tr>   
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                      <td><?php echo $row['type']; ?></td>                     
                      <!--BTN EDITAR-->            
                      <td style="text-align:right;">
                          <a class="btn btn-success btn-sm fa fa-pencil" href="<?php echo URLROOT; ?>/users/edit/<?php echo $row['id'];?>" class="pull-left"> Editar</a>                          
                      
                          <a class="btn bg-warning btn-sm fa fa-share" href="<?php echo URLROOT; ?>/inscricoes/inscreverUsuario/<?php echo $row['id'];?>" class="pull-left"> Inscrever</a>                          
                      </td>
            </tr>
    <?php endforeach; ?>    
  </tbody>
</table>
<?php  

    /*
     * Echo out the UL with the page links
     */
    echo '<p>'.$paginate->links_html.'</p>';

    /*
     * Echo out the total number of results
     */
    echo '<p style="clear: left; padding-top: 10px;">Total de rows: '.$paginate->total_results.'</p>';

    /*
     * Echo out the total number of pages
     */
    echo '<p>Total de Paginas: '.$paginate->total_pages.'</p>';

    echo '<p style="clear: left; padding-top: 10px; padding-bottom: 10px;">-----------------------------------</p>';
  
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>