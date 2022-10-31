<?php require APPROOT . '/views/inc/header.php';?>

<!-- LINHA PARA A MENSÁGEM DO JQUERY -->
<div class="container">
    <div class="row" style="height: 50px;  margin-bottom: 25px;">
        <div class="col-12">
            <div role="alert" id="messageBox" style="display:none"></div>
        </div>
    </div>
</div>


<div class="row align-items-center mb-3">
  <div class="col-md-12">
           

      <?php //var_dump($data); ?>

      

      <section class="h-100">
        <header class="container h-100">
          <div class="d-flex align-items-center justify-content-center h-100">
            <div class="d-flex flex-column">
              <h1 class="text align-self-center p-2">Registro de Frequência</h1>          

              <div class="text align-self-center p-2">                 
                  <input 
                      class="form-control cpfmask"
                      type="text" 
                      name="cpf"
                      id="cpf"                                             
                      placeholder="CPF"                      
                  >
                  <div class="text-danger" id="cpf_err">
                      <?php echo $data['cpf_err']; ?>                     
                  </div>                   
              </div>   
            </div>
          </div>
        </header>
      </section>

  </div><!--col-md-12-->
</div><!--div class="row align-items-center mb-3--> 


<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>
let timer;

function delay(val){
  clearTimeout(timer);
  return new Promise((resolve)=>{
    timer = setTimeout(()=>{
      resolve(val);
    },3000)
  })
}


const searchCPF = document.getElementById("cpf");

async function Search(e){
  document.getElementById("cpf_err").innerText = '';
  const cpf = await delay(e.target.value);
  cpfValido = validacaocpf(cpf);
  
  if(!cpfValido){    
    document.getElementById("cpf_err").innerText = 'CPF Inválido!';
    return;
  }

  gravar(<?php echo $data['abre_presenca_id'];?>)
}


searchCPF.addEventListener('keyup',(e)=>{ 
  Search(e);
})


$(document).ready(function() {
  setFocus();
});

  function getUserId(cpf){
    $.ajax({
      url: `<?php echo URLROOT; ?>/users/getUsersCpf/${cpf}`,
      method:'POST',
      data:{
        cpf:cpf
      },    
      async: false,
      dataType: 'json'
    }).done(function (response){
      ret_val = response;
    }).fail(function (jqXHR, textStatus, errorThrown) {
      ret_val = null;
    });
   return ret_val;
}


function estaInscrito(user_id,inscricoes_id){
  $.ajax({
      url: `<?php echo URLROOT; ?>/inscricoes/estaInscrito`,
      method:'POST',
      data:{
        user_id:user_id,
        inscricoes_id:inscricoes_id
      },    
      async: false,
      dataType: 'json'
    }).done(function (response){
      ret_val = response;
    }).fail(function (jqXHR, textStatus, errorThrown) {
      ret_val = null;
    });
   return ret_val;
}


function gravar(id){
    let cpfInput = document.getElementById("cpf").value;     
    /* pego o id do usuário pelo cpf */
    let user = getUserId(`${cpfInput}`);  
    
    /* verifico se o usuário está inscrito */  
    let userInscrito = estaInscrito(`${user.id}`,<?php echo $data['inscricoes_id'];?>);
        
    let erro = null;

    if(!userInscrito){
      erro = 'CPF não inscrito no curso';
    }

    if(cpfInput == ''){
      erro = 'Por favor informe seu cpf';
    }

    if(user == false){
      erro = 'CPF não cadastrado!';
    }


    if(erro != null){
      $("#messageBox")
      .removeClass()      
      .addClass('alert alert-danger')
      .html(erro)
      .fadeIn(1000).fadeOut(3000);
      return;
    }

    $.ajax({
      url: `<?php echo URLROOT; ?>/presencas/add/${id}`,
      method:'POST',
      data:{
        abre_presenca_id:id,
        user_id:user.id
      },
    success: function(retorno_php){
      let responseObj = JSON.parse(retorno_php);
      console.log(responseObj);
      $("#messageBox")
      .removeClass()
      /* aqui em addClass adiciono a classe que vem do php se sucesso ou danger */
      /* pode adicionar mais classes se precisar ficaria assim .addClass("confirmbox "+responseObj.classe) */
      .addClass(responseObj.classe) 
      /* aqui a mensagem que vem la do php responseObj.mensagem */                       
      .html(responseObj.message) 
      .fadeIn(1000).fadeOut(6000);
      }
    });
  }

  function setFocus(){
    document.getElementById("cpf").focus();
  }

  

</script>

