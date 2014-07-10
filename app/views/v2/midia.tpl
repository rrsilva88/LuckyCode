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
                    
                    
                    {foreach $noticias noticia}
                        <div class="artigo-topo"></div>
                        <article class="artigo">
                            <time datetime="{$noticia.data}">{$noticia.data_formatada}</time>
                            <header>
                                <a href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}"><h2>{$noticia.titulo}</h2></a>
                                <a href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}"><small class="fonte">{$noticia.subtitulo}</small></a>
                                <div class="clear"></div>
                            </header>
                            <div class="descricao">
                               <a href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}">
                                <p>
                                    {$noticia.chamada}
                                </p>
                                </a>
                            </div>
                            <footer>
                                <a href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}" class="ler-mais submit">Ler mais</a>

                                <div class="social">
                                    <div class="fb-like" data-href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}" data-layout="button_count" data-action="recommend" data-show-faces="true" data-share="false"></div>
                                    
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-text='{$noticia.titulo}' data-url='{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}' data-lang="pt-BR" data-via="VaiMoto"  data-hashtags="vaimoto,vaimotonamidia">Tweet</a>
                                    <div class="g-plusone" data-size="medium" data-href="{$dwoo.session.sys.base_url}midia/view/{$noticia.alias}"></div>
                                </div>
                            </footer>
                        </article>
                        
                      {/foreach}  
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


