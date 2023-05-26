<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('message');?>
   

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3"><?php echo $data['title'];?></h1>
          <p><?php echo $data['description'];?></p>
         <!--  <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-6">
            <h2>Dados Anuais dos Alunos</h2>
            <p>Se você pai e mãe têm alunos matriculados na rede municipal de ensino, realize o cadastro dos dados anuais dos seus filhos. Os dados anuais são referentes a uniforme e transporte escolar. Você também pode informar dados importantes como uso de medicamentos e restrição alimentar. </p>
            <p><a class="btn btn-secondary" href="<?php echo URLROOT; ?>/datausers/show" role="button">Dados Anuais &raquo;</a></p>
          </div>
          <div class="col-md-6">
            <h2>Inscrições</h2>
            <p>As inscrições para cursos de formação da Secretaria de Educação são disponibilizados aqui. Você pode realizar uma inscrição, cancelar e ao final do curso emitir seu certificado.   </p>
            <p><a class="btn btn-secondary" href="<?php echo URLROOT; ?>/inscricoes/index" role="button">Inscrições &raquo;</a></p>
          </div>
          <!-- <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div> -->
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

    <footer class="container">
      &copy; <?php echo date("Y"); ?>
    </footer>

   

<?php require APPROOT . '/views/inc/footer.php'; ?>