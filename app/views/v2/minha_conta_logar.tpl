{include('../header.tpl')}
<script type="text/javascript">
 
    function sair(){
      
              $.post("User/Sair",
              function(data){
                  if(data.status == true){
                     generateNoty('success','Logout efetuado com sucesso!','topRight');
                     window.location.href = '{$dwoo.session.sys.base_url}'; 
                  }
                  
              }, "json");
      }
    
     
$(function() {  
      $("#painel-motoboy").remove();
      
});
    

</script>

<div id="fb-root"></div>
<header id="main-header">
    <h1 title="VaiMoto">VaiMoto - Logística Urbana</h1>
</header>
<main id="main">
   {include ('menu.tpl')}
   <section id="secao" class="mostrar">
            <div id="conteudo-minha-conta" class="conteudo com-scroll">
                <div class="wrapper">
                    <header class="header">
                        <h1>Você precisa estar logado para acessar essa pagina!</h1>
                    </header> 
                </div>
                <div class="controle">
                        <a href="{$dwoo.session.sys.base_url}" class="submit novo-pedido"  style='cursor:pointer;'>Fazer Login</a>
                </div>
                <br>
                <center>
                    <h1>Você precisa estar logado para acessar essa pagina! </h1>
                </center>
            </div>
        </section>
   
   
</main>



{include('../footer.tpl')}
