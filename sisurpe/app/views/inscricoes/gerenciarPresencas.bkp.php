<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('mensagem');?>

<div class="row d-flex flex-column">        
    
      <div id="messageBox" style="display:none"></div>
  
</div>


<!-- ROW PRINCIPAL -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gy-2">
  <!-- COL 1 -->
  <div class="col-4">  
    NOME
  </div>
  <!-- COL 1 -->
  <!-- COL 1 -->
  <div class="col-4">  
    CPF
  </div>
  <!-- COL 1 -->
  <!-- COL 1 -->
  <div class="col-4"> 
   PRESENTE    
  </div>
  <!-- COL 1 -->
</div>
<!-- ROW PRINCIPAL -->

<?php foreach($data['inscritos'] as $row) : ?>
<hr>
<!-- ROW PRINCIPAL -->
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 gy-2">
  <!-- COL 1 -->
  <div class="col-4">  
    <?php echo $row->name; ?>
  </div>
  <!-- COL 1 -->
  <!-- COL 1 -->
  <div class="col-4">  
    <?php echo $row->cpf; ?>
  </div>
  <!-- COL 1 -->
  <!-- COL 1 -->
  <div class="col-4"> 
    <div class="form-check form-switch form-check-inline">
        <input 
            id="mobilhado" 
            name="mobilhado" 
            type="checkbox" 
            class="form-check-input" 
            value="<?php echo $row->user_id;?>"
            onChange="atualizaPresenca(<?php echo $row->user_id;?>,this)"
            <?php echo ($this->presencaModel->presente($data['abrePresencaId'],$row->user_id)) ? "checked" : "";?>

        >        
    </div> 
    
  </div>
  <!-- COL 1 -->
</div>
<!-- ROW PRINCIPAL -->

<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script> 


  function atualizaPresenca(user_id,val){       
    $.ajax({  
        url: `<?php echo URLROOT; ?>/presencas/update`,                
        method:'POST',                 
        data:{
          abre_presenca_id:<?php echo ($data['abrePresencaId']) ? $data['abrePresencaId'] : 'NULL' ;?>,                   
          user_id:user_id,
          presenca:val.checked                                       
        },         
        success: function(retorno_php){                    
          var responseObj = JSON.parse(retorno_php);   
          createNotification(responseObj['message'], responseObj['class']);
        }
    });//Fecha o ajax 

   
}

</script>