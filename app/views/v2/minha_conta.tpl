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
                        <h1>Meu Pedido</h1>
                    </header>
                    <div class="controle">
                        <a href="{$dwoo.session.sys.base_url}" class="submit novo-pedido"  style='cursor:pointer;'>Novo pedido</a>
                        <div class="extra">
                            <span class="nome">Olá, {$dwoo.session.user.nome}</span> <!--a href="#" class="submit editar-meus-dados">Editar meus dados</a--> <a id='sair' onclick="sair()" class="submit sair" style='cursor:pointer;'>Sair</a>
                        </div>
                    </div>
                    <div class="caixa">
                        <ul class="pedidos">
                          {if $dwoo.session.historico}
                        {foreach $dwoo.session.historico pedido}
                    
                        {if $pedido.pedido_status == 1}
                            {$status_pedido = 'Em Andamento'}
                            
                        {elseif $pedido.pedido_status == 2}
                            {$status_pedido = 'Entregando'}
                            
                        {elseif $pedido.pedido_status == 3}
                            {$status_pedido = 'Entregue'} 
                            
                        {elseif $pedido.pedido_status == 4}
                            {$status_pedido = 'Cancelado'} 
                        {else}
                                {$status_pedido = 'Em Andamento'}
                        {/if}
                            <li>
                                <time datetime="{$pedido.datetime}">{$pedido.data}  - {$status_pedido}</time>
                                <h3>{$pedido.nome}</h3>
                                <span class="preco">R$ {$pedido.valor_pedido}</span>
                                <span class="separador"></span>
                                <address class="saindo">
                                    {$pedido.remetente_endereco}, {$pedido.remetente_numero} <br>
                                    {$pedido.remetente_bairro}
                                </address>
                                <address class="entregando">
                                   {$pedido.destinatario_endereco}, {$pedido.destinatario_numero}<br>
                                   {$pedido.destinatario_bairro}
                                </address>
                            </li>
                         {/foreach}   
                            
                           
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <footer class="rodape-principal">
                        <span class="copyright">
                            2014 © VaiMoto
                        </span>
                        <a href="#" target="_blank" class="facebook" title="Acesse o facebook">Facebook</a>
                    </footer>
                </div>
            </div>
        </section>
   
   
</main>



{include('../footer.tpl')}
