<section class="unit three-quarters">
                
                <header class="post-header">
                    <h1 class="post-title">Últimas Notícias</h1>
                    <div class="breadcrumbs"><a href="{$dwoo.session.sys.base_url}">Home</a> <i class="delimeter"></i> Notícias</div>
                </header>
                
                <div class="posts">
                
                
                {foreach $noticias noticia}
                      <article class="post with-thumbnail" data-appear-animation="fadeIn">
                        <div class="thumbnail">
                            <a href="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}"><img src="{$dwoo.session.sys.base_url}uploads/{$noticia.foto_chamada}" alt="" width="364" height="130" /></a>
                            <a href="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}" class="thumb-hover"><span class="details">Ver mais <i class="menu-angle"></i></span></a>
                            <div class="clear"></div>
                        </div>
                        <header>
                            <h2><a href="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}">{$noticia.titulo}</a></h2>
                            <div class="data">
                                <span class="date">{$noticia.data_formatada}</span>
                            </div>
                        </header>
                        <div class="text">
                            <p>
                                {$noticia.chamada}
                            </p>
                        </div>
                                        
                        <footer>
                            <a href="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}" class="continue-reading">Ver Mais <i class="arrow-keep-reading"></i></a>
                        </footer>
                    </article>
                {/foreach}   
                    
                    
                </div>
                
                
                {if $paginacao}

                <div class="pagination">
                    <div class="numeric">
                        <a href="{$dwoo.session.sys.base_url}Noticias/" class="button dark"><<</a>
                        {if $paginacao.atual > 1}
                              <a href="{$dwoo.session.sys.base_url}Noticias/pagina/{$paginacao.atual - 1}" class="button dark">{$paginacao.atual - 1}</a> 
                        {/if}
                        {foreach $paginacao.paginas pag} 
                            <a href="{$dwoo.session.sys.base_url}Noticias/pagina/{$pag.num}" class="button {if $pag.current}{$pag.current}{else}dark{/if}">{$pag.num}</a> 
                        {/foreach}
                         <a href="{$dwoo.session.sys.base_url}Noticias/pagina/{$paginacao.total}" class="button dark">>></a>
                    </div>
                    
                </div>
                
                {/if}
                
            </section>