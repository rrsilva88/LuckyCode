<aside id="painel-acoes">
    <ul>
        <li><a href="{$dwoo.session.sys.base_url}pedido" class="pedido {$dwoo.session.sys.page_pedido}" >Pedido</a></li>
        <li><a href="quem_somos" class="quem-somos   {$dwoo.session.sys.page_quemsomos}">Quem Somos</a></li>
        <li><a href="midia"  class="midia  {$dwoo.session.sys.page_midia}">Mídia</a></li>
        <li><a href="http://vaimoto.zendesk.com/" target='_blank' class="faq  {$dwoo.session.sys.page_faq}">FAQ</a></li>
        <li id='minha_conta'  {if !$dwoo.session.user.id_user}style="display:none;"{/if}><a href="{$dwoo.session.sys.base_url}pedido/minha_conta" class="minha-conta  {$dwoo.session.sys.page_minhaconta}">Minha Conta</a></li>
        <li id='facebook'><a href="http://www.facebook.com.br/vaimoto" class="facebook  ativo" target="_blank"  title="Acesse o facebook"></a></li>
        
    </ul>
</aside>