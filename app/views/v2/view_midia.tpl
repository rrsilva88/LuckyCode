{include('../header.tpl')}
<div id="fb-root"></div>
<header id="main-header">
    <h1 title="VaiMoto">VaiMoto - Logística Urbana</h1>
</header>
<main id="main">
   {include ('menu.tpl')}
   <section id="secao" class="mostrar">
            <div id="conteudo-midia" class="conteudo com-scroll">
                <div class="wrapper">
                    <header class="header">
                        <h1>VaiMoto na Mídia</h1>
                    </header>
                    <div class="caixa">
                        <div class="artigo-topo"></div>
                        <article class="artigo">
                        {if $noticia.id_noticia}
                            <time datetime="{$noticia.data}">{$noticia.data_formatada}</time>
                            <header>
                                <h2>{$noticia.titulo}</h2>
                                <small class="fonte">{$noticia.subtitulo}</small>
                                <div class="clear"></div>
                            </header>
                            <div class="descricao">
                                <p>
                                    {$noticia.chamada}
                                </p>
                                <br />
                                {$noticia.content_html}
                                
                                
                            </div>
                            <footer>
                                <a href="{$dwoo.session.sys.base_url}midia/" class="ler-mais submit">Voltar</a>

                                <div class="social">
                                    <div class="fb-like" data-href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="false"></div>
                                    
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-text='{$noticia.titulo}' data-url='{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}' data-lang="pt-BR" data-via="VaiMoto"  data-hashtags="vaimoto,vaimotonamidia">Tweet</a>
                                    <div class="g-plusone" data-size="medium" data-href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}"></div>
                                </div>
                            </footer>
                             {else}
                             
                              <header>
                                <h2>Opsss...</h2>
                                <small class="fonte">Não existe essa notícia!</small>
                                <div class="clear"></div>
                            </header>
                             <div class="descricao">
                                <p>
                                  Acesse nossa pagina <b><u><a href='{$dwoo.session.sys.base_url}midia/'>Mídia</a></u></b> ou clique no botão voltar!
                                </p>
                                <br />
                                <p>
                                Obrigado,<br />
                                <b>Equipe VaiMoto</b>
                                </p>
                                <br />
                            </div>
                            <footer>
                                <a href="{$dwoo.session.sys.base_url}midia/" class="ler-mais submit">Voltar</a>
                            </footer>
                            
                            
                            
                            
                            {/if}
                            
                        </article>
                        
                       
                    </div>
                    <footer class="rodape-principal">
                        <span class="copyright">
                            2014 © VaiMoto
                        </span>
                        <a href="https://www.facebook.com/vaimoto" target="_blank" class="facebook" title="Acesse o facebook">Facebook</a>
                    </footer>
                </div>
            </div>
        </section>     
</main>



{include('../footer.tpl')}


